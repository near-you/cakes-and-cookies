<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductAddRequest;
use App\Http\Requests\ProductEditRequest;
use App\Models\Product;
use App\Models\Shop;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $products = Product::query()->paginate(9);
        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Application|Factory|View
     */
    public function create()
    {
        return view('admin.product.create', [
            "shops" => Shop::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param ProductAddRequest $request
     * @return RedirectResponse
     */
    public function store(ProductAddRequest $request): RedirectResponse
    {
        $product = Product::query()->create(
            $request->all()
        );
        return redirect()->route('product.index')->with(
            'status',
            'Product #' . $product->id . ' was created!'
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
        return view('admin.product.show', [
            "product" => Product::query()->find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Application|Factory|View
     */
    public function edit(int $id)
    {
        return view('admin.product.edit', [
            "product" => Product::query()->find($id),
            "shops" => Shop::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param ProductEditRequest $request
     * @param int $id
     * @return RedirectResponse
     */
    public function update(ProductEditRequest $request, int $id): RedirectResponse
    {
        Product::updateProductData($request, $id);
        return redirect()->route('product.index')->with(
            'status',
            'Product #' . $id . ' was updated!'
        );
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return RedirectResponse
     */
    public function destroy(int $id): RedirectResponse
    {
        Product::destroy($id);
        return redirect()->route('product.index')->with(
            'status',
            'Product #' . $id. ' was deleted');
    }
}
