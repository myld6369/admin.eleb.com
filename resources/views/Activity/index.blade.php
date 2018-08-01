@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <div class="row">
        <div class="col-md-1">
            <br>
            <br>
            <br>
            <br>
            <a href="{{route('activities.index')}}" class="btn btn-default">所有活动</a>

                <a href="{{route('activities.index',['today'=>1])}}" class="btn btn-default">未开始</a>
            <br>
            <a href="{{route('activities.index',['today'=>2])}}" class="btn btn-default">进行中</a>
            <br>
            <a href="{{route('activities.index',['today'=>3])}}" class="btn btn-default">已结束</a>
            <br>

        </div>
            <div class="col-md-11">
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
                    <td>
                        <a href="{{route('activities.edit',['activity'=>$activity])}}" class="btn btn-xs btn-primary" >修改</a>
                    </td>
                    <td>
                        <a href="{{route('activities.destroy',['activity'=>$activity])}}" class="btn btn-xs btn-primary" >删除</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10">
                    <a href="{{route('activities.create')}}" class="btn btn-xs btn-primary" >添加</a>
                </td>
            </tr>
        </table>
    </div>
            {{$activities->appends($data)->links()}}
        </div>

    </div>
@endsection
