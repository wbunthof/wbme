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

Route::get('/types', 'TypesController@index')->name('types.index');
Route::get('types/{type}', 'TypesController@show')->name('types.show');
Route::post('/types', 'TypesController@store')->name('types.store');
Route::patch('/types/{type}', 'TypesController@update')->name('types.update');
Route::delete('/types/{type}', 'TypesController@destroy')->name('types.destroy');

Route::get('/products', 'ProductsController@index')->name('products.index');
Route::get('/products/{product}', 'ProductsController@show')->name('products.show');
Route::post('/products', 'ProductsController@store')->name('products.store');
Route::patch('/products/{product}', 'ProductsController@update')->name('products.update');
Route::delete('/products/{product}', 'ProductsController@destroy')->name('products.destroy');
