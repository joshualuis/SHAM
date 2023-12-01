@extends('layouts.master')

@section('title')
  STUDENTS
@endsection

@section('pagetitle')
  PROMOTION 
@endsection

@section('css')

@endsection

@section('content')
         
<div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <a href="javascript:history.back()">
          <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
          <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
          </button>
        </a>
      </div>
    </div>

	<div class="row">
	  <div class="col-md-12">
      <br><br>
	    <form id="promoteStudent" action="/admin/students/promote" method="POST">
        @if($section->glevel == '11')
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Set a new section</h4>
            <p class="category">Please ensure you are promoting incoming Grade 12 students with the same strand and section.</p>
          </div>
	      
        <div class="card-content">
          <form action="/sections" method="POST">
            @csrf
            <div class="row">
            <input type="hidden" class="form-control" id="section_id" name="section_id" value="{{$section->id}}">
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Section Name<star>*</star></label>
                    {{ Form::text('sectionName',null,array('class'=>'form-control','id'=>'sectionName')) }}                  
                  </div>
                </div>

                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Room<star>*</star></label>
                    <input class="form-control" type="text" id="room" name="room" value="{{old('room')}}" placeholder="ex: room" required="required" style="text-transform:uppercase" >
                  </div>
                </div>
                
                <div class="col-sm-4">
                  <div class="form-group">
                    <label class="control-label">Adviser<star>*</star></label>
                    {!! Form::select('teacher_id', $fteacher, null, ['placeholder' => 'Select an Adviser','class' => 'form-control']) !!}         
                  </div>
                </div>

              </div>

              <br>

	      </div>
	    </div>
      @endif
	  </div>
  </div>

                    <div class="row">
	                    <div class="col-md-12">
                        <div class="card">

                          <div class="card-header">
                            <div class="row">

                              <div class="col-sm-4">
                                  <h4 class="card-title"><b>SECTION:</b> {{$section->glevel}} - {{$section->name}}</h4> 
                              </div>

                              <div class="col-sm-4"> 
                                  @if(empty($section->teacher))
                                    <h4 class="card-title"><b>ADVISER:</b> TBD</h4> 
                                  @else
                                      <h4 class="card-title"><b>ADVISER:</b> {{$section -> teacher -> lname}}, {{$section -> teacher -> fname}} {{$section -> teacher -> mname}}</h4>
                                  @endif
                              </div>
                              
                              <div class="col-sm-4">
                                <h4 class="card-title">{{$allCleared}} / {{$allStudent}} Students are cleared</h4>
                              </div>
                                            
                            </div>
                          </div>
                            
                          <div class="card-content table-responsive table-full-width">
                              <table class="table">
                                  <thead>
                                    <tr>
                                      <th style="padding-left:20px;">NAME</th>
                                      <th>CLEARANCE</th>
                                      <th>STATUS</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  @foreach($cleared as $student)
                                    <tr>
                                      <td style="padding-left:20px;">{{$student -> lname}}, {{$student->fname}} {{$student->mname}}</td>
                                      <td>{{$student->clearance}}</td>
                                      <td>{{$student->status}}</td>
                                      <!-- <td>
                                        <a href="/admin/students/showStudent/{{$student->id}}"> <button type="submit"id="enrollBtn" class="btn btn-warning float-left">view info</button></a>
                                      </td> -->
                                    </tr>
                                  @endforeach
                                  </tbody>
                              </table>
                          </div>

                          <div class="row">
                            <div class="col-sm-12">
                              <div class="form-group pull-right" style="margin-right:20px;">
                                @if($section->glevel == '11')
                                  <button type="button" onclick="promoteSwal('warning-message-and-cancel')" id="promoteBtn" class="btn btn-success btn-fill btn-wd">PROMOTE ALL</button>
                                  
                                @else
                                  <a href="/admin/students/promoteGraduation/{{$section->id}}"> <button type="button" id="moveupBtn" class="btn btn-success btn-fill btn-wd">MOVE UP</button></a>
                                @endif
                                  <a href="javascript:history.back()" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
                              </div>
                            </div> 
                          </div>

                          <br>
	                            
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
        showNotification('top', 'right', 'Fill in the required fields before submitting. </>Please make sure everything is correct before submitting.');
        return false;
      }
    }

    return true;
  }
</script>


<script>
  function promoteSwal(type) {

    if (validateForm()) {
      if (type == 'warning-message-and-cancel') {
        swal({
          title: 'Promote Students',
          text: 'Would you like to promote this students?',
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
            document.getElementById('promoteStudent').submit();
            
            swal({
            title: 'Submitted!',
            text: 'Cleared students are now promoted to Grade 12!',
            type: 'success',
            confirmButtonClass: "btn btn-success btn-fill",
            buttonsStyling: false
            })
          } else {
            swal({
            title: 'Cancelled!',
            text: 'Record submission cancelled.',
            type: 'error',
            confirmButtonClass: "btn btn-danger btn-fill",
            buttonsStyling: false
            })
          }
        });
      } 
    }}


    function moveupSwal(type) {

    if (validateForm()) {
      if (type == 'warning-message-and-cancel') {
        swal({
          title: 'Moveup Students',
          text: 'Would you like to moveup this students?',
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
            document.getElementById('moveupBtn').submit();
            
            swal({
            title: 'Submitted!',
            text: 'Cleared students are now moved up and ready to graduate!',
            type: 'success',
            confirmButtonClass: "btn btn-success btn-fill",
            buttonsStyling: false
            })
          } else {
            swal({
            title: 'Cancelled!',
            text: 'Record submission cancelled.',
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