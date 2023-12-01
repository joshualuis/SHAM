@extends('layouts.master')

@section('title')
  SHORTLISTED
@endsection

@section('pagetitle')
   SHORTLISTED
@endsection

@section('css')
    
@endsection

@section('content')

                <div class="container-fluid">

	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">Modify strand and section</h4>
	                            </div>

                              <div class="card-content">
                              <h5>Name : <b>{{$shortlisted->name}}</b></h5>
                              {{ Form::model($shortlisted,['method'=>'PATCH','route' => ['shortlisteds.update', $shortlisted->_id, 'files' => true], 'id' => 'shortlistedEdit']) }}
                                  @csrf
                                  
                                  <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="control-label">Strand and Section<star>*</star></label>
                                          {!! Form::select('section_id', $sections,$shortlisted->section_id,['placeholder' => 'Select a Strand', 'class' => 'form-control','required'=>'true']) !!}
                                        </div>
                                      </div>


                                  </div>

                                  <div class="row"><br>
                                    <div class="col-sm-12" >
                                      <div class="form-group pull-right" style="margin-right:10px;">
                                        <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                                        <a href="javascript:history.back()" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
                                      </div>
                                    </div> 
                                  </div>

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
      showNotification('top', 'right', 'Please select a strand and section to be assigned to the student.');
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
          title: 'Modify the Strand & Section',
          text: 'Would you like to change the strand and section of this shortlisted student?',
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
            document.getElementById('shortlistedEdit').submit();
            swal({
            title: 'Successfully changed!',
            text: 'The strand & section of the student is now modified!',
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


