@extends('layouts.master')

@section('title')
SCHOOL YEAR
@endsection

@section('pagetitle')
   SCHOOL YEAR
@endsection

@section('css')

@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4 class="title">School Year Records
          <a href="{{route('years.create')}}"> <button type="button" class="btn btn-success pull-right">Create a new School Year</button></a>
         </h4>
         <br>
        <div class="card">
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                
                <table class="table" id="years-table">
                  <thead class="text-primary">
                    <tr>
                      <th>School Year</th>
                      <th>Principal</th>
                      <th>Title</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>School Year</th>
                      <th>Principal</th>
                      <th>Title</th>
                      <th>Action</th>
										</tr>
									</tfoot>
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


<script type="text/javascript">
   $(document).ready( function () {

      $('#years-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('years.index') !!}',
         columns: [
            {data: 'year', name: 'year'},
            {data: 'principal', name: 'principal'},
            {data: 'title', name: 'title'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
      });
   } );

</script>
@endsection


