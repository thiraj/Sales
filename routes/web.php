<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', 'HomeController@index');

Auth::routes();

//Group for use Auth. Inside this group, every route must authenticate
Route::group(['middleware' => 'auth'], function () {



Route::get('/home', 'HomeController@index');

Route::get('/logout', 'UserController@logout');

Route::get('/profile', 'UserController@profileView');

Route::post('/edit_profile', 'UserController@editProfile');

Route::get('/agents','AgentController@viewAgents' );

Route::post('/new_agent','AgentController@newAgents' );

Route::get('/performance_client', 'PerformanceController@viewMyPerformance');

Route::post('/new_performance','PerformanceController@newPerformance' );

Route::post('/reports','ReportController@viewReports');

Route::get('/director', function () {
    return view('index_director');
});

//Route::get('/hash', 'HomeController@hash');
//
//Route::get('/dehash', 'HomeController@dehash');

Route::get('/report_get_user', 'ReportController@getUsers');

//Route::get('/test', function(){
//
//    return view('auth/passwords/reset');
//
//});

Route::get('/users','UserController@userView');

Route::get('/view_user','UserController@userSingleView');

Route::get('/edit_user','UserController@viewEditUser');

Route::post('/edit_user_submission','UserController@editUser');

Route::post('/delete_user','UserController@deleteUser');

Route::post('/new_user','UserController@newUser');

Route::get('/get_edit_agent','AgentController@getEditAgent');

Route::get('/edit_agent','AgentController@editAgent');

Route::get('/team','TeamController@viewTeam');

Route::post('/team_report','ReportController@teamFullReport');

Route::post('/team_user_report','ReportController@teamSingleReport');

Route::get('/team_user_performance/{id}','PerformanceController@viewTeamUserPerformance');

Route::get('/complain','ComplainController@viewComplain');

Route::get('/new_complain','ComplainController@newComplain');




});