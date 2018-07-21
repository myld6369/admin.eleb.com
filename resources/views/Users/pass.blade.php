@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <form action="{{route('users.password',['user'=>$user])}}}" method="post">
            <h1>修改账号</h1>
            <div class="form-group">
                <label>旧密码</label>
                <input type="password" name="oldpassword" class="form-control">
            </div>
            <div class="form-group">
                <label>新密码</label>
                <input type="password" name="password" class="form-control">
            </div>
            <div class="form-group">
                <label>确认密码</label>
                <input type="password" name="repassword" class="form-control">
            </div>
            {{--<div class="form-group">--}}
            {{--<label>所属店铺</label>--}}
            {{--<select name="shop_categorry_id" id="" class="form-control">--}}
            {{--@foreach($shops as $shop)--}}
            {{--<option value="{{$shop->id}}">{{$shop->name}}</option>--}}
            {{--@endforeach--}}
            {{--</select>--}}
            {{--</div>--}}
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <button type="submit" class="btn btn-block btn-primary">提交</button>
        </form>
    </div>
@endsection
