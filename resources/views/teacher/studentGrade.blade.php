@extends('layouts.master')

@section('title')
	STUDENT INFORMATION
@endsection

@section('pagetitle')
    STUDENT INFORMATION
@endsection

@section('css')
@endsection

@section('content')
<div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title"><B>STUDENT INFORMATION</b></h4>
	                                <p class="category"></p>
	                            </div>

                              <div class="card-content">
                              <form action="/admin/applicants/emailing" method="POST">
                                  @csrf
                                  <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="control-label">NAME: {{$student->lname}}, {{$student->fname}} {{$student->mname}}</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="control-label">LRN: {{$student->lrn}}</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="control-label">GENDER: {{$student->gender}}</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="control-label">AGE: {{$student->age}}</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="control-label">STRAND: {{$student->strand->name}}</label>
                                        </div>
                                      </div>
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                        <label class="control-label">GRADE & SECTION: {{$student->section->glevel}} - {{$student->section->name}}</label>
                                        </div>
                                      </div>
                                  </div>
                              </div>
	                        </div>
                      </div>
                  </div>




                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                      <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                          <div style="display: inline-block;">
                              <h4 class="card-title"><b>GRADES</b></h4>
                          </div>
                          <div style="display: flex; align-items:right;">
                              <form action="/teacher/viewReportCard/{$student->id}}" method="POST">
                                  @csrf
                                  <a href="/teacher/viewReportCard/{{$student->id}}" target="_blank">
                                      <button type="button" class="btn btn-success">View Report Card</button>
                                  </a>
                              </form>
                              <form action="/teacher/downloadReportCard/{{$student->id}}" method="POST">
                                  @csrf
                                  <a href="/teacher/downloadReportCard/{{$student->id}}">
                                      <button type="button" style="margin-left:5px;" class="btn btn-success">Download Report Card</button>
                                  </a>
                              </form>
                          </div>
                      </div>

                        <div class="card-content table-responsive table-full-width">
                            <div class="col-md-12">
                            <h5 class="card-title">FIRST SEMESTER (S.Y.: {{$year->year}})</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <th style="padding-left:20px;"></th>
                                    <th>SUBJECTS</th>
                                    <th>TEACHER</th>
                                    <th>Quarter 1</th>
                                    <th>Quarter 2</th>
                                    <th>Final Grade</th>
                                    <th>REMARKS</th>
                                </thead>
                                <tbody>
                                @foreach($grades as $grade)
                                    @if($grade->semester->semester == "First")
                                    <tr>
                                        <th style="padding-left:20px;">{{$grade->curriculum->level}}</th>
                                        <td>{{$grade->curriculum->name}}</td>
                                        <td>{{$grade->teacher->fullname}}</td>
                                        <td>{{$grade->q1}}</td>
                                        <td>{{$grade->q2}}</td>
                                        <td>{{$grade->final}}</td>
                                        @if($grade->remarks == 'PASSED')
                                            <td style="color: GREEN">{{$grade->remarks}}</td>
                                        @else
                                            <td style="color: RED">{{$grade->remarks}}</td>
                                        @endif

                                    </tr>
                                    @endif
                                @endforeach
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><strong>GWA: </strong></td>
                                  <td><strong>{{$firstGWA}}</strong></td>
                                  <td></td>
                                </tr>
                                
                                </tbody>
                               
                            </table>
                            
                            
                        </div>

                        <hr>

                        <div class="card-content table-responsive table-full-width">
                            <div class="col-md-12">
                            <h5 class="card-title">SECOND SEMESTER (S.Y.: {{$year->year}})</h5>
                            </div>
                            <table class="table">
                                <thead>
                                    <th style="padding-left:20px;"></th>
                                    <th>SUBJECTS</th>
                                    <th>TEACHER</th>
                                    <th>Quarter 1</th>
                                    <th>Quarter 2</th>
                                    <th>Final Grade</th>
                                    <th>REMARKS</th>
                                </thead>
                                <tbody>
                                @foreach($grades as $grade)
                                    @if($grade->semester->semester == "Second")
                                    <tr>
                                        <th style="padding-left:20px;">{{$grade->curriculum->level}}</th>
                                        <td>{{$grade->curriculum->name}}</td>
                                        <td>{{$grade->teacher->fullname}}</td>
                                        <td>{{$grade->q1}}</td>
                                        <td>{{$grade->q2}}</td>
                                        <td>{{$grade->final}}</td>
                                        @if($grade->remarks == 'PASSED')
                                            <td style="color: GREEN">{{$grade->remarks}}</td>
                                        @else
                                            <td style="color: RED">{{$grade->remarks}}</td>
                                        @endif

                                    </tr>
                                    @endif
                                @endforeach
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td><strong>GWA: </strong></td>
                                  <td><strong>{{$secondGWA}}</strong></td>
                                  <td></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="row"><br>
                            <div class="col-md-12" >
                            <div class="form-group pull-right" style="padding-right: 10px;">
                                <form style="display:inline-block;" action="/teacher/clearance" method="POST">
                                    <input type="hidden" name="student_ids[]" value="{{$student->id}}">
                                    <button type="submit" class="btn btn-success btn-fill btn-wd">Cleared</button>
                                </form>
                                <a href="/teacher/advisory">
                                    <button type="button" class="btn btn-wd" onclick="showNotification('top','center')">BACK
                                    </button>
                                </a>
                                </div>
                            </div> 
                        </div>

                        


                      </div>
                    </div>
                  </div>



        </div>




@endsection