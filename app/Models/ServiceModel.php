<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class ServiceModel extends Model
{
    protected $pk='service_id';
    protected $table='service';
    protected $fillable=['type_id','service_desc','service_price','contract_id'];
}
