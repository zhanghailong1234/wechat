<?php

namespace App\Http\Controllers\Admin;
use App\Tools\Wechat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FirstModel;
use App\Models\MediaModel;
class FirstController extends Controller
{
    public function firstAdd(){

    	return view('admin/firstAdd');
    }

    public function firstCreate(Request $request){

        $data=request()->except("_token");
       // dd($data);
        if(!empty($data['media'])){
            $data['mediawechat_id']=$data['media_id'];
            $res=FirstModel::create($data);
        }
        if($image=request()->file('image')){
        	if(!$request->hasFile('image')){
        		echo "必须上传文件!";die;
        	}
        	$ext=$image->getClientOriginalExtension();//获取后缀名
        	$filename=md5(uniqid()).".".$ext;//获取文件名拼接后缀名
        	$path=$image->storeAs('img',$filename);
        	$data['image']=$path;
        	//调用接口添加到微信

        	$mediawechat_id=Wechat::uploadMedia($path,$data['first_type']);

        	$data['mediawechat_id']=$mediawechat_id;
        } 
        	
    		//dd($data);
        $res=FirstModel::create($data);
        if($res){
            return redirect('admin/firstIndex');
        }
    }


    public function firstIndex(){

    	$data=FirstModel::paginate(2);
    	return view('admin/firstIndex',['data'=>$data]);
    }

    public function getMedia(){

    	$mediaData=MediaModel::where(["media_format"=>"image"])->get()->toArray();

    	//dd($mediaData);
    	return json_encode($mediaData);
    }
}
