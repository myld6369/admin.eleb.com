@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>修改分类</h1>
        <form action="{{route('shops_categories.update',['shops_category'=>$shops_category])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>分类名称</label>
                <input type="text" name="name" class="form-control" value="{{$shops_category->name}}">
            </div>
            <div>
                <label>是否显示: <input type="checkbox" name="status"  value="1" {{$shops_category->status==1?"checked":""}}></label>
            </div>
            <div class="form-group">
                <label>分类图片</label>
                <input type="file" name="img">
                <img src="{{\Illuminate\Support\Facades\Storage::url($shops_category->img)}}">
            </div>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
@endsection