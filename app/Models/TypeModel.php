<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class TypeModel extends Model
{
    protected $pk='type_id';
    protected $table='type';
    protected $fillable=['type_name'];
}
