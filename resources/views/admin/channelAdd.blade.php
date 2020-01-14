@extends('layout.layout')
<h1>渠道管理-渠道添加</h1>
<form class="form-horizontal" action="{{url('admin/channelCreate')}}" method="post">
@csrf
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">渠道名称</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="channel_name" placeholder="渠道名称">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">渠道标识</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="channel_status" placeholder="渠道标识">
    </div>
  </div>
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      
    </div>
  </div>
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-success">渠道添加</button>
    </div>
  </div>
</form>
