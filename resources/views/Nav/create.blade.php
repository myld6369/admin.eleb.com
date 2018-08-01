@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('navs.store')}}" method="post" enctype="multipart/form-data">
            <h1>添加菜单</h1>
            <div class="form-group">
                <label>菜单名称</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label>菜单地址</label>
                <input type="text" name="url" class="form-control" value="{{old('url')}}">
            </div>
            <div class="form-group">
                <label>菜单权限</label>
                <select name="permission_id" class="form-control">
                    @foreach($permissions as $permission)
                    <option value="{{$permission->id}}">{{$permission->name}}</option>
                        @endforeach
                </select>

            </div>
            <div class="form-group">
                <label>所属菜单</label>
                    <select name="pid"  class="form-control">
                        <option value="0">======顶级菜单======</option>
                        @foreach($navs as $nav)
                        <option value="{{$nav->id}}">{{$nav->name}}</option>
                        @endforeach
                    </select>

            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection