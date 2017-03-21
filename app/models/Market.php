<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

class Market extends Model
{
    protected $table='market_details_tbl';


    public function getMarket(){

        $result = DB::table('market_details_tbl')
            ->join('country_details','market_details_tbl.id','=','country_details.id')
            ->join('cuntry_city_tbl','market_details_tbl.c_id','=','cuntry_city_tbl.c_id')
            ->join('profile_tbl_sales','market_details_tbl.profile_id','=','profile_tbl_sales.id')
            ->where('market_details_tbl.profile_id','=',Auth::user()->id)
            ->get();

//        dd($result);
        return $result;

    }



    public function getAllMarket(){

        $result = DB::table('market_details_tbl')
            ->join('country_details','market_details_tbl.id','=','country_details.id')
            ->join('cuntry_city_tbl','market_details_tbl.c_id','=','cuntry_city_tbl.c_id')
            ->join('profile_tbl_sales','market_details_tbl.profile_id','=','profile_tbl_sales.id')
            ->get();

//        dd($result);
        return $result;

    }
}
