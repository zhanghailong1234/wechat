<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class IndexController extends Controller
{
   public function index(){
   	//查询用户菜单
   	$userinfo=session('user');
   	$user_id=$userinfo['user_id'];
   	$sql="select * from power where power_id in(select power_id from rolePower where role_id in(select role_id from userRole where user_id=$user_id))";
    //dd($sql);
   	$powerdata=\DB::select($sql);
   	$powerdata=json_encode($powerdata);
   	$powerdata=json_decode($powerdata,true);
   	$powerdata=$this->createTreeBySon($powerdata);
   	
   	return view('admin/index',['powerdata'=>$powerdata]);
   }




       /**
     * 顺序展示 菜单数据
     * @return [type] [description]
     */
    public function createTree($data,$parent_id=0,$level=0)
    {
        //定义一个容器
        static $new_arr = [];
        //循环比对
        foreach ($data as $key => $value) {
            //判断 
            if($value['parent_id'] == $parent_id){
                //找到了
                $value['level'] = $level;
                $new_arr[] = $value;
                //找子分类 
                $this->createTree($data,$value['power_id'],$level+1);
            }
        }
        return $new_arr;
    }


    /**
     * 递归排序 把二级分类放到 1级 son字段里
     * @param  [type]  $data      [description]
     * @param  integer $parent_id [description]
     * @return [type]             [description]
     */
    public function createTreeBySon($data,$parent_id=0)
    {   
        //定义一个容器
        $new_arr = [];
        //循环比对
        foreach ($data as $key => $value) {
            //判断 
            if($value['parent_id'] == $parent_id){
                //找到了
                $new_arr[$key] = $value;
                //找子分类 
                $new_arr[$key]['son'] = $this->createTreeBySon($data,$value['power_id']);
            }
        }
        return $new_arr;
    } 
}
