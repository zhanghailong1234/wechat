@extends('layout.layout')
<h1>管理员管理-角色添加</h1>
<form class="form-horizontal" action="{{url('admin/roleCreate')}}" method="post">
@csrf
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">角色名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="role_name" placeholder="用户名">
    </div>
  </div>
  
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">角色添加</button>
    </div>
  </div>
</form>
