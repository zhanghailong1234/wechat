<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\UsersModel;
class UsersLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        $users_token=request()->input('users_token');
        if(!$users_token){
            echo json_encode([
            'code'=>202,
            'msg'=>'token为空!',
            ]);die;
        }
        $data=UsersModel::where(["users_token"=>$users_token])->first();
        if(!$data){
            echo json_encode([
            'code'=>203,
            'msg'=>'token不对!',
            ]);die;
        }
        if(time()>$data['expire_time']){
            echo json_encode([
            'code'=>204,
            'msg'=>'token时间过期!',
            ]);die;
        }
        $data->expire_time=time()+7200;
        $data->save();
       
        $mid_params = ['mid_params'=>'this is mid_params'];
        $request->attributes->add($mid_params);//添加参数件产生的参数
        return $next($request);
    }
}
