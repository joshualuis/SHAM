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
                <div class="row">
                    <div class="col-md-12">
                           <a href="javascript:history.back()">
                            <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
                                <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
                                </button>
                            </a><br><br>
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title"><b>Attendance Record:</b></h4>
                        </div>
                                   
                             
                        <div class="card-content table-responsive table-full-width">
                          <table class="table">
                            <thead>
                                <th style="padding-left:20px;">DATE</th>
                                <th>ACTION</th>
                            </thead>
                                <tbody>
                                @foreach($final as $date)
                                  <tr>
                                    <td style="padding-left:20px;">{{$date}}</td>
                                    <form action="/teacher/attendance/{{$section_id}}/edit" method="POST">
                                        <td>
                                            <input type="hidden" name="date" value="{{$date}}">
                                            <input type="hidden" name="curriculum_id" value="{{$curriculum_id}}">
                                            <input type="hidden" name="teacher_id" value="{{$teacher_id}}">
                                            <input type="hidden" name="section_id" value="{{$section_id}}">
                                            <input type="hidden" name="teach_curr" value="{{$teach_curr}}">
                                            <button class="btn btn-warning">Edit</button>
                                        </td>
                                      </form>
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