<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Mail;
use Auth;

class UsersController extends Controller
{
    //
public function create(){

    return view('user.create');
}


    public function show(User $user)
    {
//        显示用户信息
//        权限 用户只能编辑自己的资料(只能自己查看自己的个人中心页面=微博列表)
//        教程最后一节 关注 取消其他用户的时候 要把这个限制去掉！！！
//        $this->authorize('update', $user);
//        return view('user.show', compact('user'));

//        微博
        $statuses = $user->statuses()
            ->orderBy('created_at', 'desc')
            ->paginate(10);
        return view('user.show', compact('user', 'statuses'));


    }




//注册
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
//        Auth::login($user);

//发送邮件
        $this->sendEmailConfirmationTo($user);

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
            'except' => ['create','store','show','index','confirmEmail']
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


//删除用户
    public function destroy(User $user)
    {
        $this->authorize('destroy', $user);
        $user->delete();
        session()->flash('success', '成功删除用户！');
        return back();
    }



//该方法将用于发送邮件给指定用户。
    protected function sendEmailConfirmationTo($user)
    {
        $view = 'emails.confirm';
        $data = compact('user');
        $from = 'summer@example.com';
        $name = 'Summer';
        $to = $user->email;
        $subject = "感谢注册 Weibo 应用！请确认你的邮箱。";

        Mail::send($view, $data, function ($message) use ($from, $name, $to, $subject) {
            $message->from($from, $name)->to($to)->subject($subject);
        });
    }



//邮件发送

    public function confirmEmail($token)
    {
        $user = User::where('activation_token', $token)->firstOrFail();

        $user->activated = true;
        $user->activation_token = null;
        $user->save();

        Auth::login($user);
        session()->flash('success', '恭喜你，激活成功！');
        return redirect()->route('users.show', [$user]);
    }



    public function followings(User $user)
    {
        $users = $user->followings()->paginate(30);
        $title = $user->name . '关注的人';
        return view('user.show_follow', compact('users', 'title'));
    }

    public function followers(User $user)
    {
        $users = $user->followers()->paginate(30);
        $title = $user->name . '的粉丝';
        return view('user.show_follow', compact('users', 'title'));
    }


}
