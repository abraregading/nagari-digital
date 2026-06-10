<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MessageController;

// ===== SITE ROUTES =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/fitur', [HomeController::class, 'fitur'])->name('fitur');
Route::get('/harga', [HomeController::class, 'harga'])->name('harga');
Route::get('/tentang', [HomeController::class, 'tentang'])->name('tentang');
Route::get('/kontak', [HomeController::class, 'kontak'])->name('kontak');
Route::get('/demo', [HomeController::class, 'demo'])->name('demo');

Route::post('/kontak', [MessageController::class, 'store'])->name('kontak.store');

// ===== AUTH ROUTES =====
Route::get('/login', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'authenticate'])->name('authenticate');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// ===== ADMIN ROUTES =====
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('home');

    // Resource routes for admin CRUD
    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'updateAll'])->name('settings.update');
    Route::resource('stats', \App\Http\Controllers\Admin\StatController::class)->except(['show']);
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
    Route::resource('why-choose-us', \App\Http\Controllers\Admin\WhyChooseUsController::class)->except(['show']);
    Route::resource('testimonials', \App\Http\Controllers\Admin\TestimonialController::class)->except(['show']);
    Route::resource('pricing-plans', \App\Http\Controllers\Admin\PricingPlanController::class)->only(['index', 'edit', 'update']);
    Route::resource('faqs', \App\Http\Controllers\Admin\FaqController::class)->except(['show']);
    Route::post('pricing-plans/{pricing_plan}/toggle-popular', [\App\Http\Controllers\Admin\PricingPlanController::class, 'togglePopular'])->name('pricing-plans.toggle');
    Route::resource('about-sections', \App\Http\Controllers\Admin\AboutSectionController::class)->only(['index', 'edit', 'update']);
    Route::resource('messages', \App\Http\Controllers\Admin\MessageController::class)->only(['index', 'show', 'destroy']);

    Route::patch('/messages/{message}/read', [\App\Http\Controllers\Admin\MessageController::class, 'markRead'])->name('messages.read');
});
