<?php

use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\UserManagement\Admins\AdminController;
use App\Http\Controllers\Dashboard\UserManagement\Customers\CustomerController;
use App\Http\Controllers\Dashboard\UserManagement\Roles\RoleController;
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


        Route::group(['prefix' => 'admins'], function () {
            Route::get('/', [AdminController::class, 'index'])->name('admins.index');
            Route::get('/create/{id?}', [AdminController::class, 'create'])->name('admins.create');
            Route::post('/store', [AdminController::class, 'store'])->name('admins.store');
            Route::post('{id}/update', [AdminController::class, 'update'])->name('admins.update');
            Route::post('{id}/delete', [AdminController::class, 'delete'])->name('admins.delete');
            Route::post('delete-selected', [AdminController::class, 'deleteSelected'])->name('admins.deleteSelected');
        });


        Route::group(['prefix' => 'customers'], function () {
            Route::get('/', [CustomerController::class, 'index'])->name('customers.index');
            Route::get('/create/{id?}', [CustomerController::class, 'create'])->name('customers.create');
            Route::post('/store/{id?}', [CustomerController::class, 'store'])->name('customers.store');
//            Route::post('{id}/update', [CustomerController::class, 'update'])->name('customers.update');
            Route::post('{id}/delete', [CustomerController::class, 'delete'])->name('customers.delete');
            Route::post('delete-selected', [CustomerController::class, 'deleteSelected'])->name('customers.deleteSelected');
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [RoleController::class, 'index'])->name('roles.index');
            Route::get('/create/{id?}', [RoleController::class, 'create'])->name('roles.create');
            Route::post('/store', [RoleController::class, 'store'])->name('roles.store');
            Route::post('{id}/update', [RoleController::class, 'update'])->name('roles.update');
            Route::post('delete', [RoleController::class, 'delete'])->name('roles.delete');
        });


        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create/{id?}', [ProductController::class, 'create'])->name('products.create');
            Route::post('/store/{id?}', [ProductController::class, 'store'])->name('products.store');
//            Route::post('{id}/update', [CustomerController::class, 'update'])->name('customers.update');
            Route::post('{id}/delete', [ProductController::class, 'delete'])->name('products.delete');
            Route::post('delete-selected', [ProductController::class, 'deleteSelected'])->name('products.deleteSelected');
        });



    });





//    Route::group(['middleware' => [ 'check-year-and-center','UserSystem']], function () {
//
//
//    });

});
