<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\Users;
use Illuminate\Http\Request;

class EventMemberController extends Controller
{
    //
    public function index()
    {
        $eventmembers = EventMember::paginate(10);
        return view('EventMember/index',compact('eventmembers'));
    }

    public function create()
    {
        $events = Event::all();
        $users = Users::all();
        return view('EventMember/create',compact('events','users'));
    }

    public function store(Request $request)
    {

        $evemembers =EventMember::all();
        foreach ($evemembers as $evemember){
            if ($request->member_id==$evemember->member_id&&$request->events_id==$evemember->events_id){
                session()->flash('danger', '该商户已报名,请勿重复操作');
                return back();
            }
        }

        $this->validate($request,[
            'member_id'=>'required',
            'events_id'=>'required'
        ],[
            'member_id.required'=>'商家账号不能为空',
            'events_id.required'=>"活动不能为空"
        ]);
        EventMember::create([
            'member_id'=>$request->member_id,
            'events_id'=>$request->events_id
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('eventmembers.index');
    }

    public function edit(EventMember $eventmember)
    {
        $users = Users::all();
        $events = Event::all();
        return view('EventMember/edit',compact('eventmember','events','users'));
    }

    public function update(Request $request,EventMember $eventmember)
    {
        $evemembers =EventMember::all();
        foreach ($evemembers as $evemember){
            if ($request->member_id==$evemember->member_id&&$request->events_id==$evemember->events_id){
                if ($request->member_id==$eventmember->member_id&&$request->events_id==$eventmember->events_id){
                    continue;
                }else{
                    session()->flash('danger', '该商户已报名,请勿重复操作');
                    return back();
                }


            }
        }

        $this->validate($request,[
            'member_id'=>'required',
            'events_id'=>'required'
        ],[
            'member_id.required'=>'商家账号不能为空',
            'events_id.required'=>"活动不能为空"
        ]);
        $eventmember->update([
            'member_id'=>$request->member_id,
            'events_id'=>$request->events_id
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('eventmembers.index');
    }

    public function destroy(EventMember $eventmember)
    {
        $eventmember->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('eventmembers.index');
    }
}
