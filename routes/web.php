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

Route::get('/', function () {
    return view('home');
});

Auth::routes();

Route::get('/home', [
  'uses' => 'HomeController@index',
  'as' => 'home',

]);
Route::get('/bills/create/{id}',
[
  'uses' => 'BillsController@create',
  'as' => 'createbill',
  'role' => 'admin'
])->middleware('role');


Route::post('/bills/create',
[
  'uses' => 'BillsController@store',
  'as' => 'storebill',
  'role' => 'admin'
])->middleware('role');

Route::get('/admin', [
  'uses' => 'AdminController@index',
  'as' => 'admin',
  'role' => 'admin'
])->middleware('role');



Route::get('/bills',
[
  'uses' => 'BillsController@index',
  'as' => 'bills',
  'role' => 'user'
])->middleware('role');


Route::get('/bills/{id}',
[
  'uses' => 'BillsController@showPayForm',
  'as' => 'paybill',
  'role' => 'user'
])->middleware('role');


Route::post('/bills/pay/{id}',
[
  'uses' => 'BillsController@pay',
  'as' => 'pay',
  'role' => 'user'
])->middleware('role');

Route::get('/admin/makeadmin/{id}',
[
  'uses' => 'AdminController@makeAdmin',
  'as' => 'makeadmin',
  'role' => 'admin'
])->middleware('role');
