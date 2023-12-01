
@extends('layouts.master')

@section('title')
   SCHEDULE
@endsection

@section('pagetitle')
   SCHEDULE
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
                            </a><br><br>
	                        <div class="card">
	                            <div class="card-header">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <h4 class="card-title"><b>SECTION:</b> {{$section->glevel}} - {{$section->name}}</h4> 
                                        </div>
                                        <div class="col-sm-6"> 
                                            @if(empty($section->teacher))
                                                <h4>ADVISER: TBD</h4>
                                            @else
                                                <h4 class="card-title"><b>ADVISER:</b> {{$section -> teacher -> lname}}, {{$section -> teacher -> fname}} {{$section -> teacher -> mname}}</h4>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    <br>
                                </div>
	                        </div>
	                            <div class="card-content table-responsive table-full-width">
	                                
	                            </div>
	                    </div>
	                </div>
                </div>


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
    
            
                {{ Form::model($section,['method'=>'PATCH','route' => ['subject.update', $section->_id, 'files' => true], 'id' => 'schedEdit']) }}
                @csrf

                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title"><b>SCHEDULE:</b> {{$sem->semester}} Semester / School Year: {{$year->year}}</h4>
                                <input type="hidden" name="section_id" value="{{$section->id}}">
                            </div>
                            
                                
                           
                            <div class="card-content">
                                <!-- -----------------MONDAY----------------- -->

                                  <div class="row">
                                    @if (session('mon_error'))
                                        <div class="alert alert-danger">
                                            {{ session('mon_error') }}
                                        </div>
                                    @endif
                                    <div class="col-md-2">
                                    <button class="btn btn-warning mon_add">+</button>
                                        <label for="">MONDAY</label>
                                      
                                      
                                    </div>
                                  </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                    <div id="show_mon">
                                    @foreach ($schedules as $sched)
                                        @if ($sched->day == 'monday')
                                                <div class="row"><br>
                                                    
                                                    <div class="col-md-1 mb-5 d-grid"><br>
                                                        <button class="btn btn-danger mon_remove">-</button>
                                                    </div>

                                                    <div class="col-md-3 mb-3">Subject
                                                        {!! Form::select('mon_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">Teacher
                                                        {!! Form::select('mon_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="col-md-2 mb-3">Room
                                                        {!! Form::text('mon_room[]', $sched->room, ['class' => 'form-control']) !!}
                                                    </div>
                                                                
                                                    <div class="col-md-2 mb-3">Start
                                                    {!! Form::time('mon_start[]', $sched->start, ['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">End
                                                    {!! Form::time('mon_end[]', $sched->end, ['class' => 'form-control']) !!}
                                                    </div>

                                                </div>
                                        @endif
                                    @endforeach
                                    </div>
                                    </div>

                                  </div>

                                <!-- -----------------MONDAY----------------- -->
                                <hr>

                                <!-- -----------------TUESDAY----------------- -->
                                <div class="row">
                                    @if (session('tue_error'))
                                        <div class="alert alert-danger">
                                            {{ session('tue_error') }}
                                        </div>
                                    @endif
                                    <div class="col-md-12">
                                    <button class="btn btn-warning tue_add">+</button>
                                        <label for="">TUESDAY</label>
                                        
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                    <div id="show_tue">
                                    @foreach ($schedules as $sched)
                                        @if ($sched->day == 'tuesday')
                                                <div class="row"><br>
                                                    
                                                    <div class="col-md-1 mb-5 d-grid"><br>
                                                        <button class="btn btn-danger tue_remove">-</button>
                                                    </div>

                                                    <div class="col-md-3 mb-3">Subject
                                                        {!! Form::select('tue_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">Teacher
                                                        {!! Form::select('tue_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="col-md-2 mb-3">Room
                                                        {!! Form::text('tue_room[]', $sched->room, ['class' => 'form-control']) !!}
                                                    </div>
                                                                
                                                    <div class="col-md-2 mb-3">Start
                                                    {!! Form::time('tue_start[]', $sched->start, ['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">End
                                                    {!! Form::time('tue_end[]', $sched->end, ['class' => 'form-control']) !!}
                                                    </div>

                                                </div>
                                        @endif
                                    @endforeach
                                    </div>
                                    </div>

                                  </div>


                                <!-- -----------------TUESDAY----------------- -->
                            <hr>

                                <!-- -----------------WEDNESDAY----------------- -->
                                <div class="row">
                                    @if (session('wed_error'))
                                        <div class="alert alert-danger">
                                            {{ session('wed_error') }}
                                        </div>
                                    @endif
                                    <div class="col-md-2">
                                    <button class="btn btn-warning wed_add">+</button>
                                        <label for="">WEDNESDAY</label>
                                      
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                    <div id="show_wed">
                                    @foreach ($schedules as $sched)
                                        @if ($sched->day == 'wednesday')
                                                <div class="row"><br>
                                                    
                                                    <div class="col-md-1 mb-5 d-grid"><br>
                                                        <button class="btn btn-danger wed_remove">-</button>
                                                    </div>

                                                    <div class="col-md-3 mb-3">Subject
                                                        {!! Form::select('wed_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">Teacher
                                                        {!! Form::select('wed_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="col-md-2 mb-3">Room
                                                        {!! Form::text('wed_room[]', $sched->room, ['class' => 'form-control']) !!}
                                                    </div>
                                                                
                                                    <div class="col-md-2 mb-3">Start
                                                    {!! Form::time('wed_start[]', $sched->start, ['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">End
                                                    {!! Form::time('wed_end[]', $sched->end, ['class' => 'form-control']) !!}
                                                    </div>

                                                </div>
                                        @endif
                                    @endforeach
                                    </div>
                                    </div>

                                  </div>


                                <!-- -----------------WEDNESDAY----------------- -->
                            <hr>

                             <!-- -----------------THURSDAY----------------- -->
                             <div class="row">
                                    @if (session('thu_error'))
                                        <div class="alert alert-danger">
                                            {{ session('thu_error') }}
                                        </div>
                                    @endif
                                    <div class="col-md-2">
                                      <button class="btn btn-warning thu_add">+</button>
                                        <label for="">THURSDAY</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                    <div id="show_thu">
                                    @foreach ($schedules as $sched)
                                        @if ($sched->day == 'thursday')
                                                <div class="row"><br>
                                                    
                                                    <div class="col-md-1 mb-5 d-grid"><br>
                                                        <button class="btn btn-danger thu_remove">-</button>
                                                    </div>

                                                    <div class="col-md-3 mb-3">Subject
                                                        {!! Form::select('thu_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">Teacher
                                                        {!! Form::select('thu_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control']) !!}
                                                    </div>

                                                    <div class="col-md-2 mb-3">Room
                                                        {!! Form::text('thu_room[]', $sched->room, ['class' => 'form-control']) !!}
                                                    </div>
                                                                
                                                    <div class="col-md-2 mb-3">Start
                                                    {!! Form::time('thu_start[]', $sched->start, ['class' => 'form-control']) !!}
                                                    </div>
                                                    <div class="col-md-2 mb-3">End
                                                    {!! Form::time('thu_end[]', $sched->end, ['class' => 'form-control']) !!}
                                                    </div>

                                                </div>
                                        @endif
                                    @endforeach
                                    </div>
                                    </div>

                                  </div>


                                <!-- -----------------THURSDAY----------------- -->
                            <hr>

                            <!-- -----------------FRIDAY----------------- -->
                            <div class="row">
                                    @if (session('fri_error'))
                                        <div class="alert alert-danger">
                                            {{ session('fri_error') }}
                                        </div>
                                    @endif
                                    <div class="col-md-2">
                                      <button class="btn btn-warning fri_add">+</button>
                                        <label for="">FRIDAY</label>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="show_fri">
                                        @foreach ($schedules as $sched)
                                            @if ($sched->day == 'friday')
                                                    <div class="row"><br>
                                                        
                                                        <div class="col-md-1 mb-5 d-grid"><br>
                                                            <button class="btn btn-danger fri_remove">-</button>
                                                        </div>

                                                        <div class="col-md-3 mb-3">Subject
                                                            {!! Form::select('fri_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-2 mb-3">Teacher
                                                            {!! Form::select('fri_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control']) !!}
                                                        </div>

                                                        <div class="col-md-2 mb-3">Room
                                                            {!! Form::text('fri_room[]', $sched->room, ['class' => 'form-control']) !!}
                                                        </div>
                                                                    
                                                        <div class="col-md-2 mb-3">Start
                                                        {!! Form::time('fri_start[]', $sched->start, ['class' => 'form-control']) !!}
                                                        </div>
                                                        <div class="col-md-2 mb-3">End
                                                        {!! Form::time('fri_end[]', $sched->end, ['class' => 'form-control']) !!}
                                                        </div>

                                                    </div>
                                            @endif
                                        @endforeach
                                        </div>
                                    </div>

                                  </div>
                                <!-- -----------------FRIDAY----------------- -->

                                <hr>

                                <div class="row"><br>
                                    <div class="col-sm-12" >
                                    <div class="form-group pull-right">
                                        <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                                        <a href="javascript:history.back()" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
                                    </div>
                                    </div> 
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
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'></script>
<script>
    $(document).ready(function(){

        // ------------------------------- MONDAY
        $(".mon_add").click(function(e){
            e.preventDefault();
            $("#show_mon").append(`
                <div class="row append_day"><br>

                  <div class="col-md-1 mb-5 d-grid"><br>
                    <button class="btn btn-danger mon_remove">-</button>
                  </div>

                  <div class="col-md-3 mb-3">Subject
                    {!! Form::select('mon_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-2 mb-3">Teacher
                    {!! Form::select('mon_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-2 mb-3">Room
                    {!! Form::text('mon_room[]', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-2 mb-3">Start
                    <input type="time" name="mon_start[]" id="" class="form-control">
                  </div>

                  <div class="col-md-2 mb-3">End
                    <input type="time" name="mon_end[]" id="" class="form-control">
                  </div>


                </div>
            `);
        });

        $(document).on('click', '.mon_remove', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });

        // ------------------------------- TUESDAY
        $(".tue_add").click(function(e){
            e.preventDefault();
            $("#show_tue").append(`
                <div class="row append_day"><br>

                  <div class="col-md-1 mb-5 d-grid"><br>
                    <button class="btn btn-danger tue_remove">-</button>
                  </div>

                  <div class="col-md-3 mb-3">Subject
                    {!! Form::select('tue_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-2 mb-3">Teacher
                    {!! Form::select('tue_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-2 mb-3">Room
                    {!! Form::text('tue_room[]', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-2 mb-3">Start
                    <input type="time" name="tue_start[]" id="" class="form-control">
                  </div>
                  
                  <div class="col-md-2 mb-3">End
                    <input type="time" name="tue_end[]" id="" class="form-control">
                  </div>

                </div>
            `);
        });

        $(document).on('click', '.tue_remove', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });

        // ------------------------------- WEDNESDAY
        $(".wed_add").click(function(e){
            e.preventDefault();
            $("#show_wed").append(`
                <div class="row append_day"><br>

                  <div class="col-md-1 mb-5 d-grid"><br>
                    <button class="btn btn-danger wed_remove">-</button>
                  </div>

                  <div class="col-md-3 mb-3">Subject
                    {!! Form::select('wed_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                  </div>
                  <div class="col-md-2 mb-3">Teacher
                    {!! Form::select('wed_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-2 mb-3">Room
                    {!! Form::text('wed_room[]', null, ['class' => 'form-control']) !!}
                  </div>

                  <div class="col-md-2 mb-3">Start
                    <input type="time" name="wed_start[]" id="" class="form-control">
                  </div>
                  
                  <div class="col-md-2 mb-3">End
                    <input type="time" name="wed_end[]" id="" class="form-control">
                  </div>

                </div>
            `);
        });

        $(document).on('click', '.wed_remove', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });

        // ------------------------------- THURSDAY
        $(".thu_add").click(function(e){
            e.preventDefault();
            $("#show_thu").append(`
                <div class="row append_day"><br>

                <div class="col-md-1 mb-5 d-grid"><br>
                  <button class="btn btn-danger thu_remove">-</button>
                </div>

                <div class="col-md-3 mb-3">Subject
                  {!! Form::select('thu_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                </div>
                <div class="col-md-2 mb-3">Teacher
                  {!! Form::select('thu_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                </div>

                <div class="col-md-2 mb-3">Room
                  {!! Form::text('thu_room[]', null, ['class' => 'form-control']) !!}
                </div>

                <div class="col-md-2 mb-3">Start
                  <input type="time" name="thu_start[]" id="" class="form-control">
                </div>

                <div class="col-md-2 mb-3">End
                  <input type="time" name="thu_end[]" id="" class="form-control">
                </div>

                </div>
            `);
        });

        $(document).on('click', '.thu_remove', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });


        // ------------------------------- FRIDAY
        $(".fri_add").click(function(e){
            e.preventDefault();
            $("#show_fri").append(`
                <div class="row append_day"><br>

                <div class="col-md-1 mb-5 d-grid"><br>
                  <button class="btn btn-danger fri_remove">-</button>
                </div>

                <div class="col-md-3 mb-3">Subject
                  {!! Form::select('fri_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                </div>
                <div class="col-md-2 mb-3">Teacher
                  {!! Form::select('fri_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                </div>

                <div class="col-md-2 mb-3">Room
                  {!! Form::text('fri_room[]', null, ['class' => 'form-control']) !!}
                </div>

                <div class="col-md-2 mb-3">Start
                  <input type="time" name="fri_start[]" id="" class="form-control">
                </div>

                <div class="col-md-2 mb-3">End
                  <input type="time" name="fri_end[]" id="" class="form-control">
                </div>

                </div>
            `);
        });

        $(document).on('click', '.fri_remove', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });



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

  function showSwal(type) {

      if (type == 'warning-message-and-cancel') {
        swal({
          title: 'Edit Schedule',
          text: 'Would you like to make this changes to the schedule?',
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
            document.getElementById('schedEdit').submit();
            swal({
            title: 'Record Updated',
            text: 'The schedule is successfully updated!',
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
    }


   
</script>
@endsection


