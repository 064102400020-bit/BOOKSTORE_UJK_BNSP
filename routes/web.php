<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

// Halaman Publik & User
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/about', [HomeController::class, 'about'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact.index');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Pengalihan otomatis setelah Login / Register
Route::get('/dashboard', function () {
    if (auth()->user()->role === 'admin') {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('home');
})->middleware(['auth'])->name('dashboard');

// Fitur Khusus User (Wajib Login)
Route::middleware(['auth', 'role:user'])->group(function () {
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart/{book}', [CartController::class, 'store'])->name('cart.store');
    Route::delete('/cart/{cart}', [CartController::class, 'destroy'])->name('cart.destroy');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout.process');
    Route::get('/orders/{order}', [CheckoutController::class, 'show'])->name('orders.show');
    Route::post('/orders/{order}/pay', [CheckoutController::class, 'simulatePay'])->name('orders.pay');
    Route::get('/checkout/pay/{order}', [CheckoutController::class, 'pay'])->name('checkout.pay');
    Route::get('/checkout/success/{order}', [CheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/my-orders', [CheckoutController::class, 'myOrders'])->name('orders.my');
});

// Fitur Khusus Admin
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');

    Route::resource('categories', CategoryController::class)->except(['create', 'show', 'edit']);
    Route::resource('books', BookController::class)->except(['create', 'show', 'edit']);
});

require __DIR__.'/auth.php';