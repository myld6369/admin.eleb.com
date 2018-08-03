@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    @include('vendor.ueditor.assets')
    <div class="container">

        <form action="{{route('events.update',['event'=>$event])}}" method="post">
            <h1>修改抽奖活动</h1>
            <div class="form-group">
                <label>标题</label>
                <input type="text" name="title" class="form-control" value="{{$event->title}}">
            </div>
            <div class="form-group">
                <label>报名人数限制</label>
                <input type="text" name="signup_num" class="form-control" value="{{$event->signup_num}}">
            </div>
            <div class="form-group">
                <label>选择开始时间</label>
                <input type="datetime-local" name="signup_start" class="form-control" value="{{date('Y-m-d\TH:i',$event->signup_start)}}">
            </div>
            <div class="form-group">
                <label>选择结束时间</label>
                <input type="datetime-local" name="signup_end" class="form-control" value="{{date('Y-m-d\TH:i',$event->signup_end)}}">
            </div>
            <div class="form-group">
                <label>活动开奖时间</label>
                <input type="datetime-local" name="prize_date" class="form-control" value="{{date('Y-m-d\TH:i',$event->prize_date)}}">
            </div>
            <div class="form-group">
                <label>活动内容</label>
            </div>
            <!-- 实例化编辑器 -->
            <script type="text/javascript">
                var ue = UE.getEditor('container');
                ue.ready(function() {
                    ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
                });
            </script>
            <!-- 编辑器容器 -->
            <script id="container" name="content" type="text/plain">{!! $event->content !!}</script>
            {{method_field('PATCH')}}
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
@endsection