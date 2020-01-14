<?php

namespace App\Http\Controllers\Admin;
use App\Tools\Wechat;
use App\Tools\Curl;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MediaModel;
class MediaController extends Controller
{
    public function mediaAdd(){

    	return view('admin/mediaAdd');
    }


    public function mediaCreate(Request $request){

    	$data=$request->except('_token');
    	$media_img=request()->file('media_img');
    	if(!$request->hasFile('media_img')){
    		echo "必须上传文件!";die;
    	}
    	$ext=$media_img->getClientOriginalExtension();//获取后缀名
    	$filename=md5(uniqid()).".".$ext;//获取文件名拼接后缀名
    	$path=$media_img->storeAs('img',$filename);
    	$data['media_img']=$path;
  //   	//调用接口添加到微信
  
		$mediawechat_id=Wechat::uploadMedia($path,$data['media_format']);
		$data['mediawechat_id']=$mediawechat_id;
		//dd($data);
		
    	$res=MediaModel::create($data);
    	if($res){
    		return redirect('admin/mediaIndex');
    	}
    }


    public function mediaIndex(){
    	$search=request()->all();
    	 // var_dump($search);
    	$where=[];
    	if(!empty($search)){
	    	if($search['media_format']=='视频'){
	    		$where[]=['media_format','=',"video"];
	    	}
	    	if($search['media_format']=='图片'){
	    		$where[]=['media_format','=',"image"];
	    	}
	    	if($search['media_format']=='语音'){
	    		$where[]=['media_format','=',"voice"];
	    	}
    	}
    	$data=MediaModel::where($where)->paginate(2);
    	return view('admin/mediaIndex',['data'=>$data,'search'=>$search]);
    }
}
