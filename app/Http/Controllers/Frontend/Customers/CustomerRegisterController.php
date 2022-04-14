<?php

namespace App\Http\Controllers\Frontend\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Customers\CustomerRegisterRequest;
use App\Repositories\Frontend\Customers\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class CustomerRegisterController extends Controller
{
    public function create()
    {
        $categories = app('categories');
        $cart = app('getCartByCustomerId');
        $cartCount = app('cartCount');
        $wishlistCount = app('wishlistCount');
        $total = app('total');
        return response()->view('frontend.customers.register', [
            'categories' => $categories, 
            'cart' => $cart,
            'cartCount' => $cartCount,
            'wishlistCount' => $wishlistCount,
            'total' => $total,
        ]);
    }

    public function store(CustomerRegisterRequest $request, CustomerRepository $customerRepo)
    {
        $data = $request->validated();
        $credentials = ['email' => $data['email'], 'password' => $data['password']];
        $data['password'] = Hash::make($data['password']);
        $model = $customerRepo->store($data);

        if(! $model){
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Adding',
            ]);
            return redirect()->back();
        }
        
        $request->session()->flash('data', [
            'title' => 'Success',
            'code' => 200,
            'message' => 'Added Successfully',
        ]);

        if(Auth::guard('customer')->attempt($credentials))
        {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
    }
}