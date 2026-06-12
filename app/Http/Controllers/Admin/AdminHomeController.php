<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Order;
use App\Models\Product;
use App\Models\Stat;
use App\Models\Testimonial;
use App\Models\User;

class AdminHomeController extends Controller
{
    public function index()
    {
        $productCount = Product::count();
        $testimonialCount = Testimonial::count();
        $nagariCount = Stat::where('label', 'like', '%Nagari Terdaftar%')->first()?->count ?? 50;
        $messageCount = Message::count();
        $unreadCount = Message::where('is_read', false)->count();
        $recentMessages = Message::latest()->take(5)->get();

        $newOrderCount = Order::where('status', 'pending')->count();
        $recentOrders = Order::with('user', 'pricingPlan')->latest()->take(5)->get();
        $totalRevenue = Order::where('status', 'active')->sum('amount');
        $clientCount = User::where('role', 'client')->count();
        $activeOrderCount = Order::where('status', 'active')->count();
        $paidOrderCount = Order::where('status', 'paid')->count();

        return view('admin.home.index', compact(
            'productCount', 'testimonialCount', 'nagariCount',
            'messageCount', 'unreadCount', 'recentMessages',
            'newOrderCount', 'recentOrders', 'totalRevenue',
            'clientCount', 'activeOrderCount', 'paidOrderCount'
        ));
    }
}
