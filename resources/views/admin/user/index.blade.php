@extends("admin.index")

@section('content')
    <div class="container">
        <h5>用户信息</h5>
        <div class="row">
        <ul id="" class="tabs grey lighten-5">

        <li class="tab"><a class="active" href="#">信息 </a>
        <li class="tab"><a href="#">修改</a></li>
        <li class="tab"><a href="#">找回密码</a></li>
        </ul></div>
        {{--<div class="row"></div>--}}
        <div class="row">
            <div class="col m4 s4">账号</div>
            <div class="col m8 s8">
                {{ $user['name'] }}
            </div>
        </div>
        <div class="row">
            <div class="col m4 s4">qq</div>
            <div class="col m8 s8">1249742284</div>
        </div>
        <div class="row">
            <div class="col m4 s4">头像</div>
            <div class="col m8 s8">
                <img src="/images/user.jpg" alt="" class="user-picture">
            </div>
        </div>
        <div class="row">
            <div class="col m4 s4">昵称</div>
            <div class="col m8 s8">
                FlyL3una
            </div>
        </div>
        <div class="row">
            <div class="col m4 s4">邮箱</div>
            <div class="col m8 s8">{{ $user['email'] }}</div>
        </div>
        <div class="row">
            <div class="col m4 s4">电话</div>
            <div class="col m8 s8">110</div>
        </div>
        <div class="row">
            <div class="col m4 s4">github</div>
            <div class="col m8 s8"><a href="https://www.github.com/flyl3una/">https://www.github.com/flyl3una/</a></div>
        </div>

    </div>
@endsection