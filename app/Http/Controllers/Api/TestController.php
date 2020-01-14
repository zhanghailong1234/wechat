<?php

namespace App\Http\Controllers\Api;
use App\Models\StudentModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestController extends Controller
{
	//添加
     public function testCreate(){

    // $data=request()->all();
    // // dd($data);
    // $res=StudentModel::create($data);
    // return json_encode([
    //     'code'=>200,
    //     'msg'=>"添加成功",

    //   ]);

}
//展示
public function testIndex(){
	// $name=request()->input('name');
	
	// $where=[];
	// if(!empty($name)){
	// 	$where[]=['name',"like","%$name%"];
	// }
	// $data=StudentModel::where($where)->paginate(2);

	// return json_encode(['code'=>200,'msg'=>"查询成功",'data'=>$data]);
}


//修改查询
public function testFind(){
// 	$id=request()->input('id');

// 	if(empty($id)){
// 		return json_encode(['code'=>201,'msg'=>"id不能为空"]);
// 	}
// 	$data=StudentModel::where(['id'=>$id])->first();

// 	return json_encode(['code'=>200,'msg'=>"查询成功",'data'=>$data]);
// }

// public function testUpdate(){

// 	return view('api/testUpdate');
}


//执行修改
 public function testEdit(){
 	
    // $data=request()->all();
    
    // $res=StudentModel::where(['id'=>$data['id']])->update($data);
    
    // return json_encode([
    //     'code'=>200,
    //     'msg'=>"修改成功",

    //   ]);

}

//删除
public function delete(){

	// $id=request()->input('id');
	// StudentModel::where(['id'=>$id])->delete();
	// return json_encode([
	// 	'code'=>200,
	// 	'msg'=>"删除成功",
	// 	]);
	// return json_encode([
	// 	'code'=>201,
	// 	'msg'=>"删除失败",
	// 	]);
}
}
