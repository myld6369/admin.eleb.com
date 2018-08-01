@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>用户列表</h1>
        <table class="table table-bordered table-hover table-striped">
                <form action="{{route('consumers.index')}}" method="get">
                    搜索用户名:<input type="text" class="btn btn-default" name="keyword">
                    {{ csrf_field() }}
                    <button class="btn btn-default" >确认</button>
                </form>
            <tr>
                <th>ID</th>
                <th>用户名</th>
                <th>电话</th>
                <th>注册时间</th>
                <th>当前状态</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($consumers as $consumer)
                <tr class="tr">
                    <td>{{$consumer->id}}</td>
                    <td>{{$consumer->username}}</td>
                    <td>{{$consumer->tel}}</td>
                    <td>{{$consumer->created_at}}</td>
                    <td>
                        <form action="{{route('consumers.update',['consumer'=>$consumer])}}" method="post">
                            {{csrf_field()}}
                            {{method_field('PATCH')}}
                           <button class="btn btn-default">{{$consumer->status==0?"正常":"禁用" }}</button>
                        </form>

                        </td>
                    <td><a href="{{route('consumers.show',['consumer'=>$consumer])}}" class="btn btn-xs btn-primary">查看详情</a></td>
                </tr>
            @endforeach
        </table>
        {{$consumers->appends($data)->links()}}
    </div>
@endsection