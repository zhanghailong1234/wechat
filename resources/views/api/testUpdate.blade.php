@extends('layout.layout')
@section('content')

<h1>修改</h1>
  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="姓名">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">年龄</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="age" placeholder="年龄">
    </div>
  </div>
  
  
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-success">修改</button>
    </div>
  </div>
<script type="text/javascript">
function getQueryString(name){
     var reg = new RegExp("(^|&)"+ name +"=([^&]*)(&|$)");
     var r = window.location.search.substr(1).match(reg);
     if(r!=null)return  unescape(r[2]); return null;
}
var id=getQueryString('id');
var url="http://49.235.78.223/api/test2";
$.ajax({
      
            url:url+"/"+id,
            data:{id:id},
            dataType:"json",
            success:function(res){
       
              $("[name='name']").val(res.data.name);
              $("[name='age']").val(res.data.age);
            },

  });



$(document).on("click",".btn",function(){

  var name=$("[name='name']").val();
  var age=$("[name='age']").val();

  $.ajax({
      
            url:url+"/"+id,
            data:{name:name,age:age,id:id},
            type:"PUT",
            dataType:"json",
            success:function(res){
            if(res.code==200){
              alert(res.msg);
            location.href="http://49.235.78.223/api/testIndex";

            }
            },

  });
})
</script>

@endsection