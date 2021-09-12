@extends('adminlte::page')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <h1>General Form</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">General Form</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add user</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form action="{{ route('user.store') }}" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="exampleInputName">Name</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror"
                                           value="{{ old('name') }}" placeholder="Enter Name" required autocomplete="name" autofocus>
                                    @error('name')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputLastName">Last Name</label>
                                    <input type="text" name="last_name"
                                           class="form-control @error('last_name') is-invalid @enderror"
                                           value="{{ old('last_name') }}" placeholder="Enter Last Name" required autocomplete="last_name" autofocus>
                                    @error('last_name')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail">Email address</label>
                                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}" id="exampleInputEmail"
                                           placeholder="Enter email" required autocomplete="email">
                                    @error('email')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword">Password</label>
                                    <input type="password" name="password" class="form-control @error('email') is-invalid @enderror" value="{{ old('password') }}" id="exampleInputPassword"
                                           placeholder="Password" required autocomplete="new-password">
                                    @error('password')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputConfirmPassword">Confirm Password</label>
                                    <input type="password" name="password_confirmation" class="form-control @error('confirm_password') is-invalid @enderror" placeholder="Retype password" required autocomplete="new-password">
                                    @error('confirm_password')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                {{--<div class="form-group">
                                    <label for="exampleInputFile">File input</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="custom-file-input" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                </div>--}}
                                <div class="form-group">
                                    <label for="exampleInputFile">Product Image</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" name="img" class="custom-file-input @error('img') is-invalid @enderror" id="exampleInputFile">
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                        <div class="input-group-append">
                                            <span class="input-group-text">Upload</span>
                                        </div>
                                    </div>
                                    @error('img')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Role</label>
                                    <select name="role" id="exampleInputCategory" class="form-control @error('role') is-invalid @enderror">
                                        <option>Please select role</option>
                                            <option name="role">Admin</option>
                                            <option name="role">Manager</option>
                                    </select>
                                    @error('role')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputCategory">Shop</label>
                                    <select name="shop_id" id="exampleInputCategory" class="form-control @error('shop_id') is-invalid @enderror">
                                        <option>Please select Shop</option>
                                        @foreach($shops as $shop)
                                            <option @if(old('shop_id') && old('shop_id') == $shop->id) selected @endif value="{{ $shop->id }}">{{ $shop->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <br>
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                    @enderror
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
