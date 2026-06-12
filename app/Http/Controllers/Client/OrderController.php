<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PricingPlan;
use App\Services\MidtransService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function create(PricingPlan $pricingPlan)
    {
        if (!$pricingPlan->is_active) {
            return redirect()->route('harga')->with('error', 'Paket tidak tersedia.');
        }

        return view('client.orders.checkout', compact('pricingPlan'));
    }

    public function store(Request $request, PricingPlan $pricingPlan)
    {
        if (!$pricingPlan->is_active) {
            return redirect()->route('harga')->with('error', 'Paket tidak tersedia.');
        }

        $duration = $request->input('duration', '1month');
        $monthly = $pricingPlan->price['bulanan'] ?? 0;
        $multiplier = match ($duration) {
            '6month' => 6,
            '12month' => 12,
            default => 1,
        };
        $price = $monthly * $multiplier;

        $invoice = 'INV-' . now()->format('Ymd') . '-' . strtoupper(substr(uniqid(), -5));

        $order = Order::create([
            'user_id' => Auth::id(),
            'pricing_plan_id' => $pricingPlan->id,
            'duration' => $duration,
            'invoice' => $invoice,
            'amount' => $price,
            'status' => 'pending',
        ]);

        try {
            $midtrans = new MidtransService();

            $durationLabel = $order->getDurationLabel();
            $itemName = 'Paket ' . $pricingPlan->name . ' (' . $durationLabel . ')';

            $params = [
                'transaction_details' => [
                    'order_id' => $invoice,
                    'gross_amount' => (int) $price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone,
                ],
                'item_details' => [
                    [
                        'id' => $pricingPlan->id,
                        'price' => (int) $price,
                        'quantity' => 1,
                        'name' => $itemName,
                    ],
                ],
            ];

            $snapToken = $midtrans->getSnapToken($params);

            return view('client.orders.payment', compact('snapToken', 'order'));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            Log::error('Midtrans error: ' . $msg);
            return redirect()->route('client.orders.index')
                ->with('error', $msg);
        }
    }

    public function pay(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return redirect()->route('client.orders.show', $order)
                ->with('error', 'Pesanan ini sudah diproses.');
        }

        if ($order->transaction_id) {
            return redirect()->route('client.orders.show', $order)
                ->with('info', 'Pesanan ini sudah memiliki transaksi pembayaran. Silakan selesaikan pembayaran.');
        }

        $price = $order->amount;

        try {
            $midtrans = new MidtransService();

            $durationLabel = $order->getDurationLabel();
            $itemName = 'Paket ' . ($order->pricingPlan->name ?? '') . ($durationLabel !== '-' ? ' (' . $durationLabel . ')' : '');

            $params = [
                'transaction_details' => [
                    'order_id' => $order->invoice . '-R' . $order->id,
                    'gross_amount' => (int) $price,
                ],
                'customer_details' => [
                    'first_name' => Auth::user()->name,
                    'email' => Auth::user()->email,
                    'phone' => Auth::user()->phone,
                ],
                'item_details' => [
                    [
                        'id' => $order->pricingPlan->id,
                        'price' => (int) $price,
                        'quantity' => 1,
                        'name' => $itemName,
                    ],
                ],
            ];

            $snapToken = $midtrans->getSnapToken($params);

            return view('client.orders.payment', compact('snapToken', 'order'));
        } catch (Exception $e) {
            $msg = $e->getMessage();
            Log::error('Midtrans retry error: ' . $msg);
            return redirect()->route('client.orders.show', $order)
                ->with('error', $msg);
        }
    }

    public function paymentCallback(Request $request)
    {
        try {
            $payload = $request->all();
            $orderId = $payload['order_id'] ?? '';
            $invoice = preg_replace('/-R\d+$/', '', $orderId);
            $order = Order::where('invoice', $invoice)->first();

            if (!$order || $order->user_id !== Auth::id()) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($order->status === 'paid' || $order->status === 'active') {
                return response()->json(['message' => 'OK', 'status' => $order->status]);
            }

            $transactionStatus = $payload['transaction_status'] ?? '';
            $fraudStatus = $payload['fraud_status'] ?? 'accept';
            $paymentMethod = $payload['payment_type'] ?? '';
            $transactionId = $payload['transaction_id'] ?? '';

            $vaNumbers = $payload['va_numbers'] ?? [];
            if (!empty($vaNumbers[0]['bank'])) {
                $paymentChannel = $vaNumbers[0]['bank'] . ' - ' . ($vaNumbers[0]['va_number'] ?? '');
            } elseif (!empty($payload['payment_code'])) {
                $paymentChannel = $payload['payment_code'];
            } elseif (!empty($payload['store'])) {
                $paymentChannel = $payload['store'];
            } else {
                $paymentChannel = $payload['payment_type'] ?? '';
            }

            if (in_array($transactionStatus, ['capture', 'settlement'])) {
                if ($fraudStatus === 'accept') {
                    $order->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                        'payment_method' => $paymentMethod,
                        'payment_channel' => $paymentChannel,
                        'transaction_id' => $transactionId,
                        'payment_details' => $payload,
                    ]);
                    Log::info("Order {$order->invoice} marked as paid via callback");
                }
            } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                $order->update([
                    'status' => 'cancelled',
                    'payment_details' => $payload,
                ]);
            } elseif ($transactionStatus === 'pending') {
                $order->update([
                    'payment_method' => $paymentMethod,
                    'payment_channel' => $paymentChannel,
                    'transaction_id' => $transactionId,
                    'payment_details' => $payload,
                ]);
            }

            return response()->json(['message' => 'OK', 'status' => $order->status]);
        } catch (Exception $e) {
            Log::error('Payment callback error: ' . $e->getMessage());
            return response()->json(['message' => 'Error'], 500);
        }
    }

    public function index(Request $request)
    {
        $query = Order::where('user_id', Auth::id())
            ->with('pricingPlan');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $s = $request->search;
            $query->where('invoice', 'like', "%{$s}%");
        }

        $orders = $query->latest()->get();

        return view('client.orders.index', compact('orders'));
    }

    public function show(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $paymentStatus = $request->query('status');

        return view('client.orders.show', compact('order', 'paymentStatus'));
    }

    public function edit(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending' || $order->transaction_id) {
            return redirect()->route('client.orders.show', $order)
                ->with('error', 'Pesanan ini tidak dapat diedit.');
        }

        $pricingPlans = \App\Models\PricingPlan::where('is_active', true)->get();
        return view('client.orders.edit', compact('order', 'pricingPlans'));
    }

    public function update(Request $request, Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending' || $order->transaction_id) {
            return redirect()->route('client.orders.show', $order)
                ->with('error', 'Pesanan ini tidak dapat diedit.');
        }

        $request->validate([
            'pricing_plan_id' => 'required|exists:pricing_plans,id',
            'duration' => 'required|in:1month,6month,12month',
        ]);

        $plan = \App\Models\PricingPlan::findOrFail($request->pricing_plan_id);

        if (!$plan->is_active) {
            return back()->with('error', 'Paket tidak tersedia.');
        }

        $duration = $request->duration;
        $monthly = $plan->price['bulanan'] ?? 0;
        $multiplier = match ($duration) {
            '6month' => 6,
            '12month' => 12,
            default => 1,
        };

        $order->update([
            'pricing_plan_id' => $plan->id,
            'duration' => $duration,
            'amount' => $monthly * $multiplier,
        ]);

        return redirect()->route('client.orders.show', $order)
            ->with('success', 'Pesanan berhasil diperbarui.');
    }

    public function cancel(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if ($order->status !== 'pending') {
            return redirect()->route('client.orders.show', $order)
                ->with('error', 'Pesanan ini tidak dapat dibatalkan.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('client.orders.index')
            ->with('success', 'Pesanan berhasil dibatalkan.');
    }

    public function destroy(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        if (!in_array($order->status, ['cancelled']) && !($order->status === 'pending' && !$order->transaction_id)) {
            return redirect()->route('client.orders.show', $order)
                ->with('error', 'Pesanan ini tidak dapat dihapus.');
        }

        $order->delete();

        return redirect()->route('client.orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    public function printInvoice(Order $order)
    {
        if ($order->user_id !== Auth::id()) {
            abort(403);
        }

        $order->load('pricingPlan');
        return view('client.orders.invoice', compact('order'));
    }
}
