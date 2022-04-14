@extends('frontend.layout.master')

@section('title','Profile')

@section('style')
<!-- Bootstrap CSS -->
<link href="{{asset('profile/assets/css/bootstrap.min.css')}}" rel="stylesheet">
<!-- Font-Awesome CSS -->
<link href="{{asset('profile/assets/css/font-awesome.min.css')}}" rel="stylesheet">
<!-- helper class css -->
<link href="{{asset('profile/assets/css/helper.min.css')}}" rel="stylesheet">
<!-- Plugins CSS -->
<link href="{{asset('profile/assets/css/plugins.css')}}" rel="stylesheet">
<!-- Main Style CSS -->
<link href="{{asset('profile/assets/css/style.css')}}" rel="stylesheet">
<link href="{{asset('profile/assets/css/skin-default.css')}}" rel="stylesheet" id="galio-skin">
@endsection

@section('content')
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
<!-- my account wrapper start -->
<div class="my-account-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <!-- My Account Page Start -->
                <div class="myaccount-page-wrapper">
                    <!-- My Account Tab Menu Start -->
                    <div class="row">
                        <div class="col-lg-3 col-md-4">
                            <div class="myaccount-tab-menu nav" role="tablist">
                                <a href="#orders" class="active" data-toggle="tab"><i class="fa fa-cart-arrow-down"></i> Orders</a>
                                <a href="#account-info" data-toggle="tab"><i class="fa fa-user"></i> Account Details</a>
                                <a href="#change-password" data-toggle="tab"><i class="fa fa-cloud-download"></i> Change Password</a>
                                <a href="{{route('logout')}}"><i class="fa fa-sign-out"></i> Logout</a>
                            </div>
                        </div>
                        <!-- My Account Tab Menu End -->

                        <!-- My Account Tab Content Start -->
                        <div class="col-lg-9 col-md-8">
                            <div class="tab-content" id="myaccountContent">
                                
                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade show active" id="orders" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Orders</h3>
                                        <div class="myaccount-table table-responsive text-center">
                                            <table class="table table-bordered">
                                                <thead class="thead-light">
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Payment Status</th>
                                                        <th>Total</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($orders as $order)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>
                                                        <td>{{$order->created_at}}</td>
                                                        <td>{{$order->status}}</td>
                                                        <td>{{$order->payment_status}}</td>
                                                        <td>${{$order->total}}</td>
                                                        <td><a href="{{route('orders.index', $order->id)}}" class="check-btn sqr-btn ">View</a></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="change-password" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Change Password</h3>
                                        <div class="account-details-form">
                                            <form action="{{route('customers.updatePassword')}}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="single-input-item">
                                                    <label for="current-pwd" class="required">Current Password</label>
                                                    <input type="password" id="current-pwd" name="current_password" placeholder="Current Password" />
                                                </div>
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="new-pwd" class="required">New Password</label>
                                                            <input type="password" id="new-pwd" name="password" placeholder="New Password" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="confirm-pwd" class="required">Confirm Password</label>
                                                            <input type="password" id="confirm-pwd" name="password_confirmation" placeholder="Confirm Password" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <button type="submit" class="check-btn sqr-btn ">Change Password</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <!-- Single Tab Content End -->

                                <!-- Single Tab Content Start -->
                                <div class="tab-pane fade" id="account-info" role="tabpanel">
                                    <div class="myaccount-content">
                                        <h3>Account Details</h3>
                                        <div class="account-details-form">
                                            <form action="{{route('profile.update')}}" method="POST">
                                                @method('PUT')
                                                @csrf
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="first-name" class="required">First Name</label>
                                                            <input type="text" id="first-name" name="first_name" value="{{$customer->first_name}}" placeholder="First Name" />
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="single-input-item">
                                                            <label for="last-name" class="required">Last Name</label>
                                                            <input type="text" id="last-name" name="last_name" value="{{$customer->last_name}}" placeholder="Last Name" />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="email" class="required">Email</label>
                                                    <input type="email" id="email" name="email" value="{{$customer->email}}" placeholder="Email" />
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="phone">Phone</label>
                                                    <input type="text" id="phone" name="phone" value="{{$customer->phone}}" placeholder="Phone" />
                                                </div>
                                                <div class="form-group">
                                                    <label for="address">Address</label>
                                                    <textarea class="form-control" id="address" name="address" rows="3">{{$customer->address}}</textarea>
                                                </div>
                                                <div class="single-input-item">
                                                    <label for="phone">City</label>
                                                    <input type="text" id="city" name="city" value="{{$customer->city}}" placeholder="City" />
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
                                                <div class="single-input-item">
                                                    <label for="phone">Postcode</label>
                                                    <input type="text" id="postcode" name="postcode" value="{{$customer->postcode}}" placeholder="Postcode" />
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="image">File input</label>
                                                    <div class="input-group">
                                                      <div class="custom-file">
                                                      <input type="file" class="custom-file-input" id="image" name="image">
                                                      <label class="custom-file-label" for="image">Choose file</label>
                                                      </div>
                                                    </div>
                                                </div> --}}
                                                <div class="single-input-item">
                                                    <button type="submit" class="check-btn sqr-btn ">Save Changes</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> <!-- Single Tab Content End -->
                            </div>
                        </div> <!-- My Account Tab Content End -->
                    </div>
                </div> <!-- My Account Page End -->
            </div>
        </div>
    </div>
</div>
<!-- my account wrapper end -->
@endsection

@section('script')
<!--All jQuery, Third Party Plugins & Activation (main.js) Files-->
<script src="{{asset('profile/assets/js/vendor/modernizr-3.6.0.min.js')}}"></script>
<!-- Jquery Min Js -->
<script src="{{asset('profile/assets/js/vendor/jquery-3.3.1.min.js')}}"></script>
<!-- Popper Min Js -->
<script src="{{asset('profile/assets/js/vendor/popper.min.js')}}"></script>
<!-- Bootstrap Min Js -->
<script src="{{asset('profile/assets/js/vendor/bootstrap.min.js')}}"></script>
<!-- Plugins Js-->
<script src="{{asset('profile/assets/js/plugins.js')}}"></script>
<!-- Ajax Mail Js -->
<script src="{{asset('profile/assets/js/ajax-mail.js')}}"></script>
<!-- Active Js -->
<script src="{{asset('profile/assets/js/main.js')}}"></script>
<!-- Switcher JS [Please Remove this when Choose your Final Projct] -->
<script src="{{asset('profile/assets/js/switcher.js')}}"></script>
@endsection