<?php

namespace App\Http\Controllers\Admin;
use App\Models\StudentModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tools\Wechat;
use App\Tools\Curl;
class LableController extends Controller
{
    public function getUser(){
    




    	$access_token=Wechat::getToken();
    	$url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";
    	$postData=[
        "touser"=>"oi3dzwSvHTYyNpXTuwU81aLNEMcM",
           "template_id"=>"tOEBqKAE7Su0P6sTS6DmWue82RXwnRSBbrLSHnip8hQ",
           "data"=>[
           "first"=>[
           'value'=>"张三",
           'color'=>"#173177",
           ],
           ],
        ];

   $postData=json_encode($postData,JSON_UNESCAPED_UNICODE);
        $res=Curl::curlPost($url,$postData);
        dd($res);
    }

    public function test(){
      //用户同意授权,获取code
      $redirect_uri=urlencode("http://w.wen5211314.com/admin/auth");//地址用urencode处理
      $url="https://open.weixin.qq.com/connect/oauth2/authorize?appid=wx315c6407316e90fa&redirect_uri={$redirect_uri}&response_type=code&scope=snsapi_userinfo&state=STATE#wechat_redirect";
      header("location:".$url);
    }

    public function auth(){
      //接受code
      $code=request()->input('code');
      //通过code换取网页授权access_token
      $url="https://api.weixin.qq.com/sns/oauth2/access_token?appid=wx315c6407316e90fa&secret=e220a728f43129faf22f0e334d6a8998&code={$code}&grant_type=authorization_code";
      $data=Curl::curlGet($url);
      $data=json_decode($data,true);
      $openid=$data['openid'];
      $access_token=$data['access_token'];

      //非静默授权
      $url="https://api.weixin.qq.com/sns/userinfo?access_token={$access_token}&openid={$openid}&lang=zh_CN";
      $data=Curl::curlGet($url);
      $data=json_decode($data,true);
      dd($data);
    }




    
    public function testCreate(){

    $data=request()->all();
    // dd($data);
    $res=StudentModel::create($data);
    return json_encode([
        'code'=>200,
        'msg'=>"添加成功",

      ]);

}
