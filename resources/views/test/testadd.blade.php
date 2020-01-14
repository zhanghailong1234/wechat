@extends('layout.layout')
@section('content')
<h1>添加</h1>

  <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label">姓名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="name" placeholder="用户名">
    </div>
  </div>
  <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">年龄</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="age" placeholder="年龄">
    </div>
  </div>
   <div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">签名</label>
    <div class="col-sm-10">
      <input type="text" class="form-control" name="sign" placeholder="签名">
    </div>
  </div>
 
  <div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="button" class="btn btn-success">添加</button>
    </div>
  </div>
  <script type="text/javascript">
$(document).on("click",".btn",function(){

  var name=$("[name='name']").val();
  var age=$("[name='age']").val();
  var sign=$("[name='sign']").val();
  $.ajax({
      
            url:"http://49.235.78.223/api/Create",
            data:{name:name,age:age,sign:sign},
            type:"GET",
            dataType:"json",
            success:function(res){
            if(res.code==200){
              alert(res.msg);
           

            }
            },

  });
})

  </script>
  @endsection

