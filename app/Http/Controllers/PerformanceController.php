<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Validator;

use App\Http\Requests;

use App\models\Performance;

use App\models\Agent;

use App\models\Profile;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;



class PerformanceController extends Controller
{

    public function newPerformance(Request $request){

        $data = $request->all();

        $rules = array(

            'agent' => 'required',
            'update_type' => 'required',
            'no_of_records' => 'required',
            'updated' => 'required'

        );

        // Create a new validator instance.
        $validator = Validator::make($data, $rules);


        if($validator->fails()){

        echo json_encode(0);

    }else {


        $performance = new Performance();

        $type = $request->update_type;

        switch ($type){

            case "Calls":

                $performance->profile_id = Auth::user()->id;
                $performance->agent_id = $request->agent;
                $performance->lst_visitd = $request->last_visited;
                $performance->update_type = $request->update_type;
                $performance->updtd_date = $request->updated;
                $performance->remakrs = $request->remarks;
                $performance->no_calls = $request->no_of_records;


                if ($performance->save()) {

                    echo json_encode(1);

                } else {

                    echo json_encode(0);
                }

                break;

            case "Visit":

                $performance->profile_id = Auth::user()->id;
                $performance->agent_id = $request->agent;
                $performance->lst_visitd = $request->last_visited;
                $performance->update_type = $request->update_type;
                $performance->updtd_date = $request->updated;
                $performance->remakrs = $request->remarks;
                $performance->no_visit = $request->no_of_records;


                if ($performance->save()) {

                    echo json_encode(1);

                } else {

                    echo json_encode(0);
                }

                break;

            case "Queries":

                $performance->profile_id = Auth::user()->id;
                $performance->agent_id = $request->agent;
                $performance->lst_visitd = $request->last_visited;
                $performance->update_type = $request->update_type;
                $performance->updtd_date = $request->updated;
                $performance->remakrs = $request->remarks;
                $performance->no_qurs = $request->no_of_records;


                if ($performance->save()) {

                    echo json_encode(1);

                } else {

                    echo json_encode(0);
                }

                break;

            case "Confirmation":

                $performance->profile_id = Auth::user()->id;
                $performance->agent_id = $request->agent;
                $performance->lst_visitd = $request->last_visited;
                $performance->update_type = $request->update_type;
                $performance->updtd_date = $request->updated;
                $performance->remakrs = $request->remarks;
                $performance->no_cnfrm = $request->no_of_records;


                if ($performance->save()) {

                    echo json_encode(1);

                } else {

                    echo json_encode(0);
                }

                break;


            case "Cancellations":

                $performance->profile_id = Auth::user()->id;
                $performance->agent_id = $request->agent;
                $performance->lst_visitd = $request->last_visited;
                $performance->update_type = $request->update_type;
                $performance->updtd_date = $request->updated;
                $performance->remakrs = $request->remarks;
                $performance->no_cancel = $request->no_of_records;


                if ($performance->save()) {

                    echo json_encode(1);

                } else {

                    echo json_encode(0);
                }

                break;


            case "PAX":

                $performance->profile_id = Auth::user()->id;
                $performance->agent_id = $request->agent;
                $performance->lst_visitd = $request->last_visited;
                $performance->update_type = $request->update_type;
                $performance->updtd_date = $request->updated;
                $performance->remakrs = $request->remarks;
                $performance->no_pax = $request->no_of_records;


                if ($performance->save()) {

                    echo json_encode(1);

                } else {

                    echo json_encode(0);
                }

                break;




        }


    }
    

}


//View Self Performance
    public function viewMyPerformance(){

        $agents = Agent::where('profile_id',Auth::user()->id)->get();

        $performances = DB::table('performance_tbl')
            ->join('agent_detials_tbl', 'agent_detials_tbl.agent_id', '=', 'performance_tbl.agent_id')
            ->where('performance_tbl.profile_id',Auth::user()->id)
            ->select('*')
            ->get();

        return view('performance_client')->with('performances',$performances)->with('agents',$agents);

    }


    public function viewTeamUserPerformance($user){

        $agents = Agent::where('profile_id',$user)->get();

        $user_email = Profile::where('id',$user)->pluck('email');

        $performances = DB::table('performance_tbl')
            ->join('agent_detials_tbl', 'agent_detials_tbl.agent_id', '=', 'performance_tbl.agent_id')
            ->where('performance_tbl.profile_id',$user)
            ->select('*')
            ->get();

        return view('team_performance')->with('performances',$performances)->with('agents',$agents)->with('email',$user_email);

    }

}
