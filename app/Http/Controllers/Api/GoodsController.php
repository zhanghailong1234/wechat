<?php

namespace App\Http\Controllers\Api;
use Illuminate\Support\Facades\Cache;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GoodsModel;
use App\Models\CategoryModel;
use App\Models\GoodsAttrModel;
use App\Models\AttributeModel;
use App\Models\UsersModel;
use App\Models\ProductModel;
use App\Models\CartModel;
use App\Models\AddressModel;
class GoodsController extends Controller
{
	/**
	 * 查询分类接口
	 * @return [type] [description]
	 */
    public function getCate(){
    header("Access-Control-Allow-Origin: *");
    $data=CategoryModel::where("parent_id","=",0)->get()->toArray();
    //dd($data);
    return json_encode($data);
    }
    /**
     * 查询商品最新接口
     * @return [type] [description]
     */
    public function getNewGoods(){
     header("Access-Control-Allow-Origin: *");
    //$data=Cache::get("newgoods");
   if(empty($data)){
   	 $data=GoodsModel::orderBy("goods_id","desc")->limit(4)->get()->toArray();
   	 Cache::put("newgoods",$data);
   }
    return json_encode($data);
    }

    //首页滚动屏幕
    public function showgoods(){
    header("Access-Control-Allow-Origin: *");	
    $data=GoodsModel::limit(4)->get()->toArray();
    return json_encode($data);	
    }

    //根据cateid查询下的商品
    public function categoods(){
    header("Access-Control-Allow-Origin: *");	
    $cate_id=request()->input('cate_id');

    $data=GoodsModel::where(['cate_id'=>$cate_id])->get();
    return json_encode($data);
    }
    //根据goods_id查询其商品详情
    public function goodsinfo(){
    header("Access-Control-Allow-Origin: *");	
    $goods_id=request()->input('goods_id');
    //$goods_id=58;
    $data=GoodsModel::where(['goods_id'=>$goods_id])->first();
    $data1=GoodsAttrModel::join("attribute","attribute.attr_id","=","goodsattr.attr_id")->where(['goods_id'=>$goods_id])->get()->toArray();
    //dd($data1);
    $newarr=[];
    $newarr1=[];
        foreach($data1 as $k=>$v){
            $status=$v['attr_name'];
            if($v['is_optional']==1){
              
            $newarr[$status][]=$v;  
            }else{
              
            $newarr1[$status][]=$v;    
            }
        
        } 
        // dd($newarr1);
    return json_encode(['data'=>$data,'newarr'=>$newarr,'newarr1'=>$newarr1]);
    }


    //获取token对比的接口  添加购物车接口
    public function addCart(Request $request){
          $mid_params =  $request->input('users_token');//获取参数
          $goods_id=$request->input('goods_id');
          $buy_number=$request->input('buy_number');
          $goodsattr_id=$request->input('goodsattr_id');

          
         // dd($goodsattr_list);
          //$goodsattr_id=explode(',',$goodsattr_id);
         // dd($mid_params);
         // 获取用户id
        $data=UsersModel::where(['users_token'=>$mid_params])->first();
        //dd($data);
        $users_id=$data->users_id;
        //获取货品id
        $productinfo=ProductModel::where('attrvalue_list',$goodsattr_id)->first()->toArray();
        //dd($productinfo);
        //判断库存
        $data1=CartModel::where(["users_id"=>$users_id,"goods_id"=>$goods_id,'product_id'=>$productinfo['product_id']])->first();
        //dd($data1);
        if(!$data1){
           $res=CartModel::create([
            'users_id'=>$users_id,
            'goods_id'=>$goods_id,
            'buy_number'=>$buy_number,
            'attrvalue_list'=>$goodsattr_id,
            'product_id'=>$productinfo['product_id'],
            ]);
          
         return json_encode([
            'code'=>200,
            'msg'=>'成功加入!',
            ]);  
        }else{
           $res1=CartModel::where(['product_id'=>$data1['product_id']])->update(['buy_number'=>$data1['buy_number']+1]);
           return json_encode([
            'code'=>200,
            'msg'=>'成功加入!',
            ]);  
        }
        
    }


    //购物车列表
    public function cartList(Request $request){
        $mid_params =  $request->input('users_token');//获取参数
        $data=UsersModel::where(['users_token'=>$mid_params])->first();
        //dd($data);
        $users_id=$data->users_id;
        //dd($users_id);
        $cartinfo=CartModel::join("goods","goods.goods_id","=","cart.goods_id")->where(['users_id'=>$users_id])->get()->toArray();       
       $total=0;
        foreach($cartinfo as $k=>$v){
            $goodsattr_list=explode(",",$v['attrvalue_list']);
             
            $goodsattrinfo=GoodsAttrModel::
            join("attribute","attribute.attr_id","=","goodsattr.attr_id")
            ->whereIn("goodsattr_id",$goodsattr_list)
            ->get()->toArray();
            //dd($goodsattrinfo);
            $newgoodsattr="";
            $goodsattrprice=0;
            foreach($goodsattrinfo as $kk=>$vv){
                $newgoodsattr.=$vv['attr_name'].":".$vv['attrvalue'].",";
                $goodsattrprice+=$vv['attrprice'];
            }
            $cartinfo[$k]['newgoodsattr']=rtrim($newgoodsattr,',');
            $cartinfo[$k]['goods_price']=$v['goods_price']+$goodsattrprice;
            $total+=($v['goods_price']+$goodsattrprice);
        }
        //dd($cartinfo);
        //return json_encode(['cartinfo'=>$cartinfo,'total'=>$total]);
        return json_encode($cartinfo);
    }

    //结算
    public function cartShow(Request $request){
        $mid_params =  $request->input('users_token');//获取参数
        $data=UsersModel::where(['users_token'=>$mid_params])->first();
        //dd($data);
        $users_id=$data->users_id;
        //dd($users_id);
        
        $cart_id=request()->input('cart_id');
        $cart_id=explode(',',$cart_id);
       $cartinfo=CartModel::join("goods","goods.goods_id","=","cart.goods_id")->whereIn('cart_id',$cart_id)->get()->toArray();
        //dd($cartinfo);
        $total=0;
        foreach($cartinfo as $k=>$v){
            $goodsattr_list=explode(",",$v['attrvalue_list']);
             
            $goodsattrinfo=GoodsAttrModel::
            join("attribute","attribute.attr_id","=","goodsattr.attr_id")
            ->whereIn("goodsattr_id",$goodsattr_list)
            ->get()->toArray();
            //dd($goodsattrinfo);
            $newgoodsattr="";
            $goodsattrprice=0;

            foreach($goodsattrinfo as $kk=>$vv){
                $newgoodsattr.=$vv['attr_name'].":".$vv['attrvalue'].",";
                $goodsattrprice+=$vv['attrprice'];
            }
            $cartinfo[$k]['newgoodsattr']=rtrim($newgoodsattr,',');
            $cartinfo[$k]['goods_price']=$v['goods_price']+$goodsattrprice;
           $total+=($v['goods_price']+$goodsattrprice);
        }
         
     // dd($total);
        return json_encode(['cartinfo'=>$cartinfo,'total'=>$total]);
    }

    public function address(Request $request){
        $mid_params =  $request->input('users_token');//获取参数
        $address_name=request()->input('address_name');
        $mobile=request()->input('mobile');
        $address_city=request()->input('address_city');
        $address_building=request()->input('address_building');
        $res=AddressModel::create([
            'address_name'=>$address_name,
            'mobile'=>$mobile,
            'address_city'=>$address_city,
            'address_building'=>$address_building,
            ]);
       return json_encode([
            'code'=>200,
            'msg'=>'保存成功!',
            ]);  
    }

    public function newaddress(){

        $data=AddressModel::get()->toArray();
        return json_encode($data);
    }

    //默认地址
    public function checkaddress(Request $request){
        $mid_params =  $request->input('users_token');//获取参数
        $address_id=request()->input('address_id');
        $data=AddressModel::where(['address_id'=>$address_id])->first();
        return json_encode($data);
    }
}
