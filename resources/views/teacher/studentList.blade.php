@extends('layouts.master')

@section('title')
	STUDENTS
@endsection

@section('pagetitle')
   STUDENTS 
@endsection

@section('css')
@endsection

@section('content')
              <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-12">
                            <a href="/teacher/subjects">
                            <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
                                <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
                                </button>
                            </a><br><br>
                            
                      <div class="card">
                        <div class="card-header">
                            <h4 class="card-title"><b>SECTION:</b> {{$subject->section->glevel}} - {{$subject->section->name}}</h4>

                            <a href="/teacher/viewGrades/{{$teach_curr}}/{{$subject->section->id}}"><button type="submit" class="btn btn-success pull-right">View Grades</button></a>
                            <h4 class="card-title"><b>SUBJECT:</b> {{$subject->curriculum->name}}</h4>
                        </div>
                        <div class="card-content table-responsive table-full-width">
                          <table class="table">
                            <thead>
                              <th>#</th>
                                <th style="padding-left:20px;">NAME</th>
                                <th>GENDER</th>
                                <th>STATUS</th>
                            </thead>
                                <tbody>
                                @php
                                  $counter = 1;
                                @endphp
                                @foreach($students as $student)
                                  <tr>
                                    <td>{{$counter}}</td>
                                    <td style="padding-left:20px;">{{$student -> student -> lname}}, {{$student-> student -> fname}} {{$student-> student -> mname}}</td>
                                    <td>{{$student-> student -> gender}}</td>
                                    @if($student->status == 'Transferee')
                                    <td style="color: red">{{$student-> student -> status}}</td>
                                    @else($student->status == 'Regular')
                                    <td style="color: blue">{{$student-> student -> status}}</td>
                                    @endif
                                  </tr>
                                  @php
                                    $counter++;
                                  @endphp
                                @endforeach
                                </tbody>
                          </table>
                        </div>


                      </div>
                    </div>
                  </div>
              
                  </div>



@endsection