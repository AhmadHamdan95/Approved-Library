@extends('frontend.layout.master')

@section('title','Register')

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
                   <li class="breadcrumb-item active" aria-current="page">Register</li>
                </ol>
             </nav>
          </div>
          <div class="page-header__title">
             <h1>Register</h1>
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
    <div class="block">
       <div class="container">
          <div class="row">
             <div class="col-md-6 offset-md-3 d-flex mt-4 mt-md-0">
                <div class="card flex-grow-1 mb-0">
                   <div class="card-body">
                      <h3 class="card-title">Register</h3>
                      <form action="{{route('register')}}" method="POST">
                        @csrf
                         <div class="form-group">
                            <label>First name</label>
                            <input type="text" class="form-control" name="first_name" value="{{old('first_name')}}" placeholder="First name">
                        </div>
                         <div class="form-group">
                            <label>Last name</label>
                            <input type="text" class="form-control" name="last_name" value="{{old('last_name')}}" placeholder="Last name">
                        </div>
                         <div class="form-group">
                            <label>Email</label>
                            <input type="email" class="form-control" name="email" value="{{old('email')}}" placeholder="Enter email">
                        </div>
                         <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" name="password" value="{{old('password')}}" placeholder="Password">
                        </div>
                         <div class="form-group">
                            <label>Repeat Password</label>
                            <input type="password" class="form-control" name="password_confirmation" value="{{old('password_confirmation')}}" placeholder="Password">
                        </div>
                         <button type="submit" class="btn btn-primary mt-4">Register</button>
                      </form>
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