@extends('admin.layout.master')

@section('title', 'Edit Author')

@section('styles')
    
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Author</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Author</li>
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
                    <h3 class="card-title">Edit Author</h3>
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
                  <form method="POST" action="{{route('admin.authors.update', ['id' => $author->id])}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                          <div class="form-group">
                            <label for="name">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{$author->name}}">
                        </div>
                        <div class="form-group">
                          <label for="email">E-mail</label>
                          <input type="email" class="form-control" id="email" name="email" value="{{$author->email}}">
                        </div>
                        <div class="form-group">
                          <label>Address</label>
                          <textarea class="form-control" name="address" rows="3">{{$author->address}}</textarea>
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
                          <label>Publishers</label>
                          <select class="custom-select" name="publishers[]" multiple>
                            @foreach ($publishers as $publisher)
                            <option value="{{$publisher->id}}" {{ ($author->publishers->pluck('id')->contains($publisher->id)) ? 'selected':'' }}>{{$publisher->name}}</option>
                            @endforeach
                          </select>
                        </div>
                    </div>
                    <!-- /.card-body -->
    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Edit</button>
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
@endsection

@section('scripts')
    
@endsection