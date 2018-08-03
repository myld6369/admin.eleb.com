@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('eventmembers.update',['eventmember'=>$eventmember])}}" method="post">
            <h1>修改活动报名</h1>
            <div class="form-group">
                <label>活动名称</label>
                <select name="events_id" class="form-control">
                @foreach($events as $event)
                        <option value="{{$event->id}}" {{$eventmember->events_id==$event->id?"selected":""}}>{{$event->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>商铺账号</label>
                <select name="member_id" class="form-control">
                    @foreach($users as $user)
                        <option value="{{$user->id}}" {{$eventmember->member_id==$user->id?"selected":""}}>{{$user->name}}</option>
                    @endforeach
                </select>
            </div>
            {{ csrf_field() }}
            {{method_field("PATCH")}}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection