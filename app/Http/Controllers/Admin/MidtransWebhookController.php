<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Services\MidtransService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MidtransWebhookController extends Controller
{
    public function handle(Request $request)
    {
        Log::info('Midtrans webhook received', $request->all());

        try {
            $midtrans = new MidtransService();
            $notification = $midtrans->verifyNotification($request->all());

            $orderId = $notification['order_id'];
            $transactionStatus = $notification['transaction_status'];
            $fraudStatus = $notification['fraud_status'];

            $invoice = preg_replace('/-R\d+$/', '', $orderId);
            $order = Order::where('invoice', $invoice)->first();

            if (!$order) {
                Log::warning("Order not found: {$orderId}");
                return response()->json(['message' => 'Order not found'], 404);
            }

            $paymentMethod = $notification['payment_type'];
            $transactionId = $notification['transaction_id'];
            $paymentChannel = $notification['payment_channel'];
            $payload = $notification['payload'];

            if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
                if ($fraudStatus == 'accept') {
                    $order->update([
                        'status' => 'paid',
                        'paid_at' => now(),
                        'payment_method' => $paymentMethod,
                        'payment_channel' => $paymentChannel,
                        'transaction_id' => $transactionId,
                        'payment_details' => $payload,
                    ]);

                    Log::info("Order {$orderId} marked as paid via webhook");
                }
            } elseif (in_array($transactionStatus, ['deny', 'cancel', 'expire'])) {
                $order->update([
                    'status' => 'cancelled',
                    'payment_details' => $payload,
                ]);

                Log::info("Order {$orderId} cancelled via webhook: {$transactionStatus}");
            } elseif ($transactionStatus == 'pending') {
                $order->update([
                    'payment_method' => $paymentMethod,
                    'payment_channel' => $paymentChannel,
                    'transaction_id' => $transactionId,
                    'payment_details' => $payload,
                ]);
            }

            return response()->json(['message' => 'OK']);
        } catch (Exception $e) {
            Log::error('Midtrans webhook error: ' . $e->getMessage());
            return response()->json(['message' => 'Error'], 500);
        }
    }
}
