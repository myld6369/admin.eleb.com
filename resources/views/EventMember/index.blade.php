@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <h1>活动报名列表</h1>
        <table class="table table-bordered table-hover table-striped">
            <tr>
                <th>ID</th>
                <th>活动名称</th>
                <th>店铺账号</th>
                <th colspan="2">操作</th>
            </tr>
            @foreach($eventmembers as $eventmember)
                <tr class="tr">
                    <td>{{$eventmember->id}}</td>
                    <td>{{$eventmember->Events->title}}</td>
                    <td>{{$eventmember->Users->name}}</td>

                    <td><a href="{{route('eventmembers.edit',['eventmember'=>$eventmember])}}" class="btn btn-xs btn-primary">修改</a></td>
                    <td>
                        <form action="{{route('eventmembers.destroy',['eventmember'=>$eventmember])}}" method="post">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}
                            <button class="btn btn-xs btn-primary" >删除</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            <tr>
                <td colspan="10"><a href="{{route('eventmembers.create')}}" class="btn btn-xs btn-primary">添加</a></td>
            </tr>
        </table>
        {{$eventmembers->links()}}
    </div>
@endsection