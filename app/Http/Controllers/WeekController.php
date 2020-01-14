<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use App\Common\Common;
class WeekController extends Controller
{
    public function show(Request $request){
  
    	$xmlStr=file_get_contents("php://input");
    	//dd($xmlStr);
    	file_put_contents("week.txt",$xmlStr);
		//把xml数据转成对象
		$xmlObj=simplexml_load_string($xmlStr);
		//dd($xmlObj);
		if($xmlObj->MsgType == 'event' && $xmlObj->Event == 'subscribe'){
			//关注回复文本
			//获取用户的基本信息 用户管理-获取用户基本信息 需要用access_token
			//开始开发access_token

			$access_token=Common::getToken();
			//调用用户管理-获取用户基本信息接口
			$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid=".$xmlObj->FromUserName."&lang=zh_CN";
			//发请求
			$userInfo=file_get_contents($url);
			$userInfo=json_decode($userInfo,true);
			$nickname=$userInfo['nickname'];
			if($userInfo['sex']==1){
			$sex='帅哥';
			}elseif($userInfo['sex']==2){
			$sex='美女';
			}
			$msg="欢迎".$nickname.$sex.",关注张海龙的公众号!";
			Common::responseText($msg,$xmlObj);
    }
		if($xmlObj->MsgType=='text'){
					$content=$xmlObj->Content;
					if($content=='1'){
						$msg="您好!";
					
		            Common::responseText($msg,$xmlObj);
		      }else if(mb_strpos($content,"建议+")!==false){
					$str=ltrim($content,"建议+");
					DB::table('week')->insert(
					['week_name'=>$str]
					);
					Common::responseText("感谢您的建议!",$xmlObj);
				}	

			}
		}
}
