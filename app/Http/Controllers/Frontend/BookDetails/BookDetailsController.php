<?php

namespace App\Http\Controllers\Frontend\BookDetails;

use App\Http\Controllers\Controller;
use App\Repositories\Frontend\Books\BookRepository;
use Illuminate\Http\Request;

class BookDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(BookRepository $bookRepo, $id)
    {
        $categories = app('categories');
        $cart = app('getCartByCustomerId');
        $cartCount = app('cartCount');
        $wishlistCount = app('wishlistCount');
        $total = app('total');
        $book = $bookRepo->getBook($id);
        return response()->view('frontend.bookdetails.index', [
            'categories' => $categories, 
            'book' => $book, 
            'cart' => $cart,
            'total' => $total,
            'cartCount' => $cartCount,
            'wishlistCount' => $wishlistCount,
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
    public function update(Request $request, $id)
    {
        //
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
