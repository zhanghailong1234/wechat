<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class CartModel extends Model
{
    protected $primaryKey='cart_id';
    protected $table='cart';
    public $timestamps=false;

    protected $guarded = [];  
}
