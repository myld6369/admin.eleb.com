@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('permissions.update',['permission'=>$permission])}}" method="post" enctype="multipart/form-data">
            <h1>修改权限</h1>
            <div class="form-group">
                <label>权限名称</label>
                <input type="text" name="name" class="form-control" value="{{$permission->name}}">
            </div>
            {{method_field('PATCH')}}
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection