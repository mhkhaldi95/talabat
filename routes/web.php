<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Dashboard\Auth\LoginController;
use Illuminate\Support\Facades\App;
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

Route::get('/setLocale/{locale}', function ($locale){
    $langs = ['ar','en'];
    if (isset($locale) && in_array($locale, $langs)) {
        App::setLocale($locale);
        session(['locale' => $locale]);
    }
    return back();
})->name('setLocale');
Route::get('clear', [Controller::class, 'clear']);


Route::get('/test-payment', function (){

    return view('welcome');
})->name('test-payment');

