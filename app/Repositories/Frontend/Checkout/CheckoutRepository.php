<?php

namespace App\Repositories\Frontend\Checkout;

use App\Models\Orders\Order;

class CheckoutRepository{
    public function getOrder($id)
    {
        return Order::query()->findOrFail($id);
    }

    public function getOrdersByCustomerId($customerId)
    {
        return Order::query()
        ->with(['items.book'])
        ->where('customer_id', $customerId)
        ->get();
    }

    public function getOrders($perPage){
        return Order::query()->paginate($perPage);
    }

    public function destroy($id)
    {
        return Order::query()->findOrFail($id)->delete();
    }

    public function store(array $data)
    {
        return Order::query()->create($data);
    }

    public function update($id, array $data)
    {
        return Order::query()->findOrFail($id)->update($data);
    }
}