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

Route::get('/', 'FaqController@ShowIndex')->name('index');

Route::get('/login', 'UserController@ShowLoginForm')->name('login');

Route::post('/login', 'UserController@Auth');

Route::get('/admin', 'AdminController@ShowAdminPanel')->name('admin');
Route::get('/admin/users', 'AdminController@ManageUsers')->name('manageUsers');
Route::post('/admin/users', 'AdminController@EditUser');
Route::get('/logout', 'UserController@Logout')->name('logout');
Route::get('/ask', 'FaqController@ShowAskForm')->name('ask');
Route::post('/ask', 'FaqController@Ask');

Route::get('/admin/answer/add', 'AdminController@ShowAnswerPage')->name('answer');
Route::post('/admin/answer/add', 'AdminController@SetAnswer');

Route::get('/admin/answer/manage', 'AdminController@ShowManagePage')->name('manage');
