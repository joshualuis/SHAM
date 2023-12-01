@extends('layouts.master')

@section('title')
	GRADES
@endsection

@section('pagetitle')
   STUDENTS GRADE 
@endsection

@section('css')
@endsection

@section('content')

<div class="container-fluid">
<form id="saveGrades" method="POST" action="{{ route('teacher.updateGrade') }}">
    @csrf
    @method('POST')
                  <div class="row">
                    <div class="col-md-12">
                            <a href="javascript:history.back()">
                            <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
                                <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
                                </button>
                            </a><br><br>
                            
                      <div class="card">
                        <div class="card-header">
                        @if(session('message'))
                            <div class="alert alert-success">
                                {{ session('message') }}
                            </div>
                        @endif
                          <h4 class="card-title"><b>SECTION:</b> {{$subject->section->glevel}} - {{$subject->section->name}}</h4>
                          <h4 class="card-title"><b>SUBJECT:</b> {{$subject->curriculum->name}}</h4>
                          <h5 class="card-title">{{$subject->year->year}} | {{$subject->semester->semester}} semester</h5>
                          <input type="hidden" name="teach_curr" value="{{$teach_curr}}">
                          <input type="hidden" name="section_id" value="{{$subject->section->id}}">
                        </div>
                        <div class="card-content table-responsive table-full-width">
                          <table class="table">
                            <thead>
                                <th style="padding-left:20px;">NAME</th>
                                <th>Quarter 1</th>
                                <th>Quarter 2</th>
                                <th>Final Grade</th>
                                <th>Remarks</th>
                            </thead>
                                <tbody>
                                @foreach($grades as $grade)
                                  <tr>
                                    <td style="padding-left:20px;">
                                      {{$grade->student->lname}}, {{$grade->student->fname}} {{$grade->student->mname}}
                                      {{ Form::hidden('grade_ids[]',$grade->id) }}
                                    </td>
                                    @if($edit == 'YES')
                                      <td>{{ Form::number('q1[]', $grade->q1, ['min' => 0, 'max' => 100, 'oninput' => 'javascript: if (this.value > 100) this.value = 100;']) }}</td>
                                      <td>{{ Form::number('q2[]', $grade->q2, ['min' => 0, 'max' => 100, 'oninput' => 'javascript: if (this.value > 100) this.value = 100;']) }}</td>
                                    @else
                                      <td>{{ $grade->q1 }}</td>
                                      <td>{{ $grade->q2 }}</td>
                                    @endif
                                    <td>{{$grade->final}}</td>
                                    <td>{{$grade->remarks}}</td>
                                  </tr>
                                @endforeach
                                </tbody>
                          </table>
                        </div>


                        <div class="row"><br>
                          <div class="col-sm-12" >
                            <div class="form-group pull-right" style="margin-right:20px;">
                              @if($edit == 'YES')
                                <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">SAVE</button>
                              @else
                                <label for="">EDITING OF GRADES IS CLOSED.</label>
                              @endif
                              <a href="javascript:history.back()" class="btn btn-wd" role="button">Cancel</a>
                            </div>
                          </div> 
                        </div><br>



                      </div>
                    </div>
                  </div>
                </form>
              </div>



@endsection

@section('script')

<script>
  function showSwal(type) {

      if (type == 'warning-message-and-cancel') {
        swal({
          title: 'Save Grades',
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
            document.getElementById('saveGrades').submit();
            
            swal({
            title: 'Submitted!',
            text: 'Grades for these students are now saved!',
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
    }


   
</script>
@endsection