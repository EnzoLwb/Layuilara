


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登入 </title>
    <meta name="renderer" content="webkit">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
    <link rel="stylesheet" href="{{asset('static/admin/layuiadmin/layui/css/layui.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('static/admin/layuiadmin/style/admin.css')}}" media="all">
    <link rel="stylesheet" href="{{asset('static/admin/layuiadmin/style/login.css')}}" media="all">
</head>
<body>

<div class="layadmin-user-login layadmin-user-display-show" >

    <div class="layadmin-user-login-main">
        <div class="layadmin-user-login-box layadmin-user-login-header">
            <h2>{{$system_name}}</h2>
            <p>{{$system_remarks}}</p>
        </div>
        @yield('content')
    </div>

    <div class="layui-trans layadmin-user-login-footer">
        <p>© 2019
            @if(isset($home_url))
            <a href="{{$home_url}}" target="_blank">{{$home_url}}</a>
            @endif
        </p>
    </div>
</div>

<script src="{{asset('static/admin/layuiadmin/layui/layui.js')}}"></script>
<script src="{{asset('js/jquery.min.js')}}"></script>
<script>
    layui.config({
        base: '/static/admin/layuiadmin/' //静态资源所在路径
    }).use(['layer'],function () {
        var layer = layui.layer;

        //表单提示信息
        @if(count($errors)>0)
            @foreach($errors->all() as $error)
                layer.msg("{{$error}}",{icon:5});
                @break
            @endforeach
        @endif

        //正确提示
        @if(session('success'))
        layer.msg("{{session('success')}}",{icon:6});
        @endif

    })
</script>
</body>
</html>