<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TypeModel;
use App\Models\AttributeModel;

class TypeController extends Controller
{
    public function typeAdd(){


    	return view('admin/typeAdd');
    }


    public function typeCreate(){
        
    	$data=request()->except('_token');

        // $count=AttributeModel::where(['type_id'=>$data['type_id']])->count();   
        //  dd($count);
        
    	$res=TypeModel::create($data);
        
    	if($res){
    		return redirect('admin/typeIndex');
    	}
    }

    public function typeIndex(){

    	$data=TypeModel::paginate(2);
        
    	return view('admin/typeIndex',['data'=>$data]);
    }

   public function typeDelete($type_id){
    $res=TypeModel::where(['type_id'=>$type_id])->delete();
    if($res){

        return redirect('admin/typeIndex');
    }

   }

   public function typeUpdate($type_id){

    $data=TypeModel::where(['type_id'=>$type_id])->first();
    return view('admin/typeUpdate',['data'=>$data]);
   }

   public function typeEdit(){

    $data=request()->except('_token');
    $res=TypeModel::where(['type_id'=>$data['type_id']])->update($data);
    if($res){

        return redirect('admin/typeIndex');
    }
   }
}
