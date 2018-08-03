@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <div class="row">


        <h1>抽奖活动列表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>活动标题</th>
                <th>报名开始时间</th>
                <th>报名结束时间</th>
                <th>开奖日期</th>
                <th>报名人数限制</th>
                <th>是否已开奖</th>
                <th colspan="3">操作</th>
            </tr>
            @foreach($events as $event)
                <tr class="tr">
                    <td>{{$event->id}}</td>
                    <td>{{$event->title}}</td>
                    <td>{{date("Y-m-d H:i:s",$event->signup_start)}}</td>
                    <td>{{date("Y-m-d H:i:s",$event->signup_end)}}</td>
                    <td>{{date("Y-m-d H:i:s",$event->prize_date)}}</td>
                    <td>{{$event->signup_num}}</td>
                    <td>{{$event->is_prize==1?"已开奖":"未开奖"}}</td>

                    <td>
                        <a href="{{route('events.edit',['event'=>$event])}}" class="btn btn-xs btn-primary" >修改</a>
                    </td>
                    <td>
                        <form action="{{route('events.destroy',['event'=>$event])}}" method="post">
                            {{csrf_field()}}
                            {{method_field('DELETE')}}
                            <button type="submit" class="btn btn-xs btn-primary">删除</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('events.prize',['event'=>$event])}}" class="btn btn-xs btn-primary" >抽奖</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10">
                    <a href="{{route('events.create')}}" class="btn btn-xs btn-primary" >添加</a>
                </td>
            </tr>
        </table>
    </div>
            {{$events->links()}}
        </div>


@endsection
