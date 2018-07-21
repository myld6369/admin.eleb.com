@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <form action="{{route('users.user',['user'=>$user])}}}" method="post">
            <h1>修改账号</h1>
            <div class="form-group">
                <label>账号</label>
                <input type="text" name="name" class="form-control" value="{{$user->name}}" disabled>
            </div>
            <div class="form-group">
                <label>邮箱</label>
                <input type="text" name="email" class="form-control" value="{{$user->email}}">
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
