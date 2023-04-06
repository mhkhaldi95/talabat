<?php

use App\Http\Controllers\Dashboard\Addons\AddonController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\Coupons\CouponController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Orders\OrderController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\Settings\SettingsController;
use App\Http\Controllers\Dashboard\UserManagement\Admins\AccountSettingsController;
use App\Http\Controllers\Dashboard\UserManagement\Admins\AdminController;
use App\Http\Controllers\Dashboard\UserManagement\Branches\BranchController;
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



Route::group(['prefix' => 'admin','middleware'=>'locale'], function () {

    Route::group(['prefix' => 'auth','middleware'=>'guest'], function () {
        Route::get('login', [LoginController::class, 'index'])->name('login');
        Route::post('custom-login', [LoginController::class, 'login'])->name('custom-login');
    });

    Route::group(['middleware' => ['auth:sanctum','admin']], function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard.index');

        Route::group(['prefix' => 'auth'], function () {
            Route::get('logout', [LoginController::class, 'logout'])->name('logout')->withoutMiddleware('admin');
        });
        Route::get('{id}/account', [AccountSettingsController::class, 'create'])->name('admins.account.create');
        Route::post('account/update-info', [AccountSettingsController::class, 'updateInfo'])->name('admins.account.update-info');
        Route::post('account/update-email', [AccountSettingsController::class, 'updateEmail'])->name('admins.account.update-email');
        Route::post('account/update-password', [AccountSettingsController::class, 'updatePassword'])->name('admins.account.update-password');

        Route::group(['prefix' => 'admins'], function () {
            Route::get('/', [AdminController::class, 'index'])->name('admins.index');
            Route::get('/create/{id?}', [AdminController::class, 'create'])->name('admins.create');
            Route::post('/store', [AdminController::class, 'store'])->name('admins.store');
            Route::post('{id}/update', [AdminController::class, 'update'])->name('admins.update');
            Route::post('{id}/delete', [AdminController::class, 'delete'])->name('admins.delete');
            Route::post('delete-selected', [AdminController::class, 'deleteSelected'])->name('admins.deleteSelected');

        });

        Route::group(['prefix' => 'branches'], function () {
            Route::get('/', [BranchController::class, 'index'])->name('branches.index');
            Route::get('/create/{id?}', [BranchController::class, 'create'])->name('branches.create');
            Route::post('/store', [BranchController::class, 'store'])->name('branches.store');
            Route::post('{id}/update', [BranchController::class, 'update'])->name('branches.update');
            Route::post('{id}/delete', [BranchController::class, 'delete'])->name('branches.delete');
            Route::post('delete-selected', [BranchController::class, 'deleteSelected'])->name('branches.deleteSelected');


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


        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/create/{id?}', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/store/{id?}', [CategoryController::class, 'store'])->name('categories.store');
            Route::post('{id}/delete', [CategoryController::class, 'delete'])->name('categories.delete');
            Route::post('delete-selected', [CategoryController::class, 'deleteSelected'])->name('categories.deleteSelected');
        });

        Route::group(['prefix' => 'coupons'], function () {
            Route::get('/', [CouponController::class, 'index'])->name('coupons.index');
            Route::get('/create/{id?}', [CouponController::class, 'create'])->name('coupons.create');
            Route::post('/store/{id?}', [CouponController::class, 'store'])->name('coupons.store');
            Route::post('{id}/delete', [CouponController::class, 'delete'])->name('coupons.delete');
            Route::post('delete-selected', [CouponController::class, 'deleteSelected'])->name('coupons.deleteSelected');
        });
        Route::group(['prefix' => 'orders'], function () {
            Route::get('/', [OrderController::class, 'index'])->name('admin.orders.index');
            Route::get('/show/{id}', [OrderController::class, 'show'])->name('admin.orders.show');
            Route::delete('delete', [OrderController::class, 'delete'])->name('admin.orders.delete');
            Route::post('delete-selected', [OrderController::class, 'deleteSelected'])->name('admin.coupons.deleteSelected');
        });

        Route::group(['prefix' => 'addons'], function () {
            Route::get('/', [AddonController::class, 'index'])->name('addons.index');
            Route::get('/create/{id?}', [AddonController::class, 'create'])->name('addons.create');
            Route::post('/store/{id?}', [AddonController::class, 'store'])->name('addons.store');
            Route::post('{id}/delete', [AddonController::class, 'delete'])->name('addons.delete');
            Route::post('delete-selected', [AddonController::class, 'deleteSelected'])->name('addons.deleteSelected');
        });

        Route::group(['prefix' => 'products'], function () {
            Route::get('/', [ProductController::class, 'index'])->name('products.index');
            Route::get('/create/{id?}', [ProductController::class, 'create'])->name('products.create');
            Route::post('/store/{id?}', [ProductController::class, 'store'])->name('products.store');
//            Route::post('{id}/update', [CustomerController::class, 'update'])->name('customers.update');
            Route::post('{id}/delete', [ProductController::class, 'delete'])->name('products.delete');
            Route::post('delete-selected', [ProductController::class, 'deleteSelected'])->name('products.deleteSelected');
            Route::post('upload-photo', [ProductController::class, 'uploadPhotos'])->name('products.upload.photo');
            Route::post('remove-photo', [ProductController::class, 'removePhoto'])->name('products.remove.photo');
        });

        Route::group(['prefix' => 'settings'], function () {
            Route::get('/create/{id?}', [SettingsController::class, 'create'])->name('settings.create');
            Route::post('/store/{id?}', [SettingsController::class, 'store'])->name('settings.store');
        });



    });




//    Route::group(['middleware' => [ 'check-year-and-center','UserSystem']], function () {
//
//
//    });

});
