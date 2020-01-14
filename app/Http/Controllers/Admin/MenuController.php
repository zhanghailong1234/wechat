<?php

namespace App\Http\Controllers\Admin;
use App\Tools\Wechat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MenuModel;
use App\Tools\Curl;
class MenuController extends Controller
{
    public function menuAdd(){

        $data=MenuModel::where(['parent_id'=>0])->get()->toArray();
    	return view('admin/menuAdd',['data'=>$data]);
    }

    public function menuCreate(Request $request){
	$data=request()->except('_token');
	$request->validate([
        "menu_name"=>"required|unique:menu|alpha_dash|between:1,5",
       
       
        ],[
            "menu_name.required"=>"*菜单名称必填!",
            "menu_name.unique"=>"*此菜单名称已存在!",
            "menu_name.alpha_dash"=>"*姓名必须为中文 字母 数字 下划线 1-5位!",
            "menu_name.between"=>"*姓名必须为中文 字母 数字 下划线 1-5位!",
            
            

        ]);
	$res=MenuModel::create($data);
	if($res){
		return redirect('admin/menuIndex');
	}
    }

    public function menuIndex(){

    	$data=MenuModel::paginate(2);
    	return view('admin/menuIndex',['data'=>$data]);
    }
    //一键同步微信
    public function menuWechat(){
    	
    	$access_token=Wechat::getToken();
    	$url="https://api.weixin.qq.com/cgi-bin/menu/create?access_token={$access_token}";
    	//从数据库库数据
    	$menuData=MenuModel::where(['parent_id'=>0])->get()->toArray();
        //dd($menuData);
    	$postData=[];
    	//建立类型关键字
    	$typeArr=['click'=>"key",'view'=>"url"];
    	foreach ($menuData as $key => $value) {
    		
    		if($value['menu_status']){
                $postData['button'][]=[
            'type'=>$value['menu_type'],
            'name'=>$value['menu_name'],
            $typeArr[$value['menu_type']]=>$value['menu_status']
            ];
        }else{
            $postData['button'][$key]=[
            'name'=>$value['menu_name'],
            'sub_button'=>[],
            ];
            //根据一级菜单的自增id 查询该一级菜单下的二级菜单
            $childData=MenuModel::where(['parent_id'=>$value['menu_id']])->get()->toArray();
            foreach($childData as $k=>$v){
                $postData['button'][$key]['sub_button'][]=[
                'type'=>$v['menu_type'],
                'name'=>$v['menu_name'],
                $typeArr[$v['menu_type']]=>$v['menu_status']
                ];
            }
        }
    	}
    	//转成json格式
    	$postData=json_encode($postData,JSON_UNESCAPED_UNICODE);
    	$res=Curl::curlPost($url,$postData);
    	var_dump($res);die;
    }
}
