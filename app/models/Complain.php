<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Complain extends Model
{
    protected $table = 'complains';
    public $timestamps = false;

    public function getComplain(){

        $result = DB::table('complains')
            ->join('agent_detials_tbl','complains.agent_id','=','agent_detials_tbl.agent_id')
            ->get();

        return $result;

    }
}
