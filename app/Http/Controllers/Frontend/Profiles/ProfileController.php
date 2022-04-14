<?php

namespace App\Http\Controllers\Frontend\Profiles;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Customers\CustomerDetailsRequest;
use App\Models\Countries\Country;
use App\Models\Orders\Order;
use App\Repositories\Frontend\Customers\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(CustomerRepository $customerRepo)
    {
        $categories = app('categories');
        $cart = app('getCartByCustomerId');
        $cartCount = app('cartCount');
        $wishlistCount = app('wishlistCount');
        $total = app('total');
        $customerId = app('customerId');
        $orders = Order::where('customer_id', $customerId)->get();
        $customer = Auth::guard('customer')->user();
        $countries = Country::all();
        return response()->view('frontend.profiles.index', [
            'categories' => $categories, 
            'cart' => $cart,
            'cartCount' => $cartCount,
            'wishlistCount' => $wishlistCount,
            'total' => $total,
            'orders' => $orders,
            'customer' => $customer,
            'countries' => $countries,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerDetailsRequest $request, CustomerRepository $customerRepo)
    {
        $data = $request->validated();
        $customerId = app('customerId');
        $model = $customerRepo->update($customerId, $data);
        if(! $model){
            $request->session()->flash('data', [
                'title' => 'danger',
                'message' => 'Error While Updating',
            ]);
            return redirect()->back();
        }
        $request->session()->flash('data', [
            'title' => 'success',
            'message' => 'Updated Successfully',
        ]);
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
