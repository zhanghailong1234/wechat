<?php
namespace App\Common;
use Illuminate\Support\Facades\Cache;
class Common{
    const appId="wx0be64b1e7daecd82";
    const appSecret="16aeef9ff9cb40087cda69c55c73cf03";
	 /**
     * 恢复文本消息
     * @param  [type] $msg    [description]
     * @param  [type] $xmlObj [description]
     * @return [type]         [description]
     */
public static function responseText($msg,$xmlObj){

                echo "<xml>
                     <ToUserName><![CDATA[".$xmlObj->FromUserName."]]></ToUserName>
                    <FromUserName><![CDATA[".$xmlObj->ToUserName."]]></FromUserName>
                    <CreateTime>".time()."</CreateTime>
                     <MsgType><![CDATA[text]]></MsgType>
                     <Content><![CDATA[".$msg."]]></Content>
                    </xml>";die;
}

/**
 * 获取access_token令牌
 * 
 */
public static function getToken(){
//缓存里有数据  直接从缓存读
$access_token=Cache::get("access_token");
if(empty($access_token)){
//如果token过期了 重新获取
    
    $url="https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid=".Self::appId."&secret=".Self::appSecret;
    //发请求
    $data=file_get_contents($url);
    $data=json_decode($data,true);
    $access_token=$data['access_token'];
    //令牌如何储存两小时?
    //数据库Redis  memcache  文件
    Cache::put("access_token",$access_token,7200);
    }
    return $access_token;
    }


}