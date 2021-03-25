<?php

use Illuminate\Support\Facades\Route;

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

//hyhyh屏蔽
//Route::get('/', function () {
//    return view('welcome');
//});

//hyhyh 2021年3月22日14:07:37
Route::get('/','StaticPageController@home')->name('home');
Route::get('/help','StaticPageController@help')->name('help');
Route::get('/about','StaticPageController@about')->name('about');

//hyhyh 注册页面 2021年3月23日11:12:37
Route::get('signup','UsersController@create')->name('signup');

Route::resource('users','UsersController');


//会话控制

//显示登录页面
Route::get('login','SessionController@create')->name('login');
//创建会话 登录
Route::post('login', 'SessionController@store')->name('login');
//销毁会话 退出
Route::delete('logout', 'SessionController@destroy')->name('logout');
