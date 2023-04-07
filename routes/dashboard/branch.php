<?php

use App\Http\Controllers\Branch\DashboardController;
use App\Http\Controllers\Branch\Orders\OrderController;
use App\Http\Controllers\Branch\Products\ProductController;
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



Route::group(['prefix' => 'branch','middleware' => ['auth:sanctum','branch']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('branch.dashboard');
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('branch.products.index');
            Route::get('/create/{id?}', [ProductController::class, 'create'])->name('branch.products.create');
            Route::post('change-status', [ProductController::class, 'changeStatus'])->name('change-status');
        });
        Route::group(['prefix' => 'orders'], function () {
            Route::post('/accept', [OrderController::class, 'accept'])->name('branch.orders.accept');
            Route::post('/reject', [OrderController::class, 'reject'])->name('branch.orders.reject');
        });

});
