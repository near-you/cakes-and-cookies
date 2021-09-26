@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Product</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Product</li>
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
                    <h3 class="card-title">Edit Product</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('product.update', ["product" => $product->id]) }}">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputProductName">Product Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') ?? $product->name }}" name="name" id="exampleInputProductName" placeholder="Enter Product Title">
                            @error('name')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputDescription">Product Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" name="description"
                                      id="exampleInputDescription"
                                      placeholder="Enter Description">{{ old('description') ?? $product->description }}</textarea>
                            @error('description')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="exampleInputCategory">Shop</label>
                            <select name="shop_id" id="exampleInputShop"
                                    class="form-control @error('shop_id') is-invalid @enderror">
                                <option value="0">Please select Shop</option>
                                @foreach($shops as $shop)
                                    <option
                                        @if((old('shop_id') && old('shop_id') == $shop->id) || $shop->id == $product->shop_id) selected
                                        @endif value="{{ $shop->id }}">{{ $shop->name }}</option>
                                @endforeach
                            </select>
                            @error('shop_id')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection
