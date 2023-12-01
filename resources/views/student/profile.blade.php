@extends('layouts.master')

@section('title')
	STUDENT PROFILE
@endsection

@section('pagetitle')
   WELCOME, {{$student->lname}}!
@endsection

@section('css')
@endsection

@section('content')
				<div class="container-fluid">
	                <div class="row">
	                    <div class="col-lg-4 col-md-5">
	                        <div class="card card-user">
	                            <div class="image">
	                                <img src="../../assets/img/background.jpg" alt="..."/>
	                            </div>
	                            <div class="card-content">
	                                <div class="author">
	                                  <img class="avatar border-white" src="{{URL::asset($student->image)}}" alt="..."/>
	                                  <h4 class="card-title">{{$student->fullname}}
	                                  </h4>
									  <h5 class="card-title">
                                         <a href="#">LRN: {{$student->lrn}}</a><br />
	                                     <a href="#"> EMAIL: {{$student->email}}</a><br />
                                         <a href="#">CONTACT: {{$student->contact}}</a>
	                                  </h5>
									  <a href="/user/showChange"><button type="submit" class="btn btn-primary btn-fill btn-wd">Change Password</button></a>
	                                </div>
	                            </div>
	                            <hr>
                                <div class="text-center">
	                                <div class="row">
	                                    <div class="col-md-6">
	                                        <h5>Attendance<br /><small>{{$attend}}</small></h5>
	                                    </div>
	                                    <div class="col-md-6">
	                                        <h5>Absences <br /><small>{{$absent}}</small></h5>
	                                    </div>
	                                    
	                                </div>
	                            </div>
	                        </div>
	                    </div>
	                    <div class="col-lg-8 col-md-7">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">Profile</h4>
	                            </div>
	                            <div class="card-content">
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Grade Level</label>
												<input type="text" class="form-control border-input" disabled placeholder="Grade Level" value="{{$student->glevel}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Age</label>
												<input type="number" class="form-control border-input" disabled placeholder="Age" value="{{$student->age}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Birthdate</label>
												<input type="text" class="form-control border-input" disabled placeholder="Birthdate" value="{{$student->birthdate}}">
											</div>
										</div>
									</div>
										
									
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Gender</label>
												<input type="text" class="form-control border-input" disabled placeholder="Gender" value="{{$student->gender}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Mother Toungue</label>
												<input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$student->mothertongue}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Religion</label>
												<input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$student->religion}}">
											</div>
										</div>
									</div>

						

									<div class="row">
										<div class="col-md-2">
											<div class="form-group">
												<label for="housestreet" class="control-label">House Street</label>
												<input type="text" class="form-control border-input" disabled placeholder="House No. & Street" value="{{$student->housestreet}}">
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="barangay" class="control-label">Barangay</label>
												<input type="text" class="form-control border-input" disabled placeholder="barangay" value="{{$student->barangay}}">
											</div>
										</div>

										<div class="col-md-2">
											<div class="form-group">
												<label for="city" class="control-label">City</label>
												<input type="text" class="form-control border-input" disabled placeholder="city" value="{{$student->city}}">
											</div>
										</div>

										<div class="col-md-3">
											<div class="form-group">
												<label for="province" class="control-label">Province</label>
												<input type="text" class="form-control border-input" disabled placeholder="province" value="{{$student->province}}">
											</div>
										</div>

										<div class="col-md-2">
											<div class="form-group">
												<label for="region" class="control-label">Region</label>
												<input type="text" class="form-control border-input" disabled placeholder="region" value="{{$student->region}}">
											</div>
										</div>
									</div>
									
									<hr>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Mother's Name</label>
												<input type="text" class="form-control border-input" disabled placeholder="Gender" value="{{$student->mothername}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Contact Number</label>
												<input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$student->mothercontact}}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Father's Name</label>
												<input type="text" class="form-control border-input" disabled placeholder="Gender" value="{{$student->fathername}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Contact Number</label>
												<input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$student->fathercontact}}">
											</div>
										</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Guardian's Name</label>
												<input type="text" class="form-control border-input" disabled placeholder="Gender" value="{{$student->guardianname}}">
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-group">
												<label>Contact Number</label>
												<input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$student->guardiancontact}}">
											</div>
										</div>
									</div>

								
									
									<div class="text-center">
										<a href="/student/edit/{{$student->id}}"><button type="submit" class="btn btn-info btn-fill btn-wd">Edit Profile</button></a>
										
									</div>
									<div class="clearfix"></div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

@endsection