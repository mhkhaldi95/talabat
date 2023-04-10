<?php

use App\Http\Controllers\Branch\AccountSettingsController;
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



Route::group(['prefix' => 'branch','middleware' => ['auth:sanctum','branch','locale']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('branch.dashboard');
        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('branch.products.index');
            Route::get('/create/{id?}', [ProductController::class, 'create'])->name('branch.products.create');
            Route::post('/store/{id?}', [ProductController::class, 'store'])->name('branch.products.store');
            Route::post('change-status', [ProductController::class, 'changeStatus'])->name('change-status');
        });
    Route::group(['prefix' => 'accounts'], function () {
        Route::get('{id}', [AccountSettingsController::class, 'create'])->name('branches.account.create');
        Route::post('update-info', [AccountSettingsController::class, 'updateInfo'])->name('branches.account.update-info');
        Route::post('update-email', [AccountSettingsController::class, 'updateEmail'])->name('branches.account.update-email');
        Route::post('update-password', [AccountSettingsController::class, 'updatePassword'])->name('branches.account.update-password');

    });
    Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('branch.orders.index');
            Route::get('/show/{id}', [OrderController::class, 'show'])->name('branch.orders.show');
            Route::get('{id}/receive', [OrderController::class, 'receive'])->name('branch.orders.receive');
            Route::post('/accept', [OrderController::class, 'accept'])->name('branch.orders.accept');
            Route::post('/reject', [OrderController::class, 'reject'])->name('branch.orders.reject');
        });

});
