@extends('admin.layout.master')

@section('title', 'Publishers')

@section('styles')
    
@endsection

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Publishers</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Publishers</li>
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
                <h3 class="card-title">Authors of {{$publisher->name}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0" style="height: 300px;">
                <table class="table table-head-fixed table-hover text-nowrap">
                  <thead>
                    <tr>
                        <th>#</th>
                        <th>Author's Name</th>
                        <th>Settings</th>
                    </tr>
                  </thead>
                  <tbody>
                    {{-- <tr>
                      <td>#</td>
                      <td>{{ $publishers->name }}</td>
                    </tr> --}}
                    @foreach ($authors as $author)
                      <tr>
                          <td>{{ $loop->iteration }}</td>
                          <td>{{ $author->name }}</td>
                          <td>
                            <a href="{{route('admin.publishers.deleteAuthor', [$publisher->id, $author->id])}}" class="btn btn-danger">
                              <i class="fas fa-trash"></i>
                            </a>
                          </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->

            <form method="POST" action="{{route('admin.publishers.addAuthors')}}">
              @csrf
              {{-- <div class="form-group">
                <label>Publishers</label>
                <select class="custom-select" name="authors[]">
                  @foreach ($authors as $author)
                  <option value="{{$author->id}}">{{$author->name}}</option>
                  @endforeach
                </select>
              </div> --}}
              <input type="text" value="{{$publisher->id}}" name="publisher" hidden>
              <div class="form-group">
                <label>Add Authors</label>
                <select class="custom-select" name="authors[]" multiple>
                  @foreach ($allAuthors as $author)
                  <option value="{{$author->id}}">{{$author->name}}</option>
                  @endforeach
                </select>
              </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">Add</button>
              </div>
            </form>

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