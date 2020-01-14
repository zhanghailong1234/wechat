<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryModel;
use App\Models\TypeModel;
use App\Models\AttributeModel;
use App\Models\GoodsModel;
use App\Models\GoodsAttrModel;
use App\Models\ProductModel;
class GoodsController extends Controller
{
    public function goodsAdd(){
    	$model=new CategoryModel;
    	
         $data=$model->tree();

		$typedata=TypeModel::get();
    	return view('admin/goodsAdd',['data'=>$data,'typedata'=>$typedata]);
    }


    public function getattr(){

    	$type_id=request()->input("type_id");
    	//dd($type_id);
    	$attrdata=AttributeModel::where(['type_id'=>$type_id])->get()->toArray();
    	//dd($attrdata);
    	return json_encode($attrdata);
    }



    public function goodsCreate(Request $request){
       
    	$data=request()->input();
        // dd($data);
        $goods_img=request()->file('goods_img');
        if(!$request->hasFile('goods_img')){
            echo "必须上传文件!";die;
        }
        $ext=$goods_img->getClientOriginalExtension();//获取后缀名
        $filename=md5(uniqid()).".".$ext;//获取文件名拼接后缀名
        $path=$goods_img->storeAs('img',$filename);
        $data['goods_img']=$path;

          if (empty($_data['goods_letmnumber']))
    {
        $id  = GoodsModel::select('goods_id')->orderBy('goods_id','desc')->first()['goods_id']+1;
        $data['goods_letmnumber']='EC'.str_repeat('0',6-strlen($id)).$id;
    }
    


     
        //dd($data);
    	$res=GoodsModel::create($data)->toArray();

        
        //dd($res);
        $goods_id=$res['id'];
        //dd($goods_id);
       foreach($data['attr_id_list'] as $k=>$v){
        $a=GoodsAttrModel::create([
            'goods_id'=>$goods_id,
            'attr_id'=>$v,
            'attrvalue'=>$data['attr_value_list'][$k],
            'attrprice'=>$data['attr_price_list'][$k],
            ]);


       }

       //跳转到货品添加
       return redirect('admin/goodsProduct'."/".$goods_id);
    }


//货品添加
    public function goodsProduct($goods_id){
        $goodsdata=GoodsModel::where(['goods_id'=>$goods_id])->first()->toArray();

        $goodsattrdata=GoodsAttrModel::join("attribute","goodsattr.attr_id","=","attribute.attr_id")->where(['goods_id'=>$goods_id])->get()->toArray();
        $newarr=[];
        foreach($goodsattrdata as $k=>$v){

        $status=$v['attr_name'];
        $newarr[$status][]=$v;
        } 

        return view('admin/goodsProduct',['newarr'=>$newarr,'goodsdata'=>$goodsdata,'goods_id'=>$goods_id]);
    }


    public function goodsProductDo(){

        $data=request()->except('_token');
        $size=count($data['goodsattr_id'])/count($data['product_number']);
        $attr_value_list=array_chunk($data['goodsattr_id'],$size);
        foreach($attr_value_list as $k=>$v){
           ProductModel::create([
           'goods_id'=>$data['goods_id'],
           'attrvalue_list'=>implode(",",$v),
           'product_number'=>$data['product_number'][$k],
           ]); 

        }
        return redirect('admin/goodsIndex');

    }


    public function goodsIndex(){
        $search=request()->all();
        $cate_id=request()->input('cate_id');
        $goods_name=request()->input('goods_name');
        //$is_up=request()->input('is_up');

        $cateinfo=CategoryModel::where(['cate_id'=>$cate_id])->first();
        $cate_name=$cateinfo['cate_name'];
       $where=[];
       if(!empty($cate_name)){
        $where[]=["cate_name","like","%$cate_name%"];
       }
       if(!empty($goods_name)){
        $where[]=["goods_name","like","%$goods_name%"];
       }


        $model=new CategoryModel;
        
         $data1=$model->tree();
        $data=GoodsModel::join("category","category.cate_id","=","goods.cate_id")->where($where)->paginate(2);
        // dd($data);
        return view('admin/goodsIndex',['data'=>$data,'data1'=>$data1,'search'=>$search]);
    }


    //即点即改
    public function mychange(){
    $value=request()->input('value');

    $field=request()->input('field');
    $goods_id=request()->input('goods_id');
    // dd($goods_id);
    // var_dump($filed);

    $where=[
    ['goods_id','=',$goods_id]
    ];
    $date=[$field=>$value];
    
    $res=GoodsModel::where($where)->update($date);
    
    if($res){
        echo '1';
    }else{
        echo '2';
    }
  }


  // 单选按钮即点即改
   public function changevalue(){
    $value=request()->input('value');
    $field=request()->input('field');
    $goods_id=request()->input('goods_id');
    
    //条件
    $where=[
    ['goods_id','=',$goods_id]
    ];
    //修改的数组
    $date=[$field=>$value];

    
    $res=GoodsModel::where($where)->update($date);
    if($res){
      echo '1';
    }else{
      echo '2';
    }
   }  
}
