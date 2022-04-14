<?php

namespace App\Repositories\Frontend\Orderes;

use App\Models\Orders\Order;

class OrderRepository{
    public function getOrder($id)
    {
        return Order::query()->findOrFail($id);
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