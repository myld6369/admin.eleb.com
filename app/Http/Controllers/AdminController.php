<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    Public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['']
        ]);
    }
    //
    public function index()
    {
        $admins =Admins::all();
        return view('Admin/index',compact('admins'));
    }

    public function create()
    {
        return view('Admin/create');
    }

    public function store(Request $request)
    {
        $admins = Admins::all();
        foreach ($admins as $admin){
            if ($admin->name==$request->name){
                session()->flash('danger', '用户名已存在');
                return back();
            }
        }

        if ($request->password!=$request->repassword){
            session()->flash('danger', '确认密码与输入密码不一致');
            return back();
        }
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确',
        ]);

        Admins::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'rememberToken'=>'x',
            'password'=>bcrypt($request->password)
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('admins.index');
    }

    public function edit(Admins $admin)
    {
        return view('Admin/edit',compact('admin'));
    }

    public function update(Request $request,Admins $admin)
    {


        if ($request->password!=$request->repassword){
            session()->flash('danger', '确认密码与输入密码不一致');
            return back();
        }
        $this->validate($request,[
            'name'=>'required',
            'email'=>'required',
            'password'=>'required',
            'captcha'=>'required|captcha'
        ],[
            'name.required'=>'用户名不能为空',
            'email.required'=>'用户名不能为空',
            'password.required'=>'密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确',
        ]);

        $admin->update([
            'name'=>$request->name,
            'email'=>$request->email,
            'rememberToken'=>'x',
            'password'=>bcrypt($request->password)
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('admins.index');
    }

    public function destroy(Admins $admin)
    {
        $admin->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('admins.index');
    }

    public function show(Admins $admin)
    {
        return view('Admin/password',compact('admin'));
    }
    public function password(Request $request,Admins $admin)
    {
        $this->validate($request,[
            'oldpassword'=>'required',
            'captcha'=>'required|captcha'
        ],[
            'oldpassword.required'=>'旧密码不能为空',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码不正确',
        ]);
        if ($admin->password!=bcrypt($request->oldpassword)){
            session()->flash('danger', '旧密码错误');
            return back();
        }
        if ($request->password!=$request->repassword){
            session()->flash('danger', '确认密码与输入密码不一致');
            return back();
        }
        $admin->update([
            'password'=>bcrypt($request->password)
        ]);
        session()->flash('success', '修改个人密码成功');
        return redirect()->route('admins.index');
    }
}
