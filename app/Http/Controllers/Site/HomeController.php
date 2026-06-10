<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\Product;
use App\Models\Stat;
use App\Models\Testimonial;
use App\Models\WhyChooseUs;
use App\Models\PricingPlan;
use App\Models\AboutSection;

class HomeController extends Controller
{
    public function index()
    {
        $stats = Stat::orderBy('order')->get();
        $products = Product::where('is_active', true)->orderBy('order')->get();
        $whyChooseUs = WhyChooseUs::orderBy('order')->get();
        $testimonials = Testimonial::where('is_active', true)->get();
        return view('site.home.index', compact('stats', 'products', 'whyChooseUs', 'testimonials'));
    }

    public function fitur()
    {
        $products = Product::where('is_active', true)->orderBy('order')->get();
        return view('site.fitur.index', compact('products'));
    }

    public function harga()
    {
        $pricingPlans = PricingPlan::where('is_active', true)->orderBy('order')->with('features')->get();
        $faqs = Faq::where('is_active', true)->orderBy('order')->get();
        return view('site.harga.index', compact('pricingPlans', 'faqs'));
    }

    public function tentang()
    {
        $aboutSections = AboutSection::where('is_active', true)->orderBy('order')->get();
        $stats = Stat::orderBy('order')->get();
        return view('site.tentang.index', compact('aboutSections', 'stats'));
    }

    public function kontak()
    {
        $faqs = Faq::where('is_active', true)->orderBy('order')->get();
        return view('site.kontak.index', compact('faqs'));
    }

    public function demo()
    {
        return view('site.demo.index');
    }
}
