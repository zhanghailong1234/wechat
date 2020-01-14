@extends('layout.layout')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <h1>商品管理-属性添加</h1>
  <form action="{{url('admin/attrEdit')}}" method="post">
  @csrf
  <div class="form-group" style="margin-top: 50px">
    <label for="exampleInputEmail1">属性名称</label>
    <input type="hidden" name="attr_id" value="{{$data1->attr_id}}">
    <input type="text" class="form-control" name="attr_name" placeholder="属性名称" value="{{$data1->attr_name}}">
    
  </div>
  
 <div class="form-group">
    <label for="exampleInputPassword1">所属商品类型</label>
    <select class="form-control" name="type_id">
    <option value="0">请选择...</option>
    @foreach($data as $v)
      <option value="{{$v->type_id}}">{{$v->type_name}}</option>  
      @endforeach
    </select>
  </div>

<div class="form-group">
    <label for="exampleInputPassword1">属性是否可选</label>
    <div>
    <input type="radio" name="is_optional" value="1">唯一属性
    <input type="radio" name="is_optional" value="2">单选属性
    <input type="radio" name="is_optional" value="3">复选属性
    </div>
  </div>
  <button type="submit" class="btn btn-success">属性修改</button>
  
</form>
</body>
</html>
@endsection