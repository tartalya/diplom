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

Route::get('/', 'FaqController@showIndex')->name('index');

Route::get('/login', 'UserController@showLoginForm')->name('login');

Route::post('/login', 'UserController@auth');

Route::get('/admin', 'AdminController@showAdminPanel')->name('admin');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/ask', 'FaqController@showAskForm')->name('ask');
Route::post('/ask', 'FaqController@ask');

Route::get('/admin/answer/add', 'AdminController@showAnswerPage')->name('answer');
Route::put('/admin/answer/add', 'AdminController@editAnswer');
Route::delete('/admin/answer/add', 'AdminController@deleteAnswer');

Route::get('/admin/answer/hided', 'AdminController@showHidedPage')->name('hided');
Route::put('/admin/answer/hided', 'AdminController@editAnswer');
Route::delete('/admin/answer/hided', 'AdminController@deleteAnswer');


Route::get('/admin/answer/manage', 'AdminController@showManagePage')->name('manage');
Route::put('/admin/answer/manage', 'AdminController@editAnswer');
Route::delete('/admin/answer/manage', 'AdminController@deleteAnswer');

Route::get('/admin/answer/category', 'AdminController@showAnswerByCategory');
Route::post('/admin/answer/category', 'AdminController@showAnswerByPostedCategory');

Route::get('/admin/categories', 'AdminController@showCategoriesPage')->name('categories');
Route::post('/admin/categories', 'CategoryController@manageCategories');

Route::resource('/admin/users', 'UserResourceController');

