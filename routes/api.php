<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group([

], function () {
    Route::post('login', 'AuthController@login')->name('login');
    Route::post('register', 'AuthController@register')->name('register');

    Route::group([
        'middleware' => 'auth:api'
    ], function () {
        Route::get('logout', 'AuthController@logout')->name('logout');

        Route::resource('categories', 'CategoryController')->only(['index', 'show'])->names('category');
        Route::resource('products', 'ProductController')->only(['index', 'show'])->names('product');
        Route::resource('customers', 'CustomerController')->only(['index', 'show'])->names('customer');
        Route::resource('orders', 'OrderController')->names('order');
        Route::resource('discounts', 'DiscountController')->names('discount');

        Route::get('orders/{order}/discounts', 'DiscountController@apply')->name('discount.apply');
    });
});
