@extends('layouts.master')

@section('content')



 <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Performance Details
                            </h2>
                         
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active col-amber">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">supervisor_account</i> My Performance
                                    </a>
                                </li>
                                <li role="presentation" class="col-amber">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">person_add</i> New Performance
                                    </a>
                                </li>
                               
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                
                                <div role="tabpanel" class="row tab-pane fade in active" id="home_with_icon_title">
                                        <div class="card">
                                        <div class="header">
                                            <h2>
                                                My All Performance
                                            </h2>
                                            
                                        </div>
                                        <div class="body">
                                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Date Update</th>
                                                        <th>Update Type</th>
                                                        <th>Remarks</th>
                                                        <th>Timestamp</th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                @foreach($performances as $performance)
                                                    <tr>
                                                        <td>{{$performance->agent_name}}</td>
                                                        <td>{{$performance->updtd_date}}</td>
                                                        <td>{{$performance->update_type}}</td>
                                                        <td>{{$performance->remakrs}}</td>
                                                        <td>{{$performance->timestamp}}</td>
                                                    </tr>
                                                    @endforeach


                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                
                                
                                
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                    <b>Add New Performance Form</b><hr> 
                                    <div class="row clearfix" style="padding:1em;">
                                 <form id="performanceForm" name="performanceForm" method="post">
                                     <meta name="csrf-token" content="{{ csrf_token() }}">
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Agent</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" data-live-search="true" name="agent">

                                                <option value="0">Select An Agent</option>
                                                @foreach($agents as $agent)
                                                <option value="{{$agent->agent_id}}">{{$agent->agent_name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Last Visited at</label>
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" placeholder="Last Visited at" name="last_visited" value="{{date('Y-m-d',time())}}"/>
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Type of Update</label>
                                        <div class="form-line">
                                            <select class="form-control show-tick" data-live-search="true" name="update_type">
                                                <option value="0">Select A Type</option>
                                                <option value="Calls">Call</option>
                                                <option value="Visit">Visit</option>
                                                <option value="Queries">Queries</option>
                                                <option value="Confirmation">Confirmations</option>
                                                <option value="Cancellations">Cancellations</option>
                                                <option value="PAX">PAX</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                        
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Update at</label>
                                        <div class="form-line">
                                            <input type="text" class="datepicker form-control" placeholder="Updated at" name="updated" value="{{date('Y-m-d',time())}}" />
                                        </div>
                                    </div>
                                </div>


                                 <div class="col-sm-12 col-md-6">
                                     <div class="form-group">
                                         <label class="form-label">No Of Records<small>(Calls/Queries/Visits/Confirmations/Cancellations)</small></label><label> <small style="color: red;"> Please enter the total amount of each type of performance related to the date of update.</small></label>
                                         <div class="form-line">
                                             <input type="text" class="form-control" placeholder="No Of Records" name="no_of_records" />
                                         </div>
                                     </div>
                                 </div>
                                        
                                        
                                
                                        
                                <div class="col-sm-12 col-md-6">
                                    <div class="form-group">
                                        <label class="form-label">Remarks</label>
                                        <div class="form-line">
                                            <textarea rows="4" class="form-control no-resize" placeholder="Remarks" name="remarks"></textarea>
                                        </div>
                                    </div>
                                </div>
                                 
                                <div class="col-sm-12 col-md-12" id="performance_submit">
                                    <div class="form-group">
                                        <div class="btn-group">
                                            <button type="submit" class="btn btn-success waves-effect">Add Performance</button>
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
                New Performance added successfully.
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





<script>
    $(document).ready(function(){

        $('.js-exportable').DataTable({
            dom: 'Bfrtip',
            buttons: [
                'csv', 'excel', 'pdf', 'print'
            ]
        });
    });


</script>

@endsection

