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

Route::get('/', 'FrontController@index')->name('home');

Route::get('/post/{post}', 'FrontController@show')->where(['post'=>'[0-9]+'])->name('showPost');

Route::get('/stages', 'FrontController@showStages')->name('showStages');
Route::get('/formations', 'FrontController@showFormations')->name('showFormations');
Route::get('/contact', 'FrontController@showContact')->name('contact');
// TODO
// Route::get('/category/{category}', 'FrontController@showPostByCategory')->where(['category'=>'[0-9]+']);

// Route::group(['prefix' => 'admin', 'middleware' => 'auth'], function() {
// 	// Route::resource('category', 'CategoryController')->only(['index', 'create', 'edit']);
// 	Route::resource('post', 'PostController')->only(['index', 'create', 'edit']);
// });

Route::middleware('auth')->namespace('Admin')->prefix('admin')->group(function() {
	Route::resource('post', 'PostController');

	// This route will be used with Ajax
	Route::get('trash/{post}', 'PostController@trash')->where(['post'=>'[0-9]+'])->name('trash');
	Route::get('loadOneAndEdit/{post}', 'PostController@loadOneAndEdit')->where(['post'=>'[0-9]+'])->name('loadOneAndEdit');
});
// Route::get('/home', 'HomeController@index')->name('home');
