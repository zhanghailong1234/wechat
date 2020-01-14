<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LoginModel extends Model
{
    protected $pk='user_id';
    protected $table='user';
    protected $fillable=['user_name','user_pwd','is_super','openid','created_at','updated_at'];


     
}
