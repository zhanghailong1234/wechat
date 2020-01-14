<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Test3Model;
class Test3Controller extends Controller
{
    public function create(){

    	$data=request()->all();
     //dd($data);
     $newstr=sha1("8888".$data['name'].$data['age']);
     if(empty($data['name'])||empty($data['age'])){
     	return json_encode([
        'code'=>201,
        'msg'=>"参数不能为空",

      ]);
     }

     if($newstr!=$data['sign']){

     	return json_encode([
        'code'=>201,
        'msg'=>"签名不对",

      ]);
     }

     // $info=Test3Model::where(['name'=>$info['name']])->first();
     // dd($info);
     // if($info){
     // 	return json_encode([
     //    'code'=>201,
     //    'msg'=>"此姓名已经错在",

     //  ]);
     // }
    $res=Test3Model::create($data);
    if($res){
    	return json_encode([
        'code'=>200,
        'msg'=>"添加成功",

      ]);
    }
    }
}
