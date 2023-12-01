@extends('layouts.master')

@section('title')
   Applicants
@endsection

@section('pagetitle')
   APPLICANTS
@endsection

@section('css')
@endsection

@section('content')

        <div class="container-fluid">

	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">ENLISTING APPLICANTS</h4>
	                                <p class="category">Please ensure you are enlisting applicants with the same strand and section.</p>
	                            </div>

                              <div class="card-content">
                              <form id="enlistApplicant" action="/admin/shortlisteds" method="POST">
                                  @csrf
                                  <div class="row">

                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="control-label">Strand and Section<star>*</star></label>
                                          {!! Form::select('section_id', $sections, null, ['placeholder' => 'Select a Section', 'class' => 'form-control', 'required'=>'true']) !!}
                                        </div>
                                      </div>

                                  </div>
                              </div>
	                        </div>
                      </div>
                  </div>

                  <div class="row">
                    <div class="col-md-12">
                      <div class="card">
                        <div class="card-header">
                          <h4 class="card-title">APPLICANTS</h4>
                          <p class="category">Please verify that the selected applicants are eligible for enlistment before submitting.</p>
                       
                        </div>
                        <div class="card-content table-responsive table-full-width">
                          <table class="table">
                            <thead>
                                <th style="padding-left:20px;">NAME</th>
                                <th>1ST CHOICE</th>
                                <th>TRACK</th>
                            </thead>
                            <form action="/admin/shortlisteds" method="POST">
                              @foreach($arr_applicant as $applicants)
                                @foreach($applicants as $applicant)
                                <tbody>
                                <input type="hidden" name="arr[]" value="{{$applicant->_id}}" />
                                  <tr>
                                    <td style="padding-left:20px;">{{$applicant -> fullname}}</td>
                                    <td>{{$applicant -> firstchoice}}</td>
                                    <td>{{$applicant -> track}}</td>
                                  </tr>
                                </tbody>
                                @endforeach
                              @endforeach
                          </table>
                        </div>

                        <div class="row"><br>
                          <div class="col-sm-12" >
                            <div class="form-group pull-right" style="margin-right:20px;">
                              <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Enlist Applicants</button>
                              <a href="javascript:history.back()" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
                            </div>
                          </div> 
                        </div><br>





                      </div>
                    </div>
                  </div>



          </form>
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
      showNotification('top', 'right', 'Please select the strand and section to be assigned to the applicants.');
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
          title: 'Set a Strand & Section',
          text: 'Are you sure that all selected applicants will have the same strand and section? ',
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
            document.getElementById('enlistApplicant').submit();
            swal({
            title: 'Record Submitted!',
            text: 'All selected applicants are now Shortlisted.',
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


