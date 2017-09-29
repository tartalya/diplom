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
Route::get('/logout', 'UserController@logout')->name('logout');
Route::get('/ask', 'FaqController@showAskForm')->name('ask');
Route::post('/ask', 'FaqController@ask');

Route::middleware('auth')->group(function () {
    Route::get('/admin', 'AdminController@showAdminPanel')->name('admin');
    Route::get('/admin/answer/add', 'AdminController@showAnswerPage')->name('answer');
    Route::get('/admin/answer/hided', 'AdminController@showHidedPage')->name('hided');
    Route::get('/admin/answer/manage', 'AdminController@showManagePage')->name('manage');
    Route::get('/admin/answer/category', 'AdminController@showAnswerByCategory');
    Route::post('/admin/answer/category', 'AdminController@showAnswerByPostedCategory');
    Route::get('/admin/categories', 'AdminController@showCategoriesPage')->name('categories');
    Route::post('/admin/categories', 'CategoryController@addCategory');
    Route::put('/admin/categories', 'CategoryController@editCategory');
    Route::delete('/admin/categories', 'CategoryController@deleteCategory');
    Route::resource('/admin/users', 'UserResourceController', ['names' => ['create' => 'user.create',
            'update' => 'user.update',
            'store' => 'user.store']]);
    Route::put('/admin/answer', 'AdminController@editAnswer')->name('put_answer');
    Route::delete('/admin/answer', 'AdminController@deleteAnswer')->name('delete_answer');
});
