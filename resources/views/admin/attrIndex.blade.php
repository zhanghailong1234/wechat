@extends('layout.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>商品管理-属性列表</h1>

<form>
<select name="type_id">
<option value="0">--类型选择--</option>
@foreach($list as $v)
<option value="{{$v->type_id}}">{{$v->type_name}}</option>
@endforeach
</select>
<button type="submit" class="btn-success">查询</button>
</form>


	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
      <th><input type="checkbox" id="allbox" /></th>
  		<th>ID</th>
  		<th>属性名称</th>
      <th>所属商品类型</th>
      <th>属性是否可选</th>
      <th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $v)
  	<tr attr_id="{{$v->attr_id}}">
      <td><input type="checkbox" class="box" /></td>
  		<td>{{$v->attr_id}}</td>
  		<td>{{$v->attr_name}}</td>
      <td>{{$v->type_name}}</td>
      <td>
    @if($v->is_optional==2)
    可选(参数)
    @else
    不可选(规格)
    @endif
      </td>
  		<td>{{$v->created_at}}</td>
  		<td><button class="btn btn-success"><a href="{{url('admin/attrUpdate',['attr_id'=>$v->attr_id])}}">编辑</a></button>
  			<button class="btn btn-danger"><a href="{{url('admin/attrDelete',['attr_id'=>$v->attr_id])}}">删除</a></button>			
  		</td>
  	</tr>
  	@endforeach
	</table>
  <input type="button" value="批量删除" class="btn btn-success">
	{{$data->appends($search)->links()}}
</body>
</html>
<script>

$(document).on("click",".btn",function(){

    //默认的类的id赋值给变量
    var box=$(".box:checked");

    //定义id为空
    var attr_id='';
    //用each循环each(function(index){})
    box.each(function(index){
      //找到并拼接所选择的id
      attr_id+=$(this).parents("tr").attr("attr_id")+",";
      console.log(attr_id);
      
    })
    attr_id=attr_id.substr(0,attr_id.length-1);
      location.href="{{url('admin/attrDele')}}?attr_id="+attr_id;
  })


$(document).on("click","#allbox",function(){
  var res=$(this).prop('checked');
  $(".box").prop('checked',res);
})
</script>
@endsection