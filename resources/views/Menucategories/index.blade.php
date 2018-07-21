@extends('default')
@section('contents')

    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>分类</h1>
        <table class="table table-bordered table-hover">
            <tr>
                <th>ID</th>
                <th>菜品分类</th>
                <th>所属商家</th>
                <th>是否默认分类</th>
                <th>描述</th>
                <th colspan="3">操作</th>
            </tr>
            @foreach($menucategories as $menucategory)
                <tr class="tr">
                    <td>{{$menucategory->id}}</td>
                    <td>{{$menucategory->name}}</td>
                    <td>{{$shop->shop_name}}</td>
                    <td>{{$menucategory->is_selected==1?'是':'否'}}</td>
                    <td>{{$menucategory->description}}</td>
                    <td><a href="{{route('menucategories.edit',['menucategory'=>$menucategory])}}">修改</a></td>
                    <td>
                        <form action="{{route('menucategories.destroy',['menucategory'=>$menucategory])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-link" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('menucategories.create')}}">添加</a></td>
            </tr>
        </table>
    </div>
@endsection