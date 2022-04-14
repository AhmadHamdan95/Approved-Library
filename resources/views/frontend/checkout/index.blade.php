@extends('frontend.layout.master')

@section('title','CheckOut')

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
                   <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
             </nav>
          </div>
          <div class="page-header__title">
             <h1>Checkout</h1>
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
    <div class="checkout block">
       <div class="container">
         <form action="{{route('checkout.store')}}" method="POST">
            @csrf
          <div class="row">
             <div class="col-12 col-lg-6 col-xl-7">
                <div class="card mb-lg-0">
                   <div class="card-body">
                      <h3 class="card-title">Billing details</h3>
                      <div class="form-row">
                         <div class="form-group col-md-6">
                             <label for="checkout-first-name">First Name</label>
                            <input type="text" class="form-control" id="checkout-first-name" name="first_name" value="{{$customer->first_name}}" placeholder="First Name">
                        </div>
                         <div class="form-group col-md-6">
                             <label for="checkout-last-name">Last Name</label>
                            <input type="text" class="form-control" id="checkout-last-name" name="last_name" value="{{$customer->last_name}}" placeholder="Last Name">
                        </div>
                      </div>
                      <div class="form-row">
                         <div class="form-group col-md-6">
                            <label for="checkout-email">Email</label>
                            <input type="email" class="form-control" id="checkout-email" name="email" value="{{$customer->email}}" placeholder="Email">
                           </div>
                         <div class="form-group col-md-6">
                            <label for="checkout-phone">Phone</label>
                            <input type="text" class="form-control" id="checkout-phone" name="phone" value="{{$customer->phone}}" placeholder="Phone">
                           </div>
                      </div>
                      <div class="form-group">
                         <label for="checkout-city">Address</label>
                         <textarea id="checkout-address" class="form-control" rows="4" name="address" value="{{$customer->address}}"></textarea>
                        </div>
                      <div class="form-group">
                         <label for="checkout-city">City</label>
                         <input type="text" class="form-control" id="checkout-city" name="city" value="{{$customer->city}}">
                        </div>
                        <div class="form-group">
                           <label for="country">Country</label>
                           <select class="custom-select" id="country" name="country_id">
                             <option value="">select</option>
                             @foreach ($countries as $country)
                             <option value="{{$country->id}}" {{ ($customer->country_id == $country->id) ? 'selected':'' }}>{{$country->name}}</option>
                             @endforeach
                           </select>
                       </div>
                      <div class="form-group">
                         <label for="checkout-state">County</label>
                         <input type="text" class="form-control" id="checkout-state" name="country" value="{{old('country')}}">
                        </div>
                      <div class="form-group">
                         <label for="checkout-postcode">Postcode</label>
                         <input type="text" class="form-control" id="checkout-postcode" name="postcode" value="{{$customer->postcode}}">
                        </div>
                   </div>
                </div>
             </div>
             <div class="col-12 col-lg-6 col-xl-5 mt-4 mt-lg-0">
                <div class="card mb-0">
                   <div class="card-body">
                      <h3 class="card-title">Your Order</h3>
                      <table class="checkout__totals">
                         <thead class="checkout__totals-header">
                            <tr>
                               <th>Book</th>
                               <th>Total</th>
                            </tr>
                         </thead>
                         <tbody class="checkout__totals-products">
                            @foreach ($cart as $item)
                            <tr>
                              <td>{{$item->book->name}} × {{$item->quantity}}</td>
                              <td>${{$item->total}}</td>
                           </tr>
                            @endforeach
                         </tbody>
                         <tfoot class="checkout__totals-footer">
                            <tr>
                               <th>Total</th>
                               <td>${{$total}}</td>
                            </tr>
                         </tfoot>
                      </table>
                      <div class="payment-methods">
                         <ul class="payment-methods__list">
                            <li class="payment-methods__item payment-methods__item--active">
                               <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="checkout_payment_method" type="radio" checked="checked"> <span class="input-radio__circle"></span> </span></span><span class="payment-methods__item-title">Direct bank transfer</span></label>
                               <div class="payment-methods__item-container">
                                  <div class="payment-methods__item-description text-muted">Make your payment directly into our bank account. Please use your Order ID as the payment reference. Your order will not be shipped until the funds have cleared in our account.</div>
                               </div>
                            </li>
                            <li class="payment-methods__item">
                               <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="checkout_payment_method" type="radio"> <span class="input-radio__circle"></span> </span></span><span class="payment-methods__item-title">Check payments</span></label>
                               <div class="payment-methods__item-container">
                                  <div class="payment-methods__item-description text-muted">Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.</div>
                               </div>
                            </li>
                            <li class="payment-methods__item">
                               <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="checkout_payment_method" type="radio"> <span class="input-radio__circle"></span> </span></span><span class="payment-methods__item-title">Cash on delivery</span></label>
                               <div class="payment-methods__item-container">
                                  <div class="payment-methods__item-description text-muted">Pay with cash upon delivery.</div>
                               </div>
                            </li>
                            <li class="payment-methods__item">
                               <label class="payment-methods__item-header"><span class="payment-methods__item-radio input-radio"><span class="input-radio__body"><input class="input-radio__input" name="checkout_payment_method" type="radio"> <span class="input-radio__circle"></span> </span></span><span class="payment-methods__item-title">PayPal</span></label>
                               <div class="payment-methods__item-container">
                                  <div class="payment-methods__item-description text-muted">Pay via PayPal; you can pay with your credit card if you don’t have a PayPal account.</div>
                               </div>
                            </li>
                         </ul>
                      </div>
                      <div class="checkout__agree form-group">
                         <div class="form-check">
                            <span class="form-check-input input-check">
                               <span class="input-check__body">
                                  <input class="input-check__input" type="checkbox" id="checkout-terms"> <span class="input-check__box"></span> 
                                  <svg class="input-check__icon" width="9px" height="7px">
                                     <use xlink:href="images/sprite.svg#check-9x7"></use>
                                  </svg>
                               </span>
                            </span>
                            <label class="form-check-label" for="checkout-terms">I have read and agree to the website <a target="_blank" href="terms-and-conditions.html">terms and conditions</a>*</label>
                         </div>
                      </div>
                      <button type="submit" class="btn btn-primary btn-xl btn-block">Place Order</button>
                   </div>
                </div>
             </div>
          </div>
         </form>
       </div>
    </div>
 </div>
@endsection

@section('script')
    
@endsection