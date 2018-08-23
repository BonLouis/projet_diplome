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


Auth::routes();

Route::get('/', 'FrontController@index');

Route::get('/post/{id}', 'FrontController@show')->where(['id'=>'[0-9]+']);

Route::get('/category/{id}', 'FrontController@showPostByCategory')->where(['id'=>'[0-9]+']);

Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
	Route::resource('category', 'CategoryController')->only(['index', 'create', 'edit']);
	Route::resource('post', 'PostController')->only(['index', 'create', 'edit']);
});

Route::get('/home', 'HomeController@index')->name('home');
