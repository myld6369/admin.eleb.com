<nav class="navbar navbar-default navbar-fixed-top navbar-inverse">
    <div class="container">
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li class="active"><a href="">首页 <span class="sr-only">(current)</span></a></li>
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">管理店铺 <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('menucategories.index',['user'=>\Illuminate\Support\Facades\Auth::user()])}}">管理菜品分类</a></li>
                        <li><a href="{{route('menus.index')}}">管理菜品</a></li>
                        <li><a href="#">Something else here</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">Separated link</a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="#">One more separated link</a></li>
                    </ul>
                </li>
            </ul>
            <form class="navbar-form navbar-left">
                <div class="form-group">
                    <input type="text" class="form-control" placeholder="Search">
                </div>
                <button type="submit" class="btn btn-default"><span class="
glyphicon glyphicon-search"></span></button>
            </form>
            <ul class="nav navbar-nav navbar-right">
                @guest
                <li><a href="#" data-toggle="modal" data-target="#myModal">登录</a></li>
                @endguest
                @auth
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{\Illuminate\Support\Facades\Auth::user()->name}}&emsp;<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="{{route('users.show',['user'=>\Illuminate\Support\Facades\Auth::user()])}}">修改个人信息</a></li>
                        <li><a href="{{route('users.edit',['user'=>\Illuminate\Support\Facades\Auth::user()])}}">修改商铺信息</a></li>
                        <li><a href="{{route('users.pass',['user'=>\Illuminate\Support\Facades\Auth::user()])}}">修改个人密码</a></li>
                        <li role="separator" class="divider"></li>
                        <li>
                            <form action="{{route('logout')}}" method="post">
                                {{method_field('DELETE')}}
                                {{ csrf_field() }}
                                <button type="submit" class="btn btn-block">注销</button>
                            </form>
                            <a href="{{route('users.create')}}" class="btn btn-block">注册</a>
                        </li>
                    </ul>
                </li>
            </ul>

            @endauth
        </div><!-- /.navbar-collapse -->

    </div>
</nav>

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
            <div class="modal-footer">
                <a href="{{route('users.create')}}" class="btn btn-primary">注册</a>
            </div>
        </div>
    </div>
</div>

<br>
<br>

