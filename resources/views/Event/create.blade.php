@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    @include('vendor.ueditor.assets')
    <div class="container">

        <form action="{{route('events.store')}}" method="post">
            <h1>添加抽奖活动</h1>
            <div class="form-group">
                <label>标题</label>
                <input type="text" name="title" class="form-control" value="{{old('title')}}">
            </div>
            <div class="form-group">
                <label>报名人数限制</label>
                <input type="text" name="signup_num" class="form-control" value="{{old('signup_num')}}">
            </div>
            <div class="form-group">
                <label>选择开始时间</label>
                <input type="datetime-local" name="signup_start" class="form-control">
            </div>
            <div class="form-group">
                <label>选择结束时间</label>
                <input type="datetime-local" name="signup_end" class="form-control">
            </div>
            <div class="form-group">
                <label>活动开奖时间</label>
                <input type="datetime-local" name="prize_date" class="form-control">
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
            <script id="container" name="content" type="text/plain">{{old('content')}}</script>
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
@endsection