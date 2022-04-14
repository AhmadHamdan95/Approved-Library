<?php

namespace App\Providers;

use App\Models\Cart\Cart;
use App\Models\Categories\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('customerId', function($app){
            $customerId = Auth::guard('customer')->id();
            return $customerId;
        });

        $this->app->bind('categories', function($app){
            $categories = Category::all();
            return $categories;
        });

        $this->app->bind('cartCount', function($app){
            $customerId = Auth::guard('customer')->id();
            $cartlist = Cart::where('customer_id', '=', $customerId)->get();
            $cartCount = $cartlist->count();
            return $cartCount;
        });

        $this->app->bind('wishlistCount', function($app){
            $customer = Auth::guard('customer')->user();
            $wishlist = $customer->wishlist;
            return $wishlist->count();
        });

        $this->app->bind('getCartByCustomerId', function($app){
            $customerId = Auth::guard('customer')->id();
            return Cart::query()
            ->with(['book'])
            ->where('customer_id', $customerId)
            ->get();
        });

        $this->app->bind('total', function($app){
            $customerId = Auth::guard('customer')->id();
            $cart = Cart::query()
            ->with(['book'])
            ->where('customer_id', $customerId)
            ->get();
            $total = $cart->sum('total');
            return $total;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
    }
}
