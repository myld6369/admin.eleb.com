<?php

namespace App\Http\Controllers;

use App\Models\Admins;
use App\Models\Shops;
use App\Models\Users;
use App\Modles\Shops_categories;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
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
        $users = Users::all();
        return view('Users/index',compact('users'));
    }


    public function shen(Users $user)
    {
        if ($user->status==1){
            $status =0;
        }else{
            $status =1;
        }

        $user->update([
            'status'=>$status
        ]);
        return redirect()->route('users.index');
    }

    public function edit(Users $user)
    {
        $shops =Shops::all();
        return view('Users/edit',compact('user','shops'));
    }

    public function update(Users $user,Request $request)
    {
        $this->validate($request,[
            'name'=>[
                'required',
                'min:6',
                'max:16',
                Rule::unique('users')->ignore($user->id, 'id'),
            ],
            'email'=>[
                Rule::unique('users')->ignore($user->id, 'id'),
                'required',
                'email'
            ],
        ],[
            'name.required'=>'用户名不能为空',
            'name.min'=>'用户名不能小于6位',
            'name.max'=>'用户名不能大于6位',
            'name.unique'=>'用户名已存在',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'该邮箱已存在',

        ]);

        $user->update([
            'name'=>$request->name,
            'email'=>$request->email
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('users.index');
    }

    public function show(Users $user)
    {
        return view('Users/show',compact('user'));
    }

    public function password(Request $request,Users $user)
    {
        if ($request->password!=$request->repassword){
            session()->flash('success', '确认密码与输入密码不一致');
            return back();
        }
        $this->validate($request,[
            'captcha'=>'required|captcha'
        ],[
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码错误'
        ]);
        $user->update([
            'password'=>bcrypt($request->password)
        ]);
        session()->flash('success', '重置密码成功');
        return redirect()->route('users.index');
    }
}
