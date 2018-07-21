@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>修改菜品分类</h1>
        <form action="{{route('menucategories.update',['menucategory'=>$menucategory])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>分类名称</label>
                <input type="text" name="name" class="form-control" value="{{$menucategory->name}}">
            </div>
            <div class="form-group">
                <label>描述</label>
                <input type="text" name="description" class="form-control" value="{{$menucategory->description}}">
            </div>
            <div class="form-group">
                <label>设置为默认菜品分类</label>
                <input type="checkbox" name="is_selected"  {{$menucategory->is_selected==1?"checked":""}} value="1"><span style="color: red">* 选中代表设置为默认菜品分类</span>
            </div>
            {{ csrf_field() }}
            {{method_field("PATCH")}}
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
@endsection