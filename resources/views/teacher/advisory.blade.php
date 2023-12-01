@extends('layouts.master')

@section('title')
	ATTENDANCE
@endsection

@section('pagetitle')
   ADVISORY CLASS 
@endsection

@section('css')
@endsection

@section('content')
      <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    
                      <div class="card">
                        <div class="card-header" style="display: flex; justify-content: space-between; align-items: center;">
                            <div style="display: inline-block;">
                                <h4 class="card-title"><b>SECTION: </b>{{$section->glevel}} - {{$section->name}}</h4>
                                <p class="category">Please verify that the selected students are eligible for clearance.</p>
                            </div>
                            <div style="display: flex; align-items:right;">
                                <form id="view" action="/teacher/allViewReportCard" method="POST" target="_blank">
                                    @csrf
                                    <!-- <a href="/teacher/allViewReportCard" target="_blank"> -->
                                    <input type="hidden" name="student_ids" id="view_student_ids">
                                    <button onclick="copyStudentIds()" form="view" type="submit" class="btn btn-success">View Report Card</button>
                                    <!-- </a> -->
                                    </form>
                                
                                <form id="download" action="/teacher/allDownloadReportCard" method="POST">
                                    @csrf
                                    <!-- <a href="/teacher/allDownloadReportCard"> -->
                                    <input type="hidden" name="student_ids" id="down_student_ids">
                                    <button onclick="copy()" type="submit" style="margin-left:5px;" class="btn btn-success">Download Report Card</button>
                                    <!-- </a> -->
                                </form>
                                
                            </div>
                        </div>
                        <div class="card-content table-responsive table-full-width">
                        @if (\Session::has('message'))
                          <div class="alert alert-danger">
                            <ul>
                              <li>{!! \Session()->get('message') !!}</li>
                            </ul>
                          </div>
                        @endif

                        @if (\Session::has('select'))
                          <div class="alert alert-danger">
                            <ul>
                              <li>{!! \Session()->get('select') !!}</li>
                            </ul>
                          </div>
                        @endif

                          <table class="table">
                            <thead>
                                <th style="padding-left:20px;"></th>
                                <th>#</th>
                                <th>NAME</th>
                                <th>GENDER</th>
                                <th>STATUS</th>
                                <th>CLEARANCE</th>
                                <th>ACTION</th>
                            </thead>
                            <form id="clearance" action="/teacher/clearance" method="POST">
                              @csrf
                                <tbody>
                                @php
                                  $counter = 1;
                                @endphp

                                @foreach($students as $student)
                                  <tr>
                                    <td>{{$counter}}</td>
                                    <td style="padding-left:20px; ">
                                      <input type="checkbox" name="student_ids[]" value="{{$student->id}}">
                                    </td>
                                    <td>{{ $student -> lname }}, {{ $student -> fname }} {{ $student -> mname }}</td>
                                    <td>{{ $student -> gender}}</td>
                                    @if($student->status == 'Transferee')
                                    <td style="color: blue">{{ $student -> status }}</td>
                                    @else
                                    <td style="color: green">{{ $student -> status }}</td>
                                    @endif

                                    @if($student->clearance == null)
                                    <td style="color:red">NOT CLEARED</td>
                                    @elseif($student->clearance == 'cleared')
                                    <td style="color:blue">CLEARED</td>
                                    @endif
                                    

                                    
                                    <td><a class="btn btn-warning" href="/teacher/studentGrades/{{$student->id}}">More Information</a></td>
                                  </tr>
                                  @php
                                    $counter++;
                                  @endphp
                                @endforeach
                                </tbody>
                          </table>
                        </div>

                        <div class="row"><br>
                          <div class="col-sm-12" >
                            <div class="form-group pull-right" style="margin-right:20px;">
                            <button form="clearance" type="submit" class="btn btn-success pull-right">Clearance</button>
                              
                            </div>
                          </div> 
                        </div><br>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


@endsection
<script>
function copyStudentIds() {
  // Get all the selected checkboxes
  var checkboxes = document.querySelectorAll('input[name="student_ids[]"]:checked');
  
  // Get the hidden input field in the other form
  var hiddenInput = document.getElementById('view_student_ids');
  
  // Create an array to hold the selected student IDs
  var selectedStudentIds = [];
  
  // Loop through each selected checkbox and add its value to the array
  for (var i = 0; i < checkboxes.length; i++) {
    selectedStudentIds.push(checkboxes[i].value);
  }
  
  // Set the value of the hidden input field to the selected student IDs
  hiddenInput.value = selectedStudentIds.join(',');
}


function copy() {
  // Get all the selected checkboxes
  var checkboxes = document.querySelectorAll('input[name="student_ids[]"]:checked');
  
  // Get the hidden input field in the other form
  var hiddenInput = document.getElementById('down_student_ids');
  
  // Create an array to hold the selected student IDs
  var selectedStudentIds = [];
  
  // Loop through each selected checkbox and add its value to the array
  for (var i = 0; i < checkboxes.length; i++) {
    selectedStudentIds.push(checkboxes[i].value);
  }
  
  // Set the value of the hidden input field to the selected student IDs
  hiddenInput.value = selectedStudentIds.join(',');
}
</script>