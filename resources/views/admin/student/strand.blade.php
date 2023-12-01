@extends('layouts.master')

@section('title')
    STRANDS
@endsection

@section('pagetitle')
   STRANDS
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection
@if(session('error'))
    <script>
        alert('{{ session('error') }}');
    </script>
@endif
@section('content')
<div class="container-fluid">
	                <div class="row">
<!-- abm -->
<div class="col-md-12">
	<div class="card">
		  <div class="card-content">
		    <h4 class="card-title">{{$name}}</h4>
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
              @foreach($strand as $str)
                <tr>
                  <td class="text-left">{{$str -> glevel}}</td>
                  <td>{{$str -> name}}</td>
                  <td class="text-left">{{$str -> room}}</td>
              @if(empty($str->teacher))
                  <td class="text-left">TBD</td>
              @else
                  <td class="text-left">{{$str -> teacher->fullname}}</td>
              @endif
                  <td class="text-center">
                    <a href="/admin/students/{{$str->_id}}">
                      <button class="btn btn-default">
                        View Students
                      </button>
                    </a>

                    <a href="/admin/subject/{{$str->_id}}/view">
                      <button class="btn btn-primary">
                        View Schedule
                      </button>
                    </a>

                    <a href="/admin/students/listClearance/{{$str->id}}">
                     <button class="btn btn-warning">
                       Clearance
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
<!-- end abm -->  



@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
@endsection


