<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ProductModel extends Model
{
    protected $pk='product_id';
    protected $table='product';
    protected $fillable=['goods_id','attrvalue_list','product_number'];

}
