@extends('layouts.master')

@section('title')
   TEACHERS
@endsection

@section('pagetitle')
   TEACHERS
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
                   <div class="col-md-12">
                     <a href="/admin/teachers">
                           <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
                           <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
                           </button>
                        </a><br><br>
                  </div>

	                    <div class="col-lg-4 col-md-5">
                        
	                        <div class="card card-user">
	                            <br><br>
	                            <div class="card-content">
	                                <div class="author">
										<br><br>
	                                  <img class="avatar border-white" src="{{URL::asset($teacher->image)}}" alt="..."/>
	                                  <h4 class="card-title">{{$teacher->fullname}}
	                                  </h4>
                                     <h5 class="card-title">
									 	<a href="#">POSITION TITLE: {{$teacher->position}}</a><br />
										<a href="#">EMAIL: {{$teacher->email}}</a><br />
										<a href="#">CONTACT: {{$teacher->contact}}</a>
									
	                                  </h5>
									</div>
	                            </div>
	                            <hr>
	                        </div>
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
	                                    
	                                   
	                                    
	                                    <div class="clearfix"></div>
	                            </div>
	                        </div>
	                    </div>


						<div class="col-lg-12">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title"><b>Educational Background</b></h4>
	                            </div>
	                            <div class="card-content">
										<div class="row">
											<div class="col-sm-4">
												<div class="form-group">
													<label class="control-label">Highest Educational Attainment</label>
													<input type="text" class="form-control border-input" disabled placeholder="Highest Education Attainment" value="{{$teacher->educattainment}}">
												</div>
											</div>

											<div class="col-sm-4">
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
                                        
	                                    
	                                    <div class="clearfix"></div>
	                            </div>
	                        </div>
	                    </div>

	                </div>
	            </div>

@endsection