@extends('layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>管理员管理-管理员列表</h1>
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>用户名</th>
  		<th>用户权限</th>
  		<th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->user_id}}</td>
  		<td>{{$v->user_name}}</td>
  		<td>
		@if($v->is_super==1)
		普管
		@else
		超管
		@endif
  		</td>
  		<td>{{$v->created_at}}</td>
  		<td>
        <button class="btn btn-warning"><a href="{{url('admin/selectRole',['user_id'=>$v->user_id])}}">【角色分配】</a></button>
        <button class="btn btn-success"><a href="#">编辑</a></button>
  			<button class="btn btn-danger"><a href="#">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	{{$data->links()}}
</body>
</html>
