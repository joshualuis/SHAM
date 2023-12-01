@extends('layouts.master')

@section('title')
NEW STUDENT
@endsection

@section('pagetitle')
   NEW STUDENT
@endsection

@section('css')
@endsection

@section('content')
{!! Form::open(['route' => 'admin.storeTransferee', 'method' => 'POST', 'enctype' => 'multipart/form-data', 'id' => 'addStudent']) !!}
@csrf
<div class="container-fluid">
<a href="javascript:history.back()">
                          <button type="button" class="btn btn-wd btn-default btn-fill btn-move-left">
	                        <span class="btn-label"><i class="ti-angle-left" style="margin-right:5px;"></i></span>BACK
	                        </button>
                        </a><br><br>
    <div class="row">
      <div class="col-md-12">
        <h4 class="title">SECTION : {{$section->glevel}} - {{$section->name}}
         </h4>
         <br>
        <div class="card">
            <div class="card-header">
              <h4 class="card-title" ><b>STUDENT INFORMATION</b></h4>
            </div>
            <div class="card-content">
                                 <div class="row">
                                 <input type="hidden" name="section_id" value="{{$section->id}}">

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="lrn" class="control-label">LRN<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="lrn" name="lrn" value="{{old('lrn')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="psanumber" class="control-label">PSA No.<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="psanumber" name="psanumber" value="{{old('psanumber')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="email" class="control-label">Email<star>*</star></label>
                                            <input type="email" class="form-control" placeholder="" id="email" name="email" value="{{old('email')}}" required="required">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fname" class="control-label">First Name<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="fname" name="fname" value="{{old('fname')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mname" class="control-label">Middle Name<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="mname" name="mname" value="{{old('mname')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="lname" class="control-label">Last Name<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="lname" name="lname" value="{{old('lname')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="extname" class="control-label">Extension Name<star>*</star></label>
                                            {!! Form::select('extname', ['N/A' => 'N/A','Sr.' => 'Sr.', 'Jr.' => 'Jr.'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="birthdate" class="control-label">Date of Birth<star>*</star></label>
                                            <input type="date" class="form-control" placeholder="" id="birthdate" name="birthdate" value="{{old('birthdate')}}" required="required">
                                        </div>
                                    </div>

                                    <!-- <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="age" class="control-label">Age<star>*</star></label>
                                            <input type="number" class="form-control" placeholder="" id="age" name="age" value="{{old('age')}}" required="required">
                                        </div>
                                    </div> -->

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="gender" class="control-label">Gender<star>*</star></label>
                                            {!! Form::select('gender', ['male' => 'Male', 'female' => 'Female'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                      <div class="form-group">
                                        <label class="control-label">Contact<star>*</star></label> 
                                        <label style="font-style: italic; opacity: 0.5;" >FORMAT: +63XXXXXXXXXX</label>
                                        <input type="tel" class="form-control" placeholder="" id="contact" name="contact" value="{{ old('contact', '+63') }}" required="required" pattern="^\+63[0-9]{10}$">

                                      </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mothertongue" class="control-label">Mother Tongue<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="mothertongue" name="mothertongue" value="{{old('mothertongue')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="religion" class="control-label">Religion<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="religion" name="religion" value="{{old('religion')}}" required="required">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="indipeople" class="control-label">Indigenous People<star>*</star></label>
                                            {!! Form::select('indipeople', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'indipeople', 'required' => 'true']) !!}
                                            <label for="">If yes, please specify:</label>
                                            <input type="text" class="form-control" placeholder="" id="yesindipeople" name="yesindipeople" value="{{old('yesindipeople')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="specialneeds" class="control-label">Special in Need<star>*</star></label>
                                            {!! Form::select('specialneeds', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'specialneeds', 'required' => 'true']) !!}
                                            <label for="">If yes, please specify:</label>
                                            <input type="text" class="form-control" placeholder="" id="yesspecialneeds" name="yesspecialneeds" value="{{old('yesspecialneeds')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="assistivedevices" class="control-label">Assistive Devices<star>*</star></label>
                                            {!! Form::select('assistivedevices', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'assistivedevices', 'required' => 'true']) !!}
                                            <label for="">If yes, please specify:</label>
                                            <input type="text" class="form-control" placeholder="" id="yesassistivedevices" name="yesassistivedevices" value="{{old('yesassistivedevices')}}">
                                        </div>
                                    </div>
                                </div>
                                <hr>
                                <div class="row">
                                <div class="col-md-12">
                                    <h6 class="card-title"><b>HOUSE ADDRESS</b></h6></div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="housestreet" class="control-label">House No. and Street<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="housestreet" name="housestreet" value="{{old('housestreet')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="barangay" class="control-label">Barangay<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="barangay" name="barangay" value="{{old('barangay')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="city" class="control-label">City<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="city" name="city" value="{{old('city')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="province" class="control-label">Province<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="province" name="province" value="{{old('province')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="region" class="control-label">Region<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="region" name="region" value="{{old('region')}}" required="required">
                                        </div>
                                    </div>
                                 
                                </div>

                                <hr>
                                <div class="row">
                                    <div class="col-md-4">
                                        <label for="image"  class="control-label">Upload Image<star>*</star></label>
                                        <input type="file" class="form-control" name="image" required="required"/>
                                    </div>
                                </div><br>
            </div>
        </div>


        <div class="card">
            <div class="card-header">
              <h4 class="card-title" ><b>PARENT/GUARDIAN INFORMATION</b></h4>
            </div>

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fathername" class="control-label">Father's Name<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="Last Name, First Name, Middle Name" id="fathername" name="fathername" value="{{old('fathername')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fathereducation" class="control-label">Highest Educational Attainment<star>*</star></label>
                                            {!! Form::select('fathereducation', [
                                                'none' => 'none', 
                                                'elementary graduate' => 'elementary graduate',
                                                'high school graduate' => 'high school graduate',
                                                'college graduate' => 'college graduate',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fatheremployment" class="control-label">Employment Status<star>*</star></label>
                                            {!! Form::select('fatheremployment', [
                                                'house husband' => 'house husband', 
                                                'self-employed' => 'self-employed',
                                                'fixed-employed' => 'fixed-employed',
                                                'regular-employed' => 'regular-employed',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fatherworkstat" class="control-label">WFH due to ECQ?<star>*</star></label>
                                            {!! Form::select('fatherworkstat', [
                                                'no' => 'No', 
                                                'yes' => 'Yes',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fathercontact" class="control-label">Father's Contact<star>*</star></label>
                                            <input type="tel" class="form-control" placeholder="" id="fathercontact" name="fathercontact" value="{{ old('fathercontact', '+63') }}" required="required" pattern="(^N/A$)|(^\+63[0-9]{10}$)">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mothername" class="control-label">Mother's Maiden Name<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="Last Name, First Name, Middle Name" id="mothername" name="mothername" value="{{old('mothername')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mothereducation" class="control-label">Highest Educational Attainment<star>*</star></label>
                                            {!! Form::select('mothereducation', [
                                                'none' => 'none', 
                                                'elementary graduate' => 'elementary graduate',
                                                'high school graduate' => 'high school graduate',
                                                'college graduate' => 'college graduate',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="motheremployment" class="control-label">Employment Status<star>*</star></label>
                                            {!! Form::select('motheremployment', [
                                                'house husband' => 'house wife', 
                                                'self-employed' => 'self-employed',
                                                'fixed-employed' => 'fixed-employed',
                                                'regular-employed' => 'regular-employed',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="motherworkstat" class="control-label">WFH due to ECQ?<star>*</star></label>
                                            {!! Form::select('motherworkstat', [
                                                'no' => 'No', 
                                                'yes' => 'Yes',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="mothercontact" class="control-label">Mother's Contact<star>*</star></label>
                                            <input type="tel" class="form-control" placeholder="" id="mothercontact" name="mothercontact" value="{{ old('mothercontact', '+63') }}" required="required" pattern="(^N/A$)|(^\+63[0-9]{10}$)">
                                        </div>
                                    </div>


                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="guardianname" class="control-label">Guardian's Name<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="Last Name, First Name, Middle Name" id="guardianname" name="guardianname" value="{{old('guardianname')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="guardianeducation" class="control-label">Highest Educational Attainment<star>*</star></label>
                                            {!! Form::select('guardianeducation', [
                                                'none' => 'none', 
                                                'elementary graduate' => 'elementary graduate',
                                                'high school graduate' => 'high school graduate',
                                                'college graduate' => 'college graduate',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardianemployment" class="control-label">Employment Status<star>*</star></label>
                                            {!! Form::select('guardianemployment', [
                                                'house husband' => 'house wife', 
                                                'self-employed' => 'self-employed',
                                                'fixed-employed' => 'fixed-employed',
                                                'regular-employed' => 'regular-employed',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardianworkstat" class="control-label">WFH due to ECQ?<star>*</star></label>
                                            {!! Form::select('guardianworkstat', [
                                                'no' => 'No', 
                                                'yes' => 'Yes',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardiancontact" class="control-label">Guardian's Contact<star>*</star></label>
                                            <input type="tel" class="form-control" placeholder="" id="guardiancontact" name="guardiancontact" value="{{ old('guardiancontact', '+63') }}" required="required" pattern="(^N/A$)|(^\+63[0-9]{10}$)">
                                        </div>
                                    </div>
                                </div>
                            </div>
        </div>


        <div class="card">
            <div class="card-header">
              <h4 class="card-title" ><b>SCHEDULE (First Semester)</b></h4>
              <input type="hidden" name="section_id" value="{{$section->id}}">
            </div>

                            <div class="card-content">
                                <!-- -----------------MONDAY----------------- -->
                                  <div class="row">
                                    <div class="col-md-2">
                                    <button class="btn btn-warning mon_add">+</button>
                                        <label for="">MONDAY</label>
                                      
                                    </div>
                                  </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_mon">
                                        @foreach($schedules as $sched)
                                          @if ($sched->day == 'monday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br>
                                                    <button class="btn btn-danger mon_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                  {!! Form::select('mon_curriculums[]', $mon_sched, $sched->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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
                                    <div class="col-md-2">
                                      <button class="btn btn-warning tue_add">+</button>
                                        <label for="">TUESDAY</label>
                                      
                                    </div>
                                </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_tue">
                                        @foreach($schedules as $sched)
                                          @if ($sched->day == 'tuesday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br>
                                                    <button class="btn btn-danger tue_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                  {!! Form::select('tue_curriculums[]', $tue_sched, $sched->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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
                                    <div class="col-md-2">
                                      <button class="btn btn-warning wed_add">+</button>
                                        <label for="">WEDNESDAY</label>
                                      
                                    </div>
                                </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_wed">
                                        @foreach($schedules as $sched)
                                          @if ($sched->day == 'wednesday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br>
                                                    <button class="btn btn-danger wed_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                  {!! Form::select('wed_curriculums[]', $wed_sched, $sched->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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
                                    <div class="col-md-2">
                                      <button class="btn btn-warning thu_add">+</button>
                                        <label for="">THURSDAY</label>
                                      
                                    </div>
                                </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_thu">
                                        @foreach($schedules as $sched)
                                          @if ($sched->day == 'thursday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br>
                                                    <button class="btn btn-danger thu_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                  {!! Form::select('thu_curriculums[]', $thu_sched, $sched->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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
                                    <div class="col-md-2">
                                      <button class="btn btn-warning fri_add">+</button>
                                        <label for="">FRIDAY</label>
                                      
                                    </div>
                                </div>
                                
                                  
                                  <div class="row">
                                    <div class="col-md-12">
                                      <div id="show_fri">
                                        @foreach($schedules as $sched)
                                          @if ($sched->day == 'friday')
                                            <div class="row"><br>
                                                <div class="col-md-1"><br>
                                                    <button class="btn btn-danger fri_remove">-</button>
                                                </div>

                                                <div class="col-md-11">
                                                <label for="" class="control-label">Subject</label><br>
                                                  {!! Form::select('fri_curriculums[]', $fri_sched, $sched->id, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
                                                </div>
                                            </div>
                                          @endif

                                        @endforeach
                                      </div>
                                    </div>

                                  </div>
                                <!-- -----------------FRIDAY----------------- -->

<br>
                            </div>
        </div>

            <div class="row"><br>
                <div class="col-sm-12" >
                  <div class="form-group pull-right">
                    <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd">Save</button>
                    <a href="javascript:history.back()" id="cancelBtn" class="btn btn-wd" role="button">Cancel</a>
                  </div>
                </div> 
              </div><br>
        

       
    
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

                  <div class="col-md-1"><br>
                    <button class="btn btn-danger mon_remove">-</button>
                  </div>

                  <div class="col-md-11">
                    <label for="" class="control-label">Subject</label><br>
                    {!! Form::select('mon_curriculums[]', $mon_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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

                  <div class="col-md-1"><br>
                    <button class="btn btn-danger tue_remove">-</button>
                  </div>

                  <div class="col-md-11">
                    <label for="" class="control-label">Subject</label><br>
                    {!! Form::select('tue_curriculums[]', $tue_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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

                  <div class="col-md-1"><br>
                    <button class="btn btn-danger wed_remove">-</button>
                  </div>

                  <div class="col-md-11">
                    <label for="" class="control-label">Subject</label><br>
                    {!! Form::select('wed_curriculums[]', $wed_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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

                  <div class="col-md-1"><br>
                    <button class="btn btn-danger thu_remove">-</button>
                  </div>

                  <div class="col-md-11">
                    <label for="" class="control-label">Subject</label><br>
                    {!! Form::select('thu_curriculums[]', $thu_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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

                  <div class="col-md-1"><br>
                    <button class="btn btn-danger fri_remove">-</button>
                  </div>

                  <div class="col-md-11">
                    <label for="" class="control-label">Subject</label><br>
                    {!! Form::select('fri_curriculums[]', $fri_sched, null, ['class' => 'form-control', 'placeholder' => 'Select Schedule']) !!}
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
document.getElementById('mothercontact').addEventListener('input', function(e) {
    var input = e.target;
    if (input.value.length > 13) {
        input.value = input.value.slice(0, 13);
    }
});
document.getElementById('fathercontact').addEventListener('input', function(e) {
    var input = e.target;
    if (input.value.length > 13) {
        input.value = input.value.slice(0, 13);
    }
});
document.getElementById('guardiancontact').addEventListener('input', function(e) {
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
          title: 'Add a new Student',
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
            document.getElementById('addStudent').submit();
            
            swal({
            title: 'Submitted!',
            text: 'A new student is added to the records!',
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


