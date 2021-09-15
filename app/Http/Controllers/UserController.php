<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Models\Shop;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.user.index', [
            "users" => User::query()->paginate(6)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
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
    public function store(UserAddRequest $request): RedirectResponse
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
            "user" => User::query()->find($id)
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
    public function update(UserEditRequest $request, int $id): RedirectResponse
    {
        User::updateUser($id, $request);
        return User::redirectView($id, 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id): RedirectResponse
    {
        User::userDestroy($id);
        return User::redirectView($id, 'deleted');
    }
}
