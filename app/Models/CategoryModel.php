<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
     protected $pk='cate_id';
    protected $table='category';
    protected $fillable=['cate_name','cate_show','cate_nav_show','parent_id'];

 	  function tree(){
        $data = CategoryModel::get();
        $data = self::getcateinfo($data);
        return $data;
    }

	 function getcateinfo($cateinfo,$parent_id=0,$level=0){
		static $info=[];//定义静态变量 只占用一个空间
		foreach($cateinfo as $k=>$v){
			if($v['parent_id']==$parent_id){
				$v['level']=$level;
				$info[]=$v;
				self::getcateinfo($cateinfo,$v->cate_id,$level+1);
			}
		}
		return $info;


	}
}
