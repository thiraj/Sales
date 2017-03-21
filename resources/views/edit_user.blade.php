
                <div class="row clearfix">

                    <form name="edit_user_frm" id="edit_user_frm">
                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">First Name</label>
                                <div class="form-line">
                                    <meta name="csrf-token" content="{{ csrf_token() }}">
                                    <input name="f_name" id="f_name"  type="text" class="form-control"  placeholder="{{$profile->f_name}}" value="{{$profile->f_name}}">
                                    <input name="user_id" id="user_id"  type="hidden" value="{{$profile->id}}">
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Last Name</label>
                                <div class="form-line">
                                    <input name="l_name" type="text" class="form-control" placeholder="{{$profile->l_name}}" value="{{$profile->l_name}}" />
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Email</label>
                                <div class="form-line">
                                    <input name="email" type="text"  class="form-control" placeholder="{{$profile->email}}" value="{{$profile->email}}" />
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Verify Email</label>
                                <div class="form-line">
                                    <input name="email_confirmation" type="text" class="form-control" placeholder="Verify Email" value="{{$profile->email}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Password</label>
                                <div class="form-line">
                                    <input name="password" type="password"  class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Verify Password</label>
                                <div class="form-line">
                                    <input name="password_confirmation" type="password" class="form-control">
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Phone Number</label>
                                <div class="form-line">
                                    <input name="phone" class="form-control" type="text" placeholder="{{$profile->staff_mobile}}" value="{{$profile->staff_mobile}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Country</label>
                                <div class="form-line">
                                    <input name="country" type="text" class="form-control" placeholder="{{$profile->country}}" value="{{$profile->country}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Date Joined</label>
                                <div class="form-line">
                                    <input name="date_joined" type="text" class="datepicker form-control" placeholder="{{$profile->date_joined}}" value="{{$profile->date_joined}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Covering Countries</label>
                                <div class="form-line">
                                    <input name="cover_country" type="text" class="form-control" placeholder="{{$profile->covered_country}}" value="{{$profile->covered_country}}"/>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Covering Cities</label>
                                <div class="form-line">
                                    <input name="cover_city" type="text" class="form-control" placeholder="{{$profile->covered_city}}" value="{{$profile->covered_city}}" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Staff Under You</label>
                                <div class="form-line">

                                    <input name="staff_under" type="text" class="form-control" placeholder="{{$profile->staff_below}}" value="{{$profile->staff_below}}"/>

                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Monthly Target</label>
                                <div class="form-line">
                                    <input name="monthly_target" type="text" class="form-control" placeholder="{{$profile->monthly_target}}" value="{{$profile->monthly_target}}"/>
                                </div>
                            </div>
                        </div>


                        <div class="col-sm-12 col-md-6">
                            <div class="form-group">
                                <label class="form-label">Profile image</label>
                                <div class="form-line">
                                    <input name="profile_img" type="file" class="form-control" placeholder="Profile image" />
                                </div>
                            </div>
                        </div>




                        <div class="modal-footer">
                            <button type="submit" class="btn btn-link waves-effect">UPDATE</button>
                            <a type="button" class="btn btn-link waves-effect" data-dismiss="modal">CLOSE</a>
                        </div>

                    </form>
                {{--</div>--}}



            </div>
        </div>

        <script>
            // User Edit Form Submission
            $( '#edit_user_frm' ).on( 'submit', function(e) {
                e.preventDefault();


                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                // data:new FormData($("#profile_edit")[0]),


                var datastring = new FormData($(this)[0]);

                $.ajax({
                    type: "POST",
                    url: '/edit_user_submission',
                    // dataType:'json',
                    data:datastring,
                    processData: false,
                    contentType: false

                }).done(function( result ) {

                    var result = result;

                    if(result == 1){

                        $('#edit_user').modal('hide');
                        $('#success').modal('show');


                    }else if(result == 2){

                        $('#edit_user').modal('hide');
                        $('#error').modal('show');

                    }else {

                        $('#edit_user').modal('hide');
                        $('#error').modal('show');

                    }

                });

            });



            $('.datepicker').bootstrapMaterialDatePicker({

                time: false,
                dateFormat: "dd-mm-yy"
            });


        </script>