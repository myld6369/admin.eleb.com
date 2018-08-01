@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('roles.update',['role'=>$role])}}" method="post" enctype="multipart/form-data">
            <h1>修改角色</h1>
            <div class="form-group">
                <label>角色名称</label>
                <input type="text" name="name" class="form-control" value="{{$role->name}}">
            </div>
            <div>
                @foreach($permissions as $permission)
                    <input type="checkbox" name="permission[]" value="{{$permission->id}}" {{$role->hasPermissionTo($permission->name)?"checked":""}}>{{$permission->name}}&emsp;
                    @endforeach
            </div>
            {{method_field('PATCH')}}
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection