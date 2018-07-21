@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>店铺</h1>
        <table class="table table-bordered table-hover">
            <tr>
                <th>ID</th>
                <th>店铺分类</th>
                <th>商品名称</th>
                <th>店铺图片</th>
                <th>评分</th>
                <th>是否是品牌</th>
                <th>是否准时送达</th>
                <th>是否蜂鸟配送</th>
                <th>是否保标记</th>
                <th>是否准标记</th>
                <th>起送金额</th>
                <th>配送费</th>
                <th>店公告</th>
                <th>优惠信息</th>
                <th>目前状态</th>
                <th colspan="3">操作</th>
            </tr>
            @foreach($shops as $shop)
                <tr class="tr">
                    <td>{{$shop->id}}</td>
                    <td>{{$shop->Shops_categories->name}}</td>
                    <td>{{$shop->shop_name}}</td>
                    <td><img src="{{$shop->shop_img}}" width="50"></td>
                    <td>{{$shop->shop_rating}}</td>
                    <td>{{$shop->brand?'是':'否'}}</td>
                    <td>{{$shop->ontime?'是':'否'}}</td>
                    <td>{{$shop->fengniao?'是':'否'}}</td>
                    <td>{{$shop->bao?'是':'否'}}</td>
                    <td>{{$shop->piao?'是':'否'}}</td>
                    <td>{{$shop->zhun?'是':'否'}}</td>
                    <td>{{$shop->start_send}}</td>
                    <td>{{$shop->start_cost}}</td>
                    <td>{{$shop->notice}}</td>
                    <td>{{$shop->discount}}</td>
                    <td>@if($shop->status==1)正常@elseif($shop->status=0)待审核@else禁用@endif</td>
                    <td><a href="{{route('shops.show',['shop'=>$shop])}}">审核</a></td>
                    <td><a href="{{route('shops.edit',['shop'=>$shop])}}">修改</a></td>
                    <td>
                        <form action="{{route('shops.destroy',['shop'=>$shop])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-link" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="18"><a href="{{route('shops.create')}}">添加</a></td>
            </tr>
        </table>
    </div>
    @endsection