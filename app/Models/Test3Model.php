<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Test3Model extends Model
{
    protected $pk='id';
    protected $table='test';
    protected $fillable=['name','age'];
}
