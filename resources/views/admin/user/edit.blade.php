@extends('adminlte::page')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <!-- general form elements -->
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Edit User</h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('user.update', ["user" => $user->id]) }}"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">

                            <!-- Name -->
                            <label for="exampleInputTtitle">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') ?? $user->name }}" name="name" id="exampleInputName"
                                   placeholder="Enter Name">
                            @error('name')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Name -->

                        <!-- Last Name -->
                        <div class="form-group">
                            <label for="exampleInputSku">Last Name</label>
                            <input type="text" class="form-control @error('last_name') is-invalid @enderror"
                                   value="{{ old('last_name') ?? $user->last_name }}" name="last_name"
                                   id="exampleInputLastName" placeholder="Enter Last Name">
                            @error('last_name')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Last Name -->

                        <!-- Email-->
                        <div class="form-group">
                            <label for="exampleInputDescription">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') ?? $user->email }}" name="email" id="exampleInputEmail"
                                   placeholder="Enter Email">
                            @error('email')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Email-->

                        <!-- Password -->
                        <div class="form-group">
                            <label for="exampleInputPassword">Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   value="{{ old('password') ?? $user->password }}" name="password"
                                   id="exampleInputPassword" placeholder="Enter Password">
                            @error('password')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Password -->

                        <!-- Confirm Password -->
                        <div class="form-group">
                            <label for="exampleInputConfirmPassword">Confirm Password</label>
                            <input type="password" class="form-control @error('password') is-invalid @enderror"
                                   value="{{ old('password') ?? $user->password }}" name="password_confirmation"
                                   id="exampleInputPasswordConfirm" placeholder="Retype password">
                            @error('confirm_password')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
                        </div>
                        <!-- End Confirm Password -->

                        <!-- Role -->
                        <div class="form-group">
                            <label for="exampleInputQuantity">Role</label>
                            {{--<input type="number" min="1" class="form-control @error('quantity') is-invalid @enderror"
                                   value="{{ old('quantity') ?? $product->quantity }}" name="quantity" id="exampleInputQuantity" placeholder="Enter Quantity">--}}
                            <select name="role" id="exampleInputRole"
                                    class="form-control @error('role') is-invalid @enderror">
                                <option>Please select role</option>
                                <option name="role">Admin</option>
                                <option name="role">Manager</option>
                            </select>
                            @error('quantity')
                            <br>
                            <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <!-- End Role -->

                        <!-- Shop -->
                        <div class="form-group">
                            <label for="exampleInputCategory">Shop</label>
                            <select name="shop_id" id="exampleInputShop"
                                    class="form-control @error('shop_id') is-invalid @enderror">
                                <option>Please select Shop</option>
                                @foreach($shops as $shop)
                                    <option
                                        @if((old('shop_id') && old('shop_id') == $shop->id) || $shop->id == $user->shop_id) selected
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
                        <!-- End Shop -->

                        <!-- Current User Image -->
                        <div class="form-group">
                            <label for="exampleInputFile">Current User Image</label>
                            <div class="col-4">
                                <img
                                    src="{{ Illuminate\Support\Facades\Storage::url('user_img/thumbnail/'.$user->img) }}"
                                    class="user-image" alt="User Image">
                            </div>
                            <label for="exampleInputFile">Upload New Product Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file" name="img"
                                           class="custom-file-input @error('img') is-invalid @enderror"
                                           id="exampleInputFile">
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
                    </div>
                    <!-- End Current User Image -->
                    <!-- /.card-body -->

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </form>
                <!-- end form  -->
            </div>
            <!-- /.card -->
        </div>
    </div>
@endsection

