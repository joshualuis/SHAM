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

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">SECTION : {{$section->glevel}} - {{$section->name}}</h4>
        <form action="/admin/subject/semester" id="first_form" method="POST">
            <input type="hidden" name="semester_id" value="63f35b94bde739958336b5c8">
            <input type="hidden" name="section_id" value="{{$section->id}}">
            <a href="javascript:{}" onclick="document.getElementById('first_form').submit();">first semester</a>
        </form>
        <form action="/admin/subject/semester" id="second_form" method="POST">
            <input type="hidden" name="semester_id" value="63f35b9bbde739958336b5c9">
            <input type="hidden" name="section_id" value="{{$section->id}}">
            <a href="javascript:{}" onclick="document.getElementById('second_form').submit();">second semester</a>
        </form>
      </div>
      <div class="card-body">
        
      </div>
    </div>
  </div>
</div>           

<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">SCHEDULE</h4>
      </div>
      
      <div class="card-header">
          <input type="hidden" name="section_id" value="{{$section->id}}">
      </div>

      <div class="card-body p-4">

          <!-- -----------------MONDAY----------------- -->
          <div class="row">
              
              <div class="col-2">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="">Day Monday</label>
                          
                      </div>

                  </div>
              </div>

              <div class="col-9">
                  <div id="show_mon">
                  @foreach ($schedules as $sched)
                      @if ($sched->day == 'monday')
                                <div class="row">
                                  
                                  <div class="col-md-3 mb-3">Subject
                                      {!! Form::select('mon_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">Teacher
                                      {!! Form::select('mon_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                  <div class="col-md-2 mb-3">Room
                                      {!! Form::text('mon_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                              
                                  <div class="col-md-2 mb-3">Start
                                  {!! Form::time('mon_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">End
                                  {!! Form::time('mon_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                </div>
                      @endif
                  @endforeach
                  </div>
              </div>

          </div>
          
          <hr>

          <!-- -----------------TUESDAY----------------- -->
          <div class="row">
              
              <div class="col-2">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="">Day Tuesday</label>
                          
                      </div>

                  </div>
              </div>

              <div class="col-9">
                  <div id="show_tue">
                  @foreach ($schedules as $sched)
                      @if ($sched->day == 'tuesday')
                                <div class="row">
                                  
                                  <div class="col-md-3 mb-3">Subject
                                      {!! Form::select('tue_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">Teacher
                                      {!! Form::select('tue_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                  <div class="col-md-2 mb-3">Room
                                      {!! Form::text('tue_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                              
                                  <div class="col-md-2 mb-3">Start
                                  {!! Form::time('tue_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">End
                                  {!! Form::time('tue_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                </div>
                      @endif
                  @endforeach
                  </div>
              </div>

          </div>

          <hr>

          <!-- -----------------WEDNESDAY----------------- -->
          <div class="row">
              
              <div class="col-2">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="">Day Wednesday</label>
                          
                      </div>

                  </div>
              </div>

              <div class="col-9">
                  <div id="show_wed">
                  @foreach ($schedules as $sched)
                      @if ($sched->day == 'wednesday')
                                <div class="row">
                                  
                                  <div class="col-md-3 mb-3">Subject
                                      {!! Form::select('wed_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">Teacher
                                      {!! Form::select('wed_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                  <div class="col-md-2 mb-3">Room
                                      {!! Form::text('wed_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                              
                                  <div class="col-md-2 mb-3">Start
                                  {!! Form::time('wed_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">End
                                  {!! Form::time('wed_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                </div>
                      @endif
                  @endforeach
                  </div>
              </div>

          </div>
          

          <hr>
          <!-- -----------------THURSDAY----------------- -->
          <div class="row">
              
              <div class="col-2">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="">Day Thursday</label>
                          
                      </div>

                  </div>
              </div>

              <div class="col-9">
                  <div id="show_thu">
                  @foreach ($schedules as $sched)
                      @if ($sched->day == 'thursday')
                                <div class="row">
                                  
                                  <div class="col-md-3 mb-3">Subject
                                      {!! Form::select('thu_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">Teacher
                                      {!! Form::select('thu_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                  <div class="col-md-2 mb-3">Room
                                      {!! Form::text('thu_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                              
                                  <div class="col-md-2 mb-3">Start
                                  {!! Form::time('thu_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">End
                                  {!! Form::time('thu_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                </div>
                      @endif
                  @endforeach
                  </div>
              </div>

          </div>

          <hr>

          <!-- -----------------FRIDAY----------------- -->
          <div class="row">
              
              <div class="col-2">
                  <div class="row">
                      <div class="col-md-4 mb-3">
                          <label for="">Day Friday</label>
                          
                      </div>

                  </div>
              </div>

              <div class="col-9">
                  <div id="show_fri">
                  @foreach ($schedules as $sched)
                      @if ($sched->day == 'friday')
                                <div class="row">
                                  
                                  <div class="col-md-3 mb-3">Subject
                                      {!! Form::select('fri_curriculums[]', $curriculums, $sched->curriculum_id,['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">Teacher
                                      {!! Form::select('fri_teachers[]', $teachers, $sched->teacher_id, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                  <div class="col-md-2 mb-3">Room
                                      {!! Form::text('fri_room[]', $sched->room, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                              
                                  <div class="col-md-2 mb-3">Start
                                  {!! Form::time('fri_start[]', $sched->start, ['class' => 'form-control', 'disabled']) !!}
                                  </div>
                                  <div class="col-md-2 mb-3">End
                                  {!! Form::time('fri_end[]', $sched->end, ['class' => 'form-control', 'disabled']) !!}
                                  </div>

                                </div>
                      @endif
                  @endforeach
                  </div>
              </div>

          </div>

          <hr>

          <div>
            <a href="/admin/subject/{{$section->id}}/edit" class="btn btn-primary">Edit</a>
            <a href="/admin/students" class="btn btn-default" role="button">Cancel</a>
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
                <div class="row append_day">

                  <div class="col-md-1 mb-5 d-grid">
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
                <div class="row append_day">

                  <div class="col-md-1 mb-5 d-grid">
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
                <div class="row append_day">

                  <div class="col-md-1 mb-5 d-grid">
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
                <div class="row append_day">

                <div class="col-md-1 mb-5 d-grid">
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
                <div class="row append_day">

                <div class="col-md-1 mb-5 d-grid">
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
@endsection


