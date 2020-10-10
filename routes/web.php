<?php

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



Auth::routes();

Route::get('/', 'ProductController@index')->name('home');

Route::get('product/{product}/loading','ProductController@loading')->name('product.loading');
Route::post('product/{product}/upload','ImageController@uploadImgProduct')->name('product.upload');
Route::delete('product/{product}/img/destroy','ImageController@destroyImgProduct')->name('product.img.destroy');

Auth::routes();

Route::resources([
    'product' => 'ProductController',
]);
