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
Route::post('/contact', 'FrontController@sendContactMail')->name('contact.send');

Route::get('/search', 'SearchController@doQuery')->middleware(\Barryvdh\Cors\HandleCors::class);

Route::middleware('auth')->namespace('Admin')->prefix('admin')->group(function() {
	Route::resource('post', 'PostController');

	// This route will be used with Ajax
	Route::get('trash/{post}', 'AjaxController@trash')->where(['post'=>'[0-9]+'])->name('trash');
	Route::get('loadOneAndEdit/{post}', 'AjaxController@loadOneAndEdit')->where(['post'=>'[0-9]+']);
	Route::get('loadBlankForm', 'AjaxController@loadBlankForm');
	Route::get('loadTrashes', 'AjaxController@loadTrashes');
	Route::post('untrash', 'AjaxController@untrash');
	Route::post('destroyTrash', 'AjaxController@destroyTrash');
});
// Route::get('/home', 'HomeController@index')->name('home');
