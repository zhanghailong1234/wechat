@extends('layout.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>学生展示</h1>
  <input type="text" name=name placeholder="姓名">
  <input type="button" value="搜索" id="search">
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>姓名</th>
  		<th>年龄</th>
  		<th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	<tbody id="list">

    </tbody>
	</table>



	<nav aria-label="Page navigation">
  <ul class="pagination">
   
   <!--  <li><a href="#">1</a></li>
    <li><a href="#">2</a></li>
    <li><a href="#">3</a></li>
    <li><a href="#">4</a></li>
    <li><a href="#">5</a></li> -->
    
  </ul>
</nav>
</body>
</html>
<script type="text/javascript">
var url="http://49.235.78.223/api/test2";
$.ajax({
      
            url:url,
            
            dataType:"json",
            success:function(res){
           $.each(res.data.data,function(i,v){
            //构建空tr
            var tr=$("<tr></tr>");
            //tr里追加td
            tr.append("<td>"+v.id+"</td>");
            tr.append("<td>"+v.name+"</td>");
            tr.append("<td>"+v.age+"</td>");
            tr.append("<td>"+v.created_at+"</td>");
             tr.append("<td><a href='javascript:;' test_id='"+v.id+"' class='btn btn-success update'>编辑</a>&nbsp;&nbsp;&nbsp;<a href='javascript:;' class='btn btn-danger delete' test_id='"+v.id+"'>删除</a></td>");
            //把tr放到数据区域里 #list
            $("#list").append(tr);
           });
           //构建一个人页码
           //res.data.last_page
           $(".pagination").empty();
           for (var i = 1;i<=res.data.last_page; i++) {

            if(res.data.current_page==i){
               var li="<li class='active'><a href='javascript:;'>"+i+"</a></li>";
             }else{
                var li="<li><a href='javascript:;'>"+i+"</a></li>";
                 }
                 $(".pagination").append(li);
              } 
               
            },

  });
//分页点击页码 获取数据
$(document).on('click',".pagination a",function(){

  //获取第几页数据
  var page=$(this).html();
  //调用接口获取数据
  $.ajax({

    url:url,
            data:{page:page},
            dataType:"json",
            success:function(res){
              //根据返回的结构替换页面
              $("#list").empty();
              $.each(res.data.data,function(i,v){
            //构建空tr
            var tr=$("<tr></tr>");
            //tr里追加td
            tr.append("<td>"+v.id+"</td>");
            tr.append("<td>"+v.name+"</td>");
            tr.append("<td>"+v.age+"</td>");
            tr.append("<td>"+v.created_at+"</td>");
             tr.append("<td><a href='javascript:;' test_id='"+v.id+"' class='btn btn-success update'>编辑</a>&nbsp;&nbsp;&nbsp;<a href='javascript:;' class='btn btn-danger delete' test_id='"+v.id+"'>删除</a></td>");
            //把tr放到数据区域里 #list
            $("#list").append(tr);
              });
           }
    })
})

//跳转到修改页面
$(document).on('click',".update",function(){

  var id=$(this).attr("test_id");
  
  //跳转
  location.href="http://49.235.78.223/api/testUpdate?id="+id;
})


//删除
$(document).on('click',".delete",function(){

  var id=$(this).attr("test_id");
  $.ajax({
      
            url:url+"/"+id,
            type:"DELETE",
            dataType:"json",
            success:function(res){
        if(res.code==200){
              alert(res.msg);
            location.href="http://49.235.78.223/api/testIndex";

            }

            },

  });
  
})

//搜索
$(document).on('click',"#search",function(){
var name=$("[name='name']").val();

  
  $.ajax({
      
            url:"http://49.235.78.223/api/test_Index",
            data:{name:name},
            dataType:"json",
            success:function(res){
        
              console.log(res);
            },

  });
  
})
</script>
@endsection
