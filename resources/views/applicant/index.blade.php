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
      <form action="/admin/applicants/createEmail" method="GET">

      <div class="row">
        <div class="col-md-12">
        
          <h4 class="title">Applicant's Record (For S.Y.: {{$year->year}})
            <button type="button" id="enlistBtn" onclick="ifempty()" class="btn btn-success pull-right">Send Interview Email</button>
          </h4>
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
                      <th><input type="checkbox" name="appmain_checkbox"><label></label></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Track</th>
                        <th>Strand</th>
                        <th>Status</th>
                        <th>Emailed</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tfoot>
                      <tr>
                        <th>#</th>
                      <th></th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Track</th>
                        <th>Strand</th>
                        <th>Status</th>
                        <th>Emailed</th>
                        <th>Action</th>
                      </tr>
                    </tfoot>
                  </table>
                </div>
              </div>
          
          </div>
        </div>
      </div>

      <br>

      <div class="row">
        <div class="col-md-12">
          <h4 class="title">ACADEMIC TRACK</h4>
        </div>
      </div>


      <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
	            <h4 class="card-title"><b>Accountancy, Business and  Management<b></h4>
              <p class="category"></p>
	        </div>
            <div class="card-content">
            
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              
              <div class="fresh-datatables">
                <table class="table" id="abmTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="abmmain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
	            <h4 class="card-title"><b>General Academic<b></h4>
              <p class="category"></p>
	        </div>
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="gasTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="gasmain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
	            <h4 class="card-title"><b>Humanities and Social Sciences<b></h4>
              <p class="category"></p>
	        </div>
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="humssTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="humsmain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>

      <div class="col-md-6">
        <div class="card">
            <div class="card-header">
	            <h4 class="card-title"><b>Science, Technology, Engineering and Mathematics<b></h4>
              <p class="category"></p>
	          </div>
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="stemTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="stemmain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>

  <br>
    <div class="row">
      <div class="col-md-12">
        <h4 class="title">TECHNICAL-VOCATIONAL-LIVELIHOOD TRACK</h4>
      </div>
    </div>


    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
	            <h4 class="card-title"><b>Caregiving (Nursing Arts)<b></h4>
              <p class="category"></p>
	        </div>
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="careTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="caremain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>
  
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
	            <h4 class="card-title"><b>Electrical Installation and Maintenance<b></h4>
              <p class="category"></p>
	        </div>
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="eimTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="eimmain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
											</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>
    </div>
  

    <div class="row">
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
	            <h4 class="card-title"><b>Home Economics<b></h4>
              <p class="category"></p>
	        </div>
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="heTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="hemain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
										</tr>
									</tfoot>
                </table>
              </div>
            </div>
        </div>
      </div>
  
      <div class="col-md-6">
        <div class="card">
          <div class="card-header">
	            <h4 class="card-title"><b>Information and Communications Technology<b></h4>
              <p class="category"></p>
	        </div>
            <div class="card-content">
              <div class="toolbar">
                    <!--Here you can write extra buttons/actions for the toolbar--> 
              </div>
              <div class="fresh-datatables">
                <table class="table" id="ictTop-table">
                  <thead class=" text-primary">
                    <tr>
                    <th><input type="checkbox" name="ictmain_checkbox"><label></label></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th></th>
                      <th>Image</th>
                      <th>Name</th>
                      <th>Status</th>
                      <th>Emailed for Interview</th>
											</tr>
									</tfoot>
                </table>
              </div>
            </div>
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
   
<!--------------------------------------------------------------------- ALL APPLICANTS -->
<script type="text/javascript">
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

</script>

<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#applicants-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.index') !!}',
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
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'track', name: 'track'},
            {data: 'firstchoice', name: 'firstchoice'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
            
            ]
      });
   } );


          $(document).on('click','input[name="appmain_checkbox"]', function(){
            if(this.checked){
              $('input[name="toEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="toEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              toggleappenlistbtn();
            });

  
           $(document).on('change','input[name="toEnlist[]"]', function(){
               if( $('input[name="toEnlist[]"]').length == $('input[name="toEnlist[]"]:checked').length ){
                   $('input[name="appmain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="appmain_checkbox"]').prop('checked', false);
               }
               toggleappenlistbtn();
           });

           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function toggleappenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
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
              var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length == 0) {
                showNotification('top', 'right');
              } else {
                $('button#enlistBtn').prop('type', 'submit');
              }
            }

</script>

<!--------------------------------------------------------------------- TOP ABM -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#abmTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.abmTop') !!}',
         columns: [
            {data: 'checkbox', name:'abmtoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="abmmain_checkbox"]', function(){
            if(this.checked){
              $('input[name="abmtoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="abmtoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              toggleabmenlistbtn();
            });

  
           $(document).on('change','input[name="abmtoEnlist[]"]', function(){
               if( $('input[name="abmtoEnlist[]"]').length == $('input[name="abmtoEnlist[]"]:checked').length ){
                   $('input[name="abmmain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="abmmain_checkbox"]').prop('checked', false);
               }
               toggleabmenlistbtn();
           });
           
           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function toggleabmenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }

          


</script>

<!--------------------------------------------------------------------- TOP GAS -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#gasTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.gasTop') !!}',
         columns: [
            {data: 'checkbox', name:'gastoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="gasmain_checkbox"]', function(){
            if(this.checked){
              $('input[name="gastoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="gastoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              togglegasenlistbtn();
            });

  
           $(document).on('change','input[name="gastoEnlist[]"]', function(){
               if( $('input[name="gastoEnlist[]"]').length == $('input[name="gastoEnlist[]"]:checked').length ){
                   $('input[name="gasmain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="gasmain_checkbox"]').prop('checked', false);
               }
               togglegasenlistbtn();
           });

           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function togglegasenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }


</script>

<!--------------------------------------------------------------------- TOP HUMSS -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#humssTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.humssTop') !!}',
         columns: [
            {data: 'checkbox', name:'humsstoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="humssmain_checkbox"]', function(){
            if(this.checked){
              $('input[name="humsstoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="humsstoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              togglehumssenlistbtn();
            });

  
           $(document).on('change','input[name="humsstoEnlist[]"]', function(){
               if( $('input[name="humsstoEnlist[]"]').length == $('input[name="humsstoEnlist[]"]:checked').length ){
                   $('input[name="humssmain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="humssmain_checkbox"]').prop('checked', false);
               }
               togglehumssenlistbtn();
           });

           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function togglehumssenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }



</script>


<!--------------------------------------------------------------------- TOP STEM -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#stemTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.stemTop') !!}',
         columns: [
            {data: 'checkbox', name:'stemtoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="stemmain_checkbox"]', function(){
            if(this.checked){
              $('input[name="stemtoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="stemtoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              togglestemenlistbtn();
            });

  
           $(document).on('change','input[name="stemtoEnlist[]"]', function(){
               if( $('input[name="stemtoEnlist[]"]').length == $('input[name="stemtoEnlist[]"]:checked').length ){
                   $('input[name="stemmain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="stemmain_checkbox"]').prop('checked', false);
               }
               togglestemenlistbtn();
           });


           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function togglestemenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }


</script>

<!--------------------------------------------------------------------- TOP CARE -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#careTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.careTop') !!}',
         columns: [
            {data: 'checkbox', name:'caretoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="caremain_checkbox"]', function(){
            if(this.checked){
              $('input[name="caretoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="caretoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              togglecareenlistbtn();
            });

  
           $(document).on('change','input[name="caretoEnlist[]"]', function(){
               if( $('input[name="caretoEnlist[]"]').length == $('input[name="caretoEnlist[]"]:checked').length ){
                   $('input[name="caremain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="caremain_checkbox"]').prop('checked', false);
               }
               togglecareenlistbtn();
           });


           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function togglecareenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }

</script>

<!--------------------------------------------------------------------- TOP EIM -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#eimTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.eimTop') !!}',
         columns: [
            {data: 'checkbox', name:'eimtoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="eimmain_checkbox"]', function(){
            if(this.checked){
              $('input[name="eimtoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="eimtoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              toggleeimenlistbtn();
            });

  
           $(document).on('change','input[name="eimtoEnlist[]"]', function(){
               if( $('input[name="eimtoEnlist[]"]').length == $('input[name="eimtoEnlist[]"]:checked').length ){
                   $('input[name="eimmain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="eimmain_checkbox"]').prop('checked', false);
               }
               toggleeimenlistbtn();
           });


           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function toggleeimenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }


</script>

<!--------------------------------------------------------------------- TOP HE -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#heTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.heTop') !!}',
         columns: [
            {data: 'checkbox', name:'hetoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="hemain_checkbox"]', function(){
            if(this.checked){
              $('input[name="hetoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="hetoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              toggleheenlistbtn();
            });

  
           $(document).on('change','input[name="hetoEnlist[]"]', function(){
               if( $('input[name="hetoEnlist[]"]').length == $('input[name="hetoEnlist[]"]:checked').length ){
                   $('input[name="hemain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="hemain_checkbox"]').prop('checked', false);
               }
               toggleheenlistbtn();
           });


           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function toggleheenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }


</script>

<!--------------------------------------------------------------------- TOP ICT -->
<script type="text/javascript">
   $(document).ready( function () {
    var admin = {!! json_encode(url('/')) !!}
    
      $('#ictTop-table').DataTable({
         processing: true,
         serverSide: true,
         ajax: '{!! route('applicants.ictTop') !!}',
         columns: [
            {data: 'checkbox', name:'icttoEnlist[]', orderable:false, searchable:false},
            {data: 'image', name: 'image',
              "render": function (data, type, full, meta) {
                  return "<img src=\""+ admin + "/" + data + "\" height=\"80\" width=\"80\"/>";

              },orderable: false},
            {data: 'fullname', name: 'fullname'},
            {data: 'status', name: 'status'},
            {data: 'emailStat', name: 'emailStat'},
            ]
      });
   } );


          $(document).on('click','input[name="ictmain_checkbox"]', function(){
            if(this.checked){
              $('input[name="icttoEnlist[]"]').each(function(){
                this.checked = true;
              });
            }else{
              $('input[name="icttoEnlist[]"]').each(function(){
                this.checked = false;
              });
            }
              toggleictenlistbtn();
            });

  
           $(document).on('change','input[name="icttoEnlist[]"]', function(){
               if( $('input[name="icttoEnlist[]"]').length == $('input[name="icttoEnlist[]"]:checked').length ){
                   $('input[name="ictmain_checkbox"]').prop('checked', true);
               }else{
                   $('input[name="ictmain_checkbox"]').prop('checked', false);
               }
               toggleictenlistbtn();
           });
           
           function getSelectedCheckboxes() {
            var checkboxes = [];
            $('input[name="toEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="abmtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="gastoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="humsstoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="stemtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="caretoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="eimtoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="hetoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            $('input[name="icttoEnlist[]"]:checked').each(function() {
                checkboxes.push($(this).val());
            });
            return checkboxes;
            
          }

           function toggleictenlistbtn(){
            var selectedCheckboxes = getSelectedCheckboxes();
              if (selectedCheckboxes.length > 1) {
                  $('button#enlistBtn').text('Send Interview Email (' + selectedCheckboxes.length + ')');
              } else {
                  $('button#enlistBtn').text('Send Interview Email');
              }
           }

          


</script>

@endsection


