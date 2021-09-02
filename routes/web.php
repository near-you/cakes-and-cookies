<?php

use App\Http\Controllers\AdminCategory;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    /*Route::prefix('products')->group(function () {
        Route::get('/{category_id?}', [Product::class, 'index'])->name('products')->whereNumber("category_id");
        Route::post('/add', [Product::class, 'add'])->name('products.add');
    });

    Route::prefix('cart')->group(function () {
        Route::get('/', [Cart::class, 'index'])->name('cart');
        Route::post('/add', [Cart::class, 'add'])->name('cart.add');
        Route::post('/update', [Cart::class, 'update'])->name('cart.update');
    });*/

//    Route::resource('admin_category', AdminCategory::class)->middleware('admin.check:admin');

    Route::resource('admin', AdminController::class)->middleware('admin.check:admin');

    Route::resource('manager', ManagerController::class);

});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
