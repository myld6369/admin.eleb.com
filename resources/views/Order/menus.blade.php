@extends('default')
@section('contents')

    @include('_nav')
    @include('_errors')
    @include('_msg')
    <br>
    <br>
    <div class="container">

        <div class="col-md-1">

        </div>
        <div   class="col-md-11">
            <h1>菜品销量:</h1>
            <table class="table table-bordered table-hover" id="arttable">
                <form action="{{route('orders.menus')}}" method="get">
                    <button class="btn btn-default">全部</button>
                    {{csrf_field()}}
                </form>
                <br>
                <form action="{{route('orders.menus')}}" method="get">
                    <select name="shop_id" class="btn btn-primary">
                        @foreach($shops as $shop)
                            <option value="{{$shop->id}}" class="btn">{{$shop->shop_name}}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-default">选择店铺</button>
                    {{csrf_field()}}
                </form>
                <br>
                <form action="{{route('orders.menus')}}" method="get">
                    指定某月: <input type="date" class="btn btn-default" name="month">&emsp;
                    <button class="btn btn-default">确定</button>
                    {{csrf_field()}}
                </form>
                <br>
                <form action="{{route('orders.menus')}}" method="get">
                    指定某天: <input type="date" class="btn btn-default" name="date">&emsp;
                    <button class="btn btn-default">确定</button>
                    {{csrf_field()}}
                </form>
                <tr>
                    <th>销量</th>
                    <th>菜名</th>

                </tr>
                @foreach($menus as $menu)
                    <tr>
                        <td>{{$menu->num}}</td>
                        <td>{{$menu->name}}</td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection