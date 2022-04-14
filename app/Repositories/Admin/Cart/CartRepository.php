<?php

namespace App\Repositories\Admin\Cart;

use App\Models\Cart\Cart;

class CartRepository{
    public function getCartItem($id)
    {
        return Cart::query()->findOrFail($id);
    }

    public function getCartItems($perPage){
        return Cart::query()->paginate($perPage);
    }

    public function destroy($id)
    {
        return Cart::query()->findOrFail($id)->delete();
    }

    public function store(array $data)
    {
        return Cart::query()->create($data);
    }

    public function update($id, array $data)
    {
        return Cart::query()->findOrFail($id)->update($data);
    }
}