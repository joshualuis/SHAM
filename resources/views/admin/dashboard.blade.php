@extends('layouts.master')

@section('title')
DASHBOARD
@endsection

@section('pagetitle')
   DASHBOARD (S.Y. {{$year->year}})
@endsection

@section('css')
@endsection

@section('content')

                <div class="container-fluid">
	                <div class="row">
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/abmLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>ABM</p>
	                                            {{$countabm}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under Accountancy and Business Management."></i></div>
                                    	<a href="/admin/drill/{{$abmStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    								
                                    </div>
                                </div>
	                        </div>
	                    </div>

                        <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/gasLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>GAS</p>
	                                            {{$countgas}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under General Academic."></i></div>
										<a href="/admin/drill/{{$gasStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    	
                                    </div>
                                </div>
	                        </div>
	                    </div>

                        <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/humssLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>HUMSS</p>
	                                            {{$counthumss}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under Humanities and Social Sciences."></i></div>
										<a href="/admin/drill/{{$humssStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    	
                                    </div>
                                </div>
	                        </div>
	                    </div>

                        <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/stemLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>STEM</p>
	                                            {{$countstem}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under Science, Technology, Engineering, and Mathematics."></i></div>
										<a href="/admin/drill/{{$stemStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    	
                                    </div>
                                </div>
	                        </div>
	                    </div>

                    </div>
	            </div>

                <div class="container-fluid">
	                <div class="row">
	                    <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/careLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>CAREGIVING</p>
	                                            {{$countcare}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under Caregiving (Nursing Arts)."></i></div>
										<a href="/admin/drill/{{$careStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    	
                                    </div>
                                </div>
	                        </div>
	                    </div>

                        <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/eimLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>EIM</p>
	                                            {{$counteim}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under Electrical Installation and Maintenance."></i></div>
										<a href="/admin/drill/{{$eimStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    	
                                    </div>
                                </div>
	                        </div>
	                    </div>

                        <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/heLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>HE</p>
	                                            {{$counthe}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under Home Economics."></i></div>
										<a href="/admin/drill/{{$heStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    	
                                    </div>
                                </div>
	                        </div>
	                    </div>

                        <div class="col-lg-3 col-sm-6">
	                        <div class="card">
	                            <div class="card-content">
	                                <div class="row">
	                                    <div class="col-xs-5">
	                                        <div class="icon-big icon-warning text-center" style="padding-left:20px;">
                                                <img src="../assets/img/ictLogo.png" />
	                                        </div>
	                                    </div>
	                                    <div class="col-xs-7">
	                                        <div class="numbers">
	                                            <p>ICT</p>
	                                            {{$countict}}
	                                        </div>
	                                    </div>
	                                </div>
	                            </div>
                              <div class="card-footer">
                                <hr />
                                <div class="stats">
                                    <div class="pull-right" style="position:relative; display:inline-block;"><i class="fa fa-question-circle" data-toggle="tooltip" data-placement="top" rel="tooltip" title="Number of enrolled students under Information and Communications Technology."></i></div>
										<a href="/admin/drill/{{$ictStrand->id}}"><i class="ti-clipboard"></i><div class="my-inline-block" id="campaign-name4"></div></a>    	
                                    </div>
                                </div>
	                        </div>
	                    </div>

                    </div>
	            </div>


				<div class="container-fluid">
					<div class="row">
						<div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Deadline of Grades:

									@if(Auth::user()->role == "admin")
										<a href="/admin/deadline/{{$register->_id}}/edit"> <button type="submit" id="enrollBtn" class="btn btn-success pull-right">EDIT</button></a>
									@endif
									</h4>
									
									<div class="card-body ">
										<hr>
										@if($register->deadStat == 'Open')
										<h5>Status: Open</h5>
										@else
											<h5>Deadline Status: Close</h5>
										@endif
										<hr>
										<h5>Duration: <br> Start: {{$dstart}} <br> End: {{$dend}}</h5>
										<hr>
									</div>
								
									
								</div>
							</div>
						</div>

						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">REGISTRATION: (S.Y. {{$register->year->year}})
									@if(Auth::user()->role == "admin")
										<a href="/admin/registrations/{{$register->_id}}/edit"> <button type="submit" id="enrollBtn" class="btn btn-success pull-right">EDIT</button></a>
									@endif
									</h4>
									
									<div class="card-body ">
										<hr>
										@if($register->status == 'Open')
										<h5>Status: Open</h5>
										@else
											<h5>Registration Status: Close</h5>
										@endif
										<hr>
										<h5>Duration: {{$start}} - {{$end}}</h5>
										<hr>
										<h5>Applicants: {{$countapplicants}}</h5>
										<hr>
										<h5>Shortlisteds: {{$countshortlisteds}}</h5>
										<hr>
										<h5>Students: {{$countstudents}}</h5>
										<hr>
									</div>
								
									
								</div>
							</div>
						</div>

					</div>
				</div>

@endsection

@section('script') 
@endsection


