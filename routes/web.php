<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Manager\ManagerController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\UserController;
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

    Route::middleware('admin.check:admin')->group(function () {
        Route::prefix('admin')->group(function () {
            Route::get('/', [AdminController::class, 'index'])->name('admin');
            Route::resource('/user', UserController::class);
            Route::resource('/shop', ShopController::class);
        });
    });

    Route::prefix('manager')->group(function () {
        Route::get('/', [ManagerController::class, 'index'])->name('manager');
        Route::resource('/shop', ShopController::class);
    });

});


Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
