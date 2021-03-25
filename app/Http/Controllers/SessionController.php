<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class SessionController extends Controller
{
    //登录页面
    public function create(){
        return view('session.create');

    }

//    创建会话 登录

public function store(Request $request){

        $credentials=$this->validate($request,[
            'email' => 'required|email|max:255',
            'password' => 'required'
        ]);


    if (Auth::attempt($credentials,$request->has('remember'))) {
        // 登录成功后的相关操作
        session()->flash('success', '欢迎回来！');

//        return redirect()->route('users.show', [Auth::user()]);

        $fallback = route('users.show', Auth::user());
        return redirect()->intended($fallback);


    } else {
        // 登录失败后的相关操作
        session()->flash('danger', '很抱歉，您的邮箱和密码不匹配');
        return redirect()->back()->withInput();
    }

    return;

}

//退出
    public function destroy()
    {
        Auth::logout();
        session()->flash('success', '您已成功退出！');
        return redirect('/');
    }

//只让未登录用户访问登录页面：
    public function __construct()
    {
        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }



}
