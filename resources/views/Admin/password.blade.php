@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('admins.password',['admin'=>$admin])}}" method="post" enctype="multipart/form-data">
            <h1>修改账号密码</h1>
            <div class="form-group">
                <label>旧密码</label>
                <input type="password" name="oldpassword" class="form-control">
            </div>
            <div class="form-group">
                <label>新密码</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>确认新密码</label>
                <input type="password" name="repassword" class="form-control">
            </div>
            <div class="form-group">
                <label>验证码</label>
                <input id="captcha2" class="form-control" name="captcha" >
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>
            {{ csrf_field() }}
            {{method_field("PATCH")}}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
@endsection