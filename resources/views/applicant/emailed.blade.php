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
    <form action="/admin/shortlisteds/create" method="GET">
      <div class="col-md-12"> 
        
      
        <h4 class="title">Emailed Applicants (For S.Y.: {{$year->year}})
          <button type="button" onclick="ifempty()" id="enrollBtn" class="btn btn-success pull-right">ENLIST (Set Strand & Section)</button>
         </h4>
         <p class="category">Set a strand and section for applicants that passed the interview.</p>
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
                      <th><input type="checkbox" name="main_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Interview Date</th>
                      <th>Applicant Name</th>
                      <th>First Choice</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th></th>
                      <th>Image</th>
                      <th>Interview Date</th>
                      <th>Applicant Name</th>
                      <th>First Choice</th>
                      <th>Status</th>
                      <th>Action</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
 
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
      $('#applicants-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.emailed') !!}',
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
            {data: 'checkbox', name:'toEnlist[]', orderable:false, searchable:false},
            { data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"100\" width=\"100\"/>";

              },orderable: false},
            {data: 'intDate', name: 'intDate'},
            {data: 'fullname', name: 'fullname'},
            {data: 'firstchoice', name: 'firstchoice'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
      });
   } );


            $(document).on('click','input[name="main_checkbox"]', function(){
                  if(this.checked){
                    $('input[name="toEnlist[]"]').each(function(){
                        this.checked = true;
                    });
                  }else{
                     $('input[name="toEnlist[]"]').each(function(){
                         this.checked = false;
                     });
                  }
                  toggleenrollbtn();
           });


           $(document).on('change','input[name="toEnlist[]"]', function(){
               if( $('input[name="toEnlist[]"]').length == $('input[name="toEnlist[]"]:checked').length ){
                   $('input[name="main_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="main_checkbox"]').prop('checked', false);
               }
               toggleenrollbtn();
           });

           function toggleenrollbtn(){
               if( $('input[name="toEnlist[]"]:checked').length > 1 ){
                   $('button#enrollBtn').text('ENLIST APPLICANTS ('+$('input[name="toEnlist[]"]:checked').length+')');
               }else{
                  $('button#enrollBtn').text('ENLIST APPLICANT('+$('input[name="toEnlist[]"]:checked').length+')');
               }
           }


           function showNotification(from,align) {
                $.notify({
                  message: "Please select an applicant first."
                },{
                  type: 'danger',
                  timer: 100,
                  placement: {
                    from: from,
                    align: align
                  }
                });
            }

           function ifempty() {
              if( $('input[name="toEnlist[]"]:checked').length == 0 ){
                  showNotification('top', 'right');
               }else{
                  $('button#enrollBtn').prop('type', 'submit');
               }
            }


</script>



@endsection