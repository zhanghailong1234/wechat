@extends('layout.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>商品管理-类型列表</h1>
<button class="btn btn-success"><a href="{{url('admin/attrAdd')}}">属性添加</a></button>
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>分类名称</th>
      <th>属性数</th>
      <th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->type_id}}</td>
  		<td>{{$v->type_name}}</td>
      <td>{{$v->attr_number}}</td>
  		<td>{{$v->created_at}}</td>
  		<td>
        <button class="btn btn-success"><a href="{{url('admin/attrShow',['type_id'=>$v->type_id])}}">属性列表</a></button>
        <button class="btn btn-success"><a href="{{url('admin/typeUpdate',['type_id'=>$v->type_id])}}">编辑</a></button>
  			<button class="btn btn-danger"><a href="{{url('admin/typeDelete',['type_id'=>$v->type_id])}}">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	{{$data->links()}}
</body>
</html>


@endsection