@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>活动列表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>活动标题</th>
                <th>开始时间</th>
                <th>结束时间</th>
                <th colspan="3">操作</th>
            </tr>
            @foreach($activities as $activity)
                <tr class="tr">
                    <td>{{$activity->id}}</td>
                    <td>{{$activity->title}}</td>
                    <td>{{date("Y-m-d H:i:s",$activity->start_time)}}</td>
                    <td>{{date("Y-m-d H:i:s",$activity->end_time)}}</td>
                    <td>
                        <a href="{{route('activities.show',['activity'=>$activity])}}" class="btn btn-xs btn-primary" >查看</a>
                    </td>
                </tr>
            @endforeach
            {{$activities->links()}}
        </table>
    </div>
@endsection
