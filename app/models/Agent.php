<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Pagination\Paginator;

class Agent extends Model
{
    protected $table = 'agent_detials_tbl';

    public $timestamps = false;

    protected $guarded = ['agent_id'];


}
