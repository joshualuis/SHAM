@extends('layouts.master')

@section('title')
EDIT PROFILE 
@endsection

@section('pagetitle')
  EDIT PROFILE 
@endsection

@section('css')

@endsection

@section('content')

<div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <a href="/getProfile">
        <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	      </button>
      </a><br><br>
	    
      <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">Edit your profile</h4>
	      </div>
	      
        <div class="card-content">
        {{ Form::model($teacher,['method'=>'PATCH','route' => ['teacher.updateProfile', $teacher->_id, 'files' => true], 'id' => 'editProfile']) }}
            @csrf
            <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Position Title<star>*</star></label>
                    {{ Form::text('position',null,array('class'=>'form-control','id'=>'position','required'=>'true')) }}
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">First Name<star>*</star></label>
                    {{ Form::text('fname',null,array('class'=>'form-control','id'=>'fname','required'=>'true')) }}
                  </div>                 
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Middle Name<star>*</star></label>
                    {{ Form::text('mname',null,array('class'=>'form-control','id'=>'mname','required'=>'true')) }}                 
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Last Name<star>*</star></label>
                    {{ Form::text('lname',null,array('class'=>'form-control','id'=>'lname','required'=>'true')) }}                  
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Contact<star>*</star></label> <label style="font-style: italic; opacity: 0.5;" >FORMAT: +63XXXXXXXXXX</label>
                    {{ Form::text('contact', null, array('class' => 'form-control', 'id' => 'contact', 'pattern' => '^\+63[0-9]{10}$', 'required' => 'true')) }}       
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Email<star>*</star></label><label style="font-style: italic; opacity: 0.5;" >FORMAT: XXX@gmail.com</label>
                    {{ Form::text('email', null, array('class' => 'form-control', 'id' => 'email', 'placeholder' => 'ex: albamaya@gmail.com', 'required' => 'true', 'pattern' => '[a-zA-Z0-9._%+-]+@gmail\.com$')) }}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Gender<star>*</star></label>
                    {!! Form::select('gender', ['FEMALE' => 'FEMALE', 'MALE' => 'MALE'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'required' => 'true']) !!}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Age<star>*</star></label>
                    {{ Form::text('age',null,array('class'=>'form-control','id'=>'age','required'=>'true')) }}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Civil Status<star>*</star></label>
                    {!! Form::select('civilstatus', ['SINGLE' => 'SINGLE', 'MARRIED' => 'MARRIED', 'DIVORCED' => 'DIVORCED', 'SEPARATED' => 'SEPARATED', 'WIDOWED' => 'WIDOWED'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'required' => 'required']) !!}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Birthdate<star>*</star></label>
                    {{ Form::date('birthdate',null,array('class'=>'form-control','id'=>'birthdate','required'=>'true')) }}
                  </div>
                </div>

                <div class="col-sm-12">
                  <div class="form-group">
                    <label class="control-label">Address<star>*</star></label>
                    {{ Form::text('address',null,array('class'=>'form-control','id'=>'address','required'=>'true')) }}    
                  </div>
                </div>
                

              </div>

              <hr>

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Highest Educational Attainment<star>*</star></label>
                    {!! Form::select('educattainment', ['Bachelor Degree' => 'Bachelor Degree', 'Master Degree Units' => 'Master Degree Units', 'Master Degree' => 'Master Degree', 'Doctorate Degree Units' => 'Doctorate Degree Units', 'Doctorate Degree' => 'Doctorate Degree'], null,['placeholder' => 'Select the highest educational attainment','class' => 'form-control','required'=>'true','id'=>'educattainment']) !!}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">No. of Years Teaching<star>*</star></label>
                    {{ Form::number('numberofteaching',null,array('class'=>'form-control','id'=>'numberofteaching','required'=>'true')) }}  
                  </div>
                </div>
              
              </div>

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Major in<star>*</star></label>
                    {{ Form::text('major',null,array('class'=>'form-control','id'=>'major','required'=>'true')) }}           
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Minor in</label>
                    {{ Form::text('minor',null,array('class'=>'form-control','id'=>'minor')) }}                 
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Certification/Trainings</label>
                    {{ Form::text('certificate',null,array('class'=>'form-control','id'=>'certificate')) }}                  
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Change Profile Photo</label><br>
                    <img src= "{{URL::asset($teacher->image)}}" style="width:100px; height:100px; margin-left:10px;" /> <br><br>
                    <input class="form-control" type="file" id="image" name="image" value="{{old('image')}}" placeholder="Upload image" style="text-transform:uppercase" >
                  </div>
                </div>
              
              </div>

              <div class="row">
                <br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                    <a href="/getProfile" class="btn btn-wd" role="button">Cancel</a>
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
          title: 'Edit a record',
          text: 'Would you like to make changes on your profile?',
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
            document.getElementById('editProfile').submit();
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
