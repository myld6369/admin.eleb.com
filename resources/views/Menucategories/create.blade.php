@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>添加菜品分类</h1>
        <form action="{{route('menucategories.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>分类名称</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div class="form-group">
                <label>描述</label>
                <input type="text" name="description" class="form-control">
            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
@endsection