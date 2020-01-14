<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tools\Wechat;
use App\Tools\Curl;
use App\Models\UserinfoModel;
class KaoshiController extends Controller
{
    public function list(Request $request){

    	// $echostr=$request->input('echostr');
    	// echo $echostr;die;
    	$xmlstr=file_get_contents("php://input");
    	//dd($xmlObj);
    	

    	file_put_contents('3.txt',$xmlstr);

		$xmlObj=simplexml_load_string($xmlstr);

    	if($xmlObj->MsgType="event"&&$xmlObj->Event="subscribe"){
    		
    		$access_token=Wechat::getToken();
    		$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid=".$xmlObj->FromUserName."&lang=zh_CN";

    		$userinfo=file_get_contents($url);
    		
    		$userinfo=json_decode($userinfo,true);
    		//dd($userinfo);

    		$nickname=$userinfo['nickname'];
    		
    		if(UserinfoModel::where(['user_name'=>$nickname])->count()>0){

    			$msg="你好".$nickname."欢迎回来";
    		}else{
    			$msg="你好".$nickname."欢迎首次关注";
    			$data=[];
    		$data['user_name']=$nickname;
    		$data['user_sex']=$userinfo['sex'];
    		$data['user_city']=$userinfo['province'];
    		$data['openid']=$userinfo['openid'];
    		UserinfoModel::create($data);


    		}
    		

    	Wechat::responseText($msg,$xmlObj);
    	}

    	if($xmlObj->MsgType="event"&&$xmlObj->Event="CLICK"){
    		time();
    }
    }


    public function show(){
    	 // echo "123";
    	$userInfo=Wechat::getOpenidByUserInfo();
    	return view('kaoshi/show',['userInfo'=>$userInfo]);
    }

    
}
