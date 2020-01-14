@extends('layout.layout')

@section('content')
<form action="{{url('admin/goodsProductDo')}}" method="post">
@csrf
<input type="hidden" name="goods_id" value="{{$goods_id}}">
<h3>货品添加</h3>
<table width="100%" id="table_list" class='table table-bordered'>
    <tbody>
    <tr>
      <th colspan="20" scope="col">商品名称：{{$goodsdata['goods_name']}}&nbsp;&nbsp;&nbsp;&nbsp;货号：{{$goodsdata['goods_letmnumber']}}</th>
    </tr>

    <tr>
      <!-- start for specifications -->
      @foreach($newarr as $k=>$v)
      <td scope="col"><div align="center"><strong>{{$k}}</strong></div></td>
      @endforeach
            <!-- end for specifications -->
      <td class="label_2">货号</td>
      <td class="label_2">库存</td>
      <td class="label_2">&nbsp;</td>
    </tr>
    
    <tr id="attr_row">
    @foreach($newarr as $k=>$v)
	    <!-- start for specifications_value -->
		<td align="center" style="background-color: rgb(255, 255, 255);">
			<select name="goodsattr_id[]">
				<option value="" selected="">请选择...</option>
				@foreach($v as $kk=>$vv)
				<option value="{{$vv['goodsattr_id']}}">{{$vv['attrvalue']}}</option>
        @endforeach
			</select>
		</td>
     @endforeach
		
	    <!-- end for specifications_value -->
		<td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_sn[]" value="" size="20"></td>
		<td class="label_2" style="background-color: rgb(255, 255, 255);"><input type="text" name="product_number[]" value="1" size="10"></td>
		<td style="background-color: rgb(255, 255, 255);"><input type="button" class="incre button" value="+" ></td>
    </tr>

    <tr>
      <td align="center" colspan="5" style="background-color: rgb(255, 255, 255);">
        <input type="submit" class="button" value=" 保存 ">
      </td>
    </tr>
  </tbody>
</table>
</form>
<script type="text/javascript">
$(document).on("click",".incre",function(){
    var value=$(this).val();
    if(value=="+"){
      $(this).val("-");
      var tr=$(this).parent().parent();
      var clonetr=tr.clone();
      $(this).val("+");
      tr.after(clonetr);
    }else{
      $(this).parent().parent().remove();
    }
    })  

</script>
@endsection