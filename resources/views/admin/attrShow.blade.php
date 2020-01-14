@extends('layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>商品管理-分类列表</h1>
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>属性名称</th>
      <th>所属商品类型</th>
      <th>属性是否可选</th>
      <th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->attr_id}}</td>
  		<td>{{$v->attr_name}}</td>
      <td>{{$v->type_id}}</td>
      <td>
    @if($v->is_optional==1)
    x
    @else
    √
    @endif
      </td>
  		<td>{{$v->created_at}}</td>
  		<td><button class="btn btn-success"><a href="#">编辑</a></button>
  			<button class="btn btn-danger"><a href="#">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	
</body>
</html>
