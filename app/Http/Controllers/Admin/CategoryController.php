<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
class CategoryController extends Controller
{
    public function cateAdd(){

    	$model=new CategoryModel;
    	
         $data=$model->tree();
      
    	return view('admin/cateAdd',['data'=>$data]);
    }



		public function cateCreate(Request $request){
        // $cate_name=request()->input('cate_name');
        // $data=CategoryModel::where(['cate_name'=>$cate_name])->first();
        // return json_encode(['code'=>200,'msg'=>"此分类名已存在!",'data'=>$data]);
             $request->validate([
        "cate_name"=>"required|unique:category",
       

        ],[
            "cate_name.required"=>"*姓名必填!",
            "cate_name.unique"=>"*此分类名已存在!",
           
          
          
        ]);
        $data=request()->except('_token');

        $res=CategoryModel::create($data);
        // dd($res);
        if($res){
            return redirect('admin/cateIndex');
        }
    }

    public function cateIndex(){


    	 $model=new CategoryModel;
       	 $data=$model->tree();

    	return view('admin/cateIndex',['data'=>$data]);
    }

    public function cateDelete($cate_id){

        $res=CategoryModel::where(['cate_id'=>$cate_id])->delete();
        if($res){

            return redirect('admin/cateIndex');
        }
    }

    public function cateUpdate($cate_id){
        $model=new CategoryModel;
        
         $data=$model->tree();
        $data1=CategoryModel::where(['cate_id'=>$cate_id])->first();

        return view('admin/cateUpdate',['data1'=>$data1,'data'=>$data]);
    }

    public function cateEdit(){

        $data=request()->except('_token');
        $res=CategoryModel::where(['cate_id'=>$data['cate_id']])->update($data);
        if($res){
            return redirect('admin/cateIndex');
        }
    }
}
