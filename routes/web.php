<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\UrlController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::group(['prefix' => '/urls', 'as' => 'url.'], function () {
    Route::get('{url}', [UrlController::class, 'show'])->name('show');
    Route::get('', [UrlController::class, 'index'])->name('index');
    Route::post('', [UrlController::class, 'store'])->name('store');
});
