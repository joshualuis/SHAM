@extends('layouts.master')

@section('title')
  CLASSES
@endsection

@section('pagetitle')
  CLASSES 
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
	                        <div class="card">
	                            <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="card-title"><b>SUBJECTS</b> / {{$sem->semester}} semester </h4> 
                                        </div>
                                    </div>
                                    <div style="margin-left:10px;"><h5>
                                        SCHOOL YEAR: {{$year->year}}

                                        <form action="/teacher/subject/semester" id="first_form" method="POST">
                                            <input type="hidden" name="semester_id" value="63f35b94bde739958336b5c8">
                                            <a href="javascript:{}" onclick="document.getElementById('first_form').submit();">FIRST SEMESTER</a>
                                        </form>
                                        <form action="/teacher/subject/semester" id="second_form" method="POST">
                                            <input type="hidden" name="semester_id" value="63f35b9bbde739958336b5c9">
                                            <a href="javascript:{}" onclick="document.getElementById('second_form').submit();">SECOND SEMESTER</a>
                                        </form>
                                    </h5></div>
                                    <br>
                                </div>
	                        </div>
	                    </div>
	                </div>
               

                @foreach($aray as $sub => $obj)
                <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">{{$sub}}</h4>
                        </div>
                        <div class="card-content table-responsive table-full-width">
                          <table class="table">
                            <thead>
                                <th style="padding-left:20px;">Section</th>
                                <th>Room</th>
                                <th class="text-center">Action</th>
                            </thead>
                                <tbody>
                                @foreach($obj as $sub)
                                  <tr>
                                    <td style="padding-left:20px;">{{$sub -> section -> glevel}} - {{$sub -> section -> name}}</td>
                                    <td>{{$sub -> section -> room}}</td>

                                    <td class="text-center">
                                      <div style="display: flex;flex-direction: row; justify-content: center;">  
                                      <form action="/teacher/studentList" method="POST">
                                        <input type="hidden" name="section_id" value="{{$sub->section->id}}">
                                        <input type="hidden" name="curriculum_id" value="{{$sub->id}}">
                                        <button class="btn btn-success "style="margin-right: 10px;">Master List</button>
                                      </form>
                                      
                                      <form action="/teacher/attendance" method="POST">
                                        <input type="hidden" name="section_id" value="{{$sub->section->id}}">
                                        <input type="hidden" name="curriculum_id" value="{{$sub->id}}">
                                        <button class="btn btn-warning "style="margin-right: 10px;">Attendance</button>
                                      </form>
                                        <form action="/teacher/attendance/list" method="POST">
                                        <input type="hidden" name="curriculum_id" value="{{$sub->curriculum_id}}">
                                        <input type="hidden" name="teacher_id" value="{{$sub->teacher_id}}">
                                        <input type="hidden" name="section_id" value="{{$sub->section_id}}">
                                        <input type="hidden" name="teach_curr" value="{{$sub->id}}">
                                        <button class="btn btn-primary" style="margin-right: 10px;">Attendance Record</button>
                                      </form>
                                      </div>
                                    </td>
                                  </tr>
                                @endforeach
                                </tbody>
                          </table>
                        </div>


                      </div>
                    </div>
                  </div>
                  @endforeach
                  </div>

@endsection