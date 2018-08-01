@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>权限</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>权限</th>
                <th>添加时间</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($permissions as $permission)
                <tr class="tr">
                    <td>{{$permission->id}}</td>
                    <td>{{$permission->name}}</td>
                    <td>{{$permission->created_at}}</td>
                    <td><a href="{{route('permissions.edit',['permission'=>$permission])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('permissions.destroy',['permission'=>$permission])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('permissions.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
        {{$permissions->links()}}
    </div>
@endsection