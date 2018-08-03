@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>抽奖活动奖品列表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>活动名称</th>
                <th>奖品名称</th>
                <th>奖品详情</th>
                <th>中奖商家</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($eventprizes as $eventprize)
                <tr class="tr">
                    <td>{{$eventprize->id}}</td>
                    <td>{{$eventprize->Events->title}}</td>
                    <td>{{$eventprize->name}}</td>
                    <td>{{$eventprize->description}}</td>
                    <td>{{$eventprize->member_id!=0?$eventprize->Users->name:"活动还未开奖"}}</td>

                    <td><a href="{{route('eventprizes.edit',['eventprize'=>$eventprize])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('eventprizes.destroy',['eventprize'=>$eventprize])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('eventprizes.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
        {{$eventprizes->links()}}
    </div>
@endsection