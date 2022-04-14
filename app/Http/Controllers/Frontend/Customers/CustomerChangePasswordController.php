<?php

namespace App\Http\Controllers\Frontend\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\Customers\ChangePasswordRequest;
use App\Repositories\Frontend\Customers\CustomerRepository;
use Illuminate\Support\Facades\Hash;

class CustomerChangePasswordController extends Controller
{
    public function update(ChangePasswordRequest $request, CustomerRepository $customerRepo)
    {
        $data = $request->validated();
        $customerId = app('customerId');
        $model = $customerRepo->update($customerId, ['password' => Hash::make($data['password'])]);
        if(! $model){
            $request->session()->flash('data', [
                'title' => 'danger',
                'message' => 'Error While Changing',
            ]);
            return redirect()->back();
        }
        $request->session()->flash('data', [
            'title' => 'success',
            'message' => 'Changed Successfully',
        ]);
        return redirect()->back();
    }
}