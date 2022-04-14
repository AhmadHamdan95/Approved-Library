<?php

namespace App\Http\Controllers\Frontend\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Cart\CreateCartRequest;
use App\Repositories\Frontend\Books\BookRepository;
use App\Repositories\Frontend\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $categories = app('categories');
        $cartCount = app('cartCount');
        $wishlistCount = app('wishlistCount');
        $cart = app('getCartByCustomerId');
        $total = $cart->sum('total');
       
        return response()->view('frontend.cart.index', [
            'categories' => $categories, 
            'cart' => $cart, 
            'total' => $total, 
            'cartCount' => $cartCount,
            'wishlistCount' => $wishlistCount,
        ]);        
    }

    public function store(CreateCartRequest $request, CartRepository $cartRepo, BookRepository $bookRepo)
    {
        $data = $request->validated();
        $customerId = app('customerId');
        $data += ['customer_id' => $customerId];
        $book = $bookRepo->getBook($data['book_id']);

        $cart = $cartRepo->getCartIfExist($customerId, $data['book_id']);

        if($cart){
            if(($cart->quantity + $data['quantity']) <= $book->quantity){
                $model = $cartRepo->update($cart->id, ['quantity' => $cart->quantity + $data['quantity']]);
            }else{
                return redirect()->back()->withErrors([
                    'message' => 'There is only ' . $book->quantity . ' books in the store!',
                ]);
            }
        }else{
            if($data['quantity'] <= $book->quantity){
                $model = $cartRepo->store($data);
            }else{
                return redirect()->back()->withErrors([
                    'message' => 'There is only (' . $book->quantity . ') ' . $book->name . ' in the store!',
                ]);
            }
        }

        if(! $model){
            $request->session()->flash('data', [
                'title' => 'danger',
                'message' => 'Error While Adding',
            ]);
            return redirect()->back();
        }
        $request->session()->flash('data', [
            'title' => 'success',
            'message' => 'Added Successfully',
        ]);
        return redirect()->back();
    }

    public function update(Request $request, CartRepository $cartRepo)
    {
        $data = $request->all();
        // foreach($data['quantity'] as $key => $value)
        // {
        //     echo $key . ' - ' . $value . '<br />';
        // }
        $items = app('getCartByCustomerId');
        if($items->count() > 0){
            foreach($data['quantity'] as $key => $value)
            {
                $cart = $cartRepo->getCartItem($key);
                $book = $cart->book;
                if($value <= $book->quantity){
                    $cartRepo->update($key, ['quantity' => $value]);
                }
            }
            return redirect()->back();
        }else{
            return redirect()->back()->withErrors([
                'message' => 'Your cart is empty!',
            ]);
        }
    }

    public function destroy(CartRepository $cartRepo, Request $request, $id)
    {
        $model = $cartRepo->destroy($id);
        if(! $model){
            $request->session()->flash('data', [
                'title' => 'danger',
                'message' => 'Error While Deleting',
            ]);
            return redirect()->back();
        }
        $request->session()->flash('data', [
            'title' => 'success',
            'message' => 'Deleted Successfully',
        ]);
        return redirect()->back();
    }
}
