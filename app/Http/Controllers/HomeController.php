<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Crypt;

use App\models\Home;

use App\models\Profile;

use Config;

use Hash;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');


    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        
        $home = new Home();
//
        $total['market'] = $home->getMarketTotal();
        $total['agent'] = $home->getAgentTotal();
        $total['query'] = $home->getQueryTotal();
        $total['target'] = $home->getTarget();
        $total['query_year'] = $home->getQueriesYear();
        $total['query_month'] = $home->getQueriesMonth();
        $total['query_today'] = $home->getQueriesToday();
        $total['confirm_today'] = $home->getConfirmationToday();
        $total['confirm_month'] = $home->getConfirmationMonth();
        $total['confirm_year'] = $home->getConfirmationYear();
        $total['call_today'] = $home->getCallToday();
        $total['call_month'] = $home->getCallMonth();
        $total['call_year'] = $home->getCallYear();
        $total['visit_today'] = $home->getVisitToday();
        $total['visit_month'] = $home->getVisitMonth();
        $total['visit_year'] = $home->getVisitYear();
        $total['agent_today'] = $home->getAgentToday();
        $total['agent_month'] = $home->getAgentMonth();
        $total['agent_year'] = $home->getAgentYear();
        

        return view('index')->with('total',$total);



    }

//    public function hash(){
//
//        $users = DB::table('profile_tbl_sales')->get();
//
//        foreach ($users as $user) {
//
//
//            $p =  $user->password;
//            $id = $user->id;
//            $password = Hash::make($p);
//
//            DB::table('profile_tbl_sales')->where('id',$id) ->update(['password' =>$password]);
//
//
//        }
//
//    }


}
