@extends('layouts.master')

@section('title')
STUDENT
@endsection

@section('pagetitle')
   STUDENT
@endsection

@section('css')

@endsection

@section('content')
{{ Form::model($student,['method'=>'PATCH' ,'route' => ['admin.showStudentUpdate', $student->_id, 'files' => true], 'enctype' => 'multipart/form-data']) }}
@csrf 

            <div class="container-fluid">
            <a href="javascript:history.back()">
                          <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	                        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	                        </button>
                        </a><br><br>
                        
	                <div class="row">
	                    <div class="col-lg-4 col-md-5">
	                        <div class="card card-user">
	                            <br><br>
	                            <div class="card-content">
	                                <div class="author">
                                    <br><br>
	                                  <img class="avatar border-white" src="{{URL::asset($student->image)}}" alt="..."/>
	                                  <h4 class="card-title">{{$student->fullname}}<br>
	                                  </h4>
                                    <h5 class="card-title">
                                         <a href="#">LRN: {{$student->lrn}}</a><br>
	                                     <a href="#">EMAIL: {{$student->email}}</a><br />
                                         <a href="#">CONTACT: {{$student->contact}}</a>
	                                  </h4>
									  
	                                </div>
	                            </div>
	                            <hr>
                            
	                        </div>
	                    </div>
	                    <div class="col-lg-8 col-md-7">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title"><b>PERSONAL INFORMATION</b></h4>
	                            </div>
	                            <div class="card-content">

                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Student Status</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="Status" value="{{$student->status}}">
                                      </div>
                                  </div>
                                                                    
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Grade Level</label>
                                      <input type="text" class="form-control border-input" disabled placeholder="Grade Level" value="{{$student->glevel}}" name="glevel">
                                    </div>
                                  </div>
                                  
                                  <!-- <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Age</label>
                                      <input type="number" class="form-control border-input" placeholder="Age" value="{{$student->age}}" name="age">
                                    </div>
                                  </div> -->

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Birthdate</label>
                                      <input type="date" class="form-control border-input" placeholder="Birthdate" value="{{$student->birthdate}}" name="birthdate">
                                    </div>
                                  </div>


                                </div>
                                  
                                
                                <div class="row">
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Gender</label>
                                      {!! Form::select('gender', ['male' => 'Male', 'female' => 'Female'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Mother Toungue</label>
                                      <input type="text" class="form-control border-input" placeholder="Civil Status" value="{{$student->mothertongue}}" name="mothertongue">
                                    </div>
                                  </div>
                                  <div class="col-md-4">
                                    <div class="form-group">
                                      <label>Religion</label>
                                      <input type="text" class="form-control border-input" placeholder="Civil Status" value="{{$student->religion}}" name="religion">
                                    </div>
                                  </div>
                                </div>

                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>House No. & Street</label>
                                      <input type="text" class="form-control border-input" placeholder="House No. & Street" value="{{$student->housestreet}}" name="housestreet">
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Barangay</label>
                                      <input type="text" class="form-control border-input" placeholder="Barangay" value="{{$student->barangay}}" name="barangay">
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>City</label>
                                      <input type="text" class="form-control border-input" placeholder="City" value="{{$student->city}}" name="city">
                                    </div>
                                  </div>

                                  <div class="col-md-2">
                                    <div class="form-group">
                                      <label>Province</label>
                                      <input type="text" class="form-control border-input" placeholder="Province" value="{{$student->province}}" name="province">
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>Region</label>
                                      <input type="text" class="form-control border-input" placeholder="Region" value="{{$student->region}}" name="region">
                                    </div>
                                  </div>

                                </div>

                             <br>
	                            </div>
	                        </div>
	                    </div>
	                </div>



                  <div class="row">
                    <div class="col-md-6">
                      <div class="card">

                        <div class="card-header">
                          <h4 class="card-title"><b>PARENT/GUARDIAN INFORMATION</b></h4>
                        </div>

                        <div class="card-content">
                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Mother's Maiden Name</label>
                                <input type="text" class="form-control border-input" placeholder="Gender" value="{{$student->mothername}}" name="mothername">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control border-input" placeholder="Civil Status" value="{{$student->mothercontact}}" name="mothercontact">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Father's Name</label>
                                <input type="text" class="form-control border-input" placeholder="Gender" value="{{$student->fathername}}" name="fathername">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control border-input" placeholder="Civil Status" value="{{$student->fathercontact}}" name="fathercontact">
                              </div>
                            </div>
                          </div>

                          <div class="row">
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Guardian's Name</label>
                                <input type="text" class="form-control border-input" placeholder="Gender" value="{{$student->guardianname}}" name="guardianname">
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="form-group">
                                <label>Contact Number</label>
                                <input type="text" class="form-control border-input" placeholder="Civil Status" value="{{$student->guardiancontact}}" name="guardiancontact">
                              </div>
                            </div>
                          </div>
                        </div>

                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="card">

                        <div class="card-header">
                          <h4 class="card-title"><b>MORE INFORMATION</b></h4>
                        </div>

                        <div class="card-content">

                          <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="indipeople" class="control-label">A part of indigenous people?</label>
                                    <input type="text" class="form-control border-input" disabled placeholder="A part of indigenous people?" value="{{$student->yesindipeople}}" name="indipeople">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="specialneeds" class="control-label">Have special needs?</label>
                                    <input type="text" class="form-control border-input" disabled placeholder="Have special needs?" value="{{$student->yesspecialneeds}}" name="specialneeds">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="assistivedevices" class="control-label">Have assistive devices?</label>
                                    <input type="text" class="form-control border-input" disabled placeholder="Have assistive devices?" value="{{$student->yesassistivedevices}}" name="assistivedevices">
                                </div>
                            </div>
                          </div>
                        </div>


                      </div>
                    </div>
                  </div> 

@if($student->status == 'Regular')
                <div class="row">
                  <div class="col-md-12">
                    <div class="card">

                    <div class="card-header">
                      <h4 class="card-title"><b>SCHEDULE:</b> {{$sem->semester}} Semester / School Year {{$year->year}}</h4>
                      <input type="hidden" name="section_id" value="{{$section->id}}">
                      <div style="margin-left:10px;"><h5>
                        <form action=""></form>
                        <form action="/admin/student/semester" id="first_form" method="POST">
                            <input type="hidden" name="semester_id" value="63f35b94bde739958336b5c8">
                            <input type="hidden" name="student_id" value="{{$student->id}}">
                            <a href="javascript:{}" onclick="document.getElementById('first_form').submit();">First Semester</a>
                        </form>
                        <form action="/admin/student/semester" id="second_form" method="POST">
                            <input type="hidden" name="semester_id" value="63f35b9bbde739958336b5c9">
                            <input type="hidden" name="student_id" value="{{$student->id}}">
                            <a href="javascript:{}" onclick="document.getElementById('second_form').submit();">Second Semester</a>
                        </form>
                      </div>
                    </div>

                      <div class="card-content">
                        <!-- -----------------MONDAY----------------- -->
                                      <div class="row">
                                        <div class="col-md-4 ">
                                            <label for="">MONDAY</label>
                                        </div>

                                        <div class="col-sm-12">
                                            <div id="show_mon">
                                                @foreach ($secSched as $sched)
                                                   @if ($sched->day == 'monday')
                                                            <div class="row">
                                                            
                                                            <div class="col-md-4 mb-3">Subject
                                                                {!! Form::select('mon_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">Teacher
                                                                {!! Form::select('mon_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            <div class="col-md-2 mb-3">Room
                                                                {!! Form::text('mon_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                                        
                                                            <div class="col-md-2 mb-3">Start
                                                            {!! Form::time('mon_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">End
                                                            {!! Form::time('mon_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            </div>
                                                  @endif
                                                @endforeach
                                            </div>
                                        </div>
                                      </div>  

                                    <hr>
                                    <!-- -----------------TUESDAY----------------- -->
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <label for="">TUESDAY</label>
                                        </div>

                                        <div class="col-sm-12">
                                            <div id="show_tue">
                                            @foreach ($secSched as $sched)
                                                @if ($sched->day == 'tuesday')
                                                            <div class="row">
                                                            
                                                            <div class="col-md-4 mb-3">Subject
                                                                {!! Form::select('tue_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">Teacher
                                                                {!! Form::select('tue_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            <div class="col-md-2 mb-3">Room
                                                                {!! Form::text('tue_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                                        
                                                            <div class="col-md-2 mb-3">Start
                                                            {!! Form::time('tue_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">End
                                                            {!! Form::time('tue_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <!-- -----------------WEDNESDAY----------------- -->
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <label for="">WEDNESDAY</label>
                                        </div>

                                        <div class="col-sm-12">
                                        <div id="show_wed">
                                              @foreach ($secSched as $sched)
                                                @if ($sched->day == 'wednesday')
                                                            <div class="row">
                                                            
                                                            <div class="col-md-4 mb-3">Subject
                                                                {!! Form::select('wed_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">Teacher
                                                                {!! Form::select('wed_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            <div class="col-md-2 mb-3">Room
                                                                {!! Form::text('wed_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                                        
                                                            <div class="col-md-2 mb-3">Start
                                                            {!! Form::time('wed_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">End
                                                            {!! Form::time('wed_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    

                                    <hr>
                                    <!-- -----------------THURSDAY----------------- -->
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <label for="">THURSDAY</label>
                                        </div>

                                        <div class="col-sm-12">
                                        <div id="show_thu">
                                               @foreach ($secSched as $sched)
                                                @if ($sched->day == 'thursday')
                                                            <div class="row">
                                                            
                                                            <div class="col-md-4 mb-3">Subject
                                                                {!! Form::select('thu_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">Teacher
                                                                {!! Form::select('thu_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            <div class="col-md-2 mb-3">Room
                                                                {!! Form::text('thu_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                                        
                                                            <div class="col-md-2 mb-3">Start
                                                            {!! Form::time('thu_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">End
                                                            {!! Form::time('thu_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>

                                    </div>

                                    <hr>

                                    <!-- -----------------FRIDAY----------------- -->
                                    <div class="row">
                                        <div class="col-md-4 ">
                                            <label for="">FRIDAY</label>
                                        </div>

                                        <div class="col-sm-12">
                                        <div id="show_fri">
                                              @foreach ($secSched as $sched)
                                                @if ($sched->day == 'friday')
                                                            <div class="row">
                                                            
                                                            <div class="col-md-4 mb-3">Subject
                                                                {!! Form::select('fri_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">Teacher
                                                                {!! Form::select('fri_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            <div class="col-md-2 mb-3">Room
                                                                {!! Form::text('fri_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                                        
                                                            <div class="col-md-2 mb-3">Start
                                                            {!! Form::time('fri_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>
                                                            <div class="col-md-2 mb-3">End
                                                            {!! Form::time('fri_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                                            </div>

                                                            </div>
                                                @endif
                                            @endforeach
                                            </div>
                                        </div>

                                    </div>
                      </div><br>

                    </div>
                  </div>
                </div> 

	  
    
  </div>
@endif



@if($student->status == 'Transferee')
<div class="row">
  <div class="col-md-12">
    <div class="card">

      <div class="card-header">
        <h4 class="card-title"><b>SCHEDULE:</b> {{$sem->semester}} Semester / School Year {{$year->year}}</h4>
        <div style="margin-left:10px;"><h5>
        <form action=""></form>
        <form action="/admin/student/semester" id="first_form" method="POST">
            <input type="hidden" name="semester_id" value="63f35b94bde739958336b5c8">
            <input type="hidden" name="student_id" value="{{$student->id}}">
            <a href="javascript:{}" onclick="document.getElementById('first_form').submit();">First Semester</a>
        </form>
        <form action="/admin/student/semester" id="second_form" method="POST">
            <input type="hidden" name="semester_id" value="63f35b9bbde739958336b5c9">
            <input type="hidden" name="student_id" value="{{$student->id}}">
            <a href="javascript:{}" onclick="document.getElementById('second_form').submit();">Second Semester</a>
        </form></div>
      </div>

      <div class="card-content">
                                <!-- -----------------MONDAY----------------- -->
                                  <div class="row">
                                    <div class="col-md-2">
                                        <label for="">MONDAY</label>
                                      <button class="btn btn-warning mon_add">+</button>
                                    </div>
                                  </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_mon">
                                      @foreach($schedules as $sched)
                                        @foreach($sched as $a)

                                          @if ($a->day == 'monday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br><br>
                                                    <button class="btn btn-danger mon_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                {!! Form::select('mon_curriculums[]', $mon_sched, $a->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
                                                </div>
                                            </div>
                                          @endif
                                          @endforeach
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>
                                <!-- -----------------MONDAY----------------- -->
                                <hr>

                                <!-- -----------------TUESDAY----------------- -->
                                  <div class="row">
                                    <div class="col-md-2">
                                        <label for="">TUESDAY</label>
                                      <button class="btn btn-warning tue_add">+</button>
                                    </div>
                                  </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_tue">
                                      @foreach($schedules as $sched)
                                        @foreach($sched as $a)

                                          @if ($a->day == 'tuesday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br><br>
                                                    <button class="btn btn-danger tue_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                {!! Form::select('tue_curriculums[]', $tue_sched, $a->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
                                                </div>
                                            </div>
                                          @endif
                                          @endforeach
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>
                                <!-- -----------------TUESDAY----------------- -->
                                <hr>

                                <!-- -----------------WEDNESDAY----------------- -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <label for="">WEDNESDAY</label>
                                      <button class="btn btn-warning wed_add">+</button>
                                    </div>
                                  </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_wed">
                                      @foreach($schedules as $sched)
                                        @foreach($sched as $a)

                                          @if ($a->day == 'wednesday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br><br>
                                                    <button class="btn btn-danger wed_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                {!! Form::select('wed_curriculums[]', $wed_sched, $a->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
                                                </div>
                                            </div>
                                          @endif
                                          @endforeach
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>
                                <!-- -----------------WEDNESDAY----------------- -->
                                <hr>


                                <!-- -----------------THURSDAY----------------- -->
                                  <div class="row">
                                    <div class="col-md-2">
                                        <label for="">THURSDAY</label>
                                      <button class="btn btn-warning thu_add">+</button>
                                    </div>
                                  </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_thu">
                                      @foreach($schedules as $sched)
                                        @foreach($sched as $a)

                                          @if ($a->day == 'thursday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br><br>
                                                    <button class="btn btn-danger thu_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                {!! Form::select('thu_curriculums[]', $thu_sched, $a->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
                                                </div>
                                            </div>
                                          @endif
                                          @endforeach
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>
                                <!-- -----------------THURSDAY----------------- -->
                                <hr>

                                 <!-- -----------------FRIDAY----------------- -->
                                 <div class="row">
                                    <div class="col-md-2">
                                        <label for="">FRIDAY</label>
                                      <button class="btn btn-warning fri_add">+</button>
                                    </div>
                                  </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_fri">
                                      @foreach($schedules as $sched)
                                        @foreach($sched as $a)

                                          @if ($a->day == 'friday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br><br>
                                                    <button class="btn btn-danger fri_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                {!! Form::select('fri_curriculums[]', $fri_sched, $a->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
                                                </div>
                                            </div>
                                          @endif
                                          @endforeach
                                        @endforeach
                                      </div>
                                    </div>
                                  </div>
                                <!-- -----------------FRIDAY----------------- -->


                                <div class="row"><br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <button type="submit" class="btn btn-success btn-fill btn-wd">Save</button>
                    <a href="javascript:history.back()" id="cancelBtn" onclick="showNotification('top','center')" class="btn btn-wd" role="button">Cancel</a>
                  </div>
                </div> 
              </div>
                                

                                


      </div>
                                      
    
         
      

    </div>
    <div>
  </div>
</div>
@endif



                           


@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script>
    $(document).ready(function(){

// ------------------------------- MONDAY
$(".mon_add").click(function(e){
    e.preventDefault();
    $("#show_mon").append(`
        <div class="row append_day"><br>

          <div class="col-md-1"><br>
            <button class="btn btn-danger mon_remove">-</button>
          </div>

          <div class="col-md-11">Subject
            {!! Form::select('mon_curriculums[]', $mon_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
          </div>

        </div>
    `);
});

$(document).on('click', '.mon_remove', function(e){
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
});

// ------------------------------- TUESDAY
$(".tue_add").click(function(e){
    e.preventDefault();
    $("#show_tue").append(`
        <div class="row append_day"><br>

          <div class="col-md-1 mb-5 d-grid">
            <button class="btn btn-danger tue_remove">-</button>
          </div>

          <div class="col-md-9 mb-3">Subject
            {!! Form::select('tue_curriculums[]', $tue_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
          </div>

        </div>
    `);
});

$(document).on('click', '.tue_remove', function(e){
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
});

// ------------------------------- WEDNESDAY
$(".wed_add").click(function(e){
    e.preventDefault();
    $("#show_wed").append(`
        <div class="row append_day"><br>

          <div class="col-md-1 mb-5 d-grid">
            <button class="btn btn-danger wed_remove">-</button>
          </div>

          <div class="col-md-9 mb-3">Subject
            {!! Form::select('wed_curriculums[]', $wed_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
          </div>


        </div>
    `);
});

$(document).on('click', '.wed_remove', function(e){
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
});

// ------------------------------- THURSDAY
$(".thu_add").click(function(e){
    e.preventDefault();
    $("#show_thu").append(`
        <div class="row append_day"><br>

          <div class="col-md-1 mb-5 d-grid">
            <button class="btn btn-danger thu_remove">-</button>
          </div>

          <div class="col-md-9 mb-3">Subject
            {!! Form::select('thu_curriculums[]', $thu_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
          </div>


        </div>
    `);
});

$(document).on('click', '.thu_remove', function(e){
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
});


// ------------------------------- FRIDAY
$(".fri_add").click(function(e){
    e.preventDefault();
    $("#show_fri").append(`
        <div class="row append_day"><br>

          <div class="col-md-1 mb-5 d-grid">
            <button class="btn btn-danger fri_remove">-</button>
          </div>

          <div class="col-md-9 mb-3">Subject
            {!! Form::select('fri_curriculums[]', $fri_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
          </div>

        </div>
    `);
});

$(document).on('click', '.fri_remove', function(e){
    e.preventDefault();
    let row_item = $(this).parent().parent();
    $(row_item).remove();
});



});
</script>

<script>
        $(document).ready(function() {

            $('#indipeople').change(function() {
                if ($(this).val() == 'No' || $(this).val() == 'false') {
                $('#yesindipeople').prop('disabled', true).val(null);
                } else {
                $('#yesindipeople').prop('disabled', false);
                }
            });

            $('#specialneeds').change(function() {
                if ($(this).val() == 'No' || $(this).val() == 'false') {
                $('#yesspecialneeds').prop('disabled', true).val(null);
                } else {
                $('#yesspecialneeds').prop('disabled', false);
                }
            });

            $('#assistivedevices').change(function() {
                if ($(this).val() == 'No' || $(this).val() == 'false') {
                $('#yesassistivedevices').prop('disabled', true).val(null);
                } else {
                $('#yesassistivedevices').prop('disabled', false);
                }
            });

        });
    </script>
@endsection


