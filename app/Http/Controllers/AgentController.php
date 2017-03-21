<?php

namespace App\Http\Controllers;

use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\models\Agent;

use App\models\Market;

class AgentController extends Controller
{


    public function viewAgents(){



        $agents = Agent::where('profile_id', Auth::user()->id)->paginate(6);

        $agents_form = new Market();

        $markets = $agents_form->getMarket();

        return view('agents',['agents' => $agents])->with('market',$markets);

    }
    
    




    public function newAgents(Request $request){

    if(!empty($request->name) && !empty($request->market)) {

    $agent = Agent::create([

        'agent_name' => $request->name,
        'agent_address' => $request->address,
        'remarks' => $request->remarks,
        'market_id' => $request->market,
        'contact_name' => $request->contact_name,
        'designation' => $request->designation,
        'email' => $request->email,
        'telephone' => $request->contact_number,
        'profile_id' => Auth::user()->id


    ]);


    if ($agent) {

        echo json_encode(1);

    } else {

        echo json_encode(0);
    }

    }else{

        echo json_encode(0);
    }

    }


    public function getEditAgent(Request $request){

        $id = $request->get('user_id');

        $agents = Agent::where('agent_id',$id)->get();


        return view('edit_agent')->with('agents',$agents);



    }

    public function editAgent(Request $request){

        $id = $request->agent_id;

        $agent = Agent::where('agent_id',$id)
            ->update([
                'remarks'=>$request->remarks,
                'agent_name'=>$request->name,
                'agent_address'=>$request->address,
                'contact_name'=>$request->contact_name,
                'designation'=>$request->designation,
                'email'=>$request->email,
                'telephone'=>$request->contact
            ]);


        if($agent){

            echo json_encode(1);
        }else{

            echo json_encode(0);
        }



    }


}
