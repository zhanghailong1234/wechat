<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\LoginModel;
use App\Tools\Curl;
use App\Models\RoleModel;
use App\Models\PowerModel;
use App\Models\AdminRoleModel;
use App\Models\RolePowerModel;
class AdminController extends Controller
{
    public function adminAdd(){

    	return view('admin/adminAdd');
    }
    /**
     * 天气预报展示
     */
    public function weather(){


        return view('admin/weather');
    }

    /**
     * 查询天气
     */
    public function getWeather(){
        $city=request()->input('city');

        
        $weatherData=Cache::get("weatherData_".$city);
        if(empty($weatherData)){
           $url="http://api.k780.com:88/?app=weather.future&weaid=".$city."&&appkey=10003&sign=b59bc3ef6191eb9f747dd4e83c99f2a4&format=json";
        $weatherData=Curl::curlGet($url);
        $weatherData=json_decode($weatherData,true); 
        $time24=strtotime(date("Y-m-d"))+86400;
        $second=$time24-time();
        Cache::put("weatherData_".$city,$weatherData,$second);
        }
        
        return $weatherData;
    }

    public function adminCreate(){

    	$data=request()->except('_token');
    	$data['user_pwd']=md5($data['user_pwd']);
    	// dd($data);
    	$res =LoginModel::create($data);
    	// dd($res);
    	if($res){
    		 echo "<script>alert('注册成功!');location='/admin/adminIndex'</script>";
    	}else{
    		 echo "<script>alert('注册失败!');location='/admin/adminAdd'</script>";
    	}
    }


    public function adminIndex(){

    	$data=LoginModel::paginate(2);
    	return view('admin/adminIndex',['data'=>$data]);
    }

    //角色视图role
    public function roleAdd(){

        return view('admin/roleAdd');
    }
    //角色添加
    public function roleCreate(){

        $data=request()->except('_token');
        $res=RoleModel::create($data);
        if($res){
            return redirect('admin/roleIndex');
        }

    }

    //角色展示
    public function roleIndex(){
        $data=RoleModel::get();
        return view('admin/roleIndex',['data'=>$data]);
    }

    //权限视图
    public function powerAdd(){
        $model=new PowerModel;
        $data=$model->tree();
        // $data=PowerModel::get()->toArray();
        // $data=$this->createTree($data);
        return view('admin/powerAdd',['data'=>$data]);
    }

    //权限添加
    public function powerCreate(){

        $data=request()->except('_token');

        $res=PowerModel::create($data);

        if($res){
            return redirect('admin/powerIndex');
        }
    }

    public function powerIndex(){

        //$data=PowerModel::get();
         $model=new PowerModel;
        $data=$model->tree();
        return view('admin/powerIndex',['data'=>$data]);
    }


    public function selectRole($user_id){
        
        
        $userData=LoginModel::where(['user_id'=>$user_id])->first()->toArray();
        $roleData=RoleModel::get()->toArray();
        return view('admin/selectRole',['userData'=>$userData,'roleData'=>$roleData]);
    }

    public function seleRole(){
        if(request()->isMethod('post')){
            $postData=request()->input();
            //dd($postData);
             AdminRoleModel::where(['user_id'=>$postData['user_id']])->delete();
            //入库用户角色关系
            foreach($postData['role_id'] as $k=>$v){
                $res=AdminRoleModel::create([

                    'user_id'=>$postData['user_id'],
                    'role_id'=>$v,
                    ]);

            }
            if($res){
                   echo "<script>alert('分配成功!');location='/admin/adminIndex'</script>";
                }
        }
    }
//页面渲染
    public function selectPower($role_id){
        //获取角色表数据
        $roledata=RoleModel::where(['role_id'=>$role_id])->first()->toArray();
        //dd($roledata);
        //获取权限数据
        
        $powerdata=PowerModel::get()->toArray();
        $powerdata=$this->createTreeBySon( $powerdata);
        //dd($powerdata);
        //获取当前角色对应权限有哪些
        $rolepowerdata=RolePowerModel::where(['role_id'=>$role_id])->get()->toArray();
        $rolepowerdata=array_column($rolepowerdata,"power_id");
        //dd($rolepowerdata);
        return view("admin/selectPower",['roledata'=>$roledata,'powerdata'=>$powerdata,'rolepowerdata'=>$rolepowerdata]);
       
    }


    public function selePower(){
        if(request()->isMethod('post')){
            $postData=request()->input();
            //dd($postData);
            //先删除关系表中所有数据 重新录入关系
            $a=RolePowerModel::where(['role_id'=>$postData['role_id']])->delete();

            //入库用户角色关系
            foreach($postData['power_id'] as $k=>$v){
                $res=RolePowerModel::create([

                    'role_id'=>$postData['role_id'],
                    'power_id'=>$v,
                    ]);

            }
            if($res){
                   echo "<script>alert('分配成功!');location='/admin/roleIndex'</script>";
                }
        }

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
