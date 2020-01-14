<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title> - 登录</title>
    <meta name="keywords" content="">
    <meta name="description" content="">

    <link rel="shortcut icon" href="favicon.ico"> <link href="{{asset('adminjs/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('adminjs/css/font-awesome.css')}}" rel="stylesheet">

    <link href="{{asset('adminjs/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('adminjs/css/style.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html" />
    <![endif]-->
    <script>if(window.top !== window.self){ window.top.location = window.location;}</script>
</head>

<body class="gray-bg">

    <div class="middle-box text-center loginscreen  animated fadeInDown">
        <div>
            <div>

                <h1 class="logo-name">h</h1>

            </div>
            <h3>欢迎使用 hAdmin</h3>

            <form class="m-t" role="form" action="{{url('admin/loginDo')}}" method="post">
            @csrf
                <div class="form-group">
                    <input type="text" class="form-control" name="user_name" placeholder="用户名" required="">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control" name="user_pwd" placeholder="密码" required="">
                </div>
                <div class="form-group">
                    <input type="text" class="form-control" name="code" placeholder="微信验证码" style="width:68%;float:left"> 
                    <input type="button" class="btn btn-success" value="发送验证码" id='send'>
                </div>
                <button type="submit" class="btn btn-primary block full-width m-b">登 录</button>


                <p class="text-muted text-center"> <a href="login.html#"><small>忘记密码了？</small></a> | <a href="register.html">注册一个新账号</a>
                </p>
            

                <div class="form-group">
                <h3 style="color:red">点击前往微信扫码登录</h3>
                    <img src="/img/1.jpg" style="width:200px;height:200px">
                </div>
            </form>
        </div>
    </div>

    <!-- 全局js -->
    <script src="{{asset('adminjs/js/jquery.min.js')}}"></script>
    <script src="{{asset('adminjs/js/bootstrap.min.js')}}"></script>

    
    

</body>

</html>
<script type="text/javascript">

$("#send").on("click",function(){

    var user_name=$("[name='user_name']").val();
   var user_pwd=$("[name='user_pwd']").val();
$.ajax({

    url:"{{url('admin/send')}}",
    type:"GET",
    data:{user_name:user_name,user_pwd:user_pwd},
    dataType:"json",
    success:function(res){

    }
})
})
</script>
