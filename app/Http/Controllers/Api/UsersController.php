<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UsersModel;
class UsersController extends Controller
{
	//跳登录页面调用的登录接口生成token
    public function login(){
    	header("Access-Control-Allow-Origin: *");
    	$users_name=request()->input('users_name');
        
    //$users_name="users";$users_pwd="123";
    	$users_pwd=request()->input('users_pwd');

    	$data=UsersModel::where(['users_name'=>$users_name,'users_pwd'=>$users_pwd])->first();
    	// dd($data);
    	if(!$data){
    		return json_encode([
    		'code'=>201,
    		'msg'=>'用户或密码错误!',
    		]);
    	}
    	
    	$token=md5($data->users_id.time());
    	//dd($token);
    	$data->users_token=$token;
    	$data->expire_time=time()+7200;
    	//dd($data->expire_time);
    	$data->save();
    	
    	return json_encode([
    		'code'=>200,
    		'msg'=>'登录成功!',
    		'data'=>$token,
    		]);
    }
	
}
