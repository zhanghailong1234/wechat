<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WechatUserModel extends Model
{
    protected $pk='wechatUser_id';
    protected $table='wechatUser';
    protected $fillable=['openid','nickname','sex','city','channel_status'];
}
