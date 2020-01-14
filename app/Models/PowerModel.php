<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class PowerModel extends Model
{
    protected $pk='power_id';
    protected $table='power';
    protected $fillable=['power_name','parent_id','url'];

    function tree(){
        $data = PowerModel::get();
        $data = self::getcateinfo($data);
        return $data;
    }

	 function getcateinfo($cateinfo,$parent_id=0,$level=0){
		static $info=[];//定义静态变量 只占用一个空间
		foreach($cateinfo as $k=>$v){
			if($v['parent_id']==$parent_id){
				$v['level']=$level;
				$info[]=$v;
				self::getcateinfo($cateinfo,$v->power_id,$level+1);
			}
		}
		return $info;


	}
}
