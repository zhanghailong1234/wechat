@extends('layout.layout')
@section('content')


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
  <h1>商品管理-分类添加</h1>
  <form action="{{url('admin/cateEdit')}}" method="post">
  @csrf
  <input type="hidden" name="cate_id" value="{{$data1->cate_id}}">
  <div class="form-group" style="margin-top: 50px">
    <label for="exampleInputEmail1">分类名称</label>
    <input type="text" class="form-control" name="cate_name" placeholder="分类名称" id="cate_name" value="{{$data1->cate_name}}">
    
  </div>
  
 <div class="form-group">
    <label for="exampleInputPassword1">是否展示</label>
    <div>
    <input type="radio" name="cate_show" value="1">是
    <input type="radio" name="cate_show" value="2">否
    </div>
    
  </div>

<div class="form-group">
    <label for="exampleInputPassword1">是否在导航栏展示</label>
    <div>
    <input type="radio" name="cate_nav_show" value="1">是
    <input type="radio" name="cate_nav_show" value="2">否
    </div>
    
  </div>
<div class="form-group">
    <label for="exampleInputPassword1">上级分类</label>
    <select class="form-control" name="parent_id">
    <option value="0">一级分类</option>
     @foreach($data as $v)
      <option value="{{$v['cate_id']}}">{{str_repeat("——",$v['level']).$v['cate_name']}}</option>  
      @endforeach   
    </select>
  </div>
 
  
  <button type="submit" class="btn btn-success">分类修改</button>
</form>
</body>
</html>
<!-- <script type="text/javascript">
$(document).on("blur","#cate_name",function(){
  var _this=$(this);
  var cate_name=_this.val();

  $.ajax({

    Type:"GET",
    url:"{{url('admin/cateCreate')}}",
    data:{cate_name:cate_name},
    dataType:"json",
    success:function(res){
      if(res.code==200){

      }
    },
  })
})
</script> -->
@endsection
