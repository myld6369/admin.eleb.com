@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>修改菜品</h1>
        <form action="{{route('menus.update',['menu'=>$menu])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>名称</label>
                <input type="text" name="goods_name" class="form-control" value="{{$menu->goods_name}}">
            </div>
            <div class="form-group">
                <label>描述</label>
                <input type="text" name="description" class="form-control" value="{{$menu->description}}">
            </div>
            <div class="form-group">
                <label>价格</label>
                <input type="text" name="goods_price" class="form-control" value="{{$menu->goods_price}}">
            </div>
            <div class="form-group">
                <label>提示信息</label>
                <input type="text" name="tips" class="form-control" value="{{$menu->tips}}">
            </div>
            <div class="form-group">
                <label>商品图片</label>
                <input type="file" name="goods_img">
                <img src="{{$menu->goods_img}}" width="50">
            </div>
            <div class="form-group">
                <label>所属分类</label>
                <select name="category_id" id="" class="form-control">
                    @foreach($menucategories as $menucategory)
                    <option value="{{$menucategory->id}}" {{$menu->category_id==$menucategory->id?"checked":""}}>{{$menucategory->name}}</option>
                    @endforeach
                </select>
            </div>
            {{ csrf_field() }}
            {{ method_field("PATCH") }}
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
@endsection