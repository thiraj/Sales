@extends('layouts.master') @section('content')
<!-- Tabs With Icon Title -->
<div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="card">
            <div class="header bg-red">
                <h2>
                                Users
                            </h2> </div>
            <div class="body">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active col-amber">
                        <a href="#home_with_icon_title" data-toggle="tab"> <i class="material-icons">supervisor_account</i> Users Details </a>
                    </li>
                    <li role="presentation" class="col-amber">
                        <a href="#profile_with_icon_title" data-toggle="tab"> <i class="material-icons">person_add</i> New User </a>
                    </li>
                </ul>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="row tab-pane fade in active" id="home_with_icon_title">
                        <div class="card">
                            <div class="body">
                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Covered Country</th>
                                            <th>Monthly Target</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Edit</th> {{--
                                            <th>Delete</th>--}} </tr>
                                    </thead>
                                    <tbody> @foreach($users as $user)
                                        <tr>
                                            <td><a href="#" data-id="/view_user?user_id={{$user->id}}" id="user_view_link" data-toggle="modal" data-target="#view_user"> {{$user->f_name}}&nbsp;{{$user->l_name}}</a></td>
                                            <td>{{$user->country_covered}}</td>
                                            <td>{{$user->monthly_target}}</td>
                                            <td>{{$user->email}}</td>
                                            <td>{{$user->staff_mobile}}</td>
                                            <td><a href="#" data-id="/edit_user?user_id={{$user->id}}" id="user_edit_link" data-toggle="modal" data-target="#edit_user">Edit</a></td> {{--
                                            <td><a href="#" data-id="{{$user->id}}" id="user_delete_link" data-toggle="modal" data-target="#delete">Delete</a></td>--}} </tr> @endforeach </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    
                    
                    
                    <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title"> <b>Add New User Form</b>
                        <hr>
                        <div class="row clearfix" style="padding:1em;">
                            <form id="userForm" name="userForm">

                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">First Name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="First Name" name="f_name" /> </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Name</label>
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Last Name" name="l_name" /> </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <div class="form-line">
                                            <input type="email" class="form-control" placeholder="Email" name="email" /> </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Verify Email</label>
                                        <div class="form-line">
                                            <input type="email" class="form-control" placeholder="Verify Email" name="email_confirmation" /> </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Password</label>
                                        <div class="form-line">
                                            <input type="password" class="form-control" placeholder="Password" name="password" /> </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Verify Password</label>
                                        <div class="form-line">
                                            <input type="password" class="form-control" placeholder="Verify Password" name="password_confirmation" /> </div>
                                    </div>
                                </div>
                                
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Country</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" data-live-search="true" name="country">
                                                <option value="">Country...</option>
                                                @foreach($country as $country_list)
                                                <option value="{{$country_list->id}}">{{$country_list->nicename}}</option>
                                                    @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                

                                
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">City Covered</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="city_covered">
                                                    <option value="">City...</option>
                                                    @foreach($city as $city_list)
                                                        <option value="{{$city_list->c_id}}">{{$city_list->city_name}}</option>
                                                    @endforeach

                                                </select>
                                                <input type="text" class="form-control" placeholder="City Covered" name="city_covered" /> </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Monthly Target</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Monthly Target" name="target" /> </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Staff Under You</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Staff Under You" name="staff_under" /> </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Role</label>
                                            <div class="form-line">
                                                <select class="form-control show-tick" data-live-search="true" name="role">
                                                    <option value="1">Administrator</option>
                                                    <option value="2">Manager</option>
                                                    <option value="3">User</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Contact Number</label>
                                            <div class="form-line">
                                                <input type="text" class="form-control" placeholder="Contact Number" name="phone" /> </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-12 col-md-6">
                                        <div class="form-group">
                                            <label class="form-label">Date Joined</label>
                                            <div class="form-line">
                                                <input type="text" class="datepicker form-control" placeholder="Date Joined" name="date_joined" /> 
                                            </div>
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-12 col-md-6">
                                        <hr>
                                        <div class="form-group">
                                            <input id="submit" type="submit" class="btn btn-link waves-effect col-md-6" value="Create">
                                            <input type="reset" class="btn btn-link waves-effect col-md-6" value="Cancel"> </div>
                                    </div>
                            </form>
                         </div>
                        </div>
                </div>
            </div>
        </div>
        </div>
</div>
        <!-- #END# Tabs With Icon Title -->
        <!-- For Material Design Colors -->
        <div class="modal fade" id="success" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-teal">
                        <h4 class="modal-title" id="defaultModalLabel" style="color: yellow; font-size: 20px;">Success...!</h4> </div>
                    <div class="modal-body"> New User added successfully. </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="error" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <h4 class="modal-title" id="defaultModalLabel" style="color: darkred; font-size: 20px;">Error...!</h4> </div>
                    <div class="modal-body"> Whoops..! Something went wrong. Please fill detail correctly and try again. </div>
                    <div class="modal-footer"> {{--
                        <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>--}}
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="view_user" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-teal">
                        <h4 class="modal-title" id="defaultModalLabel">User Details</h4> </div>
                    <div class="modal-body"> </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="edit_user" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-teal">
                        <h2 class="modal-title" id="defaultModalLabel">Edit User</h2> </div>
                    <div class="modal-body"> </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="delete" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <h2 class="modal-title" id="defaultModalLabel">Delete User</h2> </div>
                    <form id="delete_user_frm" name="delete_user_frm">
                        <div class="modal-body">
                            <h5>Are You sure? Do you want to remove the selected user? </h5>
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" value="" id="user_id" name="user_id"> </div>
                        <div class="modal-footer">
                            <button id="submit" type="submit" class="btn btn-link waves-effect">DELETE</button> <a type="button" class="btn btn-link waves-effect" data-dismiss="modal">CANCEL</a> </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="modal fade" id="success_deleted" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-teal">
                        <h4 class="modal-title" id="defaultModalLabel" style="color: yellow; font-size: 20px;">Success...!</h4> </div>
                    <div class="modal-body"> New agent added successfully. </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="error_deleted" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header bg-red">
                        <h4 class="modal-title" id="defaultModalLabel" style="color: darkred; font-size: 20px;">Error...!</h4> </div>
                    <div class="modal-body"> Whoops..! Something went wrong. Please fill detail correctly and try again. </div>
                    <div class="modal-footer"> {{--
                        <button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>--}}
                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button>
                    </div>
                </div>
            </div>
        </div>
        <script>
            $(document).ready(function () {
                $('.js-exportable').DataTable({
                    dom: 'Bfrtip'
                    , buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
                });
            });
            //View User Modal
            $("#view_user").on("show.bs.modal", function (e) {
                var link = $(e.relatedTarget).attr("data-id");
                //        alert(link);
                $("#view_user").find(".modal-body").load(link);
            });
            
            //Edit User Modal
            $("#edit_user").on("show.bs.modal", function (e) {
                var link = $(e.relatedTarget).attr("data-id");
                //        alert(link);
                $("#edit_user").find(".modal-body").load(link);
            });
            
            //Delete User Modal
            $("#delete").on("show.bs.modal", function (e) {
                var user_id = $(e.relatedTarget).attr("data-id");
                //        alert(link);
                $("#delete").find("#user_id").val(user_id);
            });
            
    
        </script> @endsection