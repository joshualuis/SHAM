@extends('layouts.master')

@section('title')
INTERVIEW SCHEDULE
@endsection

@section('pagetitle')
   INTERVIEW SCHEDULE
@endsection

@section('css')
    
@endsection

@section('content')
          <div class="container-fluid">

	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title">Schedule for Claiming</h4>
	                                <p class="category"></p>
	                            </div>

                              <div class="card-content">
                              <form id="sendEmail" action="/admin/shortlisted/delete" method="POST">
                                  @csrf
                                  <div class="row">
                                      <div class="col-sm-6">
                                        <div class="form-group">
                                          <label class="control-label">Date and Time<star>*</star></label>
                                          {{ Form::datetimeLocal('date',null,array('class'=>'form-control','required'=>'true')) }}
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
                          <h4 class="card-title">Shortlisted</h4>
                          <p class="category">Please ensure you are sending interview schedule for eligible shortlisted.</p>
                        </div>
                        <div class="card-content table-responsive table-full-width">
                          <table class="table">
                            <thead>
                                <th style="padding-left:20px;">NAME</th>
                                <th>1ST CHOICE</th>
                                <th>TRACK</th>
                            </thead>
                            <form action="/admin/applicants/emailing" method="POST">

                                <tbody>
                                <input type="hidden" name="short" value="{{$short->id}}" />
                                  <tr>
                                    <td style="padding-left:20px;">{{$short -> fullname}}</td>
                                    <td>{{$short -> firstchoice}}</td>
                                    <td>{{$short -> track}}</td>
                                  </tr>
                                </tbody>
                          </table>
                        </div>

                        <div class="row"><br>
                          <div class="col-sm-12" >
                            <div class="form-group pull-right" style="margin-right:20px;">
                              <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Send Interview Schedule</button>
                              <a href="/admin/applicants" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
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
          text: 'Would you like to send a scheduled interview to the applicants?',
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
            document.getElementById('sendEmail').submit();
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
            text: 'Email has not been sent.',
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


