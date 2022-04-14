@extends('frontend.layout.master')

@section('title','Shopping Cart')

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
                   <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
             </nav>
          </div>
          <div class="page-header__title">
             <h1>Shopping Cart</h1>
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
    <div class="cart block">
       <div class="container">
          <form action="{{ route("cart.update") }}" method="POST">
            @method('PUT')
            @csrf
          <table class="cart__table cart-table">
             <thead class="cart-table__head">
                <tr class="cart-table__row">
                   <th class="cart-table__column cart-table__column--image">Image</th>
                   <th class="cart-table__column cart-table__column--product">Book</th>
                   <th class="cart-table__column cart-table__column--price">Price</th>
                   <th class="cart-table__column cart-table__column--quantity">Quantity</th>
                   <th class="cart-table__column cart-table__column--total">Total</th>
                   <th class="cart-table__column cart-table__column--remove"></th>
                </tr>
             </thead>
             <tbody class="cart-table__body">
                @foreach ($cart as $item)
                <tr class="cart-table__row">
                  <td class="cart-table__column cart-table__column--image">
                     <a href="#"><img src="{{url(Storage::url($item->book->image))}}" alt=""></a>
                  </td>
                  <td class="cart-table__column cart-table__column--product">
                     <a href="#" class="cart-table__product-name">{{$item->book->name}}</a>
                  </td>
                  <td class="cart-table__column cart-table__column--price" data-title="Price">{{$item->book->price}}</td>
                  <td class="cart-table__column cart-table__column--quantity" data-title="Quantity">
                     <div class="input-number">
                        <input class="form-control input-number__input" name="quantity[{{ $item->id }}]" type="number" min="1" value="{{$item->quantity}}">
                        <div class="input-number__add"></div>
                        <div class="input-number__sub"></div>
                     </div>
                  </td>
                  <td class="cart-table__column cart-table__column--total" data-title="Total">${{ $item->total }}</td>
                  <td class="cart-table__column cart-table__column--remove">
                     <a href="{{route('cart.destroy', $item->id)}}" class="btn btn-light btn-sm btn-svg-icon">
                        <svg width="12px" height="12px">
                           <use xlink:href="{{asset('library/images/sprite.svg#cross-12')}}"></use>
                        </svg>
                     </a>
                  </td>
               </tr>
                @endforeach
             </tbody>
          </table>
          <div class="cart__actions">
            <button type="submit" class="btn btn-primary">Update Cart</button>
          </div>
          </form>
          <div class="row justify-content-end pt-5">
             <div class="col-12 col-md-7 col-lg-6 col-xl-5">
                <div class="card">
                   <div class="card-body">
                      <h3 class="card-title">Cart Totals</h3>
                      <table class="cart__totals">
                         <tfoot class="cart__totals-footer">
                            <tr>
                               <th>Total</th>
                               <td>${{$total}}</td>
                            </tr>
                         </tfoot>
                      </table>
                      <a class="btn btn-primary btn-xl btn-block cart__checkout-button" href="{{route('checkout.index')}}">Proceed to checkout</a>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>
 </div>
@endsection

@section('script')
    
@endsection