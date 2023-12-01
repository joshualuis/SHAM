@extends('layouts.master')

@section('title')
    EDIT deadline
@endsection

@section('pagetitle')
   EDIT deadline
@endsection

@section('css')
@endsection

@section('content')

<div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <a href="/admin/dashboard">
        <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	      </button>
      </a><br><br>
	    
      <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">SET DEADLINE</h4>
	      </div>
	      
        <div class="card-content">
        {{ Form::model($deadline,['method'=>'PATCH','route' => ['admin.deadUpdate', $deadline->_id, 'files' => true], 'id'=>'editRegis']) }}
              
            @csrf
            <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Status<star>*</star></label>
                    {!! Form::select('deadStat', ['Open' => 'Open', 'Close' => 'Close'], null,['placeholder' => 'Select','class' => 'form-control', 'required' => 'true']) !!}
                    </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Start<star>*</star></label>
                    {{ Form::datetimeLocal('deadStart',null,array('class'=>'form-control', 'required' => 'true')) }}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">End<star>*</star></label>
                    {{ Form::datetimeLocal('deadEnd',null,array('class'=>'form-control', 'required' => 'true')) }}
                  </div>
                </div>
              </div>

                <div class="row">
                  <br>
                  <div class="col-sm-12" >
                    <div class="form-group pull-right">
                      <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                      <a href="/admin/dashboard" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
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
document.getElementById('contact').addEventListener('input', function(e) {
    var input = e.target;
    if (input.value.length > 13) {
        input.value = input.value.slice(0, 13);
    }
});
</script>

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
      showNotification('top', 'right', 'Fill in the required fields before submitting. </>Please make sure everything is correct before submitting.');
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
          title: 'Edit the deadline',
          text: 'Would you like to make changes in this record?',
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
            document.getElementById('editRegis').submit();
            swal({
            title: 'Successfully updated',
            text: 'This record is successfully updated!',
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


