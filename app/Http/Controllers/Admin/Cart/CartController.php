<?php

namespace App\Http\Controllers\Admin\Cart;

use App\Http\Controllers\Controller;
use App\Repositories\Admin\Cart\CartRepository;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(CartRepository $cartRepo)
    {
        $items = $cartRepo->getCartItems(20);
        return response()->view('admin.cart.index', ['items' => $items]);
    }

    public function destroy(Request $request, CartRepository $cartRepo, $id)
    {
        $item = $cartRepo->getCartItem($id);
        $delete = $cartRepo->destroy($id);

        if (!$delete) {
            $request->session()->flash('data', [
                'title' => 'Error',
                'code' => 400,
                'message' => 'Error While Deleting'
            ]);
            return redirect()->route('admin.cart.index');
        }

        $request->session()->flash('data', [
            'title' => 'success',
            'code' => 200,
            'message' => 'Deleted Successfully'
        ]);
        return redirect()->route('admin.cart.index');
    }
}
