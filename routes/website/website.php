<?php

use App\Http\Controllers\Website\BranchController;
use App\Http\Controllers\Website\CouponController;
use App\Http\Controllers\Website\CustomerAccountController;
use App\Http\Controllers\Website\LogingController;
use App\Http\Controllers\Website\OrderController;
use App\Http\Controllers\Website\PaymentController;
use App\Http\Controllers\Website\ProductController;
use App\Http\Controllers\Website\CartController;
use App\Http\Controllers\Website\HomeController;
use App\Http\Controllers\Website\ProductSearchController;
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

Route::group(['middleware'=>'locale'], function () {
    Route::get('/', [HomeController::class, 'index'])->name('break.index');
    Route::get('/branches', [BranchController::class, 'index'])->name('break.branches.index');
    Route::post('add-to-cart', [CartController::class, 'addToCart'])->name('add-to-cart');
    Route::post('delete-from-cart', [CartController::class, 'remove'])->name('delete-from-cart');
    Route::post('minus', [CartController::class, 'minus'])->name('minus');
    Route::post('check-phone', [LogingController::class, 'checkPhoneNumber'])->name('check-phone');
    Route::post('check-code-sms', [LogingController::class, 'checkCodeSms'])->name('checkCodeSms');
    Route::post('resend-code-sms', [LogingController::class, 'resendCodeSms'])->name('resendCodeSms');

    Route::group(['middleware' => ['select_branch']], function () {
        Route::get('/products', [ProductController::class, 'index'])->name('break.products.index');
        Route::get('/products_search', [ProductSearchController::class, 'index'])->name('products.search');
        Route::post('/products_filter', [ProductSearchController::class, 'filter'])->name('products.filter');




        Route::group(['middleware' => ['auth:sanctum']], function () {
            Route::get('/break/logout', [LogingController::class, 'logout'])->name('break.logout')->withoutMiddleware('select_branch');
            Route::post('customer-complete-register', [LogingController::class, 'completeRegister'])->name('customer-complete-register')->withoutMiddleware('select_branch');
            Route::post('customer-update/{id}', [CustomerAccountController::class, 'update'])->name('customer.update')->withoutMiddleware('select_branch');
            Route::get('/customer-account', [CustomerAccountController::class, 'index'])->name('customer.account')->withoutMiddleware('select_branch');
            Route::get('/orders', [OrderController::class, 'index'])->name('orders.index')->withoutMiddleware('select_branch');
            Route::get('/orderInfo', [OrderController::class, 'orderInfo'])->name('orderInfo')->withoutMiddleware('select_branch');
            Route::post('/orders/store', [OrderController::class, 'store'])->name('orders.store');
            Route::get('/create/order', [PaymentController::class, 'create'])->name('create.order');
            Route::get('/check-cashback', [PaymentController::class, 'checkCashback'])->name('checkCashback')->withoutMiddleware('select_branch');
            Route::get('/payment', [PaymentController::class, 'index'])->name('payment.index');
            Route::post('/payment/completed', [PaymentController::class, 'completed'])->name('completed.payment')->withoutMiddleware('select_branch');

            Route::get('/payment/callback', [PaymentController::class, 'callBack'])->name('callback.payment')->withoutMiddleware('select_branch');

        });

    });


    Route::post('/check-coupon/{code}', [CouponController::class, 'check'])->name('check.coupon');


});






