<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
     protected $primaryKey='users_id';
    protected $table='users';
    public $timestamps=false;

    protected $guarded = [];  
}
