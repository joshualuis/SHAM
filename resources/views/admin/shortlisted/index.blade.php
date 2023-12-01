@extends('layouts.master')

@section('title')
   SHORTLISTED
@endsection

@section('pagetitle')
   SHORTLISTED
@endsection

@section('sidebar')
@include('layouts.navs.sidebar')
@endsection

@section('css')
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@endsection

@section('content')
<div class="container-fluid">
<form id="enrollShortlisted" action="/admin/students" method="POST"  id="formenroll" autocomplete="off">

    <div class="row">
      <div class="col-md-12">
      
        <h4 class="title">Shortlisted's Record (For S.Y.: {{$year->year}})
        
          <button type="button" onclick="showSwal('warning-message-and-cancel')" id="enrollBtn" class="btn btn-success pull-right" method="POST" form="formenroll">Enroll Student</button>
   
        </h4>
         <br>
        <div class="card">
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="shortlisted-table">
                  <thead class=" text-primary">
                    <tr>
                      <th>#</th>
                      <th><input type="checkbox" name="main_checkbox"><label></label></th>
                      <th>Name</th>
                      <th>Strand</th>
                      <th>Section</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>#</th>
                      <th></th>
                      <th>Name</th>
                      <th>Strand</th>
                      <th>Section</th>
                      <th>Status</th>
                      <th>Action</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>


@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    

<script type="text/javascript">
   $(document).ready( function () {
      $('#shortlisted-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('shortlisteds.index') !!}',
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
            {data: 'checkbox', name:'checkbox', orderable:false, searchable:false},
            {data: 'name', name: 'name'},
            {data: 'strand_name', name: 'strand_name'},
            {data: 'section_name', name: 'section_name'},
            {data: 'status', name: 'status'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            ]
      });
   } );


         $(document).on('click','input[name="main_checkbox"]', function(){
                  if(this.checked){
                    $('input[name="sl_checkbox"]').each(function(){
                        this.checked = true;
                    });
                  }else{
                     $('input[name="sl_checkbox"]').each(function(){
                         this.checked = false;
                     });
                  }
                  toggleenrollbtn();
           });

           $(document).on('change','input[name="sl_checkbox"]', function(){
               if( $('input[name="sl_checkbox"]').length == $('input[name="sl_checkbox"]:checked').length ){
                   $('input[name="main_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="main_checkbox"]').prop('checked', false);
               }
               toggleenrollbtn();
           });


           function toggleenrollbtn(){
               if( $('input[name="sl_checkbox"]:checked').length > 1 ){
                   $('button#enrollBtn').text('Enroll Students ('+$('input[name="sl_checkbox"]:checked').length+')');
               }else{
                $('button#enrollBtn').text('Enroll Student');
               }
           }


          function enrollShort(){
         
           };

        
function showNotification(from, align, message) {
    $.notify({
      message: message
    },{
      type: 'warning',
      timer: 100,
      placement: {
        from: from,
        align: align
      }
    });
}

function validateForm() {
  // Perform validation checks
  var requiredFields = document.querySelectorAll('input[required], select[required], textarea[required]');

  for (var i = 0; i < requiredFields.length; i++) {
    if (requiredFields[i].value === '') {
      showNotification('top', 'right', 'Please select students to be enrolled.');
      return false;
    }
  }

  return true;
}

function ifempty() {
    if( $('input[name="sl_checkbox"]:checked').length == 0 ){
      showNotification('top', 'right', 'Please select a shortlisted student first before proceeding to enroll.');
      return false;
      }
      return true;
  }
</script>


<script>
  function showSwal(type) {

    if (ifempty()) {
      if (type == 'warning-message-and-cancel') {
        swal({
          title: 'Enroll Students',
          text: 'Would you like to enroll the selected students to their respective strands and section?',
          type: 'warning',
          showCancelButton: true,
          showCloseButton: true,
          confirmButtonText: 'Yes',
          cancelButtonText: 'No',
          confirmButtonClass: "btn btn-success btn-fill",
          cancelButtonClass: "btn btn-danger btn-fill",
          buttonsStyling: false
        }).then((result) => {
          if (result.value) {
            var checkedPeople = [];
            $('input[name="sl_checkbox"]:checked').each(function(){
                  checkedPeople.push($(this).data('id'));
               });

               //console.log(checkedPeople);

               var url = '/admin/students';
               if(checkedPeople.length > 0){
                // console.log(people_ids:checkedPeople);
                  $.post(url,{people_ids:checkedPeople},function(data){
                    console.log(data);       
                 $('#shortlisted-table').DataTable().ajax.reload(null, true);
         
                              
                },'json');
               }
            swal({
            title: 'Successfully Enrolled!',
            text: 'The selected students are now enrolled! Login credentials were sent successfully on their email.',
            type: 'success',
            confirmButtonClass: "btn btn-success btn-fill",
            buttonsStyling: false
            })
          } else {
            swal({
            title: 'Cancelled!',
            text: 'No changes made.',
            type: 'error',
            confirmButtonClass: "btn btn-danger btn-fill",
            buttonsStyling: false
            })
          }
        });
      } 
    }}


   
</script>
@endsection