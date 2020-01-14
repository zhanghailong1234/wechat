<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaModel extends Model
{
    protected $pk='media_id';
    protected $table='media';
    protected $fillable=['media_name','media_format','media_type','media_img','mediawechat_id'];
}
