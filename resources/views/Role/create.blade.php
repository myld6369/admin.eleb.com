@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('roles.store')}}" method="post" enctype="multipart/form-data">
            <h1>添加角色</h1>
            <div class="form-group">
                <label>角色名称</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div>
                @foreach($permissions as $permission)
                    <input type="checkbox" name="permission[]" value="{{$permission->name}}">{{$permission->name}}&emsp;
                    @endforeach
            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection