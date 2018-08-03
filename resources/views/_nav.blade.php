<div class="navbar navbar-fixed-top navbar-inverse" >
    <div class="container">
        {{--<div class="nav-logo">--}}
            {{--<a class="" href="#">--}}
                {{--<img class="img-responsive" src="" alt="北京市XXXX科技有限公司" style="height:20px;width: auto;" />--}}
            {{--</a>--}}
        {{--</div>--}}
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#navBar">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="navBar">
            <ul class="nav navbar-nav">
                <li><a href="#">首页</a></li>

                @foreach(\App\Models\Nav::where('pid',0)->get() as $value)
                    @if(\App\Models\Nav::where('pid',$value->id)->get()->count()>=1)
                        @can(\Spatie\Permission\Models\Permission::where('id',$value->permission_id)->first()->name)
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    {{$value->name}}<span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    @foreach(\App\Models\Nav::where('pid',$value->id)->get() as $v)
                                        <li><a href="{{route($v->url)}}">{{$v->name}}</a></li>
                                    @endforeach
                                </ul>
                            </li>
                        @endcan
                        @endif
                        @endforeach

            </ul>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="#" data-toggle="modal" data-target="#myModal">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}&emsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li></li>
                        <li></li>
                        <li></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-block">注销</button>
                            </form>
                        </li>
                    </ul>
                </li>
            </ul>
            @endauth
        </div>
    </div>
</div>

<!-- Modal -->
<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" >
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">登录</h4>
            </div>
            <div class="modal-body">
                <form action="{{route('login.store')}}" method="post">
                    <div class="form-group">
                        <label>用户名</label>
                        <input type="text" class="form-control" name="name"  placeholder="用户名">
                    </div>
                    <div class="form-group">
                        <label>密码</label>
                        <input type="password" class="form-control" name="password" placeholder="密码">
                    </div>

                    <div class="form-group">
                        <label>验证码</label>
                        <input id="captcha1" class="form-control" name="captcha" >
                        <img id="captcha_login" class="thumbnail captcha" src="{{ captcha_src('flat') }}" onclick="this.src='/captcha/flat?'+Math.random()" title="点击图片重新获取验证码">
                    </div>
                    <div class="checkbox">
                        <label>
                            <input type="checkbox" name="rememberMe">下次自动登录
                        </label>
                    </div>
                    {{csrf_field()}}
                    <button type="submit" class="btn btn-default btn-block">登录</button>
                </form>
            </div>
        </div>
    </div>
</div>

<br>
<br>
