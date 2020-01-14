<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginModel;
use App\Tools\Wechat;
use App\Tools\Curl;

class LoginController extends Controller
{/**
 * 登录页面
 */
    public function login(){
    	return view('admin/login');

    }

    //发送验证码
    public function send(){

        $user_name=request()->input('user_name');
        $user_pwd=request()->input('user_pwd');
        $user_pwd=md5($user_pwd);
        
        $userInfo=LoginModel::where(['user_name'=>$user_name,'user_pwd'=>$user_pwd])->first();
        //dd($userInfo);
        if(!$userInfo){
            echo "账号或密码不对!";
        }
        $openid=$userInfo['openid'];

        //生成验证码
        $code=rand(1000,9999);

        session(['code'=>$code]);


        //调用模板消息接口
        $access_token=Wechat::getToken();
        $url="https://api.weixin.qq.com/cgi-bin/message/template/send?access_token={$access_token}";
        $postData=[
        "touser"=>$openid,
           "template_id"=>"tOEBqKAE7Su0P6sTS6DmWue82RXwnRSBbrLSHnip8hQ",
           "data"=>[
           "name"=>[
           'value'=>$user_name,
           'color'=>"#173177",
           ],
            "code"=>[
           'value'=>$code,
           'color'=>"#173177",
           ],
           ],
        ];

   $postData=json_encode($postData,JSON_UNESCAPED_UNICODE);
   //dd($postData);
        $res=Curl::curlPost($url,$postData);
        //dd($res);
    }

    //执行登录
    public function loginDo(){

    	$data=request()->except('_token','code');

        $data['user_pwd']=md5($data['user_pwd']);
        $code=request()->input('code');
        
        if($code!=session('code')){
            echo "<script>alert('验证码错误!');location='/admin/login'</script>";
        }

    	
        //dd($data);
    	$res=LoginModel::where($data)->first();
        //dd($res);
    	if($res){
    		session(['user'=>$res]);
    		 echo "<script>alert('登陆成功!');location='/admin/index'</script>";
    	}else{
    		echo "<script>alert('账号或密码错误!');location='/admin/login'</script>";
    	}

    }

    public function loginBind(){
      
    $openid=Wechat::getOpenid();
    //dd($openid);
      return view('admin/loginBind');
    }

    public function loginBindDo(){
      $openid=Wechat::getOpenid();
      //dd($openid);
      //修改
      $user_name=request()->input('user_name');
      $user_pwd=request()->input('user_pwd');
      $user_pwd=md5($user_pwd);
      //检测用户密码是否正确
      $userInfo=LoginModel::where(['user_name'=>$user_name,'user_pwd'=>$user_pwd])->first()->toArray();
      //dd($userInfo);
      if(!$userInfo){
        echo "<script>alert('账号或密码错误!');location='/admin/loginBind'</script>";die;
      }
     $userInfo['openid']=$openid;
    //dd($userInfo);
    $res=LoginModel::where('user_id',$userInfo['user_id'])->update($userInfo);
    //dd($res);
    if($res){
      echo "<script>alert('绑定成功!');location='/admin/login'</script>";die;
    }
    
    }


    
}
