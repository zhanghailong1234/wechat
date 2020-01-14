@extends('layout.layout')

<h1>管理员管理-管理员添加</h1>
<form class="form-horizontal" action="{{url('admin/adminCreate')}}" method="post">
@csrf
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">用户名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="user_name" placeholder="用户名">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">密码</label>
    <div class="col-sm-10">
      <input type="password" class="form-control" name="user_pwd" placeholder="密码">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">管理权限</label>
    <div class="col-sm-10">
      <input type="radio" name="is_super" value='1' checked>普通
      <input type="radio" name="is_super" value="2">超管
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">管理员注册</button>
    </div>
  </div>
</form>
