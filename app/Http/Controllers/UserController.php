<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Pagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index()
    {

        return view('admin.user.index', [
            "users" => User::paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     *
     */
    public function create()
    {
        return view('admin.user.create',
            [
                'shops' => Shop::all()
            ]
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserAddRequest $request)
    {
        $user = User::createUser($request);

        return redirect()->route('user.index')->with(
            'status',
            'User ' . $user->name . ' was created!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(int $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        User::destroy($id);
        return redirect()->route('admin.user.index')->with(
            'status',
            'Category #' . $id . ' was deleted!');
    }
}
