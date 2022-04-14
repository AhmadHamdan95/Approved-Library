@extends('admin.layout.master')

@section('title', 'Create Book')

@section('styles')
    
@endsection

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Create Book</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Create Book</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- general form elements -->
                <div class="card card-primary">
                  <div class="card-header">
                    <h3 class="card-title">Create Book</h3>
                  </div>
                  <!-- /.card-header -->

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

                  <!-- form start -->
                  <form method="POST" action="{{route('admin.books.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="description" rows="3" placeholder="Enter Description"></textarea>
                        </div>
                        <div class="form-group">
                          <label for="price">Price</label>
                          <input type="number" class="form-control" id="price" name="price" placeholder="Price">
                        </div>
                        <div class="form-group">
                          <label for="quantity">Quantity</label>
                          <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Quantity">
                        </div>
                        <div class="form-group">
                          <label for="image">File input</label>
                          <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                          </div>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select class="custom-select" name="status">
                            <option value="">select</option>
                            {{-- <option value="featured">Featured</option> --}}
                            <option value="new">New</option>
                            <option value="sale">Sale</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Publisher</label>
                          <select class="custom-select" name="publisher_id">
                            <option value="">select</option>
                            @foreach ($publishers as $publisher)
                            <option value="{{$publisher->id}}">{{$publisher->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Authors</label>
                          <select class="custom-select" name="authors[]" multiple>
                            <option value="">select</option>
                            @foreach ($authors as $author)
                            <option value="{{$author->id}}">{{$author->name}}</option>
                            @endforeach
                          </select>
                        </div>
                        <div class="form-group">
                          <label>Categories</label>
                          <select class="custom-select" name="categories[]" multiple>
                            <option value="">select</option>
                            @foreach ($categories as $category)
                            <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>
                  </form>
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
<script src="{{asset('admin/plugins/bs-custom-file-input/bs-custom-file-input.min.js')}}"></script>
@endsection