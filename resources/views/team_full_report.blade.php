@extends('layouts.master')

@section('content')


  <!-- Exportable Table -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    @if(!empty($reports))
                    <div class="card">
                        <div class="header">
                            <h2>
                                Full Report
                            </h2>
                        
                        </div>
                        <div class="body">
                            <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Queries</th>
                                        <th>Visits</th>
                                        <th>Confirmations</th>
                                        <th>Calls</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Queries</th>
                                        <th>Visits</th>
                                        <th>Confirmations</th>
                                        <th>Calls</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach($reports as $report)
                                    <tr>
                                        <td>{{$report['f_name']}} &nbsp; {{$report['l_name']}}</td>
                                        <td>{{$report['queries']}}</td>
                                        <td>{{$report['visits']}}</td>
                                        <td>{{$report['confirmations']}}</td>
                                        <td>{{$report['calls']}}</td>
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
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
                                Report 
                            </h2>
                        
                        </div>
                        <div class="body">
                            <h5>No Data to show</h5>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- #END# Exportable Table -->




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

