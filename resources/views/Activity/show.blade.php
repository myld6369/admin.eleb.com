@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
       <h1>活动标题:{{$activity->title}}</h1>
        开始时间:{{date("Y-m-d",$activity->start_time)}}
        <br>
        结束时间:{{date("Y-m-d",$activity->end_time)}}
        {!! $activity->content!!}
    </div>
@endsection
