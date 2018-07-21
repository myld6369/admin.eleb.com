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

//Route::get('/', function () {
//    return view('welcome');
//});
Route::resource('/shops_categories','Shops_categoriesController');
Route::resource('/shops','ShopsController');
Route::patch('/shops/shen/{shop}','ShopsController@shen')->name('shops.shen');
Route::patch('/users/shen/{user}','UsersController@shen')->name('users.shen');
Route::resource('/users','UsersController');
Route::get('login', 'SessionsController@login')->name('login');
Route::post('login', 'SessionsController@store')->name('login.store');
Route::delete('logout', 'SessionsController@destroy')->name('logout');
Route::resource('/admins','AdminController');
Route::patch('/admins/password/{admin}','AdminController@password')->name('admins.password');
Route::patch('/users/password/{user}','UsersController@password')->name('users.password');
Route::resource('/activities','ActivityController');