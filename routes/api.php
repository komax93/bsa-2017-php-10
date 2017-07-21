<?php

use Illuminate\Http\Request;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('cars', 'Api\CarsController@index');
Route::get('cars/{id}', 'Api\CarsController@show')->where('id', '[0-9]+');
Route::resource('admin/cars', 'Api\AdminController', ['except' => ['create', 'edit']]);