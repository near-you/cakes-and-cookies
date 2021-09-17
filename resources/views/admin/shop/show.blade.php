@extends('adminlte::page')


@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ $shop->name }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('user.index') }}">Home</a></li>
                        <li class="breadcrumb-item active">Shop Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="card">
        <div class="card-header">
            <h3 class="card-title">Projects</h3>
            <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
        <div class="card-body p-0">
            <table class="table table-striped projects">
                <thead>
                <tr>
                    <th style="width: 10%">
                        Manager(s)
                    </th>
                    <th style="width: 80%">
                        Products
                    </th>
                    <th style="width: 10%" class="text-center">
                        Status
                    </th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>
                        @foreach($users as $user)
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <img alt="Avatar" class="table-avatar"
                                         src="{{ Illuminate\Support\Facades\Storage::url('user_img/thumbnail/' . $user->img) }}">
                                </li>
                            </ul>
                            <br>
                        @endforeach
                    </td>
                    <td>
                        @foreach($products as $product)
                            <ul class="list-inline">

                                <li class="list-inline-item">
                                    <a>
                                        <b>{{ $product->name }}</b>
                                    </a>
                                    <br>
                                    <small>
                                        Created {{ $product->created_at }}
                                    </small>
                                    <p>
                                        {{ $product->description }}
                                    </p>
                                </li>
                            </ul>
                        @endforeach
                    </td>
                    <td class="project-state">
                        <span class="badge badge-success">Success</span>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <!-- /.card-body -->
    </div>

@endsection
