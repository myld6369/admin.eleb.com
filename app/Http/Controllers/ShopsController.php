<?php

namespace App\Http\Controllers;


use App\Models\Shops;
use App\Models\Users;
use App\Modles\Shops_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ShopsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['']
        ]);
    }
        //
    public function index()
    {
        $shops =Shops::all();
        return view('Shops/index',compact('shops'));
    }

    public function create()
    {
        $categories = Shops_categories::all();
        return view('Shops/create',compact('categories'));

    }

    public function store(Request $request)
    {


        $names =Users::all();
        foreach ($names as $name){
            if ($name->name==$request->name){
                session()->flash('danger', '用户名已存在');
                return back();
            }
        }

        if ($request->password!=$request->repassword){
            session()->flash('danger', '确认密码与输入密码不一致');
            return back();
        }
        $this->validate($request,[
            'shop_name'=>'required|max:10',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',
            'name'=>'required|min:6|max:16|unique:users',
            'password'=>'required|min:6|max:16',
            'email'=>'required|email|unique:users',
            'captcha'=>'required|captcha',
            'shop_img'=>'required'

        ],[
            'shop_name.required'=>'店铺名称不能为空!',
            'shop_name.max'=>'店铺名称最多10个字符',
            'shop_rating.required'=>'评分不能为空',
            'start_send.required'=>'起送金额不能为空',
            'send_cost.required'=>'配送费不能为空',
            'notice.required'=>'店公告不能为空',
            'discount.required'=>'优惠信息不能为空',
            'name.required'=>'用户名不能为空',
            'email.required'=>'邮箱不能为空',
            'email.email'=>'邮箱格式不正确',
            'email.unique'=>'邮箱已存在',
            'name.min'=>'用户名不能小于6位',
            'name.max'=>'用户名不能大于6位',
            'name.unique'=>'用户名已存在',
            'password.required'=>'密码不能为空',
            'password.min'=>'密码不能小于6位',
            'password.max'=>'密码不能大于6位',
            'captcha.required'=>'验证码不能为空',
            'captcha.captcha'=>'验证码错误',
            'shop_img.required'=>'图片不能为空'
        ]);

        $img =$request->shop_img;


        DB::beginTransaction();
        try{
            $id=Shops::create([
                'shop_name'=>$request->shop_name,
                'shop_category_id'=>$request->shop_category_id,
                'shop_img'=>$img,
                'shop_rating'=>$request->shop_rating,
                'brand'=>$request->brand,
                'on_time'=>$request->on_time,
                'fengniao'=>$request->fengniao,
                'bao'=>$request->bao,
                'piao'=>$request->piao,
                'zhun'=>$request->zhun,
                'start_send'=>$request->start_send,
                'send_cost'=>$request->send_cost,
                'notice'=>$request->notice,
                'discount'=>$request->discount,
                'status'=>$request->status
            ]);


            Users::create([
                'name'=>$request->name,
                'password'=>bcrypt($request->password),
                'email'=>$request->email,
                'status'=>1,
                'shop_id'=>$id->id,
                'remember_token'=>'xxxx'
            ]);
             DB::commit();
            session()->flash('success', '注册成功');
            return redirect()->route('shops.index');
        }catch (\Exception $e) {
             DB::rollBack();
            session()->flash('danger', '注册失败');
            return redirect()->route('shops.create');
        }



    }

    public function edit(Shops $shop)
    {
        $categories =Shops_categories::all();
        return view('Shops/edit',compact('shop','categories'));
    }

    public function update(Request $request,Shops $shop)
    {
        $img =$request->shop_img;
        if (empty($img)){
            $img=$shop->shop_img;
        }else{
            $img =$request->shop_img;
        }

        $this->validate($request,[
            'shop_name'=>'required|max:10',
            'shop_rating'=>'required',
            'start_send'=>'required',
            'send_cost'=>'required',
            'notice'=>'required',
            'discount'=>'required',


        ],[
            'shop_name.required'=>'店铺名称不能为空!',
            'shop_name.max'=>'店铺名称最多10个字符',
            'shop_rating.required'=>'评分不能为空',
            'start_send.required'=>'起送金额不能为空',
            'send_cost.required'=>'配送费不能为空',
            'notice.required'=>'店公告不能为空',
            'discount.required'=>'优惠信息不能为空',
        ]);

        $shop->update([
            'shop_name'=>$request->shop_name,
            'shop_category_id'=>$request->shop_category_id,
            'shop_img'=>$img,
            'shop_rating'=>$request->shop_rating,
            'brand'=>$request->brand,
            'on_time'=>$request->on_time,
            'fengniao'=>$request->fengniao,
            'bao'=>$request->bao,
            'piao'=>$request->piao,
            'zhun'=>$request->zhun,
            'start_send'=>$request->start_send,
            'send_cost'=>$request->send_cost,
            'notice'=>$request->notice,
            'discount'=>$request->discount,
            'status'=>$request->status
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('shops.index');
    }

    public function destroy(Shops $shop)
    {
        $shop->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('shops.index');
    }

    public function show(Shops $shop)
    {
        return view('Shops/show',compact('shop'));
    }

    public function shen(Shops $shop)
    {
        if ($shop->status==1){
            $status=-1;
        }else{
            $status=1;
        }

        $shop->update([
            'status'=>$status
        ]);
        if ($status==1){
            $user= Users::where('shop_id',$shop->id)->first();
            $email =$user->email;
            \Illuminate\Support\Facades\Mail::raw('您的店铺'.$shop->shop_name.'已通过审核',function($message)use($email){
                $message->from('18200367375@163.com','店铺审核通知');
                $message->to([$email])->subject('皮皮');

            });
        }
        return back();
    }
}
