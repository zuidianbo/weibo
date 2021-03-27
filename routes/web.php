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

//激活路由
Route::get('signup/confirm/{token}', 'UsersController@confirmEmail')->name('confirm_email');


//重置密码
//显示重置密码的邮箱发送页面
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
//邮箱发送重设链接
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
//密码更新页面
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
//执行密码更新操作
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

//微博
Route::resource('statuses', 'StatusesController', ['only' => ['store']]);
Route::delete('/statuses/{status}', 'StatusesController@destroy1')->name('statuses.destroy1');
//Route::delete('/users/{user}', 'UsersController@destroy')->name('users.destroy');

//关注的人列表
Route::get('/users/{user}/followings', 'UsersController@followings')
    ->name('users.followings');

//粉丝列表
Route::get('/users/{user}/followers', 'UsersController@followers')
    ->name('users.followers');

//关注用户
Route::post('/users/followers/{user}', 'FollowersController@store')->name('followers.store');

//取消用户
Route::delete('/users/followers/{user}', 'FollowersController@destroy')->name('followers.destroy');