<?php

namespace App\Http\Controllers;
use App\Models\ChannelModel;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Models\MediaModel;
use App\Models\WechatUserModel;
use App\Models\FirstModel;
class WechatController extends Controller
{
    public function index(Request $request){
    	// Wechat::getToken();
    	// die;
		//接入微信测试号后台点击提交按钮,填一个url地址 微信会推送几个参数过来
		//完成校验(xxx) 原样输出 echostr的参数
		// $echostr=$request->input("echostr");
		// echo $echostr;die;
		//接入成功之后,微信公众号内 所有操作(点菜单 关注 发消息)微信服务器推送一个xml数据包
		//$_post
		$xmlStr=file_get_contents("php://input");
		//var_dump($xmlstr);die;
		file_put_contents("1.txt",$xmlStr);
		//把xml数据转成对象
		$xmlObj=simplexml_load_string($xmlStr);
		// dd($xmlObj);
		
        //如果是用户发送消息
		if($xmlObj->MsgType=='event'&&$xmlObj->Event=='subscribe'){
		// 单独用户关注时 如果是通过渠道关注 统计关注数量
		$channel_status=$xmlObj->EventKey;
		if(!empty($channel_status)){
			$channel_status=ltrim($channel_status,'qrscene_');
			ChannelModel::where(['channel_status'=>$channel_status])->increment('people');
		}else{
			$channel_status=1;
		}
			//关注回复文本
			//获取用户的基本信息 用户管理-获取用户基本信息 需要用access_token
			
			$userInfo=Wechat::getUserInfo($xmlObj->FromUserName);
			$data['channel_status']=$channel_status;
			$data['openid']=$userInfo['openid'];
			$data['nickname']=$userInfo['nickname'];
			$data['sex']=$userInfo['sex'];
			$data['city']=$userInfo['city'];
			
			WechatUserModel::create($data);
			// dd($res);
			//查询数据库关注回复表
			$first=FirstModel::orderByRaw("RAND()")->first();
			
			if($first['first_type']=='textarea'){
				$msg=$first['textarea'];
				Wechat::responseText($msg,$xmlObj);
			}else if($first['first_type']=='image'){
				$media_id=$first['mediawechat_id'];

			echo "<xml>
				  <ToUserName><![CDATA[".$xmlObj->FromUserName."]]></ToUserName>
				  <FromUserName><![CDATA[".$xmlObj->ToUserName."]]></FromUserName>
				  <CreateTime>".time()."</CreateTime>
				  <MsgType><![CDATA[image]]></MsgType>
				  <Image>
				    <MediaId><![CDATA[".$media_id."]]></MediaId>
				  </Image>
				</xml>";die;
			}
			if(empty($first['first_type'])){

				$nickname=$userInfo['nickname'];
				if($userInfo['sex']==1){
			$sex='帅哥';
			}elseif($userInfo['sex']==2){
			$sex='美女';
			}
				$msg="欢迎".$nickname.$sex.",关注张海龙的公众号";
				Wechat::responseText($msg,$xmlObj);
			}
			 

			
		}


		//用户取关
		if($xmlObj->MsgType == 'event' && $xmlObj->Event == 'unsubscribe'){
			$userInfo=WechatUserModel::where(['openid'=>$xmlObj->FromUserName])->first();
			$channel_status=$userInfo['channel_status'];
			//自减根据渠道
			$res=ChannelModel::where(['channel_status'=>$channel_status])->decrement('people');

			

		}
		//如果是用户发送消息
		if($xmlObj->MsgType=='text'){
			$content=$xmlObj->Content;
			if($content=='1'){
				$msg="天王盖地虎,宝塔镇河妖!";
			
            Wechat::responseText($msg,$xmlObj);
			}elseif($content=='2'){
				$msg='飞雪连天射白鹿,笑书神侠倚碧鸳!';
				 Wechat::responseText($msg,$xmlObj);
			}elseif($content=='3'){
				$msg='山西悬空寺,寺悬空山,黄山落叶松,叶落山黄!';
				 Wechat::responseText($msg,$xmlObj);
			}elseif($content=='4'){
				$msg='上海自来水来自海上,山西运煤车煤运西山!';
				 Wechat::responseText($msg,$xmlObj);
			}elseif($content=='5'){
				$msg='天对地,雨对风,大陆对长空,雷隐隐,雾蒙蒙,山花对海树,赤日对苍穹,平仄平仄平平仄,仄平仄平仄仄平,仄仄平!';
				 Wechat::responseText($msg,$xmlObj);
			}elseif($content=='6'){
				$msg='打倒小日本,活捉苍井空!';
				 Wechat::responseText($msg,$xmlObj);

			}elseif(mb_strpos($content,"天气")!==false){
				//得到城市名
				$city=rtrim($content,"天气");
				if(empty($city)){
					$city="北京";
				}
				//回复天气
				//借助第三方的接口k780
				//调用k780接口 得到json数据 处理一下
				
				$msg=Wechat::getWeather($city);
				Wechat::responseText($msg,$xmlObj);
			}
		}

		//如果用户发送图片
		if($xmlObj->MsgType=='image'){
			$mediaData=MediaModel::orderByRaw("RAND()")->first();
			//dd($mediaData);
			$media_id=$mediaData['mediawechat_id'];

			echo "<xml>
				  <ToUserName><![CDATA[".$xmlObj->FromUserName."]]></ToUserName>
				  <FromUserName><![CDATA[".$xmlObj->ToUserName."]]></FromUserName>
				  <CreateTime>".time()."</CreateTime>
				  <MsgType><![CDATA[image]]></MsgType>
				  <Image>
				    <MediaId><![CDATA[".$media_id."]]></MediaId>
				  </Image>
				</xml>";die;
		}

    }
   
}
