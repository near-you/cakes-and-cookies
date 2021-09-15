<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Shop;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', [
            "users" => User::paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
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
     */
    public function store(UserAddRequest $request): \Illuminate\Http\RedirectResponse
    {
        $user = User::createUser($request);

        return redirect()->route('user.index')->with(
            'status',
            'User ' . $user->name . ' was created!'
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        return view('admin.user.show', [
            "user" => User::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(int $id)
    {
        return view('admin.user.edit', [
            "user" => User::query()->find($id),
            "shops" => Shop::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserEditRequest $request, int $id): \Illuminate\Http\RedirectResponse
    {
        $user = User::updateUser($id, $request);
        dd($user);
        //return User::redirectView($id, 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): \Illuminate\Http\RedirectResponse
    {
        User::userDestroy($id);
        return User::redirectView($id, 'deleted');
    }
}
