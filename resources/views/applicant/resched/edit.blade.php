@extends('layouts.master')

@section('title')
EDIT SCHEDULED INTERVIEW 
@endsection

@section('pagetitle')
  EDIT SCHEDULED INTERVIEW 
@endsection

@section('css')

@endsection

@section('content')
         
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
       
      </div>
    </div>

	<div class="row">
	  <div class="col-md-12">
      <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">Edit Scheduled Interview</h4>
          <p class="category"></p>
	      </div>
	      
        <div class="card-content">
          {{ Form::model($applicant,['method'=>'PATCH','route' => ['applicant.revertUpdate', $applicant->_id, 'files' => true], 'id' => 'applicantEdit']) }}
            @csrf
            <div class="row">

                <div class="col-sm-6">
                  <div class="form-group">
                    <label class="control-label">Date & Time<star>*</star></label>
                    {{ Form::datetimeLocal('intDate', $dateTime, array('class'=>'form-control','id'=>'intDate', 'required'=>'true')) }}
                  </div>
                </div>
                
              </div>

              <div class="row">
                <br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                    <a href="javascript:history.back()" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
                  </div>
                </div> 
              </div>
              
              <br>
              {!! Form::close() !!}   
        
	      </div>
	    </div>
	  </div>
  </div>



</div>  
	               
@endsection


@section('script')
<script>
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
      showNotification('top', 'right', 'Please select the date and time for the scheduled interview before submitting.');
      return false;
    }
  }

  return true;
}


</script>


<script>
  function showSwal(type) {

    if (validateForm()) {
      if (type == 'warning-message-and-cancel') {
        swal({
          title: 'Schedule an Interview',
          text: 'Would you like to send a new schedule for interview to this applicant?',
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
            document.getElementById('applicantEdit').submit();
            swal({
            title: 'SENT',
            text: 'The email for the scheduled interview is sent!',
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