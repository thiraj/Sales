<?php

namespace App\Http\Controllers;

//use Illuminate\Support\Facades\Request;

use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;

use Illuminate\Support\Facades\Input;

use Illuminate\Http\Request;

use Hash;

use App\models\Profile;

class UserController extends Controller
{

	protected $id;
    
    public function __construct()
    {
        $this->middleware('auth');


    }


	public function userView(){

		$users = Profile::all();

		$country = new Profile();
		$country_list = $country->getCountry();

		$city_list = $country->getCity();

		return view('users')->with('users',$users)->with('country',$country_list)->with('city',$city_list);


	}


	public function viewEditUser(Request $request){

		$id = $request->get('user_id');

		$users = Profile::where('id',$id)->first();

		return view('edit_user')->with('profile',$users);

	}


	public function editUser(Request $request){

		$data = $request->all();



		$rules = array(

			'email' => 'required|email|confirmed',
			'f_name' => 'required',
			'l_name' => 'required'

		);


		// Create a new validator instance.
		$validator = Validator::make($data, $rules);


		if ($validator->passes()) {

			$id = $request->input('user_id');


			$p = Profile::where('id',$id)->pluck('password');



			if(empty($request->input('password'))){


				$password = $p;

			}else {

				$validate = Validator::make($request->all(), [
					'password' => 'required|confirmed'
				]);

				if ($validate->fails()) {
                    

					return json_encode(0);
                    

				} else {

					$password = Hash::make($request->input('password'));

				}
			}




			$profile = Profile::where('id', $id)

				->update([

					'f_name' => $request->input('f_name'),
					'l_name' => $request->input('l_name'),
					'email' => $request->input('email'),
					'password' => $password,
					'staff_mobile' => $request->input('phone'),
					'country' => $request->input('country'),
					'date_joined' => $request->input('date_joined'),
					'country_covered' => $request->input('cover_country'),
					'city_covered' => $request->input('cover_city'),
					'staff_below' => $request->input('staff_under'),
					'monthly_target' => $request->input('monthly_target')
				]);


			if($profile){

				echo json_encode(1);

			}else{

				echo json_encode(0);
			}



		}else{

			echo json_encode(2);
		}


	}


	public function userSingleView(Request $request){

		$id = $request->get('user_id');

		$users = Profile::where('id',$id)->first();

		return view('view_user')->with('profile',$users);


	}

    
	public function profileView(){

	   $user  = Auth::user();

       $id = $user->id;

	   $profile = Profile::where('id', $id)->first();
		
        return view('profile')->with('profile',$profile);
		

	}


	public function editProfile(Request $request){

//		if(Request::ajax()) {

			$data = $request->all();

			$rules = array(

				'email' => 'required|email|confirmed',
				'f_name' => 'required',
				'l_name' => 'required'

			);


			// Create a new validator instance.
			$validator = Validator::make($data, $rules);


			if ($validator->passes()) {

				$user  = Auth::user();

				$id = $user->id;

				$p = Profile::where('id',$id)->pluck('password');



				if(empty($request->input('password'))){


					$password = $p;

				}else{

					$validate = Validator::make($request->all(),[
						'password' => 'required|confirmed'
					]);

					if($validate->fails()){

						return json_encode(0);

					}else{

						$password = Hash::make($request->input('password'));

					}





				}



				$profile = Profile::where('id', $id)

					->update([

						'f_name' => $request->get('f_name'),
						'l_name' => $request->get('l_name'),
						'email' => $request->get('email'),
						'password' => $password,
						'staff_mobile' => $request->get('phone'),
						'country' => $request->get('country'),
						'date_joined' => $request->get('date_joined'),
						'country_covered' => $request->get('cover_country'),
						'city_covered' => $request->get('cover_city'),
						'staff_below' => $request->get('staff_under'),
						'monthly_target' => $request->get('monthly_target')
					]);


				if($profile){

					echo json_encode(1);

				}else{

					echo json_encode(0);
				}



			}else{

				echo json_encode(2);
			}




	}

    
    public function newUser(Request $request){

			$data = $request->all();

			$rules = array(

				'email' => 'required|email|confirmed',
				'f_name' => 'required',
                'password' => 'required|confirmed'

			);


			// Create a new validator instance.
			$validator = Validator::make($data, $rules);


			if ($validator->passes()) {


				$profile = new Profile();

					

				$profile->f_name = $request->get('f_name');
				$profile->l_name = $request->get('l_name');
				$profile->email = $request->get('email');
				$profile->password = Hash::make($request->get('password'));
				$profile->staff_mobile = $request->get('phone');
				$profile->country = $request->get('country');
				$profile->date_joined = $request->get('date_joined');
				$profile->country_covered = $request->get('cover_country');
				$profile->city_covered = $request->get('cover_city');
				$profile->staff_below = $request->get('staff_under');
				$profile->monthly_target = $request->get('monthly_target');
                $profile->role = $request->get('role');
                
					


				if($profile->save()){

					echo json_encode(1);

				}else{

					echo json_encode(0);
				}



			}else{

				echo json_encode(2);
			}




	}


	public function deleteUser(Request $request){

		$id = $request->input('user_id');


		$user = Profile::where('id',$id)->delete();
		
		if($user){

			echo json_encode(1);
			
		}else{

			echo json_encode(0);
		}


	}
    
	
	public function logout(){

		Auth::logout();

		return redirect('/');
		
	}
    
    
}
