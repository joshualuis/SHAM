@extends('layouts.master')

@section('title')
  PROFILE
@endsection

@section('pagetitle')
   EDIT PROFILE
@endsection

@section('css')

@endsection

@section('content')
{{ Form::model($student,['method'=>'PATCH' ,'route' => ['student.updateProfile', $student->_id, 'files' => true], 'enctype' => 'multipart/form-data','id'=>'editProfile']) }}
@csrf
              
                <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header">
	                                <h4 class="card-title"><B>STUDENT INFORMATION</b></h4>
	                                <p class="category"></p>
	                            </div>

                              <div class="card-content">
                                  <div class="row">
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="lrn" class="control-label">LRN</label>
                                        {{ Form::text('lrn',null,array('class'=>'form-control','id'=>'lrn','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="psanumber" class="control-label">PSA No.</label>
                                        {{ Form::text('psanumber',null,array('class'=>'form-control','id'=>'psanumber','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="glevel" class="control-label">Grade Level</label>
                                        {{ Form::text('glevel',null,array('class'=>'form-control','id'=>'religion', 'disabled' => true)) }}
                                      </div>
                                    </div>

                          

                                  </div>
                                  <div class="row">
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="fname" class="control-label">First Name</label>
                                        {{ Form::text('fname',null,array('class'=>'form-control','id'=>'fname','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="mname" class="control-label">Middle Name</label>
                                        {{ Form::text('mname',null,array('class'=>'form-control','id'=>'mname','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="lname" class="control-label">Last Name</label>
                                        {{ Form::text('lname',null,array('class'=>'form-control','id'=>'lname','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="extname" class="control-label">Extension Name</label>
                                        {!! Form::select('extname', ['N/A' => 'N/A','Sr.' => 'Sr.', 'Jr.' => 'Jr.'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                                      </div>
                                    </div>
                                  </div>
                                  <div class="row">

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="email" class="control-label">Email</label>
                                        {{ Form::text('email',null,array('class'=>'form-control','id'=>'email', 'disabled' => true)) }}
                                      </div>
                                    </div>

                                    
                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="birthdate" class="control-label">Date of Birth</label>
                                        {{ Form::date('birthdate',null,array('class'=>'form-control','id'=>'birthdate','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="age" class="control-label">Age</label>
                                        {{ Form::number('age',null,array('class'=>'form-control','id'=>'age','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="gender" class="control-label">Gender</label>
                                        {!! Form::select('gender', ['male' => 'Male', 'female' => 'Female'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required'=>'true']) !!}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="contact" class="control-label">Contact</label>
                                        {{ Form::text('contact',null,array('class'=>'form-control','id'=>'contact','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="mothertongue" class="control-label">Mother Tongue</label>
                                        {{ Form::text('mothertongue',null,array('class'=>'form-control','id'=>'mothertongue','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="religion" class="control-label">Religion</label>
                                        {{ Form::text('religion',null,array('class'=>'form-control','id'=>'religion','required'=>'true')) }}
                                      </div>
                                    </div>

                                  </div>

                                  <hr>

                                  <div class="row">
                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="housestreet" class="control-label">House Street</label>
                                        {{ Form::text('housestreet',null,array('class'=>'form-control','id'=>'housestreet','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="barangay" class="control-label">Barangay</label>
                                        {{ Form::text('barangay',null,array('class'=>'form-control','id'=>'barangay','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="city" class="control-label">City</label>
                                        {{ Form::text('city',null,array('class'=>'form-control','id'=>'city','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label for="province" class="control-label">Province</label>
                                        {{ Form::text('province',null,array('class'=>'form-control','id'=>'province','required'=>'true')) }}
                                      </div>
                                    </div>

                                    <div class="col-md-2">
                                      <div class="form-group">
                                        <label for="region" class="control-label">Region</label>
                                        {{ Form::text('region',null,array('class'=>'form-control','id'=>'region','required'=>'true')) }}
                                      </div>
                                    </div>
                                  </div>
                                  

                                  <div class="row">
                                    <div class="col-md-3">
                                        <img src= "{{URL::asset($student->image)}}" style=" height:150" /> <br>
                                        <label for="image"  class="control-label">Upload Image</label>
                                        <input type="file" class="form-control" name="image" />
                                    </div>
                                  </div> 

                                  <hr>

                                  <div class="row">
                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="indipeople" class="control-label">Indigenous People<star>*</star></label>
                                        {!! Form::select('indipeople', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'indipeople', 'required' => true]) !!}
                                        <label for="">if yes, please specify</label>

                                        @if($student->indipeople == 'No')
                                          {{ Form::text('yesindipeople','',array('class'=>'form-control','id'=>'yesindipeople' , 'disabled' => true)) }}
                                        @endif
                                        @if($student->indipeople == 'Yes')
                                          {{ Form::text('yesindipeople',null,array('class'=>'form-control','id'=>'yesindipeople')) }}
                                        @endif
                                        
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="specialneeds" class="control-label">Special in Need<star>*</star></label>
                                        {!! Form::select('specialneeds', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'specialneeds', 'required' => true]) !!}
                                        <label for="">if yes, please specify</label>

                                        @if($student->specialneeds == 'No')
                                          {{ Form::text('yesspecialneeds','',array('class'=>'form-control','id'=>'yesspecialneeds' , 'disabled' => true)) }}
                                        @endif
                                        @if($student->specialneeds == 'Yes')
                                          {{ Form::text('yesspecialneeds',null,array('class'=>'form-control','id'=>'yesspecialneeds')) }}
                                        @endif
                                      </div>
                                    </div>

                                    <div class="col-md-4">
                                      <div class="form-group">
                                        <label for="assistivedevices" class="control-label">Assistive Devices<star>*</star></label>
                                        {!! Form::select('assistivedevices', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'assistivedevices', 'required' => true]) !!}
                                        <label for="">if yes, please specify</label>

                                        @if($student->assistivedevices == 'No')
                                          {{ Form::text('yesassistivedevices','',array('class'=>'form-control','id'=>'yesassistivedevices' , 'disabled' => true)) }}
                                        @endif
                                        @if($student->assistivedevices == 'Yes')
                                          {{ Form::text('yesassistivedevices',null,array('class'=>'form-control','id'=>'yesassistivedevices')) }}
                                        @endif
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
                      <div class="card-header" >
                              <h4 class="card-title"><b>PARENT/GUARDIAN INFORMATION</b></h4>
                         
                      </div>

                        <div class="card-content">
                          <div class="row">

                            <div class="col-md-4 pl-3">
                              <div class="form-group">
                                <label for="fathername" class="control-label">Father's Name</label>
                                {{ Form::text('fathername',null,array('class'=>'form-control','id'=>'fathername','placeholder'=>'Last Name, First Name, Middle Name')) }}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="fathereducation" class="control-label">Highest Educational Attainment</label>
                                {!! Form::select('fathereducation', [
                                    'none' => 'none', 
                                    'elementary graduate' => 'elementary graduate',
                                    'high school graduate' => 'high school graduate',
                                    'college graduate' => 'college graduate',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="fatheremployment" class="control-label">Employment Status</label>
                                {!! Form::select('fatheremployment', [
                                    'house husband' => 'house husband', 
                                    'self-employed' => 'self-employed',
                                    'fixed-employed' => 'fixed-employed',
                                    'regular-employed' => 'regular-employed',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="fatherworkstat" class="control-label">Working From home due to ECQ?</label>
                                {!! Form::select('fatherworkstat', [
                                    'no' => 'No', 
                                    'yes' => 'Yes',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="fathercontact" class="control-label">Father's Contact</label>
                                {{ Form::text('fathercontact',null,array('class'=>'form-control','id'=>'fathercontact')) }}
                              </div>
                            </div>

                            <div class="col-md-4 pl-3">
                              <div class="form-group">
                                <label for="mothername" class="control-label">Mother's Maiden Name</label>
                                {{ Form::text('mothername',null,array('class'=>'form-control','id'=>'mothername','placeholder'=>'Last Name, First Name, Middle Name')) }}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="mothereducation" class="control-label">Highest Educational Attainment</label>
                                {!! Form::select('mothereducation', [
                                    'none' => 'none', 
                                    'elementary graduate' => 'elementary graduate',
                                    'high school graduate' => 'high school graduate',
                                    'college graduate' => 'college graduate',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="motheremployment" class="control-label">Employment Status</label>
                                {!! Form::select('motheremployment', [
                                    'house husband' => 'house wife', 
                                    'self-employed' => 'self-employed',
                                    'fixed-employed' => 'fixed-employed',
                                    'regular-employed' => 'regular-employed',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="motherworkstat" class="control-label">Working From home due to ECQ?</label>
                                {!! Form::select('motherworkstat', [
                                    'no' => 'No', 
                                    'yes' => 'Yes',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="mothercontact" class="control-label">Mother's Contact</label>
                                {{ Form::text('mothercontact',null,array('class'=>'form-control','id'=>'mothercontact')) }}
                              </div>
                            </div>


                            <div class="col-md-4 pl-3">
                              <div class="form-group">
                                <label for="guardianname" class="control-label">Guardian's Name</label>
                                {{ Form::text('guardianname',null,array('class'=>'form-control','id'=>'guardianname','placeholder'=>'Last Name, First Name, Middle Name')) }}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="guardianeducation" class="control-label">Highest Educational Attainment</label>
                                {!! Form::select('guardianeducation', [
                                    'none' => 'none', 
                                    'elementary graduate' => 'elementary graduate',
                                    'high school graduate' => 'high school graduate',
                                    'college graduate' => 'college graduate',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="guardianemployment" class="control-label">Employment Status</label>
                                {!! Form::select('guardianemployment', [
                                    'house husband' => 'house wife', 
                                    'self-employed' => 'self-employed',
                                    'fixed-employed' => 'fixed-employed',
                                    'regular-employed' => 'regular-employed',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="guardianworkstat" class="control-label">Working From home due to ECQ?</label>
                                {!! Form::select('guardianworkstat', [
                                    'no' => 'No', 
                                    'yes' => 'Yes',
                                    ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                              </div>
                            </div>

                            <div class="col-md-2 pl-1">
                              <div class="form-group">
                                <label for="guardiancontact" class="control-label">Guardian's Contact</label>
                                {{ Form::text('guardiancontact',null,array('class'=>'form-control','id'=>'guardiancontact')) }}
                              </div>
                            </div>



                          </div> 
                            <div class="row"><br>
                                <div class="col-sm-12" >
                                  <div class="form-group pull-right">
                                  <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                                    
                                    <a href="javascript:history.back()">
                                      <button type="button" class="btn btn-wd">BACK
                                      </button>
                                    </a>
                                  </div>
                                </div> 
                              </div>
                        </div>

                        
                          


                      </div>
                    </div>
                  </div>






                </div>


@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>

    <script>
         $(document).ready(function() {

            $('#indipeople').change(function() {
                if ($(this).val() == 'No' || $(this).val() == 'false') {
                $('#yesindipeople').prop('readonly', true).val('N/A').attr('name', 'yesindipeople');
                } else {
                $('#yesindipeople').prop('readonly', false);
                }
            });

            $('#specialneeds').change(function() {
                if ($(this).val() == 'No' || $(this).val() == 'false') {
                $('#yesspecialneeds').prop('readonly', true).val('N/A').attr('name', 'yesspecialneeds');
                } else {
                $('#yesspecialneeds').prop('readonly', false);
                }
            });

            $('#assistivedevices').change(function() {
                if ($(this).val() == 'No' || $(this).val() == 'false') {
                $('#yesassistivedevices').prop('readonly', true).val('N/A').attr('name', 'yesassistivedevices');
                } else {
                $('#yesassistivedevices').prop('readonly', false);
                }
            });

});
    </script>

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


