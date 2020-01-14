@extends('layout.layout')

	<h1>给用户选择角色</h1>
	<br>
	<h4>用户:{{$userData['user_name']}}</h4>
    <form action="{{url('admin/seleRole')}}" method="POST">
    	<input type="hidden" value="{{$userData['user_id']}}" name="user_id">
		  <table class='table table-bordered'>
		  		@foreach($roleData as $v)
	  	  		<tr>
			  		<td width="18%" valign="top" class="first-cell">
			    		<input type="checkbox" name="role_id[]" value="{{$v['role_id']}}" class="checkbox" title="">
			    		{{$v['role_name']}}  
			    	</td>
			   	</tr>
			   	@endForeach
	 	 </table>

	 	 <button type="submit" class="btn btn-success">角色分配</button>
	</form>
