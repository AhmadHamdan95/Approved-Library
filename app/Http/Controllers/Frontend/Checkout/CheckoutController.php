<?php

namespace App\Http\Controllers\Frontend\Checkout;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Checkout\CheckoutRequest;
use App\Models\Countries\Country;
use App\Repositories\Frontend\Books\BookRepository;
use App\Repositories\Frontend\Cart\CartRepository;
use App\Repositories\Frontend\OrderAddresses\OrderAddressRepository;
use App\Repositories\Frontend\Orderes\OrderRepository;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Throwable;

class CheckoutController extends Controller
{
    public function index()
    {
        $items = app('getCartByCustomerId');
        if($items->count() > 0){
            foreach($items as $item){
                if($item->quantity > $item->book->quantity){
                    return redirect()->back()->withErrors([
                        'message' => 'The quantity in the store is not enough!',
                    ]);
                }
            }
            $categories = app('categories');
            $cartCount = app('cartCount');
            $wishlistCount = app('wishlistCount');
            $total = app('total');
            $customer = Auth::guard('customer')->user();
            $countries = Country::all();
            return response()->view('frontend.checkout.index', [
                'categories' => $categories, 
                'cart' => $items, 
                'total' => $total, 
                'cartCount' => $cartCount,
                'wishlistCount' => $wishlistCount,
                'customer' => $customer,
                'countries' => $countries,
            ]);
        }else{
            return redirect()->back()->withErrors([
                'message' => 'Your cart is empty!',
            ]);
        }
    }

    public function store(CheckoutRequest $request, 
                        OrderAddressRepository $addressRepo, 
                        OrderRepository $orderRepo, 
                        CartRepository $cartRepo,
                        BookRepository $bookRepo)
    {
        $data = $request->validated();
        $items = app('getCartByCustomerId');
        if($items->count() > 0){
            foreach($items as $item){
                if($item->quantity > $item->book->quantity){
                    return redirect()->back()->withErrors([
                        'message' => 'The quantity in the store is not enough!',
                    ]);
                }
            }
            DB::beginTransaction();
            try{
                $address = $addressRepo->store($data);
                $customerId = app('customerId');
                $order = $orderRepo->store([
                    'customer_id' => $customerId,
                    'address_id' => $address->id,
                    'status' => 'pending',
                    'payment_status' => 'not_paid',
                ]);
                foreach($items as $item){
                    $order->items()->create([
                        'price' => $item->book->price,
                        'quantity' => $item->quantity,
                        'book_id' => $item->book_id,
                    ]);
                    $newQty = $item->book->quantity - $item->quantity;
                    $bookRepo->update($item->book_id, ['quantity' => $newQty]);
                    $cartRepo->destroy($item->id);
                }
                DB::commit();
            }catch(Throwable $e){
                DB::rollBack();
            }
            return redirect()->route('home');
        }else{
            return redirect()->back()->withErrors([
                'message' => 'Your cart is empty!',
            ]);
        }
    }
}
