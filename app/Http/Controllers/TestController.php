<?php

namespace App\Http\Controllers;
use App\Tools\Curl;
use Illuminate\Http\Request;
use App\Tools\Wechat;
class TestController extends Controller
{

  public function test(){
  	$access_token=Wechat::getToken();
  	//dd($access_token);
	$url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";
	$postData='{"expire_seconds": 604800, "action_name": "QR_STR_SCENE", "action_info": {"scene": {"scene_str": "地铁推广"}}}';
	$res=Curl::curlPost($url,$postData);
	
	$res=json_decode($res,true);
	//dd($res);
	$ticket=$res['ticket'];
	var_dump($ticket);die;
  }  
}
