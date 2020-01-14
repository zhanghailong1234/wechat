<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class FirstModel extends Model
{
    protected $pk='first_id';
    protected $table='first';
    protected $fillable=['first_id','first_type','textarea','image','mediawechat_id'];
}
