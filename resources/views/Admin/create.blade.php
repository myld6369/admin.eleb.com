@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('admins.store')}}" method="post" enctype="multipart/form-data">
            <h1>添加账号</h1>
            <div class="form-group">
                <label>用户名</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label>邮箱</label>
                <input type="text" name="email" class="form-control" value="{{old('email')}}">
            </div>
            <div class="form-group">
                <label>密码</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>确认密码</label>
                <input type="password" name="repassword" class="form-control">
            </div>
            <div class="form-group">
                @foreach($roles as $role)
                    {{$role->name}}: <input type="checkbox" name="role[]" value="{{$role->name}}"> &emsp;
                    @endforeach
            </div>
            <div class="form-group">
                <label>验证码</label>
                <input id="captcha2" class="form-control" name="captcha" >
                <img class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection