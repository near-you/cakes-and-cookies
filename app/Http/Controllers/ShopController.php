<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShopAddRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::query()->paginate(6);
        return view('admin.shop.index', [
            'shops' => $shops,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shop.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ShopAddRequest $request): RedirectResponse
    {
        $shop = Shop::query()->create(
            $request->all()
        );
        return redirect()->route('shop.index')->with(
            'status',
            'Shop #' . $shop->id . ' was created!'
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function show(int $id)
    {
        return view('admin.shop.show', [
            "products" => Shop::query()->find($id)->products,
            "users" => Shop::query()->find($id)->users,
            'shop' => Shop::query()->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        return view('admin.shop.edit', [
            "shop" => Shop::query()->find($id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        Shop::updateData($id, $request->name);
        return redirect()->route('shop.index')->with(
            'status',
            'Shop #' . $id . ' was updated!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Shop::destroy($id);
        return redirect()->route('shop.index')->with(
            'status',
            'Shop #' . $id. ' was deleted');
    }
}
