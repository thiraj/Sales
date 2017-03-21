<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    protected $table='performance_tbl';

    public $guarded = ['prfm_id'];

    public $timestamps= false;
    
}
