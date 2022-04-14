@extends('frontend.layout.master')

@section('title','Wishlist')

@section('style')
    
@endsection

@section('content')
<div class="site__body">
    <div class="page-header">
       <div class="page-header__container container">
          <div class="page-header__breadcrumb">
             <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                   <li class="breadcrumb-item">
                      <a href="index.html">Home</a> 
                      <svg class="breadcrumb-arrow" width="6px" height="9px">
                         <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                      </svg>
                   </li>
                   <li class="breadcrumb-item">
                      <a href="#">Breadcrumb</a> 
                      <svg class="breadcrumb-arrow" width="6px" height="9px">
                         <use xlink:href="images/sprite.svg#arrow-rounded-right-6x9"></use>
                      </svg>
                   </li>
                   <li class="breadcrumb-item active" aria-current="page">Wishlist</li>
                </ol>
             </nav>
          </div>
          <div class="page-header__title">
             <h1>Wishlist</h1>
          </div>
       </div>
    </div>
    @if ($errors->any())
      <div class="alert alert-danger alert-dismissible">
         <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
         <h5><i class="icon fas fa-ban"></i> Alert!</h5>
         <ul>
         @foreach ($errors->all() as $error)
               <li>{{$error}}</li>
         @endforeach
         </ul>
      </div>
   @endif
   @if (session()->has('data'))
    <div class="container">
      <div class="alert alert-{{session('data.title')}} alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
        <h5><i class="icon fas fa-check"></i> Alert!</h5>
        {{session('data.message')}}
      </div>
    </div>
    @endif
    <div class="block">
       <div class="container">
          <table class="wishlist">
             <thead class="wishlist__head">
                <tr class="wishlist__row">
                   <th class="wishlist__column wishlist__column--image">Image</th>
                   <th class="wishlist__column wishlist__column--product">Book</th>
                   <th class="wishlist__column wishlist__column--stock">Stock Status</th>
                   <th class="wishlist__column wishlist__column--price">Price</th>
                   <th class="wishlist__column wishlist__column--tocart"></th>
                   <th class="wishlist__column wishlist__column--remove"></th>
                </tr>
             </thead>
             <tbody class="wishlist__body">
                @foreach ($wishlist as $item)
                <tr class="wishlist__row">
                    <td class="wishlist__column wishlist__column--image">
                        <a href="{{route('bookdetails.index', $item->id)}}">
                            <img src="{{url(Storage::url($item->image))}}" alt="">
                        </a>
                    </td>
                    <td class="wishlist__column wishlist__column--product">
                       <a href="{{route('bookdetails.index', $item->id)}}" class="wishlist__product-name">{{$item->name}}</a>
                    </td>
                    <td class="wishlist__column wishlist__column--stock">
                       <div class="badge badge-{{$item->quantity > 0 ? 'success' : 'danger'}}">{{$item->quantity > 0 ? 'In Stock' : 'Out of stock'}}</div>
                    </td>
                    <td class="wishlist__column wishlist__column--price">${{$item->price}}</td>
                    <td class="wishlist__column wishlist__column--tocart">
                        <a href="{{route('bookdetails.index', $item->id)}}" class="btn btn-primary btn-sm">Add To Cart</a>
                        {{-- <form action="{{route('cart.store')}}" method="POST">
                            @csrf
                            <input type="text" name="book_id" value="{{$item->id}}" hidden>
                            <input type="text" name="quantity" value="1" hidden>
                            <button type="submit" class="btn btn-primary btn-sm">Add To Cart</button>
                        </form> --}}
                    </td>
                    <td class="wishlist__column wishlist__column--remove">
                       <a href="{{route('wishlist.destroy', $item->id)}}" class="btn btn-light btn-sm btn-svg-icon">
                          <svg width="12px" height="12px">
                             <use xlink:href="{{asset('library/images/sprite.svg#cross-12')}}"></use>
                          </svg>
                        </a>
                    </td>
                 </tr>
                @endforeach
             </tbody>
          </table>
       </div>
    </div>
 </div>    
@endsection

@section('script')
    
@endsection