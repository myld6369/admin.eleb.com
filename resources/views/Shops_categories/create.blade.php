@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>添加分类</h1>
        <form action="{{route('shops_categories.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>分类名称</label>
                <input type="text" name="name" class="form-control">
            </div>
            <div>
                <label>是否显示: <input type="checkbox" name="status" value="1"></label>

            </div>
            <div class="form-group">
                <label>分类图片</label>
                <input type="file" name="img">
            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
    @endsection