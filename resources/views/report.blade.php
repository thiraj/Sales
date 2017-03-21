@extends('layouts.master')

@section('content')


  <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if(!empty($performances) && $count != 0)
                    <div class="card">
                        <div class="header">
                            <h2>
                                Report 
                                <h5> {{$report_type}} - {{$count}}</h5>
                            </h2>
                        
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                <tr>
                                    <th style="color: #ce0f1a;">Employee</th>
                                    <th style="color: #ce0f1a;"></th>
                                    <th style="color: #ce0f1a;">Report Type</th>
                                    <th style="color: #ce0f1a;">{{$report_type}}</th>
                                    <th style="color: #ce0f1a;">Total</th>
                                    <th style="color: #ce0f1a;">{{$count}}</th>
                                </tr>

                                <tr>
                                        <th>Name</th>
                                        <th>Date Visited</th>
                                        <th>No Of Records</th>
                                        <th>Remarks</th>
                                        <th>Update Date</th>
                                        <th>System Date</th>
                                    </tr>

                                </thead>

                                <tbody>
                                    @foreach($performances as $performance)
                                    <tr>
                                        <td>{{$performance->agent_name}}</td>
                                        <td>{{$performance->lst_visitd}}</td>
                                        <td>
                                                @if($performance->update_type == "Calls")
                                                {{$performance->no_calls}}
                                                @elseif($performance->update_type == "Queries")
                                                {{$performance->no_qurs}}
                                                @elseif($performance->update_type == "Visit")
                                                {{$performance->no_visit}}
                                                @elseif($performance->update_type == "Confirmation")
                                                {{$performance->no_cnfrm}}
                                                @elseif($performance->update_type == "Cancellations")
                                                {{$performance->no_cancel}}
                                                @elseif($performance->update_type == "PAX")
                                                {{$performance->no_pax}}
                                                @endif

                                        </td>
                                        <td>{{$performance->remakrs}}</td>
                                        <td>{{$performance->updtd_date}}</td>
                                        <td>{{date('Y-m-d',strtotime($performance->system_date))}}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>

                                <tfoot>
                                <tr>
                                    <th>Name</th>
                                    <th>Date Visited</th>
                                    <th>No Of Records</th>
                                    <th>Remarks</th>
                                    <th>Update Date</th>
                                    <th>System Date</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    @elseif(!empty($agents) && $count != 0)
                    <div class="card">
                        <div class="header">
                            <h2>
                                Report 
                            </h2>
                            <h5>{{$report_type}} -  {{$count}}</h5>
                        
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Contact Name</th>
                                        <th>Telephone</th>
                                        <th>Remarks</th>
                                        <th>Date Added</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Address</th>
                                        <th>Email</th>
                                        <th>Contact Name</th>
                                        <th>Telephone</th> 
                                        <th>Remarks</th>
                                        <th>Date Added</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($agents as $agent)
                                    <tr>
                                        <td>{{$agent->agent_name}}</td>
                                        <td>{{$agent->agent_address}}</td>
                                        <td>{{$agent->email}}</td>
                                        <td>{{$agent->contact_name}}</td>
                                        <td>{{$agent->telephone}}</td>
                                        <td>{{$agent->remarks}}</td>
                                        <td>{{$agent->timestamp}}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @elseif($count == 0)
                    <div class="card">
                        <div class="header">
                            <h2>
                                Whooooops..!
                            </h2>
                        
                        </div>
                        <div class="alert alert-danger">
                            <strong>Sorry!</strong> No Data Found.
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- #END# Exportable Table -->


<!-- For Material Design Colors -->
{{--<div class="modal fade" id="success" tabindex="-1" role="dialog">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header bg-teal">--}}
                {{--<h4 class="modal-title" id="defaultModalLabel" style="color: yellow; font-size: 20px;">Success...!</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--New agent added successfully.--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}


{{--<div class="modal fade" id="error" tabindex="-1" role="dialog">--}}
    {{--<div class="modal-dialog" role="document">--}}
        {{--<div class="modal-content">--}}
            {{--<div class="modal-header bg-red">--}}
                {{--<h4 class="modal-title" id="defaultModalLabel"  style="color: darkred; font-size: 20px;">Error...!</h4>--}}
            {{--</div>--}}
            {{--<div class="modal-body">--}}
                {{--Whoops..! Something went wrong. Please fill detail correctly and try again.--}}
            {{--</div>--}}
            {{--<div class="modal-footer">--}}
                {{--<button type="button" class="btn btn-link waves-effect">SAVE CHANGES</button>--}}
                {{--<button type="button" class="btn btn-link waves-effect" data-dismiss="modal">OK</button>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</div>--}}
{{--</div>--}}





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

