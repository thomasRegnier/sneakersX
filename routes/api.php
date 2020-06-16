<?php

use Illuminate\Http\Request;
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

//Route::middleware('auth:api')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::get('/news', 'NewsController@index');
Route::get('/news/{id}', 'NewsController@show');

Route::get('/brands', 'BrandController@index');
Route::get('/brands/{id}', 'BrandController@show');

Route::post('/login', 'UserController@login');
Route::post('/register', 'UserController@register');
Route::post('/logout', 'UserController@logout');

Route::get('/products', 'ProductController@index');
Route::get('/products/{id}', 'ProductController@show');

Route::post('/order', 'OrderController@store');
Route::get('/order/{id}', 'OrderController@show');
Route::post('/contact', 'ContactController@sendMail');

Route::get('/admin/news', 'NewsController@indexAdmin');

Route::delete('/admin/news/{id}', 'NewsController@destroy');
Route::post('/admin/news', 'NewsController@store');
Route::post('/admin/news/{id}', 'NewsController@update');

Route::get('/admin/brands', 'BrandController@index');
Route::post('/admin/brands', 'BrandController@store');
Route::delete('/admin/brands/{id}', 'BrandController@destroy');
Route::get('/admin/brands/{id}', 'BrandController@adminShow');
Route::post('/admin/brand/{id}', 'BrandController@update');
Route::get('/admin/products', 'ProductController@adminIndex');
Route::post('/admin/product', 'ProductController@store');
Route::get('/admin/product/{id}', 'ProductController@show');
Route::post('/admin/product/{id}', 'ProductController@update');
Route::delete('/admin/images/{id}', 'ImageController@destroy');
Route::post('/admin/images', 'ImageController@store');
Route::delete('/admin/product/{id}', 'ProductController@destroy');



















