<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\models\Agent;

use App\models\Complain;

class ComplainController extends Controller
{




    public function viewComplain(){

        $agent = Agent::all();

        $complain = new Complain();

        $complains = $complain->getComplain();

        return view('complain')->with('agents',$agent)->with('complains',$complains);


    }


    public function newComplain(Request $request){


        $data = $request->all();

        $rules = array(

            'agent_id' => 'required',
            'date' => 'required',
            'no_of_complains' => 'required',

        );

        // Create a new validator instance.
        $validator = Validator::make($data, $rules);


        if($validator->fails()){

            echo json_encode(0);

        }else {

            $complain = new Complain();

            $complain->agent_id = $request->agent_id;
            $complain->complain_date = $request->date;
            $complain->no_complains = $request->no_of_complains;
            $complain->remarks = $request->remarks;

            if ($complain->save()) {

                echo json_encode(1);

            } else {

                echo json_encode(0);
            }

        }




    }


}
