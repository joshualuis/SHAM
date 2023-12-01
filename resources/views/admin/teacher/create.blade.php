@extends('layouts.master')

@section('title')
   Teachers
@endsection

@section('pagetitle')
   TEACHERS
@endsection

@section('css')
@endsection

@section('content')



<div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <a href="/admin/teachers">
        <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	      </button>
      </a><br><br>
	    
      <div class="card">
	      <div class="card-header">
          
          @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li>{{ $error }}</li>
                  @endforeach
              </ul>
          </div>
          @endif
          
	        <h4 class="card-title">ADDING A NEW RECORD</h4>
	      </div>
	      
        <div class="card-content">
          <form id="createteacher" action="/admin/teachers" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Position Title<star>*</star></label>
                    <input class="form-control" type="text" id="position" name="position" value="{{old('position')}}" placeholder="ex: Teacher I" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">First Name<star>*</star></label>
                    <input class="form-control" type="text" id="fname" name="fname" value="{{old('fname')}}" placeholder="ex: maria clara" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Middle Name<star>*</star></label>
                    <input class="form-control" type="text" id="mname" name="mname" value="{{old('mname')}}" placeholder="ex: reyes" required="required"  >
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">Last Name<star>*</star></label>
                    <input class="form-control" type="text" id="lname" name="lname" value="{{old('lname')}}" placeholder="ex: alba" required="required"  >
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Contact<star>*</star></label> <label style="font-style: italic; opacity: 0.5;" >FORMAT: +63XXXXXXXXXX</label>
                    <input type="tel" class="form-control" placeholder="" id="contact" name="contact" value="{{ old('contact', '+63') }}" required="required" pattern="^\+63[0-9]{10}$">

                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Email<star>*</star></label><label style="font-style: italic; opacity: 0.5;" >FORMAT: XXX@gmail.com</label>
                    <input class="form-control" type="text" id="email" name="email" value="{{old('email')}}" placeholder="ex: albamaya@gmail.com" required pattern="[a-zA-Z0-9._%+-]+@gmail\.com$">
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Gender<star>*</star></label>
                    {!! Form::select('gender', ['FEMALE' => 'FEMALE', 'MALE' => 'MALE'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                  </div>
                </div>

                <!-- <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Age<star>*</star></label>
                    <input class="form-control" type="number" id="age" name="age" value="{{old('age')}}" placeholder="age" required="required" maxLength="2"  >
                  </div>
                </div> -->

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Civil Status<star>*</star></label>
                    {!! Form::select('civilstatus', ['SINGLE' => 'SINGLE', 'MARRIED' => 'MARRIED', 'DIVORCED' => 'DIVORCED', 'SEPARATED' => 'SEPARATED', 'WIDOWED' => 'WIDOWED'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                   </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Birthdate<star>*</star></label>
                    <input class="form-control" type="date" id="birthdate" name="birthdate" value="{{old('birthdate')}}" placeholder="birthdate" required="required"  >
                  </div>
                </div>
                
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Role</label>
                    {!! Form::select('coordinator', $strands, null,['placeholder' => 'TEACHER', 'class' => 'form-control','id'=>'coordinator']) !!}              
                  </div>
                </div>


                <div class="col-sm-8">
                  <div class="form-group">
                    <label class="control-label">Address<star>*</star></label>
                    <input class="form-control" type="text" id="address" name="address" value="{{old('address')}}" placeholder="ex: House No. Street, Barangay, City"  required="required"  >
                  </div>
                </div>
              </div>

              <hr>

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Highest Educational Attainment<star>*</star></label>
                    {!! Form::select('educattainment', ['Bachelor Degree' => 'Bachelor Degree', 'Master Degree Units' => 'Master Degree Units', 'Master Degree' => 'Master Degree', 'Doctorate Degree Units' => 'Doctorate Degree Units', 'Doctorate Degree' => 'Doctorate Degree'], null,['placeholder' => 'Select the highest educational attainment','class' => 'form-control','required'=>'true']) !!}
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">No. of Years Teaching<star>*</star></label>
                    <input class="form-control" type="number" id="numberofteaching" name="numberofteaching" value="{{old('numberofteaching')}}" placeholder="Number of years teaching" required="required"  >
                  </div>
                </div>
              </div>

              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Major in<star>*</star></label>
                    <input class="form-control" type="text" id="major" name="major" value="{{old('major')}}" placeholder="major" required="required"  >
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Minor in</label>
                    <input class="form-control" type="text" id="minor" name="minor" value="{{old('minor')}}" placeholder="minor" >
                  </div>
                </div>
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Certification/Trainings</label>
                    <input class="form-control" type="text" id="certificate" name="certificate" value="{{old('certificate')}}" placeholder="certificate" >
                  </div>
                </div>
              </div>

              <hr>
              
              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Upload Profile Photo<star>*</star></label>
                    <input class="form-control" type="file" id="image" name="image" value="{{old('image')}}" placeholder="Upload image" required="required"  >
                  </div>
                </div>
              
              </div>

              <div class="row"><br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <!-- <button type="submit" class="btn btn-success btn-fill btn-wd">Save</button> -->
                    <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                    
                    <a href="/admin/teachers">
                      <button type="button" class="btn btn-wd">BACK</button>
                    </a>
                  </div>
                </div> 
              </div>

              <br>

          </form>
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
          title: 'Add a new record',
          text: 'Would you like to submit this record?',
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
            document.getElementById('createteacher').submit();
            
            swal({
            title: 'Submitted!',
            text: 'New record is saved!',
            type: 'success',
            confirmButtonClass: "btn btn-success btn-fill",
            buttonsStyling: false
            })
          } else {
            swal({
            title: 'Cancelled!',
            text: 'Record submission cancelled',
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