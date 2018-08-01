<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    //
    public function index(Request $request)
    {
        $today =intval($request->today,10);

        $time =time();
        if (empty($today)){
            $activities =Activity::paginate(5);
        }elseif ($today==1){
            $activities =Activity::where('start_time','>',$time)->paginate(1);
        }elseif ($today==2){
            $activities =Activity::where('start_time','<=',$time)->where('end_time','>=',$time)->paginate(1);

        }elseif ($today==3){
            $activities =Activity::where('end_time','<',$time)->paginate(1);
        }

        $data=[
            'start_time'=>$request->start_time,
            'end_time'=>$request->end_time,
        ];
        return view('Activity.index',compact('activities','data'));
    }

    public function create()
    {
        return view('Activity/create');
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'content'=>'required'
        ],[
            'title.required'=>'活动标题不能为空',
            'start_time.required'=>'活动开始时间不能为空',
            'end_time.required'=>'活动结束时间不能为空',
            'content.required'=>'活动内容不能为空',
        ]);

        $start_time =strtotime($request->start_time);
        $end_time =strtotime($request->end_time);

        Activity::create([
            'title'=>$request->title,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'content'=>$request->input('content'),
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('activities.index');
    }

    public function edit(Activity $activity)
    {
        return view('Activity/edit',compact('activity'));
    }

    public function update(Activity $activity,Request $request)
    {
        $this->validate($request,[
            'title'=>'required',
            'start_time'=>'required',
            'end_time'=>'required',
            'content'=>'required'
        ],[
            'title.required'=>'活动标题不能为空',
            'start_time.required'=>'活动开始时间不能为空',
            'end_time.required'=>'活动结束时间不能为空',
            'content.required'=>'活动内容不能为空',
        ]);
        $start_time =strtotime($request->start_time);
        $end_time =strtotime($request->end_time);
        $activity->update([
            'title'=>$request->title,
            'start_time'=>$start_time,
            'end_time'=>$end_time,
            'content'=>$request->input('content'),
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('activities.index');
    }

    public function destroy(Activity $activity)
    {
        $activity->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('activities.index');
    }

    public function show(Activity $activity)
    {
        return view('Activity/show',compact('activity'));
    }
}
