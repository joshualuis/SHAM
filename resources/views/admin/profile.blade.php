@extends('layouts.master')

@section('title')
	ADMIN PROFILE
@endsection

@section('pagetitle')
   ADMINISTRATOR
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
	                                  <img class="avatar border-white" src="{{URL::asset($admin->image)}}" alt="..."/>
	                                  <h4 class="card-title">{{$admin->name}}<br /><br />
                                         <a href="#"><small>{{$admin->email}}</small></a><br />
	                                     <a href="#"><small>{{$admin->status}}</small></a><br />
                                         <a href="#"><small>{{$admin->role}}</small></a>
	                                  </h4>
									  <a href="/user/showChange"><button type="submit" class="btn btn-primary btn-fill btn-wd">Change Password</button></a>
	                                </div>
	                            </div>
	                            <hr>
	                        </div>
	                    </div>
	                    <div class="col-lg-8 col-md-7">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">Profile</h4>
	                            </div>
	                            <div class="card-content">
									<div class="row">
										<div class="col-md-6">
											<div class="form-group">
												<label>Name</label>
												<input type="text" class="form-control border-input" disabled placeholder="Birthdate" value="{{$admin->name}}">
											</div>
										</div>
									</div>
										
									
									<div class="row">
										<div class="col-md-4">
											<div class="form-group">
												<label>Email</label>
												<input type="text" class="form-control border-input" disabled placeholder="Gender" value="{{$admin->email}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Status</label>
												<input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$admin->status}}">
											</div>
										</div>
										<div class="col-md-4">
											<div class="form-group">
												<label>Role</label>
												<input type="text" class="form-control border-input" disabled placeholder="Civil Status" value="{{$admin->role}}">
											</div>
										</div>
									</div>

				
									<div class="text-center">
										<a href="/admin/edit/{{$admin->id}}"><button type="submit" class="btn btn-info btn-fill btn-wd">Edit Profile</button></a>
										
									</div>
									<div class="clearfix"></div>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>

@endsection