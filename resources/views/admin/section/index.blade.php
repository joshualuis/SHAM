@extends('layouts.master')

@section('title')
SECTIONS
@endsection

@section('pagetitle')
   SECTIONS
@endsection

@section('css')
   <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
      <div class="container-fluid">
         
                        <div class="row">
                        <div class="col-md-12">
                           <h4 class="title">Sections
                           <a href="{{route('sections.create')}}"> <button type="button" class="btn btn-success pull-right">Add a new section</button></a>
                           </h4>
                           <br>

                           

	                        <div class="card">
	                           
	                            <div class="card-content table-responsive table-full-width">
	                                <table class="table">
	                                    <thead>
                                          <th style="padding-left:20px;">Section Name</th>
                                          <th>Room</th>
                                          <th>Strand</th>
                                          <th>Adviser</th>
                                          <th class="text-center">Action</th>
	                                    </thead>
	                                    <tbody>
                                          @foreach($sections as $section)
                                          <tr style="padding:20px;">
                                             <td style="padding-left:20px;" class="text-left">{{$section -> glevel}} - {{$section -> name}}</td>
                                             <td class="text-left">{{$section -> room}}</td>
                                             @if(empty($section->strand))
                                                <td class="text-left">TBD</td>
                                             @else
                                                <td class="text-left">{{$section -> strand -> name}}</td>
                                             @endif
                                             
                                             @if(empty($section->teacher))
                                                <td class="text-left">TBD</td>
                                             @else
                                                <td class="text-left">{{$section -> teacher -> fullname}}</td>
                                             @endif   

                                             <td class="text-center">
                                                <a href="/admin/subject/{{$section->_id}}/view">
                                                   
                                                <button class="btn btn-default"></i>View Schedule</button></a>

                                                <!-- <a href="/subject/{{$section->_id}}/create">
                                                <button><i class="" style="font-size:15px; color:red" ></i>Add Sched</button></a> -->

                                                <a href="/admin/sections/{{$section->_id}}/edit">
                                                <button class="btn btn-primary" >Edit</button></a>

                                                <!-- {!! Form::open(array('route' => array('sections.destroy', $section->_id),'method'=>'DELETE')) !!}
                                                <button><i class="" style="font-size:15px; color:red" ></i>Delete</button></a>
                                                {!! Form::close() !!}  -->
                                             </td>
                                          </tr>
                                          @endforeach
	                                    </tbody>
	                                </table>
	                            </div>
	                        </div>
	                    </div>
             
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>

@endsection

