
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<div>头像:<img src="{{$userInfo['headimgurl']}}"></div>
	<div>昵称:{{$userInfo['nickname']}}</div>
	<div>性别:
		@if($userInfo['sex']==1)
		男
		@else
		女
		@endif
		<div>区县:{{$userInfo['city']}}</div>
		<div>城市:{{$userInfo['province']}}</div>
		<div>国家:{{$userInfo['country']}}</div>
	</div>
</body>
</html>