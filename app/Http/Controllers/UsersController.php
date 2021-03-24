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
        return view('user/show', compact('user'));
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
        return;
    }
}
