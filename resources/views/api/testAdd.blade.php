@extends('layout.layout')
@section('content')

<h1>添加</h1>
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
      <button type="button" class="btn btn-success">添加</button>
    </div>
  </div>

<script type="text/javascript">
var url="http://49.235.78.223/api/test2";
$(document).on("click",".btn",function(){

	var name=$("[name='name']").val();
	var age=$("[name='age']").val();

	$.ajax({
			
            url:url,
            data:{name:name,age:age},
            type:"POST",
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