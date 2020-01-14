@extends('layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>菜单管理-菜单列表</h1>
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>菜单名称</th>
  		<th>菜单类型</th>
  		<th>菜单标识</th>
  		<th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->menu_id}}</td>
  		<td>{{$v->menu_name}}</td>
  		<td>{{$v->menu_type}}</td>
  		<td>{{$v->menu_status}}</td>
  		<td>{{$v->created_at}}</td>
  		<td><button class="btn btn-success"><a href="#">编辑</a></button>
  			<button class="btn btn-danger"><a href="#">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	{{$data->links()}}
  <button class="btn btn-success"><a href="{{url('admin/menuWechat')}}">一键同步微信菜单</a></button>
</body>
</html>

