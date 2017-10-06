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

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/', 'AdminController@showAdminPanel')->name('admin');
    Route::get('answer/add', 'AdminController@showAnswerPage')->name('answer');
    Route::get('answer/hided', 'AdminController@showHidedPage')->name('hided');
    Route::get('answer/manage', 'AdminController@showManagePage')->name('manage');
    Route::get('answer/category', 'AdminController@showAnswerByCategory');
    Route::post('answer/category', 'AdminController@showAnswerByPostedCategory');
    Route::get('categories', 'AdminController@showCategoriesPage')->name('categories');
    Route::post('categories/add', 'CategoryController@addCategory')->name('category_add');
    Route::put('categories/edit', 'CategoryController@editCategory')->name('category_edit');
    Route::delete('categories', 'CategoryController@deleteCategory');
    Route::resource('users', 'UserResourceController', ['names' => ['update' => 'user.update',
        'store' => 'user.store']],
        ['except' => ['create']]);
    Route::put('answer', 'AdminController@editAnswer')->name('put_answer');
    Route::delete('answer', 'AdminController@deleteAnswer')->name('delete_answer');
});
