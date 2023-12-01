@extends('layouts.master')

@section('title')
STUDENTS
@endsection

@section('pagetitle')
   STUDENTS
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
<a href="/admin/dashboard">
  <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
  <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
  </button>
</a><br><br>
<div class="row">
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">{{$strand->name}}</h4>
        <div class="card-content table-responsive table-full-width">
	        <table class="table table-striped">
            <thead>
              <th>Grade</th>
              <th>Section</th>
              <th>Room</th>
              <th>Adviser</th>
              <th class="text-center">Action</th>
            </thead>
            <tbody>
              @foreach($sections as $section)
                <tr>
                  <td class="text-left">{{$section -> glevel}}</td>
                  <td>{{$section -> name}}</td>
                  <td class="text-left">{{$section -> room}}</td>
              @if(empty($section->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$section -> teacher -> lname}}, {{$section -> teacher -> fname}} {{$section -> teacher -> mname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/drill/section/{{$section->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
		  </div>
	</div>
</div>
</div>
</div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
@endsection


