
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>

<body>
<form action="{{url('admin/contractCreat')}}" method="post">
		<div style="border:30px solid gray;width:900px;border-left:90px solid gray;">
		

				<div align="center">合同</div>
				<div style="padding-bottom:10px">&nbsp;&nbsp;&nbsp;客户名称<input type="text" name="contract_name" style="width:387px;"></div>
				
				<div style="width:900px;border:1px solid gray;">
				<div style="padding-top:30px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;成交金额:<input type="text" name="contract_price" style="width:85px;"><span style="color:red">万元</span>
					开始时间:<input type="date" name="" style="width:120px;">
					结束时间:<input type="date" name="" style="width:120px;">
				</div>
				<div style="padding-top:50px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;服务项目:<button id="incre">增加服务项目</button></div>
				<div style="margin:15px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;类型:<select name="type_id[]">

						<option value="1">广告</option>
						<option value="2">网站制作</option>
						</select>
						内容:<textarea name="service_desc[]"></textarea>
						金额:<input type="text" name="service_price[]"><span style="color:red">万元</span>
						<button id="delete">删除</button>
				</div>
				<div>&nbsp;&nbsp;&nbsp;成交情况</div>
				</div>
				
				<div style="padding-top:10px">上传电子版<input type="file" name="contract_img"></div>
				<div align="center"><input type="submit" value="确认提交"></div>
						
		
		</div>
	</form>
</body>
</html>
<script src="https://cdn.jsdelivr.net/npm/jquery@1.12.4/dist/jquery.min.js"></script>
<script>

$(document).on("click","#incre",function(){
	// event.preventDefault();
	var clonediv=$(this).parent().next().clone();
	 event.preventDefault();
	$(this).parent().next().next().after(clonediv);
	
})
 $(document).on('click','#delete',function(){
        event.preventDefault();
        $(this).parent().remove();
    })
</script>

 