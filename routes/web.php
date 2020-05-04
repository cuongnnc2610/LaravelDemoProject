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

Route::group(['prefix' => 'admin'], function(){
	Route::group(['prefix' => 'theloai'], function(){
		Route::get('danhsach', 'TheLoaiController@get');
		Route::get('sua', 'TheLoaiController@edit');
		Route::get('them', 'TheLoaiController@add');
	});

	Route::group(['prefix' => 'loaitin'], function(){
		Route::get('danhsach', 'LoaiTinController@get');
		Route::get('sua', 'LoaiTinController@edit');
		Route::get('them', 'LoaiTinController@add');
	});

	Route::group(['prefix' => 'tintuc'], function(){
		Route::get('danhsach', 'TinTucController@get');
		Route::get('sua', 'TinTucController@edit');
		Route::get('them', 'TinTucController@add');
	});

	Route::group(['prefix' => 'slide'], function(){
		Route::get('danhsach', 'SlideController@get');
		Route::get('sua', 'SlideController@edit');
		Route::get('them', 'SlideController@add');
	});

	Route::group(['prefix' => 'user'], function(){
		Route::get('danhsach', 'UserController@get');
		Route::get('sua', 'UserController@edit');
		Route::get('them', 'UserController@add');
	});

	Route::group(['prefix' => 'comment'], function(){
		Route::get('danhsach', 'CommentController@get');
		Route::get('sua', 'CommentController@edit');
		Route::get('them', 'CommentController@add');
	});
});