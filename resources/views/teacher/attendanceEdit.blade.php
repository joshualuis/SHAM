@extends('layouts.master')

@section('title')
	ATTENDANCE
@endsection

@section('pagetitle')
   ATTENDANCE 
@endsection

@section('css')
@endsection

@section('content')


<div class="container-fluid">
            <form action="/teacher/attendance/update" method="POST">    
                <div class="row">
                    <div class="col-md-12">
                           <a href="javascript:history.back()">
                            <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
                                <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
                                </button>
                            </a><br><br>
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title"><b>SECTION:</b> {{$subject->section->glevel}} - {{$subject->section->name}}</h4>
                          <h4 class="card-title"><b>SUBJECT:</b> {{$subject->curriculum->name}}</h4>
                        </div>
                                   
                             
                        <div class="card-content table-responsive table-full-width">
                        
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                            <label class="control-label">Date<star>*</star></label>
                                            {{ Form::date('date', $date, array('class'=>'form-control')) }}
                                            <input type="hidden" value="{{$subject->curriculum_id}}" name="curriculum">
                                            <input type="hidden" value="{{$subject->section_id}}" name="section">
                                        </div>
                                      </div>
                                      
                          <table class="table">
                            <thead>
                                <th style="padding-left:20px;">NAME</th>
                                <th>GENDER</th>
                                <th>STATUS</th>
                            </thead>
                                <tbody>
                                @foreach($students as $student)
                                  <tr>
                                    <td style="padding-left:20px;">{{$student -> student -> lname}}, {{$student -> student ->fname}} {{$student -> student ->mname}}</td>
                                    <td>{{$student -> student -> gender}}</td>
                                    <td>{{$student -> student -> status}}</td>
                                    
                                    <td>
                                    @if($student->status == 'PRESENT')
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
										    <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="PRESENT" id="present_{{$student->student->id}}" checked="">
                                                <label for="present_{{$student->student->id}}">Present</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="LATE" id="late_{{$student->student->id}}">
                                                <label for="late_{{$student->student->id}}">Late</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="ABSENT" id="absent_{{$student->student->id}}">
                                                <label for="absent_{{$student->student->id}}">Absent</label>
                                            </div>
                                        </div>
                                    </div> 
                                    @endif
                                    @if($student->status == 'LATE')
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
										    <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="PRESENT" id="present_{{$student->student->id}}">
                                                <label for="present_{{$student->student->id}}">Present</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="LATE" id="late_{{$student->student->id}}" checked="">
                                                <label for="late_{{$student->student->id}}">Late</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="ABSENT" id="absent_{{$student->student->id}}">
                                                <label for="absent_{{$student->student->id}}">Absent</label>
                                            </div>
                                        </div>
                                    </div> 
                                    @endif
                                    @if($student->status == 'ABSENT')
                                    <div class="col-sm-12">
                                        <div class="col-sm-4">
										    <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="PRESENT" id="present_{{$student->student->id}}">
                                                <label for="present_{{$student->student->id}}">Present</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="LATE" id="late_{{$student->student->id}}">
                                                <label for="late_{{$student->student->id}}">Late</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="radio">
                                                <input type="radio" name="stud_ids[{{$student->student->id}}]" value="ABSENT" id="absent_{{$student->student->id}}" checked="">
                                                <label for="absent_{{$student->student->id}}">Absent</label>
                                            </div>
                                        </div>
                                    </div> 
                                    @endif
                                    </div>
                                    </td> 
                                
                                  </tr>
                                @endforeach
                                </tbody>
                          </table>
                        </div>

                        <div class="row"><br>
                          <div class="col-sm-12" >
                            <div class="form-group pull-right" style="margin-right:20px;">
                              <button type="submit" class="btn btn-success btn-fill btn-wd">SAVE</button>
                            </div>
                          </div> 
                        </div><br>


                      </div>
                    </div>
                </div>
                </form>
              </div>


@endsection