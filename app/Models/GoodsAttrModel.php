<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class GoodsAttrModel extends Model
{
     protected $pk='goodsattr_id';
    protected $table='goodsattr';
    protected $fillable=['goods_id','attr_id','attrvalue','attrprice'];
}
