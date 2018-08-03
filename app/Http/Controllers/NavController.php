<?php

namespace App\Http\Controllers;

use App\Models\Nav;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Permission;

class NavController extends Controller
{
    //
    public function index()
    {
        if (!Auth::user()->can('nav-index')){
            return redirect()->route('403');
        }
         $navs =Nav::paginate(5);
         $nav['pname']=[];
         foreach ($navs as &$nav){
             if ($nav->pid==0){
                 $nav['pname']="顶级菜单";
             }else{
                 $n = Nav::where('id',$nav->pid)->first();
                 $nav['pname']=$n->name;
             }
         }
         return view('Nav/index',compact('navs'));
    }

    public function create()
    {
        if (!Auth::user()->can('nav-create')){
            return redirect()->route('403');
        }
        $permissions = Permission::all();
        $navs =Nav::all();
        return view('Nav/create',compact('navs','permissions'));
    }

    public function store(Request $request)
    {
        if (!Auth::user()->can('nav-create')){
            return redirect()->route('403');
        }
        $this->validate($request,[
            'name'=>'required|unique:navs',
            'url'=>'required',
            'permission_id'=>'required',
            'pid'=>'required',
        ],[
            'name.required'=>'菜单名称不能为空',
            'name.unique'=>'菜单名称已存在',
            'url.required'=>'菜单地址不能为空',
            'permission_id.required'=>'菜单权限不能为空',
            'pid.required'=>'菜单层级不能为空',
        ]);

        Nav::create([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid
        ]);

        session()->flash('success', '添加成功');
        return redirect()->route('navs.index');
    }

    public function edit(Nav $nav)
    {
        if (!Auth::user()->can('nav-edit')){
            return redirect()->route('403');
        }
        $permissions = Permission::all();
        $navs =Nav::all();
        return view('Nav.edit',compact('nav','navs','permissions'));
    }

    public function update(Request $request,Nav $nav)
    {
        if (!Auth::user()->can('nav-edit')){
            return redirect()->route('403');
        }
        $this->validate($request,[
            'name'=>[
                'required',
                Rule::unique('users')->ignore($nav->id, 'id')
            ],
            'url'=>'required',
            'permission_id'=>'required',
            'pid'=>'required',
        ],[
            'name.required'=>'菜单名称不能为空',
            'name.unique'=>'菜单名称已存在',
            'url.required'=>'菜单地址不能为空',
            'permission_id.required'=>'菜单权限不能为空',
            'pid.required'=>'菜单层级不能为空',
        ]);
        $nav->update([
            'name'=>$request->name,
            'url'=>$request->url,
            'permission_id'=>$request->permission_id,
            'pid'=>$request->pid
        ]);

        session()->flash('success', '修改成功');
        return redirect()->route('navs.index');
    }

    public function destroy(Nav $nav)
    {
        $navs = Nav::all();
        foreach ($navs as $v){
            if ($v->pid==$nav->id){
                session()->flash('danger', '该菜单有子菜单不能删除');
                return back();
            }
        }

        $nav->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('navs.index');
    }
}
