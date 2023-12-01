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
                        
                        <a href="javascript:history.back()">
                          <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	                        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	                        </button>
                        </a>

                        <br><br>
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">SECTION: {{$section->glevel}} - {{$section->name}}
                                    <a href="/admin/students/transferee/evaluate/{{$section->id}}"> <button type="submit" id="addBtn" style="margin-left:5px;" class="btn btn-success pull-right">Add New Student</button></a>

                                    <a href="/admin/subject/{{$section->id}}/view"> <button type="submit" id="schedBtn" style="margin-left:5px;" class="btn btn-default pull-right">View Schedule</button></a>
                                  </h4>
	                                @if(empty($section->teacher))
                                    <h5 class="card-title">ADVISOR: TBD</h5>
                                  @else
                                    <h5 class="card-title">ADVISOR: {{$section -> teacher -> fullname}}</h5>
                                  @endif
	                            </div>
	                            <div class="card-content table-responsive table-full-width">
	                                <table class="table table-striped ">
	                                    <thead>
                                        <th class="text-center">#</th>
                                        <th class="text-left">NAME</th>
                                        <th class="text-center">GENDER</th>
                                        <th class="text-center">STATUS</th>
                                        <th class="text-center">ACTION</th>
	                                    </thead>
	                                    <tbody>
                                      @php
                                        $counter = 1;
                                      @endphp

                                      @foreach($students as $student)
                                        <tr class="text-center">
                                          <td>{{$counter}}</td>
                                          <td class="text-left">{{$student -> lname}}, {{$student->fname}} {{$student->mname}}</td>
                                          <td>{{$student->gender}}</td>
                                          <td>{{$student->status}}</td>
                                          <td>
                                            <a href="/admin/students/showStudent/{{$student->id}}"> 
                                              <button type="submit" id="enrollBtn" class="btn btn-warning ">view more information</button>
                                            </a>
                                          </td>
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

