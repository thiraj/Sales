@extends('layouts.master')

@section('content')


   <!-- Widgets -->
            <div class="row clearfix">

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-pink hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">playlist_add_check</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Markets</div>
                            <div class="number count-to" data-from="0" data-to="{{$total['market']}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-cyan hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">person_add</i>
                        </div>
                        <div class="content">
                            <div class="text">Total Agents</div>
                            <div class="number count-to" data-from="0" data-to="{{$total['agent']}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-light-green hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">help</i>
                        </div>
                        <div class="content">
                            <div class="text">Target Per Month</div>
                            <div class="number count-to" data-from="0" data-to="{{$total['target']}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box bg-orange hover-expand-effect">
                        <div class="icon">
                            <i class="material-icons">forum</i>
                        </div>
                        <div class="content">
                            <div class="text">All Performances</div>
                            <div class="number count-to" data-from="0" data-to="{{$total['query']}}" data-speed="1000" data-fresh-interval="20"></div>
                        </div>
                    </div>
                </div>
            </div>
            {{--<!-- #END# Widgets -->  --}}
            {{----}}
            {{--<!-- Answered Tickets -->--}}
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-orange">
                            <div class="font-bold m-b--35" style="color: black;">THIS YEAR - {{date('Y',time())}}</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    Queries
                                    <span class="pull-right"><b>{{$total['query_year']}}</b> </span>
                                </li>
                                <li>
                                    Confirmations
                                    <span class="pull-right"><b>{{$total['confirm_year']}}</b> </span>
                                </li>
                                <li>
                                    Calls
                                    <span class="pull-right"><b>{{$total['call_year']}}</b> </span>
                                </li>
                                <li>
                                    Visits
                                    <span class="pull-right"><b>{{$total['visit_year']}}</b> </span>
                                </li>
                                <li>
                                    New Agents
                                    <span class="pull-right"><b>{{$total['agent_year']}}</b> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                {{--<!-- #END# Answered Tickets -->--}}
                {{----}}
                {{----}}
                {{--<!-- Answered Tickets -->--}}
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-teal">
                            <div class="font-bold m-b--35" style="color: black;">THIS MONTH - {{date('Y-M',time())}}</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    Queries
                                    <span class="pull-right"><b>{{$total['query_month']}}</b> </span>
                                </li>
                                <li>
                                    Confirmations
                                    <span class="pull-right"><b>{{$total['confirm_month']}}</b> </span>
                                </li>
                                <li>
                                    Calls
                                    <span class="pull-right"><b>{{$total['call_month']}}</b> </span>
                                </li>
                                <li>
                                    Visits
                                    <span class="pull-right"><b>{{$total['visit_month']}}</b> </span>
                                </li>
                                <li>
                                    New Agents
                                    <span class="pull-right"><b>{{$total['agent_month']}}</b> </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->


                <!-- Answered Tickets -->
                <div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
                    <div class="card">
                        <div class="body bg-light-green">
                            <div class="font-bold m-b--35" style="color: black;">TODAY - {{date('Y-M-d',time())}}</div>
                            <ul class="dashboard-stat-list">
                                <li>
                                    Queries
                                    <span class="pull-right"><b>{{$total['query_today']}}</b></span>
                                </li>
                                <li>
                                    Confirmations
                                    <span class="pull-right"><b>{{$total['confirm_today']}}</b> </span>
                                </li>
                                <li>
                                    Calls
                                    <span class="pull-right"><b>{{$total['call_today']}}</b> </span>
                                </li>
                                <li>
                                    Visits
                                    <span class="pull-right"><b>{{$total['visit_today']}}</b> </span>
                                </li>
                                <li>
                                    New Agents
                                    <span class="pull-right"><b>{{$total['agent_today']}}</b> </span>
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>
                <!-- #END# Answered Tickets -->



@endsection