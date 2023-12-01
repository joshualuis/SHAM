@extends('layouts.master')

@section('title')
   Teachers
@endsection

@section('pagetitle')
   TEACHERS
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('content')


  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4 class="title">Teacher's Record
          <a href="{{route('teachers.create')}}"> <button type="button" class="btn btn-success pull-right">Add a new record</button></a>
         </h4>
           
         <br>
        <div class="card">
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                
                <table class="table" id="teachers-table">
                  <thead class=" text-primary">
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Contact</th>
                      <th>Civil Status</th>
                      <th>Email</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Contact</th>
                      <th>Civil Status</th>
                      <th>Email</th>
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
    var admin = {!! json_encode(url('/')) !!}
      $('#teachers-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('teachers.index') !!}',
         columns: [
          { 
            data: null,
            render: function(data, type, row, meta) {
               // 'meta.row' provides the index of the current row
               return meta.row + 1; // Add 1 to start the counter from 1
            },
            orderable: false,
            searchable: false
         },
            { data: 'image', name: 'image',
                "render": function (data, type, full, meta) {
                    return "<img src=\""+ admin + "/" + data + "\" height=\"100\" width=\"100\"/>";

                },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'contact', name: 'contact'},
            {data: 'civilstatus', name: 'civilstatus'},
            {data: 'email', name: 'email'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
         
            ]
      });
   } );

</script>





@endsection


