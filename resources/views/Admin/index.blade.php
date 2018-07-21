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
                <th>管理员账号</th>
                <th>管理员邮箱</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($admins as $admin)
                <tr class="tr">
                    <td>{{$admin->id}}</td>
                    <td>{{$admin->name}}</td>
                    <td>{{$admin->email}}</td>
                    <td><a href="{{route('admins.edit',['admin'=>$admin])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('admins.update',['admin'=>$admin])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('admins.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
    </div>
@endsection