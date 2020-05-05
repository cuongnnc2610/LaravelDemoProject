<?php

use Illuminate\Support\Facades\Route;
use App\TheLoai;

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
    return view('welcome');
});

Route::get('admin/login', 'UserController@getLogin');
Route::post('admin/login', 'UserController@postLogin');
Route::get('admin/logout', 'UserController@logout');

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function(){

	Route::resource('theloai', 'TheLoaiController', ['except' => ['show']]);

	Route::resource('loaitin', 'LoaiTinController', ['except' => ['show']]);

	Route::get('tintuc/loaitinOptions/{idTheLoai}', 'TinTucController@loaitinOptions');
	Route::delete('tintuc/deleteComment/{idComment}/{idTinTuc}', 'TinTucController@deleteComment');
	Route::resource('tintuc', 'TinTucController', ['except' => ['show']]);

	Route::resource('user', 'UserController', ['except' => ['show']]);

	Route::resource('slide', 'SlideController', ['except' => ['show']]);
});

