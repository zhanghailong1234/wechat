@extends('layout.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Document</title>
</head>
<body>
<h1>首次关注管理-首次关注回复设置</h1>
  <form action="{{url('admin/firstCreate')}}" method="post" enctype="multipart/form-data">
  @csrf
  
  
 <div class="form-group">
    <label for="exampleInputPassword1">回复类型</label>
    
    <select class="form-control" name="first_type" id="chan">
      
      <option value="textarea">文本</option>
     <option value="image">图片</option>
    </select>
  </div>

<div class="form-group" id="textarea">
   <label for="exampleInputPassword1">文本</label>
    <textarea name="textarea" style="width:980px"></textarea>
  </div>


  <div class="form-group" style="display:none;" id="image">
   <label for="exampleInputPassword1">图片</label>
    <input type="file" name="image" style="display:inline">
    <input type="button" value="从素材库中选择" style="display:inline" id="clk">
    <table class="table table-Bodered table-hover" id="table">
    <!-- <tr>
    <td></td>
    <td></td>
    <td></td>
    </tr>
    <tr>
  <td></td>
  <td></td>
  <td></td>
    </tr> -->
    </table>
  </div>
  
  
  <button type="submit" class="btn btn-success">添加</button>
</form>
</body>
</html>
<script>
$("#chan").on("change",function(){

   var _val=$(this).val();
    if(_val=='textarea'){
      $('#image').hide().remove("div");
      $('#textarea').show();
    }else if(_val=='image'){
      $('#textarea').hide();
      $('#image').show();
    }
})
$("#clk").on("click",function(){

  $.ajax({

    url:"{{url('admin/getMedia')}}",
    type:"GET",
    dataType:"json",
    success:function(res){
      //循环构建一个table表格
      //构架标题
       $("#table").append("<tr><td>请选择</td><td>编号</td><td>名称</td><td>图片</td></tr>");
      $.each(res,function(i,v){
         //构建空tr
        var tr=$("<tr></tr>");
        //tr里追加td
        tr.append("<td><input type='radio' name='media_id' value='"+v.mediawechat_id+"'></td>");
        tr.append("<td>"+v.media_id+"</td>");
        tr.append("<td>"+v.media_name+"</td>");
        tr.append("<td><img src='/"+v.media_img+"' width='100px'></td>");
        //tr放到table里
        $("#table").append(tr);
      }) 
    } 
  })
})

</script>
@endsection