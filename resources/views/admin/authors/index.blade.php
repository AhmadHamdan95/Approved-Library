@extends('admin.layout.master')

@section('title', 'Authors')

@section('styles')
    
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Authors</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Authors</li>
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
                        <th>Name</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Image</th>
                        <th>Date</th>
                        <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($authors as $author)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $author->name }}</td>
                            <td>{{ $author->email }}</td>
                            <td>{{ $author->address }}</td>
                            <td><img src="{{ url(Storage::url($author->image)) }}" class="img-circle" width="65" height="65" alt=""></td>
                            <td>{{ $author->created_at }}</td>
                            <td>
                              <div class="btn-group">
                                <a href="{{route('admin.authors.edit', $author->id)}}" class="btn btn-info">
                                  <i class="fas fa-edit"></i>
                                </a>
                                <a href="{{route('admin.authors.destroy', $author->id)}}" class="btn btn-danger">
                                  <i class="fas fa-trash"></i>
                                </a>
                                <a href="{{route('admin.authors.publishers', $author->id)}}" class="btn btn-info">
                                  <i class="fa fa-bars"></i>
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