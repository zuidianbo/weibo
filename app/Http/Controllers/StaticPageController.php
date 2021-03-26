<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Status;
use Auth;

class StaticPageController extends Controller
{
    // hyhyh 2021年3月22日14:03:59
    public function home(){
//        return"主页";
//        return view('static_page/home');

        $feed_items = [];
        if (Auth::check()) {
            $feed_items = Auth::user()->feed()->paginate(30);
        }

        return view('static_page/home', compact('feed_items'));



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
