@extends('layouts.master')

@section('title')
	TEACHER PROFILE
@endsection

@section('pagetitle')
   WELCOME, {{$teacher->lname}}!
@endsection

@section('css')
@endsection

@section('content')
@if(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
@endif
<div class="container-fluid">
	                <div class="row">
	                    <div class="col-lg-4 col-md-5">
	                        <div class="card card-user">
	                            <div class="image">
	                                <img src="../../assets/img/background.jpg" alt="..."/>
	                            </div>
	                            <div class="card-content">
	                                <div class="author">
	                                  <img class="avatar border-white" src="{{URL::asset($teacher->image)}}" alt="..."/>
	                                  <h5 class="card-title">{{$teacher->fullname}}<br /><br />
									  	<a href="#">POSITION TITLE: {{$teacher->position}}</a><br />
										<a href="#">EMAIL: {{$teacher->email}}</a><br />
										<a href="#">CONTACT: {{$teacher->contact}}</a>
	                                  </h5>
									  <a href="/user/showChange"><button type="submit" class="btn btn-primary btn-fill btn-wd">Change Password</button></a>
	                                </div>
	                            </div>
	                            <hr>
	                        </div>
	                        <!-- <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">Classes</h4>
	                            </div>
	                            <div class="card-content" style="overflow-y: auto; max-height:300px;">
	                                <ul class="list-unstyled team-members">
                                        <li>
                                            <div class="row">
                                                <div class="col-xs-9">Subject Name 
                                                    <br />
                                                    <span class="text-muted"><small>Section</small></span>
                                                </div>
                                                <div class="col-xs-3 text-right">
                                                    <btn class="btn btn-sm btn-success btn-icon"><i class="fa fa-eye"></i></btn>
                                                </div>
                                            </div>
                                        </li>
                                       
	                                </ul>
	                            </div>
	                        </div> -->
	                    </div>
	                    <div class="col-lg-8 col-md-7">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title"><b>Profile</b></h4>
	                            </div>
	                            <div class="card-content">
	                                    <div class="row">
	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Age</label>
	                                                <input type="number" class="form-control border-input" disabled placeholder="Age" value="{{$teacher->age}}">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Birthdate</label>
	                                                <input type="text" class="form-control border-input" disabled placeholder="Birthdate" value="{{$teacher->birthdate}}">
	                                            </div>
	                                        </div>
                                            </div>
	                                        
	                                    
	                                    <div class="row">
                                            <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Gender</label>
	                                                <input type="text" class="form-control border-input" disabled placeholder="Gender" value="{{$teacher->gender}}">
	                                            </div>
	                                        </div>
	                                        <div class="col-md-6">
	                                            <div class="form-group">
	                                                <label>Civil Status</label>
	                                                <input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$teacher->civilstatus}}">
	                                            </div>
	                                        </div>
	                                    </div>

                                        <div class="row">
	                                        <div class="col-md-12">
	                                            <div class="form-group">
	                                                <label>Address</label>
	                                                <input type="text" class="form-control border-input" disabled placeholder="Home Address" value="{{$teacher->address}}">
	                                            </div>
	                                        </div>
	                                    </div>
	                                    
										
	                                    
	                            </div>

										<div class="card-header">
											<h4 class="card-title"><b>Educational Background</b></h4>
										</div>

										<div class="card-content">
											<div class="row">
												<div class="col-sm-6">
													<div class="form-group">
														<label class="control-label">Highest Educational Attainment</label>
														<input type="text" class="form-control border-input" disabled placeholder="Highest Education Attainment" value="{{$teacher->educattainment}}">
													</div>
												</div>

												<div class="col-sm-6">
													<div class="form-group">
														<label class="control-label">No. of Years Teaching</label>
														<input type="text" class="form-control border-input" disabled placeholder="Years of Teaching" value="{{$teacher->numberofteaching}}">
													</div>
												</div>
											
											</div>

											<div class="row">
												<div class="col-sm-4">
													<div class="form-group">
														<label class="control-label">Major in</label> 
														<input type="text" class="form-control border-input" disabled placeholder="Major in" value="{{$teacher->major}}">       
													</div>
												</div>

												<div class="col-sm-4">
													<div class="form-group">
														<label class="control-label">Minor in</label>
														<input type="text" class="form-control border-input" disabled placeholder="Minor in" value="{{$teacher->minor}}">
													</div>
												</div>
												<div class="col-sm-4">
													<div class="form-group">
														<label class="control-label">Certification/Trainings</label>
														<input type="text" class="form-control border-input" disabled placeholder="Certificates/Trainings" value="{{$teacher->certificate}}"> 
																		
													</div>
												</div>
											</div>
	                    				</div>



										<div class="text-center">
											<a href="/teacher/edit/{{$teacher->id}}"><button type="submit" class="btn btn-info btn-fill btn-wd">Edit Profile</button></a>

										</div>
										<br>
	                                    <div class="clearfix"></div>
	                        </div>
	                    </div>
	                </div>
	            </div>

@endsection