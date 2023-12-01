<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.1/css/bootstrap.min.css'/>
</head>
<style>
    .main {
        display: flex;
    }
</style>
<body class="bg-dark">
    <div class="container">
        <div class="row my-4">
            <div class="col-lg-12 mx-auto">
                <div class="card shadow">
                <form action="/subject" method="POST">

                    <div class="card-header">
                        <h4>Section {{$section->name}}</h4>
                        <input type="hidden" name="section_id" value="{{$section->id}}">
                    </div>

                    <div class="card-body p-4">

                        <!-- -----------------MONDAY----------------- -->
                        <div class="row">
                            
                            <div class="col-2">
                                <div class="row">

                                    <div class="col-md-3 mb-3">Day
                                        <label for="">monday</label>
                                
                                    </div>

                                </div>
                            </div>

                            <div class="col-9">
                                <div id="show_mon">
                                    <div class="row">
                                        
                                        <div class="col-md-1 mb-5 d-grid">
                                            <button class="btn btn-warning mon_add">+</button>
                                        </div>

                                        <div class="col-md-4 mb-3">Subject
                                            {!! Form::select('mon_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-md-3 mb-3">Teacher
                                            {!! Form::select('mon_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                                        </div>

                                        <div class="col-md-2 mb-3">Start
                                            <input type="time" name="mon_start[]" id="" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">End
                                            <input type="time" name="mon_end[]" id="" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>

                        <!-- -----------------TUESDAY----------------- -->
                        
                        <div class="row">
                            
                            <div class="col-2">
                                <div class="row">

                                    <div class="col-md-3 mb-3">Day
                                        <label for="">tuesday</label>
                                        
                                    </div>

                                </div>
                            </div>

                            <div class="col-9">
                                <div id="show_tue">
                                    <div class="row">
                                        
                                        <div class="col-md-1 mb-5 d-grid">
                                            <button class="btn btn-warning tue_add">+</button>
                                        </div>

                                        <div class="col-md-4 mb-3">Subject
                                            {!! Form::select('tue_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-md-3 mb-3">Teacher
                                            {!! Form::select('tue_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                                        </div>
                                                    
                                        <div class="col-md-2 mb-3">Start
                                            <input type="time" name="tue_start[]" id="" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">End
                                            <input type="time" name="tue_end[]" id="" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <!-- -----------------WEDNESDAY----------------- -->
                        <div class="row">
                            
                            <div class="col-2">
                                <div class="row">

                                    <div class="col-md-3 mb-3">Day
                                        <label for="">wednesday</label>
                                        
                                    </div>

                                </div>
                            </div>

                            <div class="col-9">
                                <div id="show_wed">
                                    <div class="row">
                                        
                                        <div class="col-md-1 mb-5 d-grid">
                                            <button class="btn btn-warning wed_add">+</button>
                                        </div>

                                        <div class="col-md-4 mb-3">Subject
                                            {!! Form::select('wed_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-md-3 mb-3">Teacher
                                            {!! Form::select('wed_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                                        </div>
                                                    
                                        <div class="col-md-2 mb-3">Start
                                            <input type="time" name="wed_start[]" id="" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">End
                                            <input type="time" name="wed_end[]" id="" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <!-- -----------------THURSDAY----------------- -->
                        <div class="row">
                            
                            <div class="col-2">
                                <div class="row">

                                    <div class="col-md-3 mb-3">Day
                                        <label for="">thursday</label>
                                        
                                    </div>

                                </div>
                            </div>

                            <div class="col-9">
                                <div id="show_thu">
                                    <div class="row">
                                        
                                        <div class="col-md-1 mb-5 d-grid">
                                            <button class="btn btn-warning thu_add">+</button>
                                        </div>

                                        <div class="col-md-4 mb-3">Subject
                                            {!! Form::select('thu_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-md-3 mb-3">Teacher
                                            {!! Form::select('thu_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                                        </div>
                                                    
                                        <div class="col-md-2 mb-3">Start
                                            <input type="time" name="thu_start[]" id="" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">End
                                            <input type="time" name="thu_end[]" id="" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>

                        <hr>
                        <!-- -----------------FRIDAY----------------- -->
                        <div class="row">
                            
                            <div class="col-2">
                                <div class="row">

                                    <div class="col-md-3 mb-3">Day
                                        <label for="">friday</label>
                                      
                                    </div>

                                </div>
                            </div>

                            <div class="col-9">
                                <div id="show_fri">
                                    <div class="row">
                                        
                                        <div class="col-md-1 mb-5 d-grid">
                                            <button class="btn btn-warning fri_add">+</button>
                                        </div>

                                        <div class="col-md-4 mb-3">Subject
                                            {!! Form::select('fri_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                                        </div>
                                        <div class="col-md-3 mb-3">Teacher
                                            {!! Form::select('fri_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
                                        </div>
                                                    
                                        <div class="col-md-2 mb-3">Start
                                            <input type="time" name="fri_start[]" id="" class="form-control">
                                        </div>
                                        <div class="col-md-2 mb-3">End
                                            <input type="time" name="fri_end[]" id="" class="form-control">
                                        </div>

                                    </div>
                                </div>
                            </div>

                        </div>
                        
                        <div>
                            <input type="submit" value="Save" class="btn btn-primary w-25" id="add_btn"> 
                        </div> 
                    </form>

                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</body>
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

                    <div class="col-md-4 mb-3">Subject
                        {!! Form::select('mon_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3 mb-3">Teacher
                        {!! Form::select('mon_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
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

                    <div class="col-md-4 mb-3">Subject
                        {!! Form::select('tue_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3 mb-3">Teacher
                        {!! Form::select('tue_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
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

                    <div class="col-md-4 mb-3">Subject
                        {!! Form::select('wed_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3 mb-3">Teacher
                        {!! Form::select('wed_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
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

                    <div class="col-md-4 mb-3">Subject
                        {!! Form::select('thu_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3 mb-3">Teacher
                        {!! Form::select('thu_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
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
                        <button class="btn btn-danger thu_remove">-</button>
                    </div>

                    <div class="col-md-4 mb-3">Subject
                        {!! Form::select('fri_curriculums[]', $curriculums, null, ['placeholder' => 'Select Subject', 'class' => 'form-control']) !!}
                    </div>
                    <div class="col-md-3 mb-3">Teacher
                        {!! Form::select('fri_teachers[]', $teachers, null, ['placeholder' => 'Select Teacher', 'class' => 'form-control']) !!}
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

        $(document).on('click', '.thu_remove', function(e){
            e.preventDefault();
            let row_item = $(this).parent().parent();
            $(row_item).remove();
        });



    });
</script>

</html>