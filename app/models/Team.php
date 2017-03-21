<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class Team extends Model
{
    protected $table = 'team';
    public $timestamps = false;


    public function viewTeam($manager){

        $teams = DB::table('department')
            ->join('team','department.dep_id','=','team.department')
            ->where('department.manager', $manager)
            ->select('department.*','team.*')
            ->get();



        foreach ($teams as $team){

            $team_id = $team->team_id;
            $team_name = $team->team_name;
            $department = $team->dep_name;

            $result[$team_id]['team_id'] = $team_id;
            $result[$team_id]['team_name'] = $team_name;
            $result[$team_id]['department'] = $department;
            $result[$team_id]['members_count'] = DB::table('profile_tbl_sales')->where('team','=',$team_id)->count();
            $result[$team_id]['members'] = DB::table('profile_tbl_sales')->where('team','=',$team_id)->get();



            foreach ($result as $results){

                foreach ($results['members'] as $member){

                    $member_id = $member->id;
                    $year = date('Y',time());

                    $agents = DB::table('agent_detials_tbl')
                        ->where('profile_id',$member_id)
                        ->get();

                    foreach ($agents as $agent) {

                        $agent_id = $agent->agent_id;

                        $result[$team_id]['agents'][$agent_id]['agent_id'] = $agent_id;
                        $result[$team_id]['agents'][$agent_id]['agent_name'] = $agent->agent_name;
                        $result[$team_id]['agents'][$agent_id]['team_id'] = $results['team_id'];

                        $result[$team_id]['agents'][$agent_id]['jan'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 1  AND YEAR(performance_tbl.timestamp) = $year")
//                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['feb'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 2  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['mar'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 3  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['apr'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 4  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['may'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 5  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['jun'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 6  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['jul'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 7  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['aug'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 8  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['sep'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 9  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');


                        $result[$team_id]['agents'][$agent_id]['oct'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 10  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');



                        $result[$team_id]['agents'][$agent_id]['nov'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 11  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');


                        $result[$team_id]['agents'][$agent_id]['dec'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 12  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');


                    }

                }

            }

        }
        return $result;
    }

    public function viewAllTeam(){

        $teams = DB::table('department')
            ->join('team','department.dep_id','=','team.department')
            ->select('department.*','team.*')
            ->get();

        foreach ($teams as $team){

            $team_id = $team->team_id;
            $team_name = $team->team_name;
            $department = $team->dep_name;

            $result[$team_id]['team_id'] = $team_id;
            $result[$team_id]['team_name'] = $team_name;
            $result[$team_id]['department'] = $department;
            $result[$team_id]['members_count'] = DB::table('profile_tbl_sales')->where('team','=',$team_id)->count();
            $result[$team_id]['members'] = DB::table('profile_tbl_sales')->where('team','=',$team_id)->get();


            foreach ($result as $results){

                foreach ($results['members'] as $member){

                    $member_id = $member->id;
                    $year = date('Y',time());

                    $agents = DB::table('agent_detials_tbl')
                        ->where('profile_id',$member_id)
                        ->get();

                    foreach ($agents as $agent) {

                        $agent_id = $agent->agent_id;
                        $result[$team_id]['agents'][$agent_id]['agent_id'] = $agent_id;
                        $result[$team_id]['agents'][$agent_id]['agent_name'] = $agent->agent_name;


                        $result[$team_id]['agents'][$agent_id]['team_id'] = $results['team_id'];

                        $result[$team_id]['agents'][$agent_id]['jan'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 1  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['feb'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 2  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['mar'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 3  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['apr'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 4  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['may'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 5  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['jun'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 6  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['jul'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 7  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['aug'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 8  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');

                        $result[$team_id]['agents'][$agent_id]['sep'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 9  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');


                        $result[$team_id]['agents'][$agent_id]['oct'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 10  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');



                        $result[$team_id]['agents'][$agent_id]['nov'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 11  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');


                        $result[$team_id]['agents'][$agent_id]['dec'] = DB::table('performance_tbl')
                            ->join('agent_detials_tbl', 'performance_tbl.agent_id', '=', 'agent_detials_tbl.agent_id')
                            ->where('performance_tbl.profile_id', $member_id)
                            ->where('performance_tbl.agent_id', $agent_id)
                            ->where('performance_tbl.update_type', 'confirmation')
                            ->whereRaw("MONTH(performance_tbl.timestamp) = 12  AND YEAR(performance_tbl.timestamp) = $year")
                            ->groupBy('performance_tbl.agent_id')
                            ->sum('performance_tbl.no_cnfrm');






                    }

                }



            }

        }

        return $result;
    }

    public function createTeam(){

        return DB::table('team')->insert([
            ['name' => 'team-1', 'department' => 1],
        ]);

    }

    public function addMembers(){



    }


}
