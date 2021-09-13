@extends('adminlte::page')

@section('content')

    <div class="card-body pb-0">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row d-flex align-items-stretch">
            @foreach( $users as $user )
                <div class="col-12 col-sm-6 col-md-4 d-flex align-items-stretch">
                    <div class="card bg-light">
                        <div class="card-header text-muted border-bottom-0">
                            {{ ucfirst($user->role) }}
                        </div>
                        <div class="card-body pt-0">
                            <div class="row">
                                <div class="col-7">
                                    <h2 class="lead"><b>{{ $user->name }} {{ $user->last_name }}</b></h2>
                                    <p class="text-muted text-sm"><b>About: </b> Web Designer / UX / Graphic Artist / Coffee
                                        Lover </p>
                                    <ul class="ml-4 mb-0 fa-ul text-muted">
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-building"></i></span>
                                            Address: Demo Street 123, Demo City 04312, NJ
                                        </li>
                                        <li class="small"><span class="fa-li"><i class="fas fa-lg fa-phone"></i></span>
                                            Phone #: + 800 - 12 12 23 52
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-5 text-center">
                                    <img src="{{ Illuminate\Support\Facades\Storage::url('user_img/thumbnail/'.$user->img) }}" alt="" class="img-circle img-fluid">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="text-right">
                                <a href="#" class="btn btn-sm bg-teal">
                                    <i class="fas fa-comments"></i>
                                </a>
                                <a href="#" class="btn btn-sm btn-primary">
                                    <i class="fas fa-user"></i> View Profile
                                </a>
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
