<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Profile extends Model
{
    protected $table = 'profile_tbl_sales';

    protected $guarded = ['id'];

    public $timestamps = false;
    
    
    public function performaces()
    {
        return $this->hasMany('App\models\Performance','profile_id');
    }

    public function getCountry(){

        $result = DB::table('country_details')->get();

        return $result;

    }

    public function getCity(){

        $result = DB::table('cuntry_city_tbl')->get();

        return $result;

    }

    public function getManagerUsers($manager){

        $users = DB::table('profile_tbl_sales')
            ->join('department','profile_tbl_sales.department','department.dep_id')
            ->where('department.manager',$manager)
            ->select('profile_tbl_sales.*')
            ->get();

        return $users;

    }


    public function getSelfUsers($manager){

        $users = DB::table('profile_tbl_sales')
            ->join('department','profile_tbl_sales.department','department.dep_id')
            ->where('department.manager',$manager)
            ->get();

        return $users;

    }
	
}
