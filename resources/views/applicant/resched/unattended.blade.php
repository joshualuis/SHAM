@extends('layouts.master')

@section('title')
   Applicants
@endsection

@section('pagetitle')
   APPLICANTS
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')

<div class="container-fluid">
    <div class="row">
      <div class="col-md-12"> 
        <h4 class="title">Requests for Reched Interview (For S.Y.: {{$year->year}})</h4>
         <br>
        <div class="card">
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                
                <table class="table" id="request-table">
                  <thead class=" text-primary">
                    <tr>
                      <th>#</th>

                      <th>Interview Date</th>
                      <th>Applicant Name</th>
                      <th>First Choice</th>
                      <th>Email Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>

                      <th>Interview Date</th>
                      <th>Applicant Name</th>
                      <th>First Choice</th>
                      <th>Email Status</th>
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


<div class="container-fluid">
    <div class="row">
      <div class="col-md-12"> 
        <h4 class="title">Unattended Applicants (For S.Y.: {{$year->year}})</h4>
         <br>
        <div class="card">
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                
                <table class="table" id="applicants-table">
                  <thead class=" text-primary">
                    <tr>
                      <th>#</th>

                      <th>Interview Date</th>
                      <th>Applicant Name</th>
                      <th>First Choice</th>
                      <th>Email Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>

                      <th>Interview Date</th>
                      <th>Applicant Name</th>
                      <th>First Choice</th>
                      <th>Email Status</th>
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

    $('#request-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicant.showRequest') !!}',
         buttons:[ 
                
                {   
                    extend: 'excel',
                    text: 'Print Excel',
                    className: 'btn btn-secondary',
                   
                },
                {   
                    extend: 'pdf',
                    text: 'Print PDF',
                    className: 'btn btn-secondary',
                   
                },
              ],
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
            {data: 'intDate', name: 'intDate'},
            {data: 'fullname', name: 'fullname'},
            {data: 'firstchoice', name: 'firstchoice'},
            {data: 'emailStat', name: 'emailStat'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
      });


      $('#applicants-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicant.unattended') !!}',
         buttons:[ 
                
                {   
                    extend: 'excel',
                    text: 'Print Excel',
                    className: 'btn btn-secondary',
                   
                },
                {   
                    extend: 'pdf',
                    text: 'Print PDF',
                    className: 'btn btn-secondary',
                   
                },
              ],
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
            {data: 'intDate', name: 'intDate'},
            {data: 'fullname', name: 'fullname'},
            {data: 'firstchoice', name: 'firstchoice'},
            {data: 'emailStat', name: 'emailStat'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
      });

   } );



</script>



@endsection