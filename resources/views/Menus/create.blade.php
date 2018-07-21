@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>添加菜品</h1>
        <form action="{{route('menus.store')}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>名称</label>
                <input type="text" name="goods_name" class="form-control">
            </div>
            <div class="form-group">
                <label>描述</label>
                <input type="text" name="description" class="form-control">
            </div>
            <div class="form-group">
                <label>价格</label>
                <input type="text" name="goods_price" class="form-control">
            </div>
            <div class="form-group">
                <label>提示信息</label>
                <input type="text" name="tips" class="form-control">
            </div>
            <div class="form-group">
                <label>商品图片</label>
                <input type="file" name="goods_img">
            </div>
            <div class="form-group">
                <label>所属分类</label>
                <select name="category_id" id="" class="form-control">
                    @foreach($menucategories as $menucategory)
                    <option value="{{$menucategory->id}}">{{$menucategory->name}}</option>
                    @endforeach
                </select>
            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary">提交</button>
        </form>
    </div>
@endsection