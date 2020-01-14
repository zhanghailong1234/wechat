<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChannelModel extends Model
{
    protected $pk='channel_id';
    protected $table='channel';
    protected $fillable=['channel_name','channel_status','ticket','people'];
}
