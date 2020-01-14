@extends('layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>管理员管理-角色列表</h1>
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>角色名称</th>
  		
  		<th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->role_id}}</td>
  		<td>{{$v->role_name}}</td>
  	
  		<td>{{$v->created_at}}</td>
  		<td>
        <button class="btn btn-warning"><a href="{{url('admin/selectPower',['role_id'=>$v->role_id])}}">【权限分配】</a></button>
        <button class="btn btn-success"><a href="#">编辑</a></button>
  			<button class="btn btn-danger"><a href="#">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	
</body>
</html>
