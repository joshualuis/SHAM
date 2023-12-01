@extends('layouts.master')

@section('title')
APPLICANTS
@endsection

@section('pagetitle')
   APPLICANTS
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
            <a href="javascript:history.back()">
                          <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	                        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	                        </button>
                        </a><br><br>
                        
	                <div class="row">
	                    <div class="col-lg-4 col-sm-5">
	                        <div class="card card-user">
	                            <br><br>
	                            <div class="card-content">
	                                <div class="author">
                                    <br><br>
	                                  <img class="avatar border-white" src="{{URL::asset($applicant->image)}}" alt="..."/>
	                                  <h4 class="card-title">{{$applicant->fullname}}<br>
	                                  </h4>
                                    <h5 class="card-title">
                                        <a href="#">Application ID: {{$applicant->id}}</a><br>
                                         <a href="#">LRN: {{$applicant->lrn}}</a><br>
	                                     <a href="#">EMAIL: {{$applicant->email}}</a><br />
                                         <a href="#">CONTACT: {{$applicant->contact}}</a>
	                                  </h4>
									  
	                                </div>
	                            </div>
	                            <hr>
                            
	                        </div>
	                    </div>
	                    <div class="col-lg-8 col-sm-7">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title"><b>PERSONAL INFORMATION</b></h4>
	                            </div>
	                            <div class="card-content">

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Status</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Status" value="{{$applicant->status}}">
                                        </div>
                                    </div>
                                                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="psanumber" class="control-label">PSA No.</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="PSA Number" value="{{$applicant->psanumber}}">
                                            
                                        </div>
                                    </div>
                                  
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Age</label>
                                            <input type="number" class="form-control border-input" disabled placeholder="Age" value="{{$applicant->age}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label>Birthdate</label>
                                            <input type="date" class="form-control border-input" disabled placeholder="Birthdate" value="{{$applicant->birthdate}}">
                                        </div>
                                    </div>


                                </div>
                                  
                                
                                <div class="row">
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Gender" value="{{$applicant->gender}}">
                                    </div>
                                  </div>
                                  <div class="col-sm-4">
                                    <div class="form-group">
                                      <label>Mother Toungue</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="Mother Toungue" value="{{$applicant->mothertongue}}">
                                    </div>
                                  </div>

                                  <div class="col-sm-4">
                                    <div class="form-group">
                                      <label>Religion</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="Religion" value="{{$applicant->religion}}">
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-sm-3">
                                    <div class="form-group">
                                      <label>House No. & Street</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="House No. & Street" value="{{$applicant->housestreet}}">
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label>Barangay</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="Barangay" value="{{$applicant->barangay}}">
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="City" value="{{$applicant->city}}">
                                    </div>
                                  </div>

                                  <div class="col-sm-2">
                                    <div class="form-group">
                                      <label>Province</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="Province" value="{{$applicant->province}}">
                                    </div>
                                  </div>

                                  <div class="col-sm-3">
                                    <div class="form-group">
                                        <label>Region</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Region" value="{{$applicant->region}}">
                                    </div>
                                  </div>

                                </div>

                             <br>
	                            </div>
	                        </div>
	                    </div>
	                </div>


                <div class="row">
                    <div class="col-sm-6">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title"><b>GRADE LEVEL AND SCHOOL INFORMATION</b></h4>
                            </div>

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                        <label>Current Student</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Grade Level" value="{{$applicant->studentstatus}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-5">
                                        <div class="form-group">
                                            <label class="control-label">Year to Finish Grade 10</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Year to Finish Grade 10" value="{{$applicant->yeartofinish}}">
                                        </div>
                                    </div>

                                    <div id="sectionfield" class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Section</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Section" value="{{$applicant->section}}">
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Last School Attended</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Last School Attended" value="{{$applicant->lastschoolattended}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Last School Address</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Last School Address" value="{{$applicant->lastschooladdress}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">School ID</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="School ID" value="{{$applicant->schoolid}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">School Type</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="School Type" value="{{$applicant->schooltype}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">School to Enroll</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="School to Enroll" value="{{$applicant->schooltoenroll}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">School Address</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="School Address" value="{{$applicant->schooladdress}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="semester" class="control-label">Semester to Enroll</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Semester to Enroll" value="{{$applicant->semester}}">
                                        </div>
                                    </div>
                                </div>
                            </div>


                        </div>
                    </div>


                    <div class="col-sm-6">
                        <div class="card">

                            <div class="card-header">
                                <h4 class="card-title"><b>GRADES AND STRAND</b></h4>
                            </div>

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <h6 class="card-title"><b>GRADES</b></h6>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="englishgrade" class="control-label">English</label>
                                            <input type="number" class="form-control border-input" disabled placeholder="english grade" value="{{$applicant->englishgrade}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="mathgrade" class="control-label">Mathematics</label>
                                            <input type="number" class="form-control border-input" disabled placeholder="mathematics grade" value="{{$applicant->mathgrade}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="sciencegrade" class="control-label">Science</label>
                                            <input type="number" class="form-control border-input" disabled placeholder="science grade" value="{{$applicant->sciencegrade}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="filipinograde" class="control-label">Fiipino</label>
                                            <input type="number" class="form-control border-input" disabled placeholder="filipino grade" value="{{$applicant->filipinograde}}">
                                        </div>
                                    </div>
                                
                                    <div class="col-sm-12">
                                        <h6 class="card-title"><b>CHOSEN STRANDS</b></h6>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="firstchoice" class="control-label">First Choice</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="first choice" value="{{$applicant->firstchoice}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="secondchoice" class="control-label">Second Choice</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="second choice" value="{{$applicant->secondchoice}}">
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="thirdchoice" class="control-label">Third Choice</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="third choice" value="{{$applicant->thirdchoice}}">
                                        </div>
                                    </div>

                                </div>

                            </div>


                        </div>
                    </div>

                </div> 

                  <div class="row">
                    <div class="col-sm-12">
                      <div class="card">

                        <div class="card-header">
                          <h4 class="card-title"><b>PARENT/GUARDIAN INFORMATION</b></h4>
                        </div>

                        <div class="card-content">
                        <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fathername" class="control-label">Father's Name</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Father's Name" value="{{$applicant->fathername}}">
                                            
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fathereducation" class="control-label">Highest Educational Attainment</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Highest Educational Attainment" value="{{$applicant->fathereducation}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fatheremployment" class="control-label">Employment Status</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Employment Status" value="{{$applicant->fatheremployment}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fatherworkstat" class="control-label">WFH due to ECQ?</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="" value="{{$applicant->fatherworkstat}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fathercontact" class="control-label">Father's Contact</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="" value="{{$applicant->fathercontact}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mothername" class="control-label">Mother's Maiden Name</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Mother's Name" value="{{$applicant->mothername}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mothereducation" class="control-label">Highest Educational Attainment</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Highest Educational Attainment" value="{{$applicant->mothereducation}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="motheremployment" class="control-label">Employment Status</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Employment Status" value="{{$applicant->motheremployment}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="motherworkstat" class="control-label">WFH due to ECQ?</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="" value="{{$applicant->motherworkstat}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="mothercontact" class="control-label">Mother's Contact</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="" value="{{$applicant->mothercontact}}">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="guardianname" class="control-label">Guardian's Name</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Guardian's Name" value="{{$applicant->guardianname}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="guardianeducation" class="control-label">Highest Educational Attainment</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Highest Educational Attainment" value="{{$applicant->guardianeducation}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardianemployment" class="control-label">Employment Status</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="Employment Status" value="{{$applicant->guardianemployment}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardianworkstat" class="control-label">WFH due to ECQ?</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="" value="{{$applicant->guardianworkstat}}">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardiancontact" class="control-label">Guardian's Contact</label>
                                            <input type="text" class="form-control border-input" disabled placeholder="" value="{{$applicant->guardiancontact}}">
                                        </div>
                                    </div>
                                </div>


                          
                        </div>

                      </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                      <div class="card">

                        <div class="card-header">
                          <h4 class="card-title"><b>MORE INFORMATION</b></h4>
                        </div>

                        <div class="card-content">

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="indipeople" class="control-label">A part of indigenous people?</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="A part of indigenous people?" value="{{$applicant->yesindipeople}}" name="indipeople">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="specialneeds" class="control-label">Have special needs?</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Have special needs?" value="{{$applicant->yesspecialneeds}}" name="specialneeds">
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="assistivedevices" class="control-label">Have assistive devices?</label>
                                        <input type="text" class="form-control border-input" disabled placeholder="Have assistive devices?" value="{{$applicant->yesassistivedevices}}" name="assistivedevices">
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Birth Certificate</label><br>
                                        <a href="{{ URL::asset($applicant->birthcertificate) }}" target="_blank">
                                            <img src="{{ URL::asset($applicant->birthcertificate) }}" style="width:100px; height:100px; margin-left:10px;" />
                                        </a><br><br>
                                    </div>
                                </div>

                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label class="control-label">Report Card</label><br>
                                        <a href="{{ URL::asset($applicant->reportcard) }}" target="_blank">
                                            <img src="{{ URL::asset($applicant->reportcard) }}" style="width:100px; height:100px; margin-left:10px;" />
                                        </a><br><br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                      </div>
                    </div>
                  </div> 


                
@endsection