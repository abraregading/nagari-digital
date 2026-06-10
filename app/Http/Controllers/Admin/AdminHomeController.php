<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Product;
use App\Models\Stat;
use App\Models\Testimonial;

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

        return view('admin.home.index', compact(
            'productCount', 'testimonialCount', 'nagariCount',
            'messageCount', 'unreadCount', 'recentMessages'
        ));
    }
}
