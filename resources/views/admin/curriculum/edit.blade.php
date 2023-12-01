@extends('layouts.master')

@section('title')
   SUBJECTS
@endsection

@section('pagetitle')
   SUBJECTS
@endsection

@section('css')
@endsection


@section('content')
<div class="container-fluid">

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Edit a subject record</h4>
                <p class="category"></p>
            </div>

            <div class="card-content">
              {{ Form::model($curriculum,['method'=>'PATCH','route' => ['curriculums.update', $curriculum->_id, 'files' => true], 'id' => 'editSubs']) }}
                @csrf
                <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Name<star>*</star></label>
                        {{ Form::text('name',null,array('class'=>'form-control','id'=>'name','required' => 'true')) }}
                      </div>
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Area<star>*</star></label>
                        {!! Form::select('level', 
                          ['CORE' => 'CORE', 
                          'APPLIED' => 'APPLIED',
                          'SPECIALIZED'=> 'SPECIALIZED',
                          ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                      </div> 
                    </div>

                    <div class="col-md-4">
                      <div class="form-group">
                        <label class="control-label">Specialized to what strand</label>
                        {!! Form::select('strand_id', 
                          ['None' => 'None', 
                          '63de7b883e464e6d2a0eb52b' => 'Accountancy, Business and Management',
                          '63de7b9a3e464e6d2a0eb52c' => 'General Academic',
                          '63de7bac3e464e6d2a0eb52d'=> 'Humanities and Social Sciences',
                          '63de7be23e464e6d2a0eb52e'=> 'Science, Technology, Engineering and Mathematics',
                          '63de7c273e464e6d2a0eb52f'=> 'Caregiving (Nursing Arts)',
                          '63de7c3a3e464e6d2a0eb530'=> 'Electrical Installation and Maintenance',
                          '63de7c613e464e6d2a0eb531'=> 'Home Economics',
                          '63de7c6f3e464e6d2a0eb532'=> 'Information and Communications Technology',
                          ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'required' => 'true']) !!}
                      </div> 
                    </div>

                    <div class="col-md-12">
                      <div class="form-group">
                        <label for="description" class="control-label">Description</label>
                         {{ Form::textarea('description',null,array('class'=>'form-control','id'=>'description','required' => 'true')) }}
                      </div>
                    </div>

                </div>


                <div class="row"><br>
                  <div class="col-sm-12" >
                    <div class="form-group pull-right" style="margin-right:10px;">
                      <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                      <a href="/admin/curriculums" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
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
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    
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
          title: 'Edit Subjects',
          text: 'Would you like to make changes in this subject?',
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
            document.getElementById('editSubs').submit();
            swal({
            title: 'Successfully updated',
            text: 'This subject information is successfully updated!',
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




