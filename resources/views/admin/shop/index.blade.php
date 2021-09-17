@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-4">
                    <h1>Shops</h1>
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
                        <li class="breadcrumb-item active">Shops</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">List of all Shops</h3>
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
                                            Created At
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($shops as $shop)
                                        <tr role="row">
                                            <td>{{ $shop->id }}</td>
                                            <td>
                                                <a href="{{ route('shop.show', ["shop" => $shop->id]) }}">{{ $shop->name }}</a>
                                            </td>
                                            <td>{{ $shop->created_at }}</td>
                                            <td>
                                                <a class="btn btn-block btn-info btn-sm"
                                                   href="{{ route('shop.edit', ["shop" => $shop->id]) }}">Edit</a>
                                            <!--<a class="btn btn-block btn-danger btn-sm"
                                               href="{{ route('shop.destroy', ["shop" => $shop->id]) }}">Delete</a>-->
                                                <form action="{{ route('shop.destroy', ["shop" => $shop->id]) }}"
                                                      method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <input class="btn btn-block btn-danger btn-sm" type="submit"
                                                           value="Delete">
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr>
                                        <th rowspan="1" colspan="1">#</th>
                                        <th rowspan="1" colspan="1">Title</th>
                                        <th rowspan="1" colspan="1">Created At</th>
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
            {{ $shops->links() }}
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

