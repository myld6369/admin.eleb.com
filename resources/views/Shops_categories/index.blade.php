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
                <th>分类</th>
                <th>图片</th>
                <th>是否显示</th>
                <th colspan="3">操作</th>
            </tr>
            @foreach($shops_categories as $shops_category)
                <tr class="tr">
                    <td>{{$shops_category->id}}</td>
                    <td>{{$shops_category->name}}</td>
                    <td><img src="{{\Illuminate\Support\Facades\Storage::url($shops_category->img)}}" width="50"></td>
                    <td>{{$shops_category->status==1?'是':'否'}}</td>
                    <td><a href="{{route('shops_categories.edit',['shops_category'=>$shops_category])}}">修改</a></td>
                    <td>
                        <form action="{{route('shops_categories.destroy',['$shops_category'=>$shops_category])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-link" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('shops_categories.create')}}">添加</a></td>
            </tr>
        </table>
    </div>
    @endsection