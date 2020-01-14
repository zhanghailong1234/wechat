<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    protected $pk='id';
    protected $table='student';
    protected $fillable=['name','age'];
}
