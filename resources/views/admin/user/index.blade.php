@extends('adminlte::page')

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    {{--<h1>Contacts</h1>--}}
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">All Users/li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </div>

    <div class="card-body pb-0">
        <div class="row d-flex align-items-stretch">
            @foreach( $users as $user )
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light d-flex flex-fill">
                        <div class="card-header text-muted border-bottom-0">
                            {{ ucfirst($user->role) }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $user->name }} {{ $user->last_name }}</b></h2>
                                    <p class="text-muted text-sm"><b>E-mail </b> {{ $user->email }}</p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i
                                                    class="fas fa-lg fa-building"></i></span>
                                            Shop: <b> {{ $user->shop->name }} </b>
                                        </li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: + 800 - 12 12 23 52
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img
                                        src="{{ Illuminate\Support\Facades\Storage::url('user_img/thumbnail/'.$user->img) }}"
                                        alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="{{ route('user.show', ["user" => $user->id]) }}"
                                   class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-info btn-sm  dropdown-toggle dropdown-icon"
                                            data-toggle="dropdown" aria-expanded="false">Action
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a class="btn btn-block btn-sm"
                                           href="{{ route('user.edit', ["user" => $user->id]) }}">Edit Profile</a>
                                        <form action="{{ route('user.destroy', ["user" => $user->id]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input class="btn btn-block btn-outline-danger btn-sm" type="submit"
                                                   value="Delete">
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- /.card-body -->
    <div class="card-footer">
        <div class="pagination justify-content-center m-0">
            {{ $users->links() }}
        </div>
    </div>
    <!-- /.card-footer -->

@endsection
