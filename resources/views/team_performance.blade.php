@extends('layouts.master')

@section('content')



    <!-- Tabs With Icon Title -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="card">
                <div class="header bg-red">
                    <h2>
                        Performance Details <small style="float: right;">{!! $email !!}</small>
                    </h2>
                </div>
                <div class="body">

                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Date Update</th>
                            <th>Update Type</th>
                            <th>Amount</th>
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
                                    @endif

                                </td>
                                <td>{{$performance->remakrs}}</td>
                                <td>{{$performance->timestamp}}</td>
                            </tr>
                        @endforeach


                        </tbody>
                    </table>


                </div>
                </div>
            </div>
        </div>
    </div>
    <!-- #END# Tabs With Icon Title -->




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

