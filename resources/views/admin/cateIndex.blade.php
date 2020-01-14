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
  		<th>分类名称</th>
      <th>是否展示</th>
      <th>是否在导航栏展示</th>
  		<th>父分类</th>
      <th>商品数量</th>
      <th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->cate_id}}</td>
  		<td>{{str_repeat("——",$v['level']).$v['cate_name']}}</td>
      <td>
    @if($v->cate_show==1)
    √
    @else
    ×
    @endif
      </td>
      <td>
    @if($v->cate_nav_show==1)
    √
    @else
    ×
    @endif
      </td>
  	  <td>{{$v->parent_id}}</td>
      <td>{{$v->goods_number}}</td>
  		<td>{{$v->created_at}}</td>
  		<td><button class="btn btn-success"><a href="{{url('admin/cateUpdate',['cate_id'=>$v->cate_id])}}">编辑</a></button>
  			<button class="btn btn-danger"><a href="{{url('admin/cateDelete',['cate_id'=>$v->cate_id])}}">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	
</body>
</html>
