@extends('default')
@section('contents')

    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h3>选择菜品分类</h3>
        <form action="{{route('menus.index')}}" method="post">
            <select name="category_id" class="btn">
                @foreach($menucategories as $menucategory)
                <option value="{{$menucategory->id}}">{{$menucategory->name}}</option>
                @endforeach
            </select>
            {{csrf_field()}}
            {{method_field("GET")}}
            <button class="btn btn-primary btn-xs">选择</button>
        </form>

        <h1>菜品表</h1>
        <table class="table table-bordered table-hover" id="arttable">

            <tr>
                <th>ID</th>
                <th>名字</th>
                <th>评分</th>
                <th>所属商家</th>
                <th>所属分类</th>
                <th>价格</th>
                <th>描述</th>
                <th>月销量</th>
                <th>评分数量</th>
                <th>提示信息</th>
                <th>满意度数量</th>
                <th>满意度评分</th>
                <th>商品图片</th>
                <th>操作</th>
            </tr>
            @foreach($menus as $menu)
                <tr>
                    <td>{{$menu->id}}</td>
                    <td>{{$menu->goods_name}}</td>
                    <td>{{$menu->rating}}</td>
                    <td>{{$user}}</td>
                    <td>{{$menu->Menucategories->name}}</td>
                    <td>{{$menu->goods_price}}</td>
                    <td>{{$menu->description}}</td>
                    <td>{{$menu->month_sales}}</td>
                    <td>{{$menu->rating_count}}</td>
                    <td>{{$menu->tips}}</td>
                    <td>{{$menu->satisfy_count}}</td>
                    <td>{{$menu->satisfy_rate}}</td>
                    <td><img src="{{$menu->goods_img}}" width="50"></td>
                    <td>

                        <a href="{{route('menus.show',[$menu])}}" title="查看"
                           class="btn btn-success btn-xs">查看</a>
                        <a href="{{route('menus.edit',[$menu])}}" title="修改"
                           class="btn btn-success btn-xs">修改</a>


                        <form class="form-inline"
                              action="{{route('menus.destroy',['menu'=>$menu])}}" method="post">
                            {{ method_field('DELETE') }}
                            {{ csrf_field() }}
                            <button title="删除" class="btn btn-danger btn-xs">删除</span>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="14">
                    <a href="{{route('menus.create')}}" title="添加" class="btn btn-info btn-block">添加</a>
                </td>
            </tr>
        </table>
        {{ $menus->links()}}
    </div>
@endsection