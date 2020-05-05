<?php


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
if (env('APP_DEBUG')) {
    Route::get('/debug', function () {
        $route = '/types';
        return redirect(url($route));
    })->name('debug');
    Route::get('/test', 'Controller@test')->name('test');
}

Route::get('/', 'WelcomeController@index')                                                                  ->name('welcome');


Route::get('/types',                fn() =>  view('types.index'))                                            ->name('types.index');
Route::get('types/{type}', fn(App\Type $type) => view('types.show')->with('type', $type))                       ->name('types.show');
Route::post('/types', 'TypesController@store')                                                              ->name('types.store');
Route::patch('/types/{type}', 'TypesController@update')                                                     ->name('types.update');
Route::delete('/types/{type}', 'TypesController@destroy')                                                   ->name('types.destroy');

Route::get('/products',             fn() => view('products.index'))                                          ->name('products.index');
Route::get('/products/{product}',   fn(App\Product $product) => view('products.show')->with('product', $product))   ->name('products.show');
Route::post('/products', 'ProductsController@store')                                                        ->name('products.store');
Route::patch('/products/{product}', 'ProductsController@update')                                            ->name('products.update');
Route::delete('/products/{product}', 'ProductsController@destroy')                                          ->name('products.destroy');

