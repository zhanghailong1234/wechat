<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuModel extends Model
{
    protected $pk='menu_id';
    protected $table='menu';
    protected $fillable=['menu_name','menu_type','menu_status','parent_id'];
}
