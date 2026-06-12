<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Site\HomeController;
use App\Http\Controllers\Admin\AdminHomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Auth\RegisterController;
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

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminHomeController::class, 'index'])->name('home');

    Route::get('settings', [\App\Http\Controllers\Admin\SettingController::class, 'index'])->name('settings.index');
    Route::post('settings', [\App\Http\Controllers\Admin\SettingController::class, 'updateAll'])->name('settings.update');
    Route::get('settings/print-out', [\App\Http\Controllers\Admin\SettingController::class, 'printOutIndex'])->name('settings.print-out');
    Route::post('settings/print-out', [\App\Http\Controllers\Admin\SettingController::class, 'updatePrintOut'])->name('settings.print-out.update');
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

    Route::get('orders', [\App\Http\Controllers\Admin\OrderManageController::class, 'index'])->name('orders.index');
    Route::get('orders/{order}', [\App\Http\Controllers\Admin\OrderManageController::class, 'show'])->name('orders.show');
    Route::get('orders/{order}/invoice', [\App\Http\Controllers\Admin\OrderManageController::class, 'printInvoice'])->name('orders.invoice');
    Route::post('orders/{order}/mark-paid', [\App\Http\Controllers\Admin\OrderManageController::class, 'markPaid'])->name('orders.mark-paid');
    Route::post('orders/{order}/activate', [\App\Http\Controllers\Admin\OrderManageController::class, 'activate'])->name('orders.activate');
    Route::post('orders/{order}/cancel', [\App\Http\Controllers\Admin\OrderManageController::class, 'cancel'])->name('orders.cancel');
    Route::delete('orders/{order}', [\App\Http\Controllers\Admin\OrderManageController::class, 'destroy'])->name('orders.destroy');
});

// ===== CLIENT ROUTES =====
Route::middleware(['auth', 'role:client'])->prefix('client')->name('client.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
    Route::get('/orders', [\App\Http\Controllers\Client\OrderController::class, 'index'])->name('orders.index');
    Route::get('/orders/{order}', [\App\Http\Controllers\Client\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/invoice', [\App\Http\Controllers\Client\OrderController::class, 'printInvoice'])->name('orders.invoice');
    Route::get('/orders/{order}/pay', [\App\Http\Controllers\Client\OrderController::class, 'pay'])->name('orders.pay');
    Route::get('/orders/{order}/edit', [\App\Http\Controllers\Client\OrderController::class, 'edit'])->name('orders.edit');
    Route::put('/orders/{order}', [\App\Http\Controllers\Client\OrderController::class, 'update'])->name('orders.update');
    Route::post('/orders/{order}/cancel', [\App\Http\Controllers\Client\OrderController::class, 'cancel'])->name('orders.cancel');
    Route::delete('/orders/{order}', [\App\Http\Controllers\Client\OrderController::class, 'destroy'])->name('orders.destroy');
    Route::get('/checkout/{pricingPlan}', [\App\Http\Controllers\Client\OrderController::class, 'create'])->name('orders.create');
    Route::post('/checkout/{pricingPlan}', [\App\Http\Controllers\Client\OrderController::class, 'store'])->name('orders.store');
    Route::post('/payment/callback', [\App\Http\Controllers\Client\OrderController::class, 'paymentCallback'])->name('payment.callback');
});

// ===== MIDTRANS WEBHOOK =====
Route::post('/midtrans/webhook', [\App\Http\Controllers\Admin\MidtransWebhookController::class, 'handle'])
    ->name('midtrans.webhook');
