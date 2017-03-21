<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Report extends Model
{

    
    public function viewReports($employee,$report_type,$month,$year){


       $result =  DB::table('performance_tbl')
            ->join('agent_detials_tbl', 'agent_detials_tbl.agent_id', '=', 'performance_tbl.agent_id')
            ->join('profile_tbl_sales', 'profile_tbl_sales.id', '=', 'performance_tbl.profile_id')
            ->where('performance_tbl.profile_id', $employee)
            ->where('performance_tbl.update_type' , '=', $report_type)
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month AND YEAR(performance_tbl.timestamp) = $year ")
            ->select('performance_tbl.*','agent_detials_tbl.*','profile_tbl_sales.*','performance_tbl.timestamp as system_date')
            ->get();




        if($result){

         return $result;

        }else{

           echo 0;
        }
    }


    public function somOfCalls($employee,$month,$year){


        return DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','calls')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month  AND YEAR(performance_tbl.timestamp) = $year ")
            ->sum('no_calls');

    }


    public function somOfQurs($employee,$month,$year){

        return DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','queries')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month  AND YEAR(performance_tbl.timestamp) = $year ")
            ->sum('no_qurs');

    }


    public function somOfConfirmations($employee,$month,$year){

        $confirm = DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','confirmation')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month  AND YEAR(performance_tbl.timestamp) = $year")
            ->sum('no_cnfrm');

        $cancel = DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','Cancellations')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month AND YEAR(performance_tbl.timestamp) = $year")
            ->sum('no_cancel');

        $total = $confirm - $cancel;

        return $total;

    }


    public function somOfVisit($employee,$month, $year){

        return DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','visit')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month AND YEAR(performance_tbl.timestamp) = $year")
            ->sum('no_visit');

    }


    public function somOfCancel($employee,$month, $year){

        return DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','Cancellations')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month AND YEAR(performance_tbl.timestamp) = $year")
            ->sum('no_cancel');

    }

    public function somOfPax($employee,$month, $year){

        $cancel = DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','Cancellations')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month AND YEAR(performance_tbl.timestamp) = $year")
            ->sum('no_cancel');

        $pax =  DB::table('performance_tbl')
            ->where('profile_id',$employee)
            ->where('update_type','PAX')
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month AND YEAR(performance_tbl.timestamp) = $year")
            ->sum('no_pax');

        $total = $pax - $cancel;

        return $total;

    }


    public static function reportFull($full_year,$full_month){

        $user = DB::table('profile_tbl_sales')->get();

       foreach ($user as $users){

           $i = 0;

           $user_id = $users->id;
           $first = $users->f_name;
           $last = $users->l_name;

           $count[$user_id]['f_name'] = $first;
           $count[$user_id]['l_name'] = $last;

           $count[$user_id]['calls'] = DB::table('performance_tbl')
               ->where('profile_id',$user_id)
               ->where('update_type','=','Calls')
               ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
               ->sum('no_calls');

           $count[$user_id]['visits'] = DB::table('performance_tbl')
               ->where('profile_id',$user_id)
               ->where('update_type','=','visit')
               ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
               ->sum('no_visit');

           $count[$user_id]['queries'] = DB::table('performance_tbl')
               ->where('profile_id',$user_id)
               ->where('update_type','=','queries')
               ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
               ->sum('no_qurs');

           $count[$user_id]['confirmations'] = DB::table('performance_tbl')
               ->where('profile_id',$user_id)
               ->where('update_type','=','Confirmation')
               ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
               ->sum('no_cnfrm');

           $count[$user_id]['cancellations'] = DB::table('performance_tbl')
               ->where('profile_id',$user_id)
               ->where('update_type','=','Cancellations')
               ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
               ->sum('no_cancel');


       }

       return $count;




    }


    public static function reportManagerFull($full_year,$full_month,$manager){

        $user = DB::table('profile_tbl_sales')
            ->join('department','profile_tbl_sales.department','department.dep_id')
            ->where('department.manager',$manager)
            ->select('profile_tbl_sales.*')
            ->get();

        foreach ($user as $users){

            $i = 0;

            $user_id = $users->id;
            $first = $users->f_name;
            $last = $users->l_name;

            $count[$user_id]['f_name'] = $first;
            $count[$user_id]['l_name'] = $last;

            $count[$user_id]['calls'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Calls')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_calls');

            $count[$user_id]['visits'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','visit')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_visit');

            $count[$user_id]['queries'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','queries')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_qurs');

            $count[$user_id]['confirmations'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Confirmation')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_cnfrm');

            $count[$user_id]['cancellations'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Cancellations')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_cancel');


        }

        return $count;




    }


    public static function reportUserFull($full_year,$full_month,$id){

        $user = DB::table('profile_tbl_sales')
            ->where('id',$id)
            ->get();

        foreach ($user as $users){

            $user_id = $users->id;
            $first = $users->f_name;
            $last = $users->l_name;

            $count[$user_id]['f_name'] = $first;
            $count[$user_id]['l_name'] = $last;

            $count[$user_id]['calls'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Calls')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_calls');

            $count[$user_id]['visits'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','visit')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_visit');

            $count[$user_id]['queries'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','queries')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_qurs');

            $count[$user_id]['confirmations'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Confirmation')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_cnfrm');

            $count[$user_id]['cancellations'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Cancellations')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $full_year AND MONTH(performance_tbl.timestamp) = $full_month")
                ->sum('no_cancel');


        }

        return $count;




    }


    public static function teamFullReport($team,$month,$year){

        $user = DB::table('profile_tbl_sales')->where('team',$team)->get();

        foreach ($user as $users){

            $i = 0;

            $user_id = $users->id;
            $first = $users->f_name;
            $last = $users->l_name;

            $count[$user_id]['f_name'] = $first;
            $count[$user_id]['l_name'] = $last;

            $count[$user_id]['calls'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Call')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $year AND MONTH(performance_tbl.timestamp) = $month")
                ->sum('no_calls');

            $count[$user_id]['visits'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','visit')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $year AND MONTH(performance_tbl.timestamp) = $month")
                ->sum('no_visit');

            $count[$user_id]['queries'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','queries')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $year AND MONTH(performance_tbl.timestamp) = $month")
                ->sum('no_qurs');

            $count[$user_id]['confirmations'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Confirmation')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $year AND MONTH(performance_tbl.timestamp) = $month")
                ->sum('no_cnfrm');

            $count[$user_id]['cancellations'] = DB::table('performance_tbl')
                ->where('profile_id',$user_id)
                ->where('update_type','=','Cancellations')
                ->whereRaw("YEAR(performance_tbl.timestamp) = $year AND MONTH(performance_tbl.timestamp) = $month")
                ->sum('no_cancel');


        }

        return $count;




    }


    public function teamUserReports($employee,$report_type,$month,$year){

        $result =  DB::table('performance_tbl')
            ->join('agent_detials_tbl', 'agent_detials_tbl.agent_id', '=', 'performance_tbl.agent_id')
            ->join('profile_tbl_sales', 'profile_tbl_sales.id', '=', 'performance_tbl.profile_id')
            ->where('performance_tbl.profile_id', $employee)
            ->where('performance_tbl.update_type' , '=', $report_type)
            ->whereRaw("MONTH(performance_tbl.timestamp) = $month AND YEAR(performance_tbl.timestamp) = $year ")
            ->select('performance_tbl.*','agent_detials_tbl.*','profile_tbl_sales.*')
            ->get();



        if($result){

            return $result;

        }else{

            echo 0;
        }
    }


}
