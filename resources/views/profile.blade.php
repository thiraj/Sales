@extends('layouts.master')

@section('content')


 <!-- Tabs With Icon Title -->
            <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header bg-red">
                            <h2>
                                Profile
                            </h2>
                         
                        </div>
                        <div class="body">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active col-amber">
                                    <a href="#home_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">supervisor_account</i> My Profile
                                    </a>
                                </li>
                                <li role="presentation" class="col-amber">
                                    <a href="#profile_with_icon_title" data-toggle="tab">
                                        <i class="material-icons">person_add</i> Edit Profile
                                    </a>
                                </li>
                               
                            </ul>

                            <!-- Tab panes -->
                            <div class="tab-content">
                                
                                <div role="tabpanel" class="row tab-pane fade in active" id="home_with_icon_title">
                                     <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
											<div class="card">
												<div class="header">
													<h2>
														Profile
													</h2>

												</div>
												<div class="body">
													<div class="row">
														<div class="col-sm-6 col-md-4">
															<div class="thumbnail">
																<img src="images/side-bg.png">
																<div class="caption" style="height: 300px;"><hr>
																	<h3>About You</h3>
																	<p>
																		{{$profile->about}}
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

														</div>
													</div>
												</div>
									 </div>
                				</div>   
                           
                                
                                
                                
                                <div role="tabpanel" class="tab-pane fade" id="profile_with_icon_title">
                                    <b>Edit Profile Form</b><br>
									<small>If you want to edit your profil, Please fill what you want to change.</small><hr>
                                    <div class="row clearfix" style="padding:1em;">

                                    		<form name="profile_edit" id="profile_edit">
											<div class="col-sm-12 col-md-6">
											<div class="form-group">
											<label class="form-label">First Name</label>
												<div class="form-line">
													<meta name="csrf-token" content="{{ csrf_token() }}">
													<input name="f_name" id="f_name"  type="text" class="form-control"  placeholder="{{$profile->f_name}}" value="{{$profile->f_name}}">
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


									

											<div class="col-sm-12 col-md-12">
												<div class="form-group">

														<input id="submit" type="submit" class="btn btn-success waves-effect col-md-4" value="Update">
														<input type="reset" class="btn btn-danger waves-effect col-md-4" value="Cancel">


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
				Your Profile was updated successfully.
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

@endsection