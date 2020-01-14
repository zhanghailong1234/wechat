@extends('layout.layout')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
	<h1>菜单管理-菜单添加</h1>
	<form action="{{url('admin/menuCreate')}}" method="post">
  @csrf
  <div class="form-group" style="margin-top: 50px">
    <label for="exampleInputEmail1">菜单名称</label>
    <input type="text" class="form-control" name="menu_name" placeholder="菜单名称">
    <p style="color:red">{{$errors->first('menu_name')}}</p>
  </div>
  
<div class="form-group">
    <label for="exampleInputPassword1">所属上级菜单</label>
    <select class="form-control" name="parent_id">
    <option value="0">一级菜单</option>
    @foreach($data as $v)
      <option value="{{$v['menu_id']}}">{{$v['menu_name']}}</option>  
      @endforeach   
    </select>
  </div>


  <div class="form-group">
    <label for="exampleInputPassword1">菜单类型</label>
    <select class="form-control" name="menu_type">
    <option>--请选择--</option>
      <option value="click">点击类型</option>
      <option value="view">跳转类型</option>     
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">菜单标识</label>
    <input type="text" class="form-control" name="menu_status" placeholder="菜单标识">
  </div>
  
  <button type="submit" class="btn btn-success">一键添加菜单</button>
</form>
</body>
</html>
@endsection