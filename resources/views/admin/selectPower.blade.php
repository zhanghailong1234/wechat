@extends('layout.layout')
@section('content')
	<h1>给角色分配权限</h1>
	<br>
	<h4>用户:{{$roledata['role_name']}}</h4>
    <form action="{{url('admin/selePower')}}" method="POST">
    	<input type="hidden" value="{{$roledata['role_id']}}" name="role_id">
		  <table class='table table-bordered'>
		  		@foreach($powerdata as $v)
	  	  		<tr>
			  		<td width="18%" valign="top" class="first-cell">
			    		<input type="checkbox" name="power_id[]" value="{{$v['power_id']}}" class="checkbox" <?php if(in_array($v['power_id'],$rolepowerdata)) echo "checked";?>>
			    		{{$v['power_name']}}  
			    	</td>
			    	@if(!empty($v['son']))
			    	<td>
			    	@foreach($v['son'] as $val)
					<div style="width:200px;float:left;">
						<input type="checkbox" name="power_id[]" value="{{$val['power_id']}}" class="checked" <?php if(in_array($val['power_id'],$rolepowerdata)) echo "checked";?>>
					{{$val['power_name']}}  
					</div>
					@endForeach
			    	</td>
			    	@endif
			   	</tr>
			   	@endForeach
	 	 </table>

	 	 <button type="submit" class="btn btn-success">权限分配</button>
	</form>
	<script type="text/javascript">
	$(".checkbox").on("click",function(){

		
		//如果是点击状态
		var status=$(this).prop('checked');
		var td=$(this).parent();
		var select=td.next("td").find("input[type='checkbox']").prop('checked',status);
	})
	</script>
@endsection