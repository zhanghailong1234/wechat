<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ContractModel;
use App\Models\ServicetModel;
class ContractController extends Controller
{
     public function contractAdd(){

   	return view('admin/contractAdd');
   }

   public function contractCreat(){

   	$data=request()->except('_token');
   	$res=ContractModel::create($data)->toArray();
   	 $contract_id=$res['id'];
        //dd($goods_id);
       foreach($data['attr_id_list'] as $k=>$v){
        $a=GoodsAttrModel::create([
            'goods_id'=>$goods_id,
            'attr_id'=>$v,
            'attrvalue'=>$data['attr_value_list'][$k],
            'attrprice'=>$data['attr_price_list'][$k],
            ]);


       }

   }
}
