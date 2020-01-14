<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ContractModel extends Model
{
     protected $pk='contract_id';
    protected $table='contract';
    protected $fillable=['contract_name','contract_price','contract_img'];
}

