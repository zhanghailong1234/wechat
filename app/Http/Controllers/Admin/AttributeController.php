<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeModel;
use App\Models\AttributeModel;
class AttributeController extends Controller
{
    public function attrAdd(){

    	$data=TypeModel::get();
    	return view('admin/attrAdd',['data'=>$data]);
    }


    public function attrCreate(){

    	$data=request()->except('_token');
    	$res=AttributeModel::create($data);
    	if($res){
    		return redirect('admin/attrIndex');
    	}
    }


    public function attrIndex(){
        $search=request()->all();
         $type_id=request()->input('type_id');
         
        $typeinfo=TypeModel::where(['type_id'=>$type_id])->first();
        $type_name=$typeinfo['type_name'];
       $where=[];
       if(!empty($type_name)){
        $where[]=["type_name","like","%$type_name%"];
       }
        $list=TypeModel::get();


    	$data=AttributeModel::join('type', 'type.type_id','=','attribute.type_id')->where($where)->paginate(2);

    	return view('admin/attrIndex',['data'=>$data,'list'=>$list,'search'=>$search]);
    }


    public function attrShow($type_id){

        $data=AttributeModel::where(['type_id'=>$type_id])->get();
         $type=[];
       foreach ($data as $k =>$v){
           $type[]=$v['type_id'];
       }
       
        $str=AttributeModel::where(['type_id'=>$type_id])->get()->toArray();
        $sum=count($str);
        //dd($sum);
        $res=TypeModel::where(['type_id'=>$type_id])->update(['attr_number'=>$sum]);
       //dd($res);
        return view('admin/attrShow',['data'=>$data]);
    }

    public function attrDelete($attr_id){
        $res=AttributeModel::where(['attr_id'=>$attr_id])->delete();

        if($res){
            return redirect('admin/attrIndex');
        }

    }


    public function attrUpdate($attr_id){
        $data=TypeModel::get();
        $data1=AttributeModel::where(['attr_id'=>$attr_id])->first();
        return view('admin/attrUpdate',['data1'=>$data1,'data'=>$data]);
    }

    public function attrEdit(){

        $data=request()->except('_token');
        
        $res=AttributeModel::where(['attr_id'=>$data['attr_id']])->update($data);
        if($res){
            return redirect('admin/attrIndex');
        }
    }


    public function attrDele(){

      $attr_id=request()->input('attr_id');
      // dd($attr_id);
      $attr_id=explode(',',$attr_id);

      // dd($attr_id);
      $model=new AttributeModel;
      $res=$model->whereIn('attr_id',$attr_id)->delete();
      if($res){
         return redirect('admin/attrIndex');
      }
    }
}
