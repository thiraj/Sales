<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


class Home extends Model
{


	public function getQueryTotal(){
		
		$total_query = DB::table('performance_tbl')->where('profile_id','=', Auth::user()->id)->count('prfm_id');
		
		return $total_query;
		
		
	}
	
	
	
	public function getAgentTotal(){
		
		$total_agent = DB::table('agent_detials_tbl')->where('profile_id','=',Auth::user()->id)->count('agent_id');
		
		return $total_agent;
		

	}
	
	
	public function getMarketTotal(){
		
		$total_market = DB::table('market_details_tbl')
			->join('country_details', 'market_details_tbl.id', '=', 'country_details.id')
			->join('cuntry_city_tbl', 'market_details_tbl.c_id', '=', 'cuntry_city_tbl.c_id')
			
			->where('market_details_tbl.profile_id','=',Auth::user()->id)->count('market_id');
		
		return $total_market;
		
		
	}
	
	
	
	public function getTarget(){
		
		return DB::table('profile_tbl_sales')->where('id','=',Auth::user()->id)->pluck('monthly_target');
		
		
	}
	
	
	public function getQueriesMonth(){
        
         $start = date('Y-m-1',time());
         $end = date('Y-m-31',time());

		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','queries')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_qurs');
		
		
	}
	
	
	
	public function getQueriesToday(){
		
		$today = date('d-m-Y',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','queries')
            ->where('updtd_date', '=', date('Y-m-d',time()))
            ->sum('no_qurs');
		
		
	}
	
	
    
    
	public function getQueriesYear(){
        
        $start = date('Y-1-1',time());
         $end = date('Y-12-31',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','queries')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_qurs');
		
		
	}
    
    
    
    public function getConfirmationMonth(){
        
         $start = date('Y-m-1',time());
         $end = date('Y-m-31',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Confirmation')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_cnfrm');
		
		
	}
	
	
	
	public function getConfirmationToday(){
		
		$today = date('d-m-Y',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Confirmation')
            ->where('updtd_date', '=', date('Y-m-d',time()))
            ->sum('no_cnfrm');
		
		
	}
    
    
    public function getConfirmationYear(){
        
         $start = date('Y-1-1',time());
         $end = date('Y-12-31',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Confirmation')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_cnfrm');
		
		
	}
    
    
    
     public function getCallMonth(){
         
         $start = date('Y-m-1',time());
         $end = date('Y-m-31',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Calls')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_calls');
         
		
		
	}
	
	
	
	public function getCallToday(){
		
		$today = date('Y-m-d',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Calls')
            ->whereRaw("STR_TO_DATE(timestamp, '%Y-%m-%d') = STR_TO_DATE('".$today."', '%Y-%m-%d')")
            ->sum('no_calls');
		
		
	}
    
    
    public function getCallYear(){
                 
         $start = date('Y-1-1',time());
         $end = date('Y-12-31',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Calls')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_calls');
				
	}
    
    
    
    public function getVisitMonth(){
         
         $start = date('Y-m-1',time());
         $end = date('Y-m-31',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Visit')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_visit');
         
		
		
	}
	
	
	
	public function getVisitToday(){
		
		$today = date('d-m-Y',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Visit')
            ->where('updtd_date', '=', date('Y-m-d',time()))
            ->sum('no_visit');
		
		
	}
    
    
    public function getVisitYear(){
                 
         $start = date('Y-1-1',time());
         $end = date('Y-12-31',time());
		
		return DB::table('performance_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->where('update_type','=','Visit')
            ->whereRaw("STR_TO_DATE(updtd_date, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->sum('no_visit');
				
	}
    
    
    
    
     public function getAgentMonth(){
         
         $start = date('Y-m-1',time());
         $end = date('Y-m-31',time());
		
		return DB::table('agent_detials_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->whereRaw("STR_TO_DATE(timestamp, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->count('agent_id');
         
		
		
	}
	
	
	
	public function getAgentToday(){
		
        $today = date('Y-m-d', time());
		
		return DB::table('agent_detials_tbl')
            ->where('profile_id','=', Auth::user()->id)
            ->whereRaw("STR_TO_DATE(timestamp, '%Y-%m-%d') = STR_TO_DATE('".$today."', '%Y-%m-%d')")
            ->count('agent_id');
		
		
	}
    
    
    public function getAgentYear(){
                 
         $start = date('Y-1-1',time());
         $end = date('Y-12-31',time());
		
		return DB::table('agent_detials_tbl')
            ->where('profile_id','=',Auth::user()->id)
            ->whereRaw("STR_TO_DATE(timestamp, '%Y-%m-%d') BETWEEN STR_TO_DATE('".$start."', '%Y-%m-%d') AND STR_TO_DATE('".$end."', '%Y-%m-%d')")
            ->count('agent_id');
				
	}
    
    
    
	
	
}