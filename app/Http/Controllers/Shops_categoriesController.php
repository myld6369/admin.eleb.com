<?php

namespace App\Http\Controllers;

use App\Models\Shops;
use App\Modles\Shops_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Shops_categoriesController extends Controller
{
    //
    Public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['']
        ]);
    }
    public function index()
    {
        $shops_categories = Shops_categories::all();
        return view('Shops_categories/index',compact('shops_categories'));
    }

    public function create()
    {
        return view('Shops_categories/create');
    }

    public function store(Request $request)
    {
        $img =$request->img;
        if (empty($img)){
            $image ='public/img/5HlwEqtJNUEEbjT73j9d6dUfLrftFhex5LaT2fly.gif';
        }else{
            $image=$img->store('public/img');
        }

        $this->validate($request,[
            'name'=>'required|max:10',
        ],[
            'name.required'=>'分类名称不能为空!',
            'name.max'=>'分类名称最多10个字符',
        ]);
        $status=$request->status;
        if (empty($status)){
            $status=0;
        }
        Shops_categories::create([
            'name'=>$request->name,
            'img'=>$image,
            'status'=>$status
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('shops_categories.index');
    }


    public function edit(Shops_categories $shops_category)
    {

        return view('Shops_categories/edit',compact('shops_category'));
    }

    public function update(Request $request,Shops_categories $shops_category)
    {
        $img =$request->img;
        if (empty($img)){
            $image =$shops_category->img;
        }else{
            $image=$img->store('public/img');
        }

        $this->validate($request,[
            'name'=>'required|max:10',
        ],[
            'name.required'=>'分类名称不能为空!',
            'name.max'=>'分类名称最多10个字符',
        ]);
        $status=$request->status;
        if (empty($status)){
            $status=0;
        }
        $shops_category->update([
            'name'=>$request->name,
            'img'=>$image,
            'status'=>$status
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('shops_categories.index');
    }

    public function destroy(Shops_categories $shops_category)
    {
        $count =DB::table("shops")->where('shop_category_id',$shops_category->id)->count();
        if ($count>0){
            session()->flash('success', '该分类中有数据不能删除');
        }else{
            $shops_category->delete();
            session()->flash('success', '删除成功');
        }
        return redirect()->route('shops_categories.index');
    }
}
