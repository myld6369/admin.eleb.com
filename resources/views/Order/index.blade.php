@extends('default')
@section('contents')

    @include('_nav')
    @include('_errors')
    @include('_msg')
    <br>
    <br>
    <div class="container">
        <h1>订单统计</h1>
        <table class="table table-bordered table-hover" id="arttable">
            <form action="{{route('orders.index')}}" method="get">
                <button class="btn btn-default">全部</button>
                {{csrf_field()}}
            </form>
            <br>
            <form action="{{route('orders.index')}}" method="get">
                <select name="shop_id" class="btn btn-primary">
                    @foreach($shops as $shop)
                    <option value="{{$shop->id}}" class="btn btn-xs btn-primary">{{$shop->shop_name}}</option>
                    @endforeach
                </select>
                <button class="btn btn-default">选择店铺</button>
                {{csrf_field()}}
            </form>
            <br>
            <form action="{{route('orders.index')}}" method="get">
                指定某月: <input type="date" class="btn btn-default" name="month">&emsp;
                <button class="btn btn-default">确定</button>
                {{csrf_field()}}
            </form>
            <br>
            <form action="{{route('orders.index')}}" method="get">
                指定某天: <input type="date" class="btn btn-default" name="date">&emsp;
                <button class="btn btn-default">确定</button>
                {{csrf_field()}}
            </form>

            <h1>订单数:{{$count}}</h1>
    </div>
@endsection