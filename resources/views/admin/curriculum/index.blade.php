@extends('layouts.master')

@section('title')
   SUBJECTS
@endsection

@section('pagetitle')
   SUBJECTS
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection


@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <h4 class="title">Subject's Record
          <a href="{{route('curriculums.create')}}"> <button type="button" class="btn btn-success pull-right">Add a new subject</button></a>
         </h4>
         <br>
        <div class="card">
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                
                <table class="table" id="subjects-table">
                  <thead class=" text-primary">
                    <tr>
                        <th>Level</th>
                        <th>Name</th>
                        <th>Strand</th>
                        <th>Actions</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                        <th>Level</th>
                        <th>Name</th>
                        <th>Strand</th>
                        <th>Actions</th>
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
      $('#subjects-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('curriculums.index') !!}',
         columns: [
            {data: 'level', name: 'level'},
            {data: 'name', name: 'name'},
            {
                data: 'strand.code',
                name: 'strand.code',
                render: function(data, type, row) {
                    return data ? data : 'None';
                }
            },
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
      });
   } );

</script>
@endsection



