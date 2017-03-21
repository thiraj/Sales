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
                    @else
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

