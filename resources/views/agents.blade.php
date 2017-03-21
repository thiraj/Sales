@extends('layouts.master')

@section('content')


 <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Agents Details
                            </h2>
                         
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active col-amber">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">supervisor_account</i> Agents Profiles
                                    </a>
                                </li>
                                <li role="presentation" class="col-amber">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">person_add</i> New Agent
                                    </a>
                                </li>
                               
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div role="tabpanel" class="row tab-pane fade in active" id="home_with_icon_title">
                                    @foreach($agents as $agent)
                                    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                        <div class="card">
                                            <div class="header bg-light-green">
                                                <h2>
                                                    {{$agent->agent_name}} <small>Profile</small>
                                                </h2>

                                            </div>
                                            <div class="body">
                                                <div class="responsive-table">
                                                     <table class="table table-bordered">
                                                         <tbody>
                                                         <tr><th width="30%">Agent ID :</th><td>{{$agent->agent_id}}</td></tr>
                                                         <tr><th>Agent Name :</th><td>{{$agent->agent_name}}</td></tr>
                                                         <tr><th>Contact Name :</th><td>{{$agent->contact_name}}</td></tr>
                                                         <tr><th>Address :</th><td>{{$agent->agent_address}}</td></tr>
                                                         <tr><th>Designation :</th><td>{{$agent->designation}}</td></tr>
                                                         <tr><th>E-mail :</th><td>{{$agent->email}}</td></tr>
                                                         <tr><th>MOB :</th><td>{{$agent->telephone}}</td></tr>
                                                         <tr><th>Remarks :</th><td>{{$agent->remarks}}</td></tr>
                                                         <tr><th>Added Date :</th><td>{{date('Y-m-d',strtotime($agent->timestamp))}}</td></tr>
                                                         </tbody>

                                                     </table>
                                                </div>

                                                <div align="center">
                                                <a href="#" data-id="/get_edit_agent?user_id={{$agent->agent_id}}" id="agent_edit_link" data-toggle="modal" data-target="#edit_agent"><span class="material-icons col-amber">edit</span></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                        @endforeach

                                        <div class="container col-md-6 col-sm-12 col-md-offset-3">
                                            <div class="pagination " >{{ $agents->render()}} </div>
                                        </div>


                                </div>


                                
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                    <b>Add New Agent Form</b><hr> 
                                    <div class="row clearfix" style="padding:1em;">

                                <form name="agentForm" id="agentForm">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <select class="form-control show-tick" data-live-search="true" name="market" required>
                                                {{--<option>Select A Market</option>--}}
                                                @foreach($market as $markets)
                                                <option value="{{$markets->market_id}}">{{$markets->markt_name}}</option>
                                               @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Agent Name" name="name" required/>
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Agent Contact Name" name="contact_name" >
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Agent Address" name="address">
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Designation" name="designation">
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Email" name="email">
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <input type="text" class="form-control" placeholder="Contact Number" name="contact_number">
                                        </div>
                                    </div>
                                </div>
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Remarks" name="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-sm-12 col-md-12" id="agent_submit_area">
                                    <div class="form-group">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-success waves-effect">Add Agent</button>
                                            <button type="reset" class="btn btn-danger waves-effect">Cancel</button>
                                           
                                        </div>
                                    </div>
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
                <h4 class="modal-title" id="defaultModalLabel" style="color: yellow; font-size: 20px;">Success...!</h4>
            </div>
            <div class="modal-body">
                New agent added successfully.
            </div>
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
                <h4 class="modal-title" id="defaultModalLabel"  style="color: darkred; font-size: 20px;">Error...!</h4>
            </div>
            <div class="modal-body">
                Whoops..! Something went wrong. Please fill detail correctly and try again.
            </div>
            <div class="modal-footer">
                {{--<button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>--}}
                <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edit_agent" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header bg-teal">
                <h4 class="modal-title" id="defaultModalLabel"  style="font-size: 20px;">Edit Agent Details</h4>
            </div>
            <form>
            <div class="modal-body">

            </div>
                
            </form>

        </div>
    </div>
</div>


<script>
    //Edit Agent Modal
    $("#edit_agent").on("show.bs.modal", function(e) {
        var link = $(e.relatedTarget).attr("data-id");
//        alert(link);
        $("#edit_agent").find(".modal-body").load(link);
    });
</script>

@endsection 