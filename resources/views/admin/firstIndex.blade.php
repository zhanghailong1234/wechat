@extends('layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<div>
<h1>首次关注管理-首次关注列表</h1>

</div>

	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>回复类型</th>
  		<th>文本</th>
  		<th>图片</th>

      <th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->first_id}}</td>
      <td>{{$v->first_type}}</td>
  		<td>{{$v->textarea}}</td>
  		<td><img src="/{{$v->image}}" width="30px"></td>
  		<td>{{$v->created_at}}</td>

      
     
  	
  		<td><button class="btn btn-success"><a href="#">编辑</a></button>
  			<button class="btn btn-danger"><a href="#">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	{{$data->links()}}
</body>
</html>
