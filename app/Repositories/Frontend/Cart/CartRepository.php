<?php

namespace App\Repositories\Frontend\Cart;

use App\Models\Cart\Cart;

class CartRepository{
    public function getCartItem($id)
    {
        return Cart::query()->findOrFail($id);
    }

    public function getCartByCustomerId($customerId)
    {
        return Cart::query()
        ->with(['book'])
        ->where('customer_id', $customerId)
        ->get();
    }

    public function getCartIfExist($customerId, $bookId){
        return Cart::query()
        ->where([
            'customer_id' => $customerId,
            'book_id' => $bookId
        ])->first();
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