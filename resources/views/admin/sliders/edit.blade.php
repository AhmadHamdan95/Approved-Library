@extends('admin.layout.master')

@section('title', 'Edit Slider')

@section('styles')
    
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Edit Slider</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Edit Slider</li>
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
                    <h3 class="card-title">Edit Slider</h3>
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
                  <form method="POST" action="{{route('admin.sliders.update', ['id' => $slider->id])}}" enctype="multipart/form-data">
                    @method('PUT')
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                          <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control" id="title" name="title" @if(old('title')) value="{{old('title')}}" @else value="{{$slider->title}}" @endif>
                        </div>
                        <div class="form-group">
                          <label>Description</label>
                          <textarea class="form-control" name="description" rows="3">@if(old('description')) {{old('description')}} @else {{$slider->description}} @endif</textarea>
                        </div>
                        <div class="form-group">
                          <label for="url">URL</label>
                          <input type="text" class="form-control" id="url" name="url" @if(old('url')) value="{{old('url')}}" @else value="{{$slider->url}}" @endif>
                        </div>
                        <div class="form-group">
                          <label>Status</label>
                          <select class="custom-select" id="status" name="status">
                            <option value="1" {{$slider->status ? 'selected' : ''}}>Enabled</option>
                            <option value="0" {{$slider->status ? '' : 'selected'}}>Disabled</option>
                          </select>
                        </div>
                        <div class="form-group">
                          <label for="image">Image</label>
                          <div class="input-group">
                            <div class="custom-file">
                            <input type="file" class="custom-file-input" id="image" name="image">
                            <label class="custom-file-label" for="image">Choose image</label>
                            </div>
                          </div>
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