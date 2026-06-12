<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderManageController extends Controller
{
    public function index(Request $request)
    {
        $query = Order::with(['user', 'pricingPlan'])->latest();

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('invoice', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        $orders = $query->paginate(20);

        $counts = [
            'total' => Order::count(),
            'pending' => Order::where('status', 'pending')->count(),
            'paid' => Order::where('status', 'paid')->count(),
            'active' => Order::where('status', 'active')->count(),
            'cancelled' => Order::where('status', 'cancelled')->count(),
        ];

        $revenueOrders = Order::where('status', 'active')->get();
        $totalRevenue = $revenueOrders->sum(fn($o) => $o->amount);

        return view('admin.orders.index', compact('orders', 'counts', 'totalRevenue'));
    }

    public function show(Order $order)
    {
        $order->load(['user', 'pricingPlan']);
        return view('admin.orders.show', compact('order'));
    }

    public function markPaid(Order $order)
    {
        if ($order->status !== 'pending') {
            return back()->with('error', 'Order sudah diproses.');
        }

        $order->update([
            'status' => 'paid',
            'paid_at' => now(),
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Status order diubah menjadi Lunas.');
    }

    public function activate(Order $order)
    {
        if ($order->status !== 'paid') {
            return back()->with('error', 'Order harus berstatus Lunas terlebih dahulu.');
        }

        $order->update([
            'status' => 'active',
            'activated_at' => now(),
        ]);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Pelanggan berhasil diaktifkan.');
    }

    public function cancel(Order $order)
    {
        if (!in_array($order->status, ['pending', 'paid'])) {
            return back()->with('error', 'Tidak dapat membatalkan order ini.');
        }

        $order->update(['status' => 'cancelled']);

        return redirect()->route('admin.orders.show', $order)
            ->with('success', 'Order dibatalkan.');
    }

    public function destroy(Order $order)
    {
        if (!in_array($order->status, ['cancelled', 'pending'])) {
            return back()->with('error', 'Hanya pesanan dibatalkan atau pending yang dapat dihapus.');
        }

        $order->delete();

        return redirect()->route('admin.orders.index')
            ->with('success', 'Pesanan berhasil dihapus.');
    }

    public function printInvoice(Order $order)
    {
        $order->load(['user', 'pricingPlan']);
        return view('admin.orders.invoice', compact('order'));
    }
}
