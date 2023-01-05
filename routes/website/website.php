<?php

use App\Http\Controllers\Dashboard\Addons\AddonController;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use App\Http\Controllers\Dashboard\Categories\CategoryController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\Products\ProductController;
use App\Http\Controllers\Dashboard\UserManagement\Admins\AdminController;
use App\Http\Controllers\Dashboard\UserManagement\Customers\CustomerController;
use App\Http\Controllers\Dashboard\UserManagement\Roles\RoleController;
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

    Route::group(['middleware' => ['auth:sanctum']], function () {

    });





