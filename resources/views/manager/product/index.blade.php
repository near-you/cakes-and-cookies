@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>All My Products</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('manager') }}">Home</a></li>
                        <li class="breadcrumb-item active">All My Products</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of all Products</h3>
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
                                        <th>#</th>
                                        <th>Title</th>
                                        <th>
                                            Description
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($products as $product)
                                        <tr role="row">
                                            <td class="align-middle">{{ $product->id }}</td>
                                            <td class="align-middle">
                                                {{ $product->name }}
                                            </td>
                                            <td class="align-middle">{{ $product->description }}</td>
                                            <td>
{{--                                                <a class="btn btn-block btn-info btn-sm"--}}
{{--                                                   href="{{ route('user_products.edit', ["user_product" => $product->id]) }}">Edit</a>--}}
{{--                                                <form action="{{ route('user_products.destroy', ["user_product" => $product->id]) }}"--}}
{{--                                                      method="POST">--}}
{{--                                                    @csrf--}}
{{--                                                    @method('DELETE')--}}
{{--                                                    <input class="btn btn-block btn-danger btn-sm" type="submit"--}}
{{--                                                           value="Delete">--}}
{{--                                                </form>--}}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Title</th>
                                        <th rowspan="1" colspan="1">Description</th>
                                        <th rowspan="1" colspan="1">Actions</th>
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

    <div class="card-footer">
        <div class="pagination justify-content-center m-0">
{{--            {{ $products->links() }}--}}
        </div>
    </div>
    <!-- /.card-footer -->

@endsection

@section('js')
    <script>
        $(function () {
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
@endsection

