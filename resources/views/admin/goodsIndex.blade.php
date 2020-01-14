@extends('layout.layout')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
</head>
<body>
<h1>商品管理-商品列表</h1>
<form action="">
      <select name="cate_id" style="width:80px;height:30px">
      <option value="">所有分类</option>
      @foreach($data1 as $k=>$v)
      <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
      @endforeach
      </select>
      <select name="is_up" style="width:50px;height:30px">
      <option value="1">上架</option>
      <option value="2">下架</option>
      </select>关键字
      <input type="text" name="goods_name" placeholder="商品名称" value="{{$search['goods_name']??''}}"" style="width:170px;height:33px">
      <button type="submit" class="btn-success" style="width:50px;height:33px">搜索</button>
</form>
	<table class="table table-hover" style="margin-top: 50px">
  	<tr>
  		<th>ID</th>
  		<th>商品名称</th>
  		<th>商品分类</th>
      <th>商品货号</th>
      <th>商品价格</th>
       <th>是否上架</th>
      <th>商品图片</th>
      <th>商品介绍</th>
  		<th>添加时间</th>
  		<th>操作</th>
  	</tr>
  	@foreach($data as $k=>$v)
  	<tr goods_id="{{$v->goods_id}}">
  		<td>{{$v->goods_id}}</td>
  		<td field="goods_name">
      <span class="clik">{{$v->goods_name}}</span>
      <input type="text" value="{{$v->goods_name}}" style="display:none;" class="mychange">
      </td>
      <td>{{$v->cate_name}}</td>
  		<td>{{$v->goods_letmnumber}}</td>
      <td>{{$v->goods_price}}</td>
      <td class="changevalues" field="is_up">@if($v->is_up==1)√@else×@endif
      </td>  
  		<td><img src="/{{$v->goods_img}}" width="30px"></td>
     
      <td>{{$v->goods_desc}}</td>
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
<script type="text/javascript">
//文本框即点即改
$(document).on("click",".clik",function(){

//当前span隐藏 把input展示出来
var _this=$(this);//当前点击的span标签
_this.hide();
_this.next("input").show();
})


$(document).on("blur",".mychange",function(){

//input隐藏 span展示 通过ajax技术请求控制器 进行修改
var _this=$(this);//当前的文本框

//获取到新值 字段 要修改的ID
var _value=_this.val();

var _field=_this.parent("td").attr("field");
var goods_id=_this.parents("tr").attr('goods_id');

  $.ajax({

    url:"{{url('admin/mychange')}}",
    data:{value:_value,field:_field,goods_id:goods_id},
    dataType:"json",
    type:"POST",
    success:function(res){
       if(res==1){
       _this.hide();//文本框隐藏
       _this.prev().show().html(_value);//span显示
       
    }else{
       _this.hide();//文本框隐藏
       _this.prev().show().html();//span显示
      
    }

    }
  })

})

//单选框即点即改

$(document).on("click",".changevalues",function(){
  
    var _this=$(this);//当前点击的td
    var _val=_this.text();//值??处理
    var _field=_this.attr("field");
    var goods_id=_this.parent("tr").attr("goods_id");
    if(_val=="√"){
      var _value=2;//用于修改数据库
      var flog='×';
    }else{
      var _value=1;
      var flog='√';
    }
   
    $.ajax({
    url:"{{url('admin/changevalue')}}",
    data:{value:_value,field:_field,goods_id:goods_id},
    dataType:"json",
    type:"POST",
    success:function(res){
      if(res.code==2){
        alert(res.font);
      }else{
        _this.text(flog);
      }

        }

    })
})  
</script>
@endsection