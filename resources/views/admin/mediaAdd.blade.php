@extends('layout.layout')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>素材管理-素材添加</h1>
	<form action="{{url('admin/mediaCreate')}}" method="post" enctype="multipart/form-data">
  @csrf
  <div class="form-group" style="margin-top: 50px">
    <label for="exampleInputEmail1">素材名称</label>
    <input type="text" class="form-control" name="media_name" placeholder="素材名称">
  </div>
   <div class="form-group">
    <label for="exampleInputEmail1">媒体格式</label>
   
    <select class="form-control" name="media_format">
      <option>--请选择--</option>
      <option value="text">文本格式</option>
      <option value="video">视屏格式</option>
      <option value="voice">语音格式</option>
      <option value="image">图片格式</option>
      
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">素材类型</label>
    <select class="form-control" name="media_type">
    <option>--请选择--</option>
      <option value="临时">临时</option>
      <option value="永久">永久</option>
      
    </select>
  </div>
  <div class="form-group">
   <label for="exampleInputPassword1">素材文件</label>
    <input type="file"  name="media_img">
   
  </div>
  
  <button type="submit" class="btn btn-success">添加</button>
</form>
</body>
</html>