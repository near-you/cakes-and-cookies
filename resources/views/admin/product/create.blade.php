@extends('adminlte::page')


@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Add New Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('product.store') }}">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputProductTitle">Product Title</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" name="name" id="exampleInputProductTitle" placeholder="Enter title">
                            @error('name')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDescription">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      id="exampleInputDescription"
                                      placeholder="Enter Description">{{ old('description') }}</textarea>
                            @error('description')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
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
@endsection
