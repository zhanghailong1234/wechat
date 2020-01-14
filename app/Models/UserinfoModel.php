<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UserinfoModel extends Model
{
    protected $pk='user_id';
    protected $table='userinfo';
    protected $fillable=['user_name','user_sex','user_city','openid'];
}
