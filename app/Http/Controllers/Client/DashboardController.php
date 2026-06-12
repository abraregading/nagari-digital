<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\PricingPlan;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $orders = Order::where('user_id', $user->id)
            ->with('pricingPlan')
            ->latest()
            ->get();

        $totalOrders = $orders->count();
        $activeOrders = $orders->where('status', 'active')->count();
        $pendingOrders = $orders->where('status', 'pending')->count();

        return view('client.dashboard.index', compact(
            'user', 'orders', 'totalOrders', 'activeOrders', 'pendingOrders'
        ));
    }
}
