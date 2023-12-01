
<!doctype html>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="../../../../../../../../assets/img/apple-icon.png">
	<link rel="icon" type="image/png" sizes="96x96" href="../../../../../../../../assets/img/SHAM-Logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Senior High Access Module</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />
    
    <!-- Bootstrap core CSS     -->
    <link href="../../../../../../../../../../../../../../../../assets/css/bootstrap.min.css" rel="stylesheet" />

    <!--  Paper Dashboard core CSS    -->
    <link href="../../../../../../../../../../../../../../../../assets/css/paper-dashboard.css" rel="stylesheet"/>


    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="../../../../../../../../../../../../../../../../assets/css/demo.css" rel="stylesheet" />


    <!--  Fonts and icons     -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='https://fonts.googleapis.com/css?family=Muli:400,300' rel='stylesheet' type='text/css'>
    <link href="../../../../../../../../../../../../../../../../assets/css/themify-icons.css" rel="stylesheet">
    <link rel='stylesheet' type='text/css' media='screen' href='../../../../../../assets/css/registration.css'>
    
</head>

<body>

  <div class="wrapper">
 
  <header class="head">

      <a href="https://seniorhigh-svnhs.com/" class="logo"><img src="../../assets/img/logowithname.png" alt="Logo"></a>
      
      
      <nav class="nav_bar">
        <ul>
            <li><a href="/applicants/create" class="register_btn">REGISTRATION</a></li>
        </ul>
      </nav>
      
      
      </header>
    <div class="content">

        @if(session('error'))
            <script>
                alert('{{ session('error') }}');
            </script>
        @endif
      
        <div class="container-fluid">
        <form id="createApp" action="/applicants" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-md-6 col-md-offset-3">
                    <div class="progress_bar">
                        <div class="progress" id="progress"></div>
                        
                        <div class="progress-step progress-step-active"data-title=""></div>
                        <div class="progress-step" data-title=""></div>
                        <div class="progress-step" data-title=""></div>
                        <div class="progress-step" data-title=""></div>
                    </div>
                </div>
                <div class="col-md-12">
                    
                    
                    <div class="card">
                        <div class="form-step form-step-active">
                            <div class="card-header">
                                <br>
                                <h3 class="card-title text-center" ><b>Registration is now open for <br>School Year {{$year->year}}</b></h3><br>
                                <p class="text-center"><b>INSTRUCTIONS:</b><br><br>
                                    <b>1.</b> This enrollment survey shall be answered  by the <b>parent/guardian of the learner.</b><br><br>
                                    <b>2.</b> Please read the questions carefully and fill in all applicable spaces in <b>CAPITAL LETTERS</b>. For items not applicable, type <b>N/A.</b><br><br>
                                    <b>3.</b> If you have questions or clarifications, please ask for the assistance of the teacher or person-in-charge. <br>You may call us at <b>8370760</b> or send email to <b>signalvillagenational@gmail.com</b> or via <b>FB Messenger Signal Hayskul</b>.<br><br>
                                    </p>
                            </div>

                            <div class="card-content">
                                    <div class="col-sm-6 col-md-offset-3">
                                        <div class="form-group">
                                            <label class="control-label text-center">Are you a current student at Signal Village National High School?<star>*</star></label>
                                            {!! Form::select('studentstatus', ['true' => 'Yes', 'false' => 'No'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                            <input type="hidden" id="year_id" name="year_id" value="{{$year_id}}">
                                        </div>
                                    </div>
 
                                    <div class="row"><br>
                                        <div class="col-sm-12" >
                                        <a href="#" class="btn btn-info btn-fill btn-wd btn-next pull-right">Next</a>
                                        </div> 
                                    </div><br>
                            </div><!-- END OF CARD-CONTENT -->
                            
                        </div>
                        
                   

                        <div class="form-step">
                            <div class="card-header">
                                <br>
                                <h4 class="card-title text-center" ><b>GRADE LEVEL AND SCHOOL INFORMATION</b></h4>

                                <p class="category"></p>
                            </div>

                            <div class="card-content">
                                <div class="row">

                                    
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">LRN Information<star>*</star></label>
                                            {!! Form::select('lrnstat', ['true' => 'With LRN', 'false' => 'No LRN'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Year to Finish Grade 10<star>*</star></label>
                                            {!! Form::selectYear('yeartofinish', 2012, 2050, null,['placeholder' => 'Select the appropriate information','class' => 'form-control','required' => 'true']) !!}
                                        </div>
                                    </div>
                                    <div id="sectionfield" class="col-sm-4">
                                        <div class="form-group">
                                            <label class="control-label">Section<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="Section" id="section" name="section" value="{{old('section')}}" required="required">
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">Last School Attended<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="lastschoolattended" name="lastschoolattended" value="{{old('lastschoolattended')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">Last School Address<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="lastschooladdress" name="lastschooladdress" value="{{old('lastschooladdress')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">School ID<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="schoolid" name="schoolid" value="{{old('schoolid')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">School Type<star>*</star></label>
                                            {!! Form::select('schooltype', ['private' => 'Private', 'public' => 'Public'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control schooltype-select','required' => 'true']) !!}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">School to Enroll<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="schooltoenroll" name="schooltoenroll" value="{{old('schooltoenroll')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label class="control-label">School Address<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="schooladdress" name="schooladdress" value="{{old('schooladdress')}}" required="required">
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="semester" class="control-label">Semester<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="semester" name="semester" value="First Semester" readonly>
                                        </div>
                                    </div>
                                </div>

                                    <div class="row">

                                    <div class="card-header">
                                    <h6 class="card-title"><b>GRADES</b></h6>
                                    </div>

                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="englishgrade" class="control-label">English<star>*</star></label>
                                            <input type="number" class="form-control" placeholder="" id="englishgrade" name="englishgrade" value="{{old('englishgrade')}}" required="required"><br>
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="mathgrade" class="control-label">Math<star>*</star></label>
                                        <input type="number" name="mathgrade"class="form-control" id="mathgrade" value="{{old('mathgrade')}}" oninput="grades()" required="required"><br />
                                        </div>
                                    </div>
                                    <div class="col-sm-3">
                                    <div class="form-group">
                                        <label for="sciencegrade" class="control-label">Science<star>*</star></label>
                                        <input type="number" name="sciencegrade" class="form-control"id="sciencegrade" value="{{old('sciencegrade')}}"oninput="grades()" required="required">
                                    </div>
                                    </div>
                                    <div class="col-sm-3">
                                        <div class="form-group">
                                            <label for="filipinograde" class="control-label">Filipino<star>*</star></label>
                                            <input type="number" class="form-control" placeholder="" id="filipinograde" name="filipinograde" value="{{old('filipinograde')}}" required="required"><br>
                                        </div>
                                    </div>
                                    </div>
                                    <div class="row">
                                    <div class="card-header">
                                    <h6 class="card-title"><b>STRANDS</b></h6>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="firstchoice" class="control-label">First Choice<star>*</star></label>
                                            <select class="form-control" name="firstchoice" id="s2" class="s2" required="required">
                                                <option value="{{old('firstchoice')}}">{{old('firstchoice')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="secondchoice" class="control-label">Second Choice<star>*</star></label>
                                            <select class="form-control" name="secondchoice" id="s3" class="s3" required="required">
                                                <option value="{{old('secondchoice')}}">{{old('secondchoice')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="thirdchoice" class="control-label">Third Choice<star>*</star></label>
                                            <select class="form-control" name="thirdchoice" id="s4" class="s4" required="required">
                                                <option value="{{old('thirdchoice')}}">{{old('secondchoice')}}</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row"><br>
                                    <div class="col-sm-12" >
                                        <a href="#" class="btn btn-default btn-fill btn-wd btn-back pull-left">Previous</a>
                                        <a href="#" class="btn btn-info btn-fill btn-wd btn-next pull-right">Next</a>
                                    </div> 
                                </div><br>
                            </div>
                        <!-- END OF CARD -->
                        </div>

                        <div class="form-step">
                            <div class="card-header">
                                <br>

                                @if ($errors->any())
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <h4 class="card-title text-center" ><b>STUDENT INFORMATION</b></h4>
                                <p class="category"></p>
                            </div>

                            <div class="card-content">
                                <div class="row">
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
                                            <label for="contact" class="control-label">Contact<star>*</star></label>
                                            <input type="tel" class="form-control" placeholder="" id="contact" name="contact" value="{{ old('contact', '+63') }}" required="required" pattern="(^N/A$)|(^\+63[0-9]{10}$)">
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
                                            <label for="">If yes, please specify:<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="yesindipeople" name="yesindipeople" value="{{old('yesindipeople')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="specialneeds" class="control-label">Special in Need<star>*</star></label>
                                            {!! Form::select('specialneeds', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'specialneeds', 'required' => 'true']) !!}
                                            <label for="">If yes, please specify:<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="yesspecialneeds" name="yesspecialneeds" value="{{old('yesspecialneeds')}}" required="required">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="assistivedevices" class="control-label">Assistive Devices<star>*</star></label>
                                            {!! Form::select('assistivedevices', ['No' => 'No', 'Yes' => 'Yes'], null,['placeholder' => 'Select the appropriate information','class' => 'form-control', 'id'=>'assistivedevices', 'required' => 'true']) !!}
                                            <label for="">If yes, please specify:<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="yesassistivedevices" name="yesassistivedevices" value="{{old('yesassistivedevices')}}"  required="required">
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
                                            <input type="text" class="form-control" placeholder="" id="housestreet" name="housestreet" value="{{old('housestreet')}}" required="required">
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

                                    <div class="col-md-4">
                                        <label for="reportcard"  class="control-label">Upload Report Card<star>*</star></label>
                                        <input type="file" class="form-control" name="reportcard" required="required"/>
                                    </div>

                                    <div class="col-md-4">
                                        <label for="birthcertificate"  class="control-label">Upload Birth Certificate<star>*</star></label>
                                        <input type="file" class="form-control" name="birthcertificate" required="required"/>
                                    </div>
                                </div>

                                <div class="row"><br>
                                    <div class="col-sm-12" >
                                        <a href="#" class="btn btn-default btn-fill btn-wd btn-back pull-left">Previous</a>
                                        <a href="#" class="btn btn-info btn-fill btn-wd btn-next pull-right">Next</a>
                                    </div> 
                                </div><br>
                            </div>

                        <!-- END OF CARD -->
                        </div>


                        <div class="form-step">
                            <div class="card-header">
                                <br>
                                <h4 class="card-title text-center" ><b>PARENT/GUARDIAN INFORMATION</b></h4>
                                <p class="category"></p>
                            </div>

                            <div class="card-content">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fathername" class="control-label">Father's Name<star>*</star></label>
                                            <input type="text" class="form-control" placeholder="" id="fathername" name="fathername" value="{{old('fathername')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="fathereducation" class="control-label">Highest Educational Attainment<star>*</star></label>
                                            {!! Form::select('fathereducation', [
                                                'N/A' => 'N/A',
                                                'none' => 'none', 
                                                'elementary graduate' => 'elementary graduate',
                                                'high school graduate' => 'high school graduate',
                                                'college graduate' => 'college graduate',
                                                'doctorate' => 'doctorate',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control fathereducation-select','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fatheremployment" class="control-label">Employment Status<star>*</star></label>
                                            {!! Form::select('fatheremployment', [
                                                'N/A' => 'N/A',
                                                'house husband' => 'house husband', 
                                                'self-employed' => 'self-employed',
                                                'fixed-employed' => 'fixed-employed',
                                                'regular-employed' => 'regular-employed',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control fatheremployment-select']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="fatherworkstat" class="control-label">WFH due to ECQ?<star>*</star></label>
                                            {!! Form::select('fatherworkstat', [
                                                'N/A' => 'N/A',
                                                'no' => 'No', 
                                                'yes' => 'Yes',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control fatherworkstat-select','required' => 'true']) !!}
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
                                            <input type="text" class="form-control" placeholder="" id="mothername" name="mothername" value="{{old('mothername')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="mothereducation" class="control-label">Highest Educational Attainment<star>*</star></label>
                                            {!! Form::select('mothereducation', [
                                                'N/A' => 'N/A',
                                                'none' => 'none', 
                                                'elementary graduate' => 'elementary graduate',
                                                'high school graduate' => 'high school graduate',
                                                'college graduate' => 'college graduate',
                                                'doctorate' => 'doctorate',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control mothereducation-select','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="motheremployment" class="control-label">Employment Status<star>*</star></label>
                                            {!! Form::select('motheremployment', [
                                                'N/A' => 'N/A',
                                                'house husband' => 'house wife', 
                                                'self-employed' => 'self-employed',
                                                'fixed-employed' => 'fixed-employed',
                                                'regular-employed' => 'regular-employed',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control motheremployment-select']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="motherworkstat" class="control-label">WFH due to ECQ?<star>*</star></label>
                                            {!! Form::select('motherworkstat', [
                                                'N/A' => 'N/A',
                                                'no' => 'No', 
                                                'yes' => 'Yes',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control motherworkstat-select','required' => 'true']) !!}
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
                                            <input type="text" class="form-control" placeholder="" id="guardianname" name="guardianname" value="{{old('guardianname')}}">
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="guardianeducation" class="control-label">Highest Educational Attainment<star>*</star></label>
                                            {!! Form::select('guardianeducation', [
                                                'N/A' => 'N/A', 
                                                'none' => 'none', 
                                                'elementary graduate' => 'elementary graduate',
                                                'high school graduate' => 'high school graduate',
                                                'college graduate' => 'college graduate',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control guardianeducation-select','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardianemployment" class="control-label">Employment Status<star>*</star></label>
                                            {!! Form::select('guardianemployment', [
                                                'N/A' => 'N/A', 
                                                'house husband' => 'house wife', 
                                                'self-employed' => 'self-employed',
                                                'fixed-employed' => 'fixed-employed',
                                                'regular-employed' => 'regular-employed',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control guardianemployment-select','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardianworkstat" class="control-label">WFH due to ECQ?<star>*</star></label>
                                            {!! Form::select('guardianworkstat', [
                                                'N/A' => 'N/A', 
                                                'no' => 'No', 
                                                'yes' => 'Yes',
                                                ], null,['placeholder' => 'Select the appropriate information','class' => 'form-control guardianworkstat-select','required' => 'true']) !!}
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="form-group">
                                            <label for="guardiancontact" class="control-label">Guardian's Contact<star>*</star></label>
                                            <input type="tel" class="form-control" placeholder="" id="guardiancontact" name="guardiancontact" value="{{ old('guardiancontact', '+63') }}" required="required" pattern="(^N/A$)|(^\+63[0-9]{10}$)">
                                        </div>
                                    </div>
                                </div>

                                <div class="row"><br>
                                    <div class="col-sm-12" >
                                        <a href="#" class="btn btn-default btn-fill btn-wd btn-back pull-left">Previous</a>
                                        <button type="button" onclick="showSwal('warning-message-and-cancel')" class="btn btn-success btn-fill btn-wd btn-next pull-right">SUBMIT</button>
                                        
                                    </div> 
                                </div><br>


                                
                            </div><!-- END OF CARD-CONTENT -->

                                
                            </div>
                        <!-- END OF CARD -->
                        </div>
                    
                    </div>

                </div>
            </div>
        </div>

        

       
     </form>
        


	</div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="../../../../../../../../../../../../../../../../assets/js/bootstrap-notify.js"></script>
  <script src="../../../../../../../../../../../../../../../../assets/js/sweetalert2.js"></script>

  <script src="../../../../../../assets/js/registration.js"></script>
  @include('sweetalert::alert')

<script>
$(document).ready(function() {
  $('select[name="studentstatus"]').change(function() {
    if ($(this).val() == 'true') {
      // Disable inputs and set specific value
      $('#lastschoolattended').prop('readonly', true).val('Signal Village National High School').attr('name', 'lastschoolattended');
      $('#lastschooladdress').prop('readonly', true).val('Ballecer St., Central Signal Village, Taguig City').attr('name', 'lastschooladdress');
      $('#schoolid').prop('readonly', true).val('305463').attr('name', 'schoolid');
      $('.schooltype-select').prop('readonly', true).val('public').attr('name', 'schooltype');
      $('#schooltoenroll').prop('readonly', true).val('Signal Village National High School').attr('name', 'schooladdress');
      $('#schooladdress').prop('readonly', true).val('Ballecer St., Central Signal Village, Taguig City').attr('name', 'schooladdress');
      $("#section").prop('readonly', false).val('').attr('name', 'section');
      $("#sectionfield").show();
    } else {
      // Enable inputs and clear values
      $('#lastschoolattended').prop('readonly', false).val('').attr('name', 'lastschoolattended');
      $('#lastschooladdress').prop('readonly', false).val('').attr('name', 'lastschooladdress');
      $('#schoolid').prop('readonly', false).val('').attr('name', 'schoolid');
      $('.schooltype-select').prop('readonly', false).val('').attr('name', 'schooltype');
      $('#schooltoenroll').prop('readonly', true).val('Signal Village National High School').attr('name', 'schooltoenroll');
      $('#schooladdress').prop('readonly', true).val('Ballecer St., Central Signal Village, Taguig City').attr('name', 'schooladdress');
      $("#section").prop('readonly', false).val('N/A').attr('name', 'section');
      $("#sectionfield").hide();
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
$(document).ready(function() {

    $('#fathername').on('change', function() {
        // Get the value of the guardianname field
        var fathername = $(this).val();
        
        // Check if the value is "N/A"
        if (fathername === "N/A") {
            $('.fathereducation-select').prop('readonly', true).val('N/A').attr('name', 'fathereducation');
            $('.fatheremployment-select').prop('readonly', true).val('N/A').attr('name', 'fatheremployment');
            $('.fatherworkstat-select').prop('readonly', true).val('N/A').attr('name', 'fatherworkstat');
        $('#fathercontact').prop('readonly', true).val('N/A').attr('name', 'fathercontact');
        } else {
            $('.fathereducation-select').prop('readonly', false).val('').attr('name', 'fathereducation');
            $('.fatheremployment-select').prop('readonly', false).val('').attr('name', 'fatheremployment');
            $('.fatherworkstat-select').prop('readonly', false).val('').attr('name', 'fatherworkstat');
            $('#fathercontact').prop('readonly', false).val('').attr('name', 'fathercontact');
        }
    });


    $('#mothername').on('change', function() {
        // Get the value of the guardianname field
        var mothername = $(this).val();
        
        // Check if the value is "N/A"
        if (mothername === "N/A") {
            $('.mothereducation-select').prop('readonly', true).val('N/A').attr('name', 'mothereducation');
            $('.motheremployment-select').prop('readonly', true).val('N/A').attr('name', 'motheremployment');
            $('.motherworkstat-select').prop('readonly', true).val('N/A').attr('name', 'motherworkstat');
        $('#mothercontact').prop('readonly', true).val('N/A').attr('name', 'mothercontact');
        } else {
            $('.mothereducation-select').prop('readonly', false).val('').attr('name', 'mothereducation');
            $('.motheremployment-select').prop('readonly', false).val('').attr('name', 'motheremployment');
            $('.motherworkstat-select').prop('readonly', false).val('').attr('name', 'motherworkstat');
            $('#mothercontact').prop('readonly', false).val('').attr('name', 'mothercontact');
        }
    });

    // Listen for changes in the guardianname field
    $('#guardianname').on('change', function() {
        // Get the value of the guardianname field
        var guardianname = $(this).val();
        
        // Check if the value is "N/A"
        if (guardianname === "N/A") {
            $('.guardianeducation-select').prop('readonly', true).val('N/A').attr('name', 'guardianeducation');
            $('.guardianemployment-select').prop('readonly', true).val('N/A').attr('name', 'guardianemployment');
            $('.guardianworkstat-select').prop('readonly', true).val('N/A').attr('name', 'guardianworkstat');
        $('#guardiancontact').prop('readonly', true).val('N/A').attr('name', 'guardiancontact');
        } else {
            $('.guardianeducation-select').prop('readonly', false).val('').attr('name', 'guardianeducation');
            $('.guardianemployment-select').prop('readonly', false).val('').attr('name', 'guardianemployment');
            $('.guardianworkstat-select').prop('readonly', false).val('').attr('name', 'guardianworkstat');
            $('#guardiancontact').prop('readonly', false).val('').attr('name', 'guardiancontact');
        }
    });

  
});


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
            document.getElementById('createApp').submit();
            
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

</body>

</html>