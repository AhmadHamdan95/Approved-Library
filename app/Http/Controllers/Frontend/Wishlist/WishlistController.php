<?php

namespace App\Http\Controllers\Frontend\Wishlist;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index()
    {
        $categories = app('categories');
        $cart = app('getCartByCustomerId');
        $cartCount = app('cartCount');
        $wishlistCount = app('wishlistCount');
        $total = app('total');
        $customer = Auth::guard('customer')->user();
        $wishlist = $customer->wishlist;
        return response()->view('frontend.wishlist.index', [
            'categories' => $categories, 
            'cart' => $cart,
            'cartCount' => $cartCount,
            'wishlistCount' => $wishlistCount,
            'total' => $total,
            'wishlist' => $wishlist,
        ]);
    }

    public function store()
    {
        // $data = $request->input('bookId');        
        // $customer = Auth::guard('customer')->user();
        // if(!$customer->getWishlistIfExist($data)){
        //     $customer->wishlist()->attach($data);
        // }else{
        //     $customer->wishlist()->detach($data);
        // }
        // return redirect()->back();

        $customer = Auth::guard('customer')->user();
        if(!$customer->getWishlistIfExist(request('bookId'))){
            $customer->wishlist()->attach(request('bookId'));
            return response()->json(['wishlist' => true]);
        }else{
            $customer->wishlist()->detach(request('bookId'));
            return response()->json(['wishlist' => false]);
        }
    }

    public function destroy(Request $request, $id)
    {
        $customer = Auth::guard('customer')->user();
        $customer->wishlist()->detach($id);
        $request->session()->flash('data', [
            'title' => 'success',
            'message' => 'Deleted Successfully',
        ]);
        return redirect()->back();
    }
}
