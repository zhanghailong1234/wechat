<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Models\MediaModel;
use App\Tools\Curl;
class DaysController extends Controller
{
    public function index(Request $request){
   //  	$echostr=$request->input("echostr");
		 // echo $echostr;die;
		 $xmlStr=file_get_contents("php://input");
		//var_dump($xmlstr);die;
		file_put_contents("days.txt",$xmlStr);
		//把xml数据转成对象
		$xmlObj=simplexml_load_string($xmlStr);
		if($xmlObj->MsgType=='event'&&$xmlObj->Event=='subscribe'){

			$access_token=Wechat::getToken();
			//调用用户管理-获取用户基本信息接口
			$url="https://api.weixin.qq.com/cgi-bin/user/info?access_token={$access_token}&openid=".$xmlObj->FromUserName."&lang=zh_CN";
			//发请求
			$userInfo=file_get_contents($url);
			//dd($userInfo);
			$userInfo=json_decode($userInfo,true);
			$nickname=$userInfo['nickname'];
			if($userInfo['sex']==1){
			$sex='帅哥';
			}elseif($userInfo['sex']==2){
			$sex='美女';
			}
			$msg="欢迎".$nickname.$sex.",关注张海龙的公众号!";
			Wechat::responseText($msg,$xmlObj);

    }


    //用户点击菜单
    if($xmlObj->MsgType=='event'&&$xmlObj->Event=='CLICK'){
    	if($xmlObj->EventKey=='weather'){
    		//调用当天的天气接口
    		$url="http://api.k780.com:88/?app=weather.today&weaid=1&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";


			$wetherData=file_get_contents($url);
			//dd($wetherData);
			$wetherData=json_decode($wetherData,true);

			//发送模板消息
			$access_token=Wechat::getToken();
    	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";
    	$postData=[
        	"touser"=>(string)$xmlObj->FromUserName,

           "template_id"=>"mZwEMVtY6wH-gP7DFGHGQPDbP4TLWK07BdTGqOeowdQ",
           "data"=>[
           		"date"=>[
           'value'=>$wetherData['result']['days'],
           'color'=>"#173177",
          		 ],
           "week"=>[
           'value'=>$wetherData['result']['week'],
           'color'=>"#173177",
           ],
           "temp"=>[
           'value'=>$wetherData['result']['temperature'],
           'color'=>"#173177",
           ],
           "weather"=>[
           'value'=>$wetherData['result']['weather'],
           'color'=>"#173177",
           ],
           ],
        ];
        //dd($postData);
        $postData=json_encode($postData,JSON_UNESCAPED_UNICODE);
        $res=Curl::curlPost($url,$postData);
			    	}
    }

		if($xmlObj->MsgType=='text'){
			$content=$xmlObj->Content;
			if($content=='1'){
				$msg="王亚蒙";
			
            Wechat::responseText($msg,$xmlObj);
			}else if($content=='2'){
			
				echo "<xml>
				  <ToUserName><![CDATA[".$xmlObj->FromUserName."]]></ToUserName>
				  <FromUserName><![CDATA[".$xmlObj->ToUserName."]]></FromUserName>
				  <CreateTime>".time()."</CreateTime>
				  <MsgType><![CDATA[image]]></MsgType>
				  <Image>
				    <MediaId><![CDATA[0wECWlbNf_379-Y6y0vRrqyRtend8bLlMUhQ7tvcKL3vT1W-hj4k_oOzacj18Gi2]]></MediaId>
				  </Image>
				</xml>";die;
			}
    
		}

	}

	public function ucenter(){

		$userInfo=Wechat::getOpenidByUserInfo();
		return view('days/ucenter',['userInfo'=>$userInfo]);
	}
}