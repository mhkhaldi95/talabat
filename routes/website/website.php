<?php

use App\Http\Controllers\Website\BranchController;
use App\Http\Controllers\Website\CustomerAccountController;
use App\Http\Controllers\Website\LogingController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\HomeController;
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


Route::get('/', [HomeController::class, 'index'])->name('break.index');
Route::get('/branches', [BranchController::class, 'index'])->name('break.branches.index');
Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::post('delete-from-cart', [CartController::class, 'remove'])->name('delete-from-cart');
Route::post('minus', [CartController::class, 'minus'])->name('minus');
Route::post('check-phone', [LogingController::class, 'checkPhoneNumber'])->name('check-phone');
Route::post('check-code-sms', [LogingController::class, 'checkCodeSms'])->name('checkCodeSms');

    Route::group(['middleware' => ['select_branch']], function () {
        Route::get('/products', [ProductController::class, 'index'])->name('break.products.index');
        Route::get('/customer-account', [CustomerAccountController::class, 'index'])->name('customer.account');




        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/break/logout', [LogingController::class, 'logout'])->name('break.logout');
        });

    });

//    Route::group(['middleware' => ['auth:sanctum']], function () {
//        Route::get('/products', [ProductController::class, 'index'])->name('break.products.index');
//
//    });




