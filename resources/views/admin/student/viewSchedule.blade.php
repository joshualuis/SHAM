@extends('layouts.master')

@section('title')
SCHEDULE
@endsection

@section('pagetitle')
   SCHEDULE
@endsection

@section('css')
@endsection

@section('content')

                <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            <a href="javascript:history.back()">
                            <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
                                <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
                                </button>
                            </a><br><br>
	                        <div class="card">
	                            <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="card-title"><b>SECTION:</b> {{$section->glevel}} - {{$section->name}}</h4> 
                                        </div>
                                        <div class="col-sm-6"> 
                                            @if(empty($section->teacher))
                                                <h4>ADVISER: TBD</h4>
                                            @else
                                                <h4 class="card-title"><b>ADVISER:</b> {{$section -> teacher -> lname}}, {{$section -> teacher -> fname}} {{$section -> teacher -> mname}}</h4>
                                            @endif
                                        </div>
                                    </div>
                                    <div style="margin-left:10px;"><h5>
                                        SCHOOL YEAR: {{$year->year}}

                                        <form action="/admin/subject/semester" id="first_form" method="POST">
                                            <input type="hidden" name="semester_id" value="63f35b94bde739958336b5c8">
                                            <input type="hidden" name="section_id" value="{{$section->id}}">
                                            <a href="javascript:{}" onclick="document.getElementById('first_form').submit();">FIRST SEMESTER</a>
                                        </form>
                                        
                                    
                                        <form action="/admin/subject/semester" id="second_form" method="POST">
                                            <input type="hidden" name="semester_id" value="63f35b9bbde739958336b5c9">
                                            <input type="hidden" name="section_id" value="{{$section->id}}">
                                            <a href="javascript:{}" onclick="document.getElementById('second_form').submit();">SECOND SEMESTER</a>                                           
                                        </form>
                                    </h5></div>
                                    <br>
                                </div>
	                        </div>
	                            <div class="card-content table-responsive table-full-width">
	                                
	                            </div>
	                    </div>
	                </div>
                </div>

                <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
                            
	                        <div class="card">
	                            <div class="card-header">
                                <input type="hidden" name="section_id" value="{{$section->id}}">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4 class="card-title"><b>SCHEDULE: {{$sem->semester}} Semester</b>
                                            <a href="/admin/subject/{{$section->id}}/edit"> <button type="button" class="btn btn-success pull-right">Edit</button></a></h4> 
                                        </div>
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
                                            @foreach ($schedules as $sched)
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
                                            @foreach ($schedules as $sched)
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
                                            @foreach ($schedules as $sched)
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
                                            @foreach ($schedules as $sched)
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
                                            @foreach ($schedules as $sched)
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

                                    <hr>


	                            </div>

                            </div>
	                    </div>
	                </div>
                </div>
	       
  


@endsection

@section('script')
@endsection


