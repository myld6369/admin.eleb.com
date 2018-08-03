<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\EventMember;
use App\Models\EventPrize;
use App\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EventController extends Controller
{
    //
    public function index()
    {
        $events =Event::paginate(5);
        return view('Event/index',compact('events'));
    }

    public function create()
    {
        return view('Event/create');
    }

    public function store(Request $request)
    {

        $this->validate($request,[
            'title'=>'required|unique:events',
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
            'content'=>'required'
        ],[
            'title.required'=>'活动标题不能为空',
            'title.unique'=>'活动已存在',
            'signup_start.required'=>'活动开始时间不能为空',
            'signup_end.required'=>'活动结束时间不能为空',
            'prize_date.required'=>'活动开奖时间不能为空',
            'content.required'=>'活动内容不能为空',
            'signup_num.required'=>'报名人数限制不能为空',
        ]);

        $signup_start=strtotime($request->signup_start);
        $signup_end=strtotime($request->signup_end);
        $prize_date=strtotime($request->prize_date);

        Event::create([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_start'=>$signup_start,
            'signup_end'=>$signup_end,
            'prize_date'=>$prize_date,
            'signup_num'=>$request->signup_num,
            'is_prize'=>0
        ]);
        session()->flash('success', '添加成功');
        return redirect()->route('events.index');
    }

    public function edit(Event $event)
    {
        return view('Event/edit',compact('event'));
    }

    public function update(Request $request,Event $event)
    {
        $this->validate($request,[
            'title'=>[
                'required',
                Rule::unique('events')->ignore($event->id, 'id')
            ],
            'signup_start'=>'required',
            'signup_end'=>'required',
            'prize_date'=>'required',
            'signup_num'=>'required',
            'content'=>'required'
        ],[
            'title.required'=>'活动标题不能为空',
            'title.unique'=>'活动已存在',
            'signup_start.required'=>'活动开始时间不能为空',
            'signup_end.required'=>'活动结束时间不能为空',
            'prize_date.required'=>'活动开奖时间不能为空',
            'content.required'=>'活动内容不能为空',
            'signup_num.required'=>'报名人数限制不能为空',
        ]);

        $signup_start=strtotime($request->signup_start);
        $signup_end=strtotime($request->signup_end);
        $prize_date=strtotime($request->prize_date);

        $event->update([
            'title'=>$request->title,
            'content'=>$request->input('content'),
            'signup_start'=>$signup_start,
            'signup_end'=>$signup_end,
            'prize_date'=>$prize_date,
            'signup_num'=>$request->signup_num,
        ]);
        session()->flash('success', '修改成功');
        return redirect()->route('events.index');
    }

    public function destroy(Event $event)
    {
        $event->delete();
        session()->flash('success', '删除成功');
        return redirect()->route('events.index');
    }

    public function prize(Event $event)
    {
        if ($event->prize_date>time()){
            session()->flash('danger', '开奖时间还未到,请耐心等待');
            return back();
        }
        if ($event->is_prize==1){
            session()->flash('danger', '当前活动已开奖,请勿重复操作');
            return back();
        }
        $members = EventMember::where('events_id',$event->id)->get(['member_id']);
        $members_id=[];
        foreach ($members as $member){
            $members_id[] =$member->member_id;
        }

        $eventprizes = EventPrize::where('events_id',$event->id)->get();
        $eventprize_id =[];
        foreach ($eventprizes as $eventprize){
            $eventprize_id[] =$eventprize->id;
        }

        foreach ($eventprizes as $eventprize){
            if (!empty($members_id)){
                $mid =$members_id[array_rand($members_id)];
                $prize = $eventprize->update([
                    'member_id'=>$mid
                ]);

                //给中奖人发邮件
                if ($eventprize->member_id!=0){
                    $user= Users::where('id',$eventprize->member_id)->first();
                    $email=$user->email;
                \Illuminate\Support\Facades\Mail::raw('您在'.$event->title.'活动中获得了'.$eventprize->name.'',function($message)use($email){
                    $message->from('18200367375@163.com','活动中奖通知');
                    $message->to([$email])->subject('皮皮');
                });
                }

                //删除数组中已中奖的账号
                 foreach ($members_id as $k=>$id){
                     if ($id==$mid){
                         unset($members_id[$k]);
                     }
                 }
            }else{
                $eventprize->update([
                    'member_id'=>0
                ]);
            }
            }
        $event->update([
            'is_prize'=>1
        ]);
        session()->flash('success', '开奖成功');
        return redirect()->route('eventprizes.index');

    }
}
