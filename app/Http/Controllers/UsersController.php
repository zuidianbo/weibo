<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    //
public function create(){

    return view('user.create');
}


    public function show(User $user)
    {
        return view('user.show', compact('user'));
    }


    public function index()
    {
        return view('user/index');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:users|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);


//        注册后自动登录
        Auth::login($user);

        session()->flash('danger', '这里是你大爷中心~');
        session()->flash('warning', '这里是你大爷中心~');
        session()->flash('success', '这里是你大爷中心~');
        session()->flash('info', '这里是你大爷中心~');

        return redirect()->route('users.show', [$user]);


    }
}
