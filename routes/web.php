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

Route::get('/', 'IndexController')->name('home');

Route::resource('cars', 'CarsController');

Auth::routes();

Route::get('login/github', 'Auth\GithubLoginController@redirectToProvider')->name('github.login');
Route::get('login/github/callback', 'Auth\GithubLoginController@handleProviderCallback');