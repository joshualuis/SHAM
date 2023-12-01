@extends('layouts.master')

@section('title')
NEW SCHOOL YEAR
@endsection

@section('pagetitle')
   NEW SCHOOL YEAR
@endsection

@section('css')

@endsection

@section('content')


<div class="container-fluid">
	<div class="row">
	  <div class="col-md-12">
      <a href="/admin/years">
        <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	      </button>
      </a><br><br>
	    
      <div class="card">
	      <div class="card-header">
	        <h4 class="card-title">Create a New School Year</h4>
	      </div>
	      
        <div class="card-content">
        {!! Form::open(['route' => 'years.store', 'id' => 'createSy']) !!}

            @csrf
            <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Year<star>*</star></label>
                    <select name="schooltaon" class="form-control" required="required">
                      @foreach($selectYear as $year)
                          <option value="{{ $year }}">{{ $year }}</option>
                      @endforeach
                  </select>
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Principal<star>*</star></label>
                    <input class="form-control" type="text" id="principal" name="principal" value="{{old('principal')}}" placeholder="ex: maria clara" required="required" style="text-transform:uppercase" >
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Title<star>*</star></label>
                    <input class="form-control" type="text" id="title" name="title" value="{{old('title')}}" placeholder="ex: Principal III" required="required" >
                  </div>
                </div>
              
              </div>
            </div>

            <hr>
            
            <div class="card-header">
              <h4 class="card-title">Create a New Registration</h4>
            </div>
            <div class="card-content">


              <div class="row">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Status<star>*</star></label>
                    {!! Form::select('status', ['Open' => 'Open', 'Close' => 'Close'], null,['placeholder' => 'Select','class' => 'form-control','required'=>'true']) !!}                 
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Start<star>*</star></label>
                    {{ Form::datetimeLocal('start',null,array('class'=>'form-control','required'=>'true')) }}
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">End<star>*</star></label>
                    {{ Form::datetimeLocal('end',null,array('class'=>'form-control','required'=>'true')) }}
                  </div>
                </div>
              </div>
              <label class="control-label"><h5>Target Number of Applicants per Strand</h5></label>

              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">ABM<star>*</star></label>
                    <input class="form-control" type="number" id="abm" name="abm" value="{{old('abm')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">GAS<star>*</star></label>
                    <input class="form-control" type="number" id="gas" name="gas" value="{{old('gas')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">HUMSS<star>*</star></label>
                    <input class="form-control" type="number" id="humss" name="humss" value="{{old('humss')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">STEM<star>*</star></label>
                    <input class="form-control" type="number" id="stem" name="stem" value="{{old('stem')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">CARE<star>*</star></label>
                    <input class="form-control" type="number" id="care" name="care" value="{{old('care')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">HE<star>*</star></label>
                    <input class="form-control" type="number" id="he" name="he" value="{{old('he')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">EIM<star>*</star></label>
                    <input class="form-control" type="number" id="eim" name="eim" value="{{old('eim')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">ICT<star>*</star></label>
                    <input class="form-control" type="number" id="ict" name="ict" value="{{old('ict')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>
              </div>

              <label class="control-label"><h5>Target Number of Waitlisted Applicants</h5></label>

              <div class="row">
                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">ABM<star>*</star></label>
                    <input class="form-control" type="number" id="wabm" name="wabm" value="{{old('wabm')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">GAS<star>*</star></label>
                    <input class="form-control" type="number" id="wgas" name="wgas" value="{{old('wgas')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">HUMSS<star>*</star></label>
                    <input class="form-control" type="number" id="whumss" name="whumss" value="{{old('whumss')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">STEM<star>*</star></label>
                    <input class="form-control" type="number" id="wstem" name="wstem" value="{{old('wstem')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">CARE<star>*</star></label>
                    <input class="form-control" type="number" id="wcare" name="wcare" value="{{old('wcare')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">HE<star>*</star></label>
                    <input class="form-control" type="number" id="whe" name="whe" value="{{old('whe')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">EIM<star>*</star></label>
                    <input class="form-control" type="number" id="weim" name="weim" value="{{old('weim')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>

                <div class="col-sm-3">
                  <div class="form-group">
                    <label class="control-label">ICT<star>*</star></label>
                    <input class="form-control" type="number" id="wict" name="wict" value="{{old('wict')}}" placeholder="ex: 80" required="required">
                  </div>
                </div>
              </div>


            </div>

              <div class="row"><br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                    <a href="/admin/years" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
                  </div>
                </div> 
              </div>

              <br>

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
          title: 'New School Year',
          text: 'Would you like to make a new school year?',
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
            document.getElementById('createSy').submit();
            swal({
            title: 'Successfully created',
            text: 'A new school year is created!',
            type: 'success',
            confirmButtonClass: "btn btn-success btn-fill",
            buttonsStyling: false
            })
          } else {
            swal({
            title: 'Cancelled!',
            text: 'No records made.',
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


