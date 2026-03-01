<?php

use App\Http\Controllers\Auth\authController;
use App\Http\Controllers\Cart\cartController;
use App\Http\Controllers\Order\orderController;
use App\Http\Controllers\Product\productController;
use App\Http\Controllers\Profile\profileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [authController::class, 'showLogin'])->name('login');
Route::post('/login', [authController::class, 'Login'])->name('login.process');
Route::get('/register', [authController::class, 'showRegister'])->name('register');
Route::post('/register', [authController::class, 'register'])->name('register.process');
Route::post('/logout', [authController::class, 'Logout'])->name('logout');

Route::middleware(['auth'])->prefix('buyer')->group(function () {

    Route::get('/home', [productController::class, 'showBuyerHome'])->name('buyer.home');

    Route::get('/products', [productController::class, 'showBuyerProduct'])->name('buyer.products');
    Route::get('/products/{product}', [productController::class, 'showBuyerProductDetail'])->name('buyer.product.show');

    Route::post('/cart/add/{product}', [cartController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart', [cartController::class, 'showCart'])->name('cart.index');
    Route::put('/cart/update/{cartItem}', [cartController::class, 'updateQuantity'])->name('cart.update');
    Route::delete('/cart/remove/{cartItem}', [cartController::class, 'remove'])->name('cart.remove');

    Route::post('/checkout', [orderController::class, 'checkOut'])->name('order.checkout');

    Route::get('/orders', [orderController::class, 'buyerOrders'])->name('buyer.orders');

    Route::get('/profile', [profileController::class, 'edit'])->name('buyer.profile.edit');
    Route::put('/profile', [profileController::class, 'update'])->name('buyer.profile.update');
    Route::put('/profile/password', [profileController::class, 'updatePassword'])->name('buyer.profile.password');
});

Route::middleware(['auth'])->prefix('seller')->group(function () {

    // Dashboard
    Route::get('/', [productController::class, 'sellerDashboard'])->name('seller.dashboard');
    Route::get('/dashboard', [productController::class, 'sellerDashboard']);

    // Products
    Route::get('/products', [productController::class, 'showSellerProduct'])->name('seller.products');
    Route::get('/products/create', [productController::class, 'create'])->name('seller.products.create');
    Route::post('/products', [productController::class, 'store'])->name('seller.products.store');
    Route::get('/products/{product}/edit', [productController::class, 'edit'])->name('seller.products.edit');
    Route::put('/products/{product}', [productController::class, 'update'])->name('seller.products.update');
    Route::delete('/products/{product}', [productController::class, 'destroy'])->name('seller.products.destroy');

    // Orders
    Route::get('/orders', [orderController::class, 'sellerOrders'])->name('seller.orders');
    Route::patch('/orders/{order}/status', [orderController::class, 'updateStatus'])->name('seller.orders.updateStatus');

    // Profile
    Route::get('/profile', [profileController::class, 'sellerEdit'])->name('seller.profile.edit');
    Route::put('/profile', [profileController::class, 'update'])->name('seller.profile.update');
    Route::put('/profile/password', [profileController::class, 'updatePassword'])->name('seller.profile.password');
});

