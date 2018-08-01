@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>商家列表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>商家账号</th>
                <th>商家邮箱</th>
                <th>所属店铺</th>
                <th>是否通过审核</th>
                <th colspan="3">操作</th>
            </tr>
            @foreach($users as $user)
                <tr class="tr">
                    <td>{{$user->id}}</td>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->Shops->shop_name}}</td>
                    <td>{{$user->status==1?'已通过':'未通过'}}</td>
                    <td>
                        <form action="{{route('users.shen',['user'=>$user])}}" method="post">
                        {{ csrf_field() }}
                        {{ method_field('PATCH') }}
                        <button class="btn btn-xs btn-primary" >{{!$user->status==1?'已通过':'未通过'}}</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{route('users.edit',['user'=>$user])}}" class="btn btn-xs btn-primary" >修改</a>
                    </td>
                    <td>
                        <a href="{{route('users.update',['user'=>$user])}}" class="btn btn-xs btn-primary" >重置密码</a>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('shops.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
    </div>
    @endsection