<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\UserManagement\Users\UserController;
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



Route::group(['prefix' => 'admin'], function () {

    Route::group(['prefix' => 'auth','middleware'=>'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::post('custom-login', [LoginController::class, 'login'])->name('custom-login');
    });

    Route::group(['middleware' => ['auth:sanctum']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::group(['prefix' => 'auth'], function () {
            Route::get('logout', [LoginController::class, 'logout'])->name('logout');
        });


        Route::group(['prefix' => 'users'], function () {
            Route::get('/', [UserController::class, 'index'])->name('users.index');
            Route::get('/create', [UserController::class, 'create'])->name('users.create');
            Route::post('/store', [UserController::class, 'store'])->name('users.store');
        });

    });





//    Route::group(['middleware' => [ 'check-year-and-center','UserSystem']], function () {
//
//
//    });

});
