<?php

namespace App\Http\Controllers\Admin\Customers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Customers\EditCustomerRequest;
use App\Repositories\Admin\Customers\CustomerRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(CustomerRepository $customerRepo)
    {
        $customers = $customerRepo->getCustomers(20);
        return response()->view('admin.customers.index', ['customers' => $customers]);
    }

    public function edit(CustomerRepository $customerRepo, $id)
    {
        $customer = $customerRepo->getCustomer($id);
        return response()->view('admin.customers.edit', ['customer' => $customer]);
    }

    public function update(EditCustomerRequest $request, CustomerRepository $customerRepo, $id)
    {
        $data = $request->validated();
        $customer = $customerRepo->getCustomer($id);

        if(isset($data['image'])){
            $imageName = rand() . '.' . $data['image']->getClientOriginalExtension();
            $data['image']->storeAs('/customers', $imageName, ['disk' => 'public']);
            $data['image'] = 'customers/' . $imageName;
            Storage::disk('public')->delete($customer->image);
        }else{
            $data['image'] = $customer->image;
        }

        $model = $customerRepo->update($id, $data);

        if(!$model){
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Updating'
            ]);
            return redirect()->route('admin.customers.index');
        }

        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Updated Successfully'
        ]);
        return redirect()->route('admin.customers.index');
    }

    public function destroy(Request $request, CustomerRepository $customerRepo, $id)
    {
        $customer = $customerRepo->getCustomer($id);
        $delete = $customerRepo->destroy($id);

        if (!$delete) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Deleting'
            ]);
            return redirect()->route('admin.customers.index');
        }

        Storage::disk('public')->delete($customer->image);
        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Deleted Successfully'
        ]);
        return redirect()->route('admin.customers.index');
    }
}
