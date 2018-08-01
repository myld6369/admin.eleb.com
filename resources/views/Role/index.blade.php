@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>角色管理</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>角色名称</th>
                <th>角色权限</th>
                <th>添加时间</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($roles as $role)
                <tr class="tr">
                    <td>{{$role->id}}</td>
                    <td>{{$role->name}}</td>
                    <td>
                        @foreach($role->permission as $permission)
                            {{ $permission->name }}
                            @endforeach
                    </td>

                    <td>{{$role->created_at}}</td>
                    <td><a href="{{route('roles.edit',['role'=>$role])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('roles.destroy',['role'=>$role])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('roles.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
        {{$roles->links()}}
    </div>
@endsection