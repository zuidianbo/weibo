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
Route::get('/','StaticPageController@home');
Route::get('/help','StaticPageController@help');
Route::get('/about','StaticPageController@about');