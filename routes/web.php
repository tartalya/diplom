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

Route::get('/admin', 'AdminController@showAdminPanel')->name('admin')->middleware('auth');
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/ask', 'FaqController@showAskForm')->name('ask');
Route::post('/ask', 'FaqController@ask');

Route::get('/admin/answer/add', 'AdminController@showAnswerPage')->name('answer')->middleware('auth');

Route::get('/admin/answer/hided', 'AdminController@showHidedPage')->name('hided')->middleware('auth');

Route::get('/admin/answer/manage', 'AdminController@showManagePage')->name('manage')->middleware('auth');

Route::get('/admin/answer/category', 'AdminController@showAnswerByCategory')->middleware('auth');
Route::post('/admin/answer/category', 'AdminController@showAnswerByPostedCategory')->middleware('auth');

Route::get('/admin/categories', 'AdminController@showCategoriesPage')->name('categories')->middleware('auth');
Route::post('/admin/categories', 'CategoryController@addCategory')->middleware('auth');
Route::put('/admin/categories', 'CategoryController@editCategory')->middleware('auth');
Route::delete('/admin/categories', 'CategoryController@deleteCategory')->middleware('auth');


Route::resource('/admin/users', 'UserResourceController', ['names' => ['create' => 'user.create',
    'update' => 'user.update',
    'store' => 'user.store'
    ]])->middleware('auth');


Route::put('/admin/answer', 'AdminController@editAnswer')->name('put_answer')->middleware('auth');
Route::delete('/admin/answer', 'AdminController@deleteAnswer')->name('delete_answer')->middleware('auth');

