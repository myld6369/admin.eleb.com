@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>修改店铺</h1>
        <form action="{{route('shops.update',['shop'=>$shop])}}" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label>店铺名称</label>
                <input type="text" name="shop_name" class="form-control" value="{{$shop->shop_name}}">
            </div>
            <div class="form-group">
                <label>起送金额</label>
                <input type="text" name="start_send" class="form-control" value="{{$shop->start_send}}">
            </div>
            <div class="form-group">
                <label>配送费</label>
                <input type="text" name="send_cost" class="form-control"  value="{{$shop->send_cost}}">
            </div>
            <div class="form-group">
                <label>店公告</label>
                <input type="text" name="notice" class="form-control"  value="{{$shop->notice}}">
            </div>
            <div class="form-group">
                <label>优惠信息</label>
                <input type="text" name="discount" class="form-control" value="{{$shop->discount}}">
            </div>
            <div class="form-group">
                <label>评分</label>
                <input type="text" name="shop_rating" class="form-control" value="{{$shop->shop_rating}}">
            </div>
            <div class="form-group">
                <label>店铺分类</label>
                <select name="shop_category_id" id="" class="form-control">
                    @foreach($categories as $category)
                    <option  value="{{$category->id}}" {{$category->id==$shop->shop_category_id?"selected":""}}>{{$category->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>店铺图片</label>
                <input type="file" name="shop_img">
                <img src="{{$shop->shop_img}}" width="50">
            </div>

            <div class="form-group">
                <label>是否是品牌:&emsp;是:<input type="radio" name="brand" value="1" {{$shop->brand==1?'checked':""}}>&emsp;否:<input type="radio" name="brand" value="0"></label>
            </div>
            <div class="form-group">
                <label>是否准时送达&emsp;是:<input type="radio" name="on_time" value="1" {{$shop->on_time==1?'checked':""}}>&emsp;否:<input type="radio" name="on_time" value="0"></label>
            </div>
            <div class="form-group">
                <label>是否蜂鸟配送&emsp;是:<input type="radio" name="fengniao" value="1" {{$shop->fengniao==1?'checked':""}}>&emsp;否:<input type="radio" name="fengniao" value="0"></label>
            </div>
            <div class="form-group">
                <label>是否保标记&emsp;是:<input type="radio" name="bao" value="1" {{$shop->bao==1?'checked':""}}>&emsp;否:<input type="radio" name="bao" value="0"></label>
            </div>
            <div class="form-group">
                <label>是否票标记&emsp;是:<input type="radio" name="piao" value="1" {{$shop->piao==1?'checked':""}}>&emsp;否:<input type="radio" name="piao" value="0"></label>
            </div>
            <div class="form-group">
                <label>是否准标记&emsp;是:<input type="radio" name="zhun" value="1" {{$shop->zhun==1?'checked':""}}>&emsp;否:<input type="radio" name="zhun" value="0"></label>
            </div>

            <div>
                <label>状态: </label>
                正常 <input type="radio" name="status" value="1" {{$shop->status==1?'checked':""}}>
                待审核 <input type="radio" name="status" value="0" {{$shop->status==0?'checked':""}}>
                禁用 <input type="radio" name="status" value="-1" {{$shop->status==-1?'checked':""}}>

            </div>
            {{ csrf_field() }}
            {{ method_field('PATCH') }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection