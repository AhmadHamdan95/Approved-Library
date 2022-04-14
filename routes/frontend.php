<?php

use App\Http\Controllers\Frontend\Auth\AuthController;
use App\Http\Controllers\Frontend\BookDetails\BookDetailsController;
use App\Http\Controllers\Frontend\Books\BookController;
use App\Http\Controllers\Frontend\Cart\CartController;
use App\Http\Controllers\Frontend\Checkout\CheckoutController;
use App\Http\Controllers\Frontend\Customers\CustomerChangePasswordController;
use App\Http\Controllers\Frontend\Customers\CustomerRegisterController;
use App\Http\Controllers\Frontend\Home\HomeController;
use App\Http\Controllers\Frontend\Orders\OrderController;
use App\Http\Controllers\Frontend\Profiles\ProfileController;
use App\Http\Controllers\Frontend\Wishlist\WishlistController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest:customer')->group(function(){
    Route::get('/login', [AuthController::class, 'index'])->name('loginPage');
    Route::post('/login', [AuthController::class, 'update'])->name('login');
    Route::get('/register', [CustomerRegisterController::class, 'create'])->name('registerPage');
    Route::post('/register', [CustomerRegisterController::class, 'store'])->name('register');
});

Route::middleware('auth:customer')->group(function(){
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::put('/change-password', [CustomerChangePasswordController::class, 'update'])->name('customers.updatePassword');

    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/books/{category_id?}', [BookController::class, 'index'])->name('books.index');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::post('/cart', [CartController::class, 'store'])->name('cart.store');
    Route::put('/cart/update', [CartController::class, 'update'])->name('cart.update');
    Route::get('/cart/destroy/{id}', [CartController::class, 'destroy'])->name('cart.destroy');
    Route::get('/bookdetails/{id}', [BookDetailsController::class, 'index'])->name('bookdetails.index');
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [CheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/my-profile', [ProfileController::class, 'index'])->name('profile.index');
    Route::put('/my-profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/orders/{id}', [OrderController::class, 'index'])->name('orders.index');
    Route::get('/wishlist', [WishlistController::class, 'index'])->name('wishlist.index');
    Route::post('/wishlist', [WishlistController::class, 'store'])->name('wishlist.store');
    Route::get('/wishlist/destroy/{id}', [WishlistController::class, 'destroy'])->name('wishlist.destroy');
});