<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    //
    public function index()
    {
        $roles =Role::paginate(5);
        foreach ($roles as &$role){
            $role->permission =$role->permissions;
        }
        return view('Role/index',compact('roles'));
    }

    public function create()
    {
        $permissions =Permission::all();
        return view('Role/create',compact('permissions'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required|unique:roles',
        ],[
            'name.required'=>'角色不能为空',
            'name.unique'=>'角色已存在'
        ]);

        DB::beginTransaction();
        try{
            $role = Role::create([
            'name'=>$request->name,
        ]);
            if (!empty($request->permission)){
                $role->givePermissionTo($request->permission);
            }
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('success', '添加失败');
            return back();
        }
        session()->flash('success', '添加成功');
        return redirect()->route('roles.index');
    }

    public function edit(Role $role)
    {

        $permissions = Permission::all();
        return view('Role/edit',compact('role','permissions'));
    }

    public function update(Request $request,Role $role)
    {
        $this->validate($request,[
            'name'=>'required',
        ],[
            'name.required'=>'角色不能为空',
            'name.unique'=>'角色已存在'
        ]);
        DB::beginTransaction();
        try{
            $role->update([
                'name'=>$request->name,
            ]);
            $role->syncPermissions($request->permission);
            DB::commit();
        }catch (\Exception $e) {
            DB::rollBack();
            session()->flash('success', '修改失败');
            return back();
        }
        session()->flash('success', '修改成功');
        return redirect()->route('roles.index');
    }

    public function destroy(Role $role)
    {
        $role->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('roles.index');
    }
}
