@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    @include('vendor.ueditor.assets')
    <div class="container">

        <form action="{{route('activities.update',['activity'=>$activity])}}" method="post">
            <h1>添加活动</h1>
            <div class="form-group">
                <label>标题</label>
                <input type="text" name="title" class="form-control" value="{{$activity->title}}">
            </div>
            <div class="form-group">
                <label>选择开始时间</label>
                <input type="date" name="start_time" class="form-control" value="{{date("Y-m-d",$activity->start_time)}}">
            </div>
            <div class="form-group">
                <label>选择结束时间</label>
                <input type="date" name="end_time" class="form-control" value="{{date("Y-m-d",$activity->end_time)}}">
            </div>
            <div class="form-group">
                <label>内容</label>
            </div>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>
            <!-- 编辑器容器 -->
            <script id="container" name="content" type="text/plain">{!!$activity->content!!}</script>
            {{ csrf_field() }}
            {{method_field("PATCH")}}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
@endsection