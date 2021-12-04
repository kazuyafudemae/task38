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

use App\User;

Auth::routes();


Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', function () {
		    return view('welcome');
});

Route::group(['prefix' => 'admin'], function(){
	//home
	Route::get('home', 'Admin\HomeController@index')->name('admin.home');
	//login logout
	Route::get('login', 'Admin\Auth\LoginController@showLoginForm')->name('admin.login');
	Route::post('login', 'Admin\Auth\LoginController@login')->name('admin.login');
	Route::post('logout', 'Admin\Auth\LoginController@logout')->name('admin.logout');
});

Route::group(['prefix' => 'address'], function(){
	Route::get('home', 'HomeController@index')->name('address.home');
	Route::get('register', 'Address\RegisterController@showRegisterForm')->name('address.register');
	Route::put('register', 'Address\RegisterController@register')->name('address.register');
	Route::get('edit', 'Address\EditController@showEditForm')->name('address.edit');
	Route::put('edit', 'Address\EditController@edit')->name('address.edit');
});

Route::group(['prefix' => 'cart'], function(){
	Route::get('home', 'HomeController@index')->name('carts.home');
});

