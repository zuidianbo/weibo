<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StaticPageController extends Controller
{
    // hyhyh 2021年3月22日14:03:59
    public function home(){
//        return"主页";
        return view('static_page/home');
    }

    public function help(){
//        return"帮助页";
        return view('static_page/help');
    }

    public function about(){
//        return "关于页";
        return view('static_page/about');
    }
}
