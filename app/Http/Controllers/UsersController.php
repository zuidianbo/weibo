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
//        显示用户信息
        $this->authorize('update', $user);
        return view('user.show', compact('user'));
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


//编辑用户
    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('user.edit', compact('user'));
    }

//    保存编辑
    public function update(User $user, Request $request)
    {
        $this->authorize('update', $user);
        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);
//
//        $user->update([
//            'name' => $request->name,
//            'password' => bcrypt($request->password),
//        ]);

        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }
        $user->update($data);

        session()->flash('success', '个人资料更新成功！');

        return redirect()->route('users.show', $user->id);
    }



//   对控制器的动作进行过滤
    public function __construct()
    {

        //  过滤动作，只有登录了，才能执行除了except中的动作：在这个范围里的，都是登不登录都能执行的。
        $this->middleware('auth', [
            'except' => ['create','store','index']
        ]);

//        只让未登录用户访问注册页面：
//        其实也可以通过上面的 auth 属性来对控制器的一些动作进行过滤 上面的auto属性中，except中，去掉create应该也无法访问了，不过那个无法访问是跳转到登录页面，这个是跳转到 /home  由于不存在这个页面 所以 显示404错误！
        $this->middleware('guest', [
            'only' => ['create']
        ]);

    }


//    public function index()
//    {
//        return view('user/index');
//    }
//
//    用户列表 路由 /users
    public function index()
    {
//        获取所有的数据
//        $usershhh = User::all();

//        分页
//       使用 paginate 方法来指定每页生成的数据数量为 10 条
        $usershhh = User::paginate(10);
        return view('user.index', compact('usershhh'));
    }


}
