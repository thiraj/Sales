<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\models\Profile;

use App\models\Team;

class TeamController extends Controller
{


    //	Team
    public function viewTeam(){

        $user = Auth::user();

        $role = $user->role;



        if($role == 1){


            $teams = new Team();

            $team = $teams->viewAllTeam();

            return view('team')->with('teams',$team);

        }else{

            $manager = $user->id;

            $teams = new Team();

            $team = $teams->viewTeam($manager);

            return view('team')->with('teams',$team);
        }


    }

    public function viewMySingleTeam(Request $request){

        $user = Auth::user();

        $manager = $user->id;

        $team = $request->team;

        if($team != 'All'){

            $team = new Team();

            $r = $team->viewMySingleTeam($manager,$team);

            dd($r);

        }else{

            $team = new Profile();

            $r = $team->viewMyAllTeam($manager);

            dd($r);
        }



    }


    public function createTeam(){

        $newTeam = new Profile();

        $team = $newTeam->createTeam();
    }


    public function addMembers(){


    }
}
