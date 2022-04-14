@extends('admin.layout.master')

@section('title', 'Cart')

@section('styles')
    
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Cart</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Cart</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    @if(Session::has('data'))
        {{ Session::get('data')['title'] }} - {{ Session::get('data')['code'] }} - {{ Session::get('data')['message'] }}
    @endif

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Index</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                        <th>Date</th>
                        <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($items as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->book->price }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ $item->book->price * $item->quantity }}</td>
                            <td>{{ $item->created_at }}</td>
                            <td>
                              <div class="btn-group">
                                {{-- <a href="{{route('admin.cart.edit', $item->id)}}" class="btn btn-info">
                                  <i class="fas fa-edit"></i>
                                </a> --}}
                                <a href="{{route('admin.cart.destroy', $item->id)}}" class="btn btn-danger">
                                  <i class="fas fa-trash"></i>
                                </a>
                              </div>
                            </td>
                        </tr>
                      @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection

@section('scripts')

@endsection