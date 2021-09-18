@extends('adminlte::page')

@section('css')
{{--    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">--}}
@stop

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Products</h1>
                </div>
                <div class="col-sm-4">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>
                <div class="col-sm-4">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">All Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of all products</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6"></div>
                            <div class="col-sm-12 col-md-6"></div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <table id="example2" class="table-striped table table-bordered table-hover" role="grid"
                                       aria-describedby="example2_info">
                                    <thead>
                                    <tr role="row">
                                        <th>Product Title</th>
                                        <th>Shop Name</th>
                                        <th>Description</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr role="row">
                                            <td><a href="{{ route('product.show', ["product" => $product->id]) }}">{{ $product->name }}</a></td>
                                            <td>{{ $product->shop->name }}</td>
                                            <td>{{ $product->description }}</td>
                                            <td>
                                                <a class="btn btn-block btn-info btn-sm"
                                                   href="{{ route('product.edit', ["product" => $product->id]) }}">Edit</a>
                                                <form action="{{ route('product.destroy', ["product" => $product->id]) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-block btn-danger btn-sm" type="submit" value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">Product Title</th>
                                        <th rowspan="1" colspan="1">Shop Name</th>
                                        <th rowspan="1" colspan="1">Description</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>
        <!-- /.col -->
    </div>

@endsection

@section('js')
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": true,
                "ordering": true,
                "info": true,
                "autoWidth": false,
            });
        });
    </script>
@endsection
