<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AttributeModel extends Model
{
    protected $pk='attr_id';
    protected $table='attribute';
    protected $fillable=['attr_name','type_id','is_optional'];
}
