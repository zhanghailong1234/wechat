@extends('layout.layout')

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<div>
<h1>素材管理-素材列表</h1>
<form>
<input type="submit" name="media_format" class='btn btn-success' value="全部">
<input type="submit" name="media_format" class='btn btn-danger' value="视频">
<input type="submit" name="media_format" class=' btn btn-warning' value="语音">
<input type="submit" name="media_format" class='btn btn-success' value="图片">
</form>
</div>

	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>素材名称</th>
  		<th>媒体格式</th>
  		<th>素材类型</th>
      <th>素材文件</th>

      <th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr>
  		<td>{{$v->media_id}}</td>
  		<td>{{$v->media_name}}</td>
  		<td>{{$v->media_format}}</td>
  		<td>{{$v->media_type}}</td>

      <td>
      @if($v['media_format']=='image')
      <img src="/{{$v->media_img}}" style="width:50px">
      @elseif($v['media_format']=='video')

    <video src="/{{$v->media_img}}" controls="controls" style="width:100px"></video>
    @elseif($v['media_format']=='voice')
    <video src="/{{$v->media_img}}" controls="controls" style="width:100px"></video>
     
    
     @endif
      </td>
      
  		<td>{{$v->created_at}}</td>
  		<td><button class="btn btn-success"><a href="#">编辑</a></button>
  			<button class="btn btn-danger"><a href="#">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
	{{$data->appends($search)->links()}}

  
</body>
</html>
