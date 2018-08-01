<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    //
    public function index()
    {
        $permissions =Permission::paginate(5);
        return view('Permission/index',compact('permissions'));
    }

    public function create()
    {
        return view('Permission/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'用户名不能为空'
        ]);

        Permission::create([
            'name'=>$request->name,
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('permissions.index');
    }

    public function edit(Permission $permission)
    {
        return view('Permission/edit',compact('permission'));
    }

    public function update(Request $request,Permission $permission)
    {
        $this->validate($request,[
            'name'=>'required'
        ],[
            'name.required'=>'用户名不能为空'
        ]);
        $permission->update([
            'name'=>$request->name,
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('permissions.index');
    }

    public function destroy(Permission $permission)
    {
        $permission->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('permissions.index');
    }
}
