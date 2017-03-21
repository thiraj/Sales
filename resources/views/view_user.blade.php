
        {{--<div class="card">--}}
            {{--<div class="header bg-teal">--}}
                {{--<h2>--}}
                    {{--User Details--}}
                {{--</h2>--}}
            {{--</div>--}}
            {{--<div class="body">--}}
                {{--<div class="row clearfix">--}}

                    <div class="col-sm-6 col-md-4">
                        <div class="thumbnail">
                            <img src="images/side-bg.png">
                            <div class="caption" style="height: 300px;"><hr>
                                <h3>About You</h3>
                                <p>
                                    Hard Coded About you section. Description about you go here
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="col-sm-6 col-md-8">
                        <div class="body table-responsive">
                            <table class="table">

                                <tbody>
                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">FIRST NAME:</th>
                                    <td>{{$profile->f_name}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">LAST NAME:</th>
                                    <td>{{$profile->l_name}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">E-MAIL:</th>
                                    <td>{{$profile->email}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">MOBILE:</th>
                                    <td>{{$profile->staff_mobile}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">DATE JOINED:</th>
                                    <td>{{$profile->date_joined}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">COUNTRY:</th>
                                    <td>{{$profile->country}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">COUNTRY COVERED:</th>
                                    <td>{{$profile->country_covered}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">CITY COVERED:</th>
                                    <td>{{$profile->city_covered}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">STAFF BELOW:</th>
                                    <td>{{$profile->staff_below}}</td>
                                </tr>

                                <tr>
                                    <th style="width: 35%; font-size: 12px; color:  #0091ea;">MONTHLY TARGET:</th>
                                    <td>{{$profile->monthly_target}}</td>
                                </tr>

                                </tbody>
                            </table>
                        </div>
                    </div>

                {{--</div>--}}


                <div class="modal-footer">
                    {{--<button type="submit" class="btn btn-link waves-effect">SEARCH</button>--}}
                    <a type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</a>
                </div>



            {{--</div>--}}
        {{--</div>--}}
