<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class RoleModel extends Model
{
    protected $pk='role_id';
    protected $table='role';
    protected $fillable=['role_name'];
}
