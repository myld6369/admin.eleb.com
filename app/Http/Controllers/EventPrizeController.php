<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventPrize;
use Illuminate\Http\Request;

class EventPrizeController extends Controller
{
    //
    public function index()
    {
        $eventprizes = EventPrize::paginate(5);
        return view('EventPrize/index',compact('eventprizes'));
    }

    public function create()
    {
        $events = Event::all();
        return view('EventPrize/create',compact('events'));
    }

    public function store(Request $request)
    {
//        $eventprizes = EventPrize::all();
//        foreach ($eventprizes as $eventprize){
//            if ($request->events_id==$eventprize->events_id&&$request->name=$eventprize->name){
//                session()->flash('danger', '该活动已存在该奖品,请勿重复操作');
//                return back();
//            }
//        }
        $event = Event::where('id',$request->events_id)->first();
        if ($event->is_prize==1){
            session()->flash('danger', '该活动已开奖,不能操作');
            return redirect()->route('eventprizes.index');
        }
        $this->validate($request,[
            'name'=>'required',
            'events_id'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>"奖品名称不能为空",
            'events_id.required'=>'所属活动不能为空',
            'description.required'=>"奖品详情不能为空"
        ]);

        EventPrize::create([
            'events_id'=>$request->events_id,
            'name'=>$request->name,
            'description'=>$request->description,
            'member_id'=>0
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('eventprizes.index');
    }

    public function edit(EventPrize $eventprize)
    {
        $events = Event::all();
        return view('EventPrize/edit',compact('eventprize','events'));
    }

    public function update(Request $request,EventPrize $eventprize)
    {
        $event = Event::where('id',$request->events_id)->first();
        if ($event->is_prize==1){
            session()->flash('danger', '该活动已开奖,不能操作');
            return redirect()->route('eventprizes.index');
        }
        $this->validate($request,[
            'name'=>'required',
            'events_id'=>'required',
            'description'=>'required',
        ],[
            'name.required'=>"奖品名称不能为空",
            'events_id.required'=>'所属活动不能为空',
            'description.required'=>"奖品详情不能为空"
        ]);

        $eventprize->update([
            'name'=>$request->name,
            'events_id'=>$request->events_id,
            'description'=>$request->description
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('eventprizes.index');

    }

    public function destroy(EventPrize $eventprize)
    {
        $event = Event::where('id',$eventprize->events_id)->first();
        if ($event->is_prize==1){
            session()->flash('danger', '该活动已开奖,不能操作');
            return redirect()->route('eventprizes.index');
        }
        $eventprize->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('eventprizes.index');
    }
}
