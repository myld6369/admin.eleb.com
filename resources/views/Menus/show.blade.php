@extends('default')
@section('contents')

    @include('_nav')
    @include('_errors')
    @include('_msg')
    <br>
    <br>
<div class="container">
    <table class="table table-striped table-bordered table-condensed table-hover">

        <tr>
            <td>名称</td>
            <td>
                {{ $menu->goods_name }}
            </td>
        </tr>

        <tr>
            <td>评分</td>
            <td>
                {{ $menu->rating }}
            </td>
        </tr>
        <tr>
            <td>所属商家</td>
            <td>
                {{$user}}
            </td>
        </tr>
        <tr>
            <td>所属分类</td>
            <td>
                {{ $menu->Menucategories->name }}
            </td>
        </tr>
        <tr>
            <td>价格</td>
            <td>
                {{ $menu->goods_price }}
            </td>
        </tr>
        <tr>
            <td>描述</td>
            <td>
                {{ $menu->description }}
            </td>
        </tr>
        <tr>
            <td>月销量</td>
            <td>
                {{ $menu->month_sales }}
            </td>
        </tr>
        <tr>
            <td>评分数量</td>
            <td>
                {{ $menu->rating }}
            </td>
        </tr>
        <tr>
            <td>评分</td>
            <td>
                {{ $menu->rating_count }}
            </td>
        </tr>
        <tr>
            <td>提示信息</td>
            <td>
                {{ $menu->tips }}
            </td>
        </tr>
        <tr>
            <td>满意度数量</td>
            <td>
                {{ $menu->satisfy_count }}
            </td>
        </tr>
        <tr>
            <td>满意度评分</td>
            <td>
                {{ $menu->satisfy_rate }}
            </td>
        </tr>
        <tr>
            <td>商品图片</td>
            <td>
                <img src=" {{ $menu->goods_img}}" width="100">
            </td>
        </tr>
        <tr>
            <td colspan="3"><a href="{{ route('menus.edit',['menu'=>$menu])}}" class="btn btn-primary btn-block">修改</a></td>
        </tr>
    </table>

</div>
    @endsection