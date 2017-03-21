@extends('layouts.master') @section('content')
    <!-- Tabs With Icon Title -->
    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
            <div class="row clearfix">
                @if(!$teams)
                    <div class="alert alert-danger">
                        <strong>Whoops</strong> There's no teams available for you.
                    </div>
                @else
                @foreach($teams as $team)
                <div class="panel-group" id="accordion_17" role="tablist" aria-multiselectable="true">
                    <div class="panel panel-col-pink">
                        <div class="panel-heading" role="tab" id="headingOne_17">
                            <h4 class="panel-title">
                                <a role="button" data-toggle="collapse"  href="#{{$team['team_id']}}" aria-expanded="true" aria-controls="collapseOne_17">
                                    <i class="material-icons">perm_contact_calendar</i> {{$team['team_name']}}
                                    <ui style="float: right;">No of Members - {{$team['members_count']}}</ui>
                                </a>
                            </h4>
                        </div>
                        <div id="{{$team['team_id']}}" class="panel-collapse collapse in" role="tabpanel" aria-labelledby="headingOne_17">
                            <div class="panel-body">

                                <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Monthly Target</th>
                                        <th>Phone</th>
                                        <th>Performance</th>
                                        {{--<th>Manage</th>--}}
                                        <th>Report</th>
                                    </tr>
                                    </thead>
                                    <tfoot>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Monthly Target</th>
                                        <th>Phone</th>
                                        <th>Performance</th>
                                        {{--<th>Manage</th>--}}
                                        <th>Report</th>
                                    </tr>
                                    </tfoot>
                                    <tbody>
                                    @foreach($team['members'] as $member)
                                        <tr>
                                            <td>{{$member->f_name}} &nbsp; {{$member->l_name}}</td>
                                            <td>{{$member->email}}</td>
                                            <td>{{$member->monthly_target}}</td>
                                            <td>{{$member->staff_mobile}}</td>
                                            <td><a href="/team_user_performance/{{$member->id}}">Performance</a> </td>
                                            {{--<td><a href="#">Manage</a> </td>--}}
                                            <td><a id="single" data-id="{{$member->id}}" data-toggle="modal" data-target="#singleReport">Report</a> </td>
                                        </tr>

                                    @endforeach

                                    </tbody>
                                </table>
                                <br>

                                <table class="table-bordered table-striped">
                                    <tr>
                                        <td>Agent Name</td>
                                        <td>January</td>
                                        <td>February</td>
                                        <td>March</td>
                                        <td>April</td>
                                        <td>May</td>
                                        <td>June</td>
                                        <td>July</td>
                                        <td>August</td>
                                        <td>September</td>
                                        <td>October</td>
                                        <td>November</td>
                                        <td>December</td>
                                    </tr>


                                    @foreach($team['agents'] as $agent)


                                        @if($team['team_id']== $agent['team_id'])
                                        <tr>
                                            <td>{{$agent['agent_name']}}</td>
                                            <td>{{$agent['jan']}}</td>
                                            <td>{{$agent['feb']}}</td>
                                            <td>{{$agent['mar']}}</td>
                                            <td>{{$agent['apr']}}</td>
                                            <td>{{$agent['may']}}</td>
                                            <td>{{$agent['jun']}}</td>
                                            <td>{{$agent['jul']}}</td>
                                            <td>{{$agent['aug']}}</td>
                                            <td>{{$agent['sep']}}</td>
                                            <td>{{$agent['oct']}}</td>
                                            <td>{{$agent['nov']}}</td>
                                            <td>{{$agent['dec']}}</td>
                                        </tr>

                                        @endif
                                    @endforeach
                                </table>

                                <a id="team" data-id="{{$team['team_id']}}" data-toggle="modal" data-target="#teamReport">Full Report (Team)</a>

                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif
            </div>
        </div>
    </div>
    <!-- #END# Tabs With Icon Title -->
    <!-- For Material Design Colors -->

    <!-- Default Size -->
    <div class="modal fade" id="teamReport" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                    <div class="card">
                        <div class="header bg-teal">
                            <h2>
                                Make Report
                            </h2>
                        </div>
                        <div class="body">
                            <div class="row clearfix">

                                <form method="post" action="/team_report">

                                <!--                    <meta name="csrf-token" content="{{ csrf_token() }}">-->
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" id="team_id" name="team_id" value="">


                                    <div class="col-md-12">
                                        <p>
                                            <b>Month</b>
                                        </p>
                                        <select class="form-control show-tick" data-live-search="true" name="month">
                                            <option value="01">January</option>
                                            <option value="02">February</option>
                                            <option value="03">March</option>
                                            <option value="04">April</option>
                                            <option value="05">May</option>
                                            <option value="06">June</option>
                                            <option value="07">July</option>
                                            <option value="08">August</option>
                                            <option value="09">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <p>
                                            <b>Year</b>
                                        </p>
                                        <select class="form-control show-tick" data-live-search="true" name="year">
                                            <?php
                                            for($i = 2016; $i < date("Y")+1; $i++){
                                                echo '<option value="'.$i.'">'.$i.'</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>

                                    <div class="col-md-12">
                                        <hr>
                                    </div>



                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-link waves-effect">SEARCH</button>
                                        <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                    </div>


                                </form>
                            </div>



                        </div>
                    </div>



            </div>
        </div>
    </div>

    <!-- Default Size -->
    <div class="modal fade" id="singleReport" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">


                <div class="card">
                    <div class="header bg-teal">
                        <h2>
                            Make Report
                        </h2>
                    </div>
                    <div class="body">
                        <div class="row clearfix">

                            <form method="post" action="/team_user_report">

                            <!--                    <meta name="csrf-token" content="{{ csrf_token() }}">-->
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <input type="hidden" id="user_id" name="user_id" value="">

                                <div class="col-md-12">
                                    <p>
                                        <b>Report Type</b>
                                    </p>
                                    <select class="form-control show-tick" data-live-search="true" name="report_type">
                                        <option value="agents">No. of Agent Added</option>
                                        <option value="Queries">Queries</option>
                                        <option value="Confirmation">Confirmations</option>
                                        <option value="Visit">Visits</option>
                                        <option value="Calls">Calls</option>
                                        <option value="Cancellations">Cancellations</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <p>
                                        <b>Month</b>
                                    </p>
                                    <select class="form-control show-tick" data-live-search="true" name="month">
                                        <option value="01">January</option>
                                        <option value="02">February</option>
                                        <option value="03">March</option>
                                        <option value="04">April</option>
                                        <option value="05">May</option>
                                        <option value="06">June</option>
                                        <option value="07">July</option>
                                        <option value="08">August</option>
                                        <option value="09">September</option>
                                        <option value="10">October</option>
                                        <option value="11">November</option>
                                        <option value="12">December</option>
                                    </select>
                                </div>

                                <div class="col-md-12">
                                    <p>
                                        <b>Year</b>
                                    </p>
                                    <select class="form-control show-tick" data-live-search="true" name="year">
                                        <?php
                                        for($i = 2016; $i < date("Y")+1; $i++){
                                            echo '<option value="'.$i.'">'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-link waves-effect">SEARCH</button>
                                    <button type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</button>
                                </div>


                            </form>
                        </div>



                    </div>
                </div>



            </div>
        </div>
    </div>

    <script>
        $(document).on("click", "#team", function() {
            var teamID = $(this).data('id');
            $(".modal-content #team_id").val( teamID );
        });

        $(document).on("click", "#single", function() {
            var teamID = $(this).data('id');
            $(".modal-content #user_id").val( teamID );
        });
    </script>


    <script>
        $(document).ready(function () {
            $('.js-exportable').DataTable({
                dom: 'Bfrtip'
                , buttons: [
                    'csv', 'excel', 'pdf', 'print'
                ]
            });
        });
    </script>

@endsection