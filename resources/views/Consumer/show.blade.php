@extends('default')
@section('contents')
    @include('_nav')
    @include('_errors')
    @include('_msg')
    <div class="container">
        <table class="table table-striped table-bordered table-condensed table-hover">
            <h1>会员详情</h1>
            <tr>
                <td>ID</td>
                <td>
                    {{ $consumer->id }}
                </td>
            </tr>

            <tr>
                <td>账号</td>
                <td>
                    {{ $consumer->username }}
                </td>
            </tr>
            <tr>
                <td>电话</td>
                <td>
                    {{$consumer->tel}}
                </td>
            </tr>
            <tr>
                <td>创建时间</td>
                <td>
                    {{ $consumer->created_at }}
                </td>
            </tr>
            <tr>
                <td>当前状态</td>
                <td>
                    {{  $consumer->status==0?"正常":"禁用" }}
                </td>
            </tr>
            </table>
    </div>
@endsection
