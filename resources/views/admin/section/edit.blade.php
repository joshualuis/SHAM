@extends('layouts.master')

@section('title')
  SECTIONS
@endsection

@section('pagetitle')
SECTIONS 
@endsection

@section('css')

@endsection

@section('content')
         
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <a href="/admin/sections">
          <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
          <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
          </button>
        </a><br><br>
      </div>
    </div>

	<div class="row">
	  <div class="col-md-12">
      <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">Edit Section Information</h4>
          <p class="category"></p>
	      </div>
	      
        <div class="card-content">
        {{ Form::model($section,['method'=>'PATCH','route' => ['sections.update', $section->_id, 'files' => true], 'id' => 'editSection']) }}
            @csrf
            <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Strand<star>*</star></label>
                    {!! Form::select('strand_id', $strands, $section->strand_id,['placeholder' => 'Select a Strand', 'class' => 'form-control', 'required' => 'true']) !!}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Grade Level<star>*</star></label>
                    {!! Form::select('glevel', ['11' => '11', '12' => '12'], null,['placeholder' => 'Select','class' => 'form-control', 'required' => 'true']) !!}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Section Name<star>*</star></label>
                    {{ Form::text('name',null,array('class'=>'form-control','id'=>'name', 'required' => 'true')) }}
                    </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Room<star>*</star></label>
                    {{ Form::text('room',null,array('class'=>'form-control','id'=>'room', 'required' => 'true')) }}
                  </div>
                </div>
                
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Adviser<star>*</star></label>
                    {!! Form::select('teacher_id',$diff, $section->teacher_id,['placeholder' => 'Select an Advisor', 'class' => 'form-control', 'required' => 'true']) !!}
                  </div>
                </div>

              </div>

              <div class="row">
                <br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                    <a href="/admin/sections" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
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
          title: 'Edit Section',
          text: 'Would you like to make changes in this section?',
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
            document.getElementById('editSection').submit();
            swal({
            title: 'Successfully updated',
            text: 'This section information is successfully updated!',
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


