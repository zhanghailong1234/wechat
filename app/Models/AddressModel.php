<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class AddressModel extends Model
{
		protected $primaryKey='address_id';
	    protected $table='address';
	    protected $guarded=[];
	   	public $timestamps=false;
}
