@extends('layout.layout')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <h1>商品管理-类型添加</h1>
  <form action="{{url('admin/typeCreate')}}" method="post">
  @csrf
  <div class="form-group" style="margin-top: 50px">
    <label for="exampleInputEmail1">类型名称</label>
    <input type="text" class="form-control" name="type_name" placeholder="类型名称">
    
  </div>
  <button type="submit" class="btn btn-success">类型添加</button>
</form>
</body>
</html>
@endsection