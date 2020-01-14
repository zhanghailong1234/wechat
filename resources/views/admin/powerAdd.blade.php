@extends('layout.layout')
<h1>管理员管理-权限添加</h1>
<form action="{{url('admin/powerCreate')}}" method="post">
  @csrf
  <div class="form-group" style="margin-top: 50px">
    <label for="exampleInputEmail1">权限名称</label>
    <input type="text" class="form-control" name="power_name" placeholder="权限名称">
    
  </div>
  
<div class="form-group">
    <label for="exampleInputPassword1">父权限</label>
    <select class="form-control" name="parent_id">
    <option value="0">顶级权限</option>
    @foreach($data as $v)
      <option value="{{$v['power_id']}}">{{str_repeat("——",$v['level']).$v['power_name']}}</option>  
      @endforeach   
    </select>
  </div>

 
  <div class="form-group">
    <label for="exampleInputEmail1">跳转路径</label>
    <input type="url" class="form-control" name="url" placeholder="跳转路径">
  </div>
  
  <button type="submit" class="btn btn-success">权限添加</button>
</form>
