<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

use App\models\Profile;

use App\models\Agent;

use App\models\Report;

use App\models\Team;

use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    
    
    
   public function viewReports(Request $request){

      $employee = $request->employee;
      $report_type = $request->report_type;
      $month = $request->month;
      $year = $request->year;
      $full_year = $request->year_full;
      $full_month = $request->full_month;
      $full = $request->full_report;
      $role = Auth::user()->role;




      if($full==='on'){

          if($role == 1){

              $report = Report::reportFull($full_year,$full_month);

              return view('full_report')->with('reports',$report);

          }elseif($role == 2){

              $manager = Auth::user()->id;

              $report = Report::reportManagerFull($full_year,$full_month,$manager);

              return view('full_report')->with('reports',$report);

          }elseif ($role == 3){

              $id = Auth::user()->id;

              $report = Report::reportUserFull($full_year,$full_month,$id);

              return view('full_report')->with('reports',$report);

          }




      }else {

          if ($report_type == "agents") {

              $agents = Agent::where('profile_id', $employee)->whereMonth('timestamp', '=', $month)->whereYear('timestamp','=', $year)->get();

              $count = count($agents);

              return view('report')->with('agents', $agents)->with('count', $count)->with('report_type', $report_type);


          } else {


              $report = new Report();

              $performances = $report->viewReports($employee, $report_type, $month,$year);


              if($performances){

                  switch ($report_type){

                      case "Queries":

                          $count = $report->somOfQurs($employee,$month,$year);
                          break;

                      case "Calls":
                          $count = $report->somOfCalls($employee,$month,$year);
                          break;

                      case "Confirmation":
                          $count = $report->somOfConfirmations($employee,$month,$year);
                          break;

                      case "Visit":
                          $count = $report->somOfVisit($employee,$month,$year);
                          break;

                      case "Cancellations":
                          $count = $report->somOfCancel($employee,$month,$year);
                          break;

                      case "PAX":
                          $count = $report->somOfPax($employee,$month,$year);
                          break;

                  }


                  return view('report')->with('performances', $performances)->with('count', $count)->with('report_type', $report_type);

              }else{

                  return view('report');

              }





          }
      }




   }


    //Team
    public function teamFullReport(Request $request){

        $team = $request->team_id;
        $month = $request->month;
        $year = $request->year;

        $full_report = new Report();

        $reports = $full_report->teamFullReport($team,$month,$year);

        return view('full_report')->with('reports',$reports);


    }


    public function teamSingleReport(Request $request){

        $employee = $request->user_id;
        $report_type = $request->report_type;
        $month = $request->month;
        $year = $request->year;


        if ($report_type == "agents") {

            $agents = Agent::where('profile_id', $employee)->whereMonth('timestamp', '=', $month)->get();

            $count = count($agents);

            return view('report')->with('agents', $agents)->with('count', $count)->with('report_type', $report_type);;


        } else {


            $report = new Report();

            $performances = $report->teamUserReports($employee, $report_type, $month,$year);


            if($performances){

                switch ($report_type){

                    case "Queries":

                        $count = $report->somOfQurs($employee,$month,$year);
                        break;

                    case "Calls":
                        $count = $report->somOfCalls($employee,$month,$year);
                        break;

                    case "Confirmation":
                        $count = $report->somOfConfirmations($employee,$month,$year);
                        break;

                    case "Visit":
                        $count = $report->somOfVisit($employee,$month,$year);
                        break;

                    case "Cancellations":
                        $count = $report->somOfCancel($employee,$month,$year);
                        break;

                }


                return view('report')->with('performances', $performances)->with('count', $count)->with('report_type', $report_type);

            }else{

                return view('report');

            }



        }
    }


    public function getUsers(){

        $role = Auth::user()->role;

        if($role == 1){

            $users = Profile::all();

            return view('report_users')->with('users',$users);

        }elseif ($role == 2){

            $manager = Auth::user()->id;
            $user = new Profile();
            $users = $user->getManagerUsers($manager);
            return view('report_users')->with('users',$users);

        }elseif ($role == 3){

            $id = Auth::user()->id;

            $users = Profile::where('id',$id)->get();

            return view('report_users')->with('users',$users);
        }



   }
}