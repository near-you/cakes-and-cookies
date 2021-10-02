<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OrderController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::middleware('admin.check:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin');
            Route::resource('/user', UserController::class);
            Route::resource('/shop', ShopController::class);
            Route::resource('/product', ProductController::class);
            Route::resource('/order', OrderController::class);
        });
    });

    Route::prefix('manager')->group(function () {
        Route::get('/', [ManagerController::class, 'index'])->name('manager');
        Route::prefix('product')->group(function () {
            Route::get('/', [App\Http\Controllers\Manager\ProductController::class, 'index'])->name('user_product');
            Route::get('/all_products', [App\Http\Controllers\Manager\ProductController::class, 'allProducts'])->name('all_products');
        });
    });

});


Auth::routes();
