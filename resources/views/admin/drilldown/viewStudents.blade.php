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
                        </a><br><br>
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">SECTION: {{$section->glevel}} - {{$section->name}}
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
                                        <th class="text-center">NAME</th>
                                        <th class="text-center">GENDER</th>
                                        <th class="text-center">STATUS</th>
	                                    </thead>
	                                    <tbody>
                                      @foreach($students as $student)
                                        <tr class="text-center">
                                          <td>{{$student -> lname}}, {{$student->fname}} {{$student->mname}}</td>
                                          <td>{{$student->gender}}</td>
                                          <td>{{$student->status}}</td>
                                        </tr>
                                      @endforeach
	                                    </tbody>
	                                </table>
	                            </div>
	                        </div>
	                    </div>
                  </div>
	              </div>
 
@endsection

