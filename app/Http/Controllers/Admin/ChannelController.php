<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ChannelModel;
use App\Tools\Curl;
use App\Tools\Wechat;
class ChannelController extends Controller
{
    public function channelAdd(){

    	return view('admin/channelAdd');
    }

    public function channelCreate(Request $request){

    	$data=$request->except('_token');

    	if(empty($data['channel_name'])||empty($data['channel_status'])){
    		echo "渠道名称和渠道标识必填";die;
    	}

    	$access_token=Wechat::getToken();
		$url="https://api.weixin.qq.com/cgi-bin/qrcode/create?access_token={$access_token}";
		$postData='{"expire_seconds": 604800, "action_name": "QR_STR_SCENE", "action_info": {"scene": {"scene_str": "'.$data['channel_status'].'"}}}';
		$res=Curl::curlPost($url,$postData);
		$res=json_decode($res,true);
		$ticket=$res['ticket'];
		$data['ticket']=$ticket;
		$data['people']=0;
		//dd($data);
		$res=ChannelModel::create($data);
		
		if($res){
			return redirect('admin/channelIndex');
		}


    }

    public function channelIndex(){

    	$data=ChannelModel::paginate(2);

    	$nameStr="";
    	$numStr="";
    	foreach($data as $k=>$value){
    		$nameStr.='"'.$value['channel_name'].'",';
    		$numStr.=$value['people'].',';
    	}
    	$nameStr=rtrim($nameStr,",");
    	$numStr=rtrim($numStr,",");

    	return view('admin/channelIndex',['data'=>$data,'nameStr'=>$nameStr,'numStr'=>$numStr]);
    }
}
