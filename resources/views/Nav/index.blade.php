@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>菜单列表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>菜单名称</th>
                <th>菜单地址</th>
                <th>菜单权限</th>
                <th>所属菜单</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($navs as $nav)
                <tr class="tr">
                    <td>{{$nav->id}}</td>
                    <td>{{$nav->name}}</td>
                    <td>{{$nav->url}}</td>
                    <td>{{$nav->Permission->name}}</td>
                    <td>{{$nav->pname}}</td>
                    <td><a href="{{route('navs.edit',['nav'=>$nav])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('navs.destroy',['nav'=>$nav])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('navs.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
        {{$navs->links()}}
    </div>
@endsection