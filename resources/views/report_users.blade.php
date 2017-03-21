<div class="card">
            <div class="header bg-teal">
                <h2>
                    Make Report
                </h2>
            </div>
            <div class="body">
                <div class="row clearfix">

                    <form method="post" action="/reports">

<!--                    <meta name="csrf-token" content="{{ csrf_token() }}">-->
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                    <div class="col-md-12">
                        <p>
                            <b>Employee</b>
                        </p>
                        <select class="form-control show-tick" data-live-search="true" name="employee">
                            <option>Please Select...</option>
                            @foreach($users as $user)
                             <option value="{{$user->id}}">{{$user->f_name}} &nbsp;{{$user->l_name}}</option>
                            @endforeach
                        </select>
                    </div>
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
                            <option value="PAX">PAX</option>
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

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-12">
                        <input type="checkbox" id="md_checkbox_1" class="chk-col-red" name="full_report"/>
                        <label for="md_checkbox_1" style="color: red;">Full Performance Report (Check this, if you want to get Full report of all agents. If checked this, No individual agent report will be created)</label>
                    </div>



                    <div class="col-md-12">
                        <p>
                            <b>Year</b>
                        </p>
                        <select class="form-control show-tick" data-live-search="true" name="year_full">
                            <?php
                            for($i = 2016; $i < date("Y")+1; $i++){
                                echo '<option value="'.$i.'">'.$i.'</option>';
                            }
                            ?>
                        </select>
                    </div>

                    <div class="col-md-12">
                        <p>
                            <b>Month</b>
                        </p>
                        <select class="form-control show-tick" data-live-search="true" name="full_month">
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
