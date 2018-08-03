@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">

        <form action="{{route('eventprizes.store')}}" method="post">
            <h1>添加抽奖活动奖品</h1>
            <div class="form-group">
                <label>活动名称</label>
                <select name="events_id" class="form-control">
                @foreach($events as $event)
                        <option value="{{$event->id}}">{{$event->title}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label>奖品名称</label>
                <input type="text" name="name" class="form-control" value="{{old('name')}}">
            </div>
            <div class="form-group">
                <label>奖品详情</label>
                <textarea name="description"  cols="30" rows="10" class="form-control">{{old('description')}}</textarea>
            </div>
            {{ csrf_field() }}
            <button class="btn btn-primary form-control" >提交</button>
        </form>
    </div>
    @endsection