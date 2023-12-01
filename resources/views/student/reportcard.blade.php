<!doctype html>
<html>
  <head>
    <title>Report Card</title>
    <style>
       @page { margin:0px; }
        html { margin-left: 20px;
            margin-right: 20px;}
        body {
        padding: 0;
        }
       
		.left-card {
		width: 50%;
		float: left;
        position: relative;
        margin-top: 0;
        margin-bottom: 0;
		}
        .left-card h2 {
        position: absolute;
        top: 0;
        left: 0;
        margin: 0;
        }
        .center {
        text-align: center;
        }
        .right {
        text-align: right;
        }
        .left {
        text-align: left;
        }
        .tablegrade{
        border-collapse: collapse;
        border: 1px solid black;
        margin-top: 0;
        margin-bottom: 0;
        font-family: 'Open Sans', sans-serif;
        }
        .noborder{
            border-collapse: collapse;
            border: none;
            padding-left: 10px;
            padding-bottom: 15px;
        }
        .noborder th,td,tr{
            border: 1 solid white;
        margin-top: 0;
        margin-bottom: 0;
        font-size: 10px; 
        font-family: 'Open Sans', sans-serif;
        padding:0;
        }
        
        th,td,tr {
        border: 1px solid black; 
        }
        
        .left-card h4 {
        margin-top: 0;
        margin-bottom: 0;
        }

        .table-container {
      
        }

        .table-container table {
          
            
        }

		.right-card {
			width: 50%;
			float: right;
		}
        .right-card h5.center {
        font-weight: normal; /* make the first h5 not bold */
        margin: 0;
        }

        .right-card h4.center, h3.center {
            font-weight: bold; /* make h4 and h3 bold */
            margin: 0;
        }
        .right-card label{
        }

        .underlinename{
            border-bottom:1px solid #000000; 
            width:461px;
        }
        .underlinelrn{
            border-bottom:1px solid #000000; 
            width:213px;
        }
        .underlinesex{
            border-bottom:1px solid #000000; 
            width:85px;
        }
        .underlineage{
            border-bottom:1px solid #000000; 
            width:82px;
        }
        .underlinegrade{
            border-bottom:1px solid #000000; 
            width:202px;
        }
        .underlinesection{
            border-bottom:1px solid #000000; 
            width:176px;
        }
        .underlinets{
            border-bottom:1px solid #000000; 
            width: 393px;
        }
        .namecontainer {
        display: flex;
    
        }

        .nameleft {
        width: 50%;
        float: left;
        }

        .nameright {
        width: 50%;
        float: right;
        }
        .attendancetable{
        border-collapse: collapse;
        border: 1px solid black;
        margin-top: 0;
        margin-bottom: 0;
        }
        
        .attendancetable th{
            font-size: 8px;
        }
        .underlineq1{
            border-bottom:1px solid #000000; 
            width:380px;
        }
        .underlineq2{
            border-bottom:1px solid #000000; 
            width:378px;
        }
        .underlineq3{
            border-bottom:1px solid #000000; 
            width:378px;
        }
        .underlineq4{
            border-bottom:1px solid #000000; 
            width:380px;
        }
        .underlineadgrade{
            border-bottom:1px solid #000000; 
            width:120px;
        }
        .underlineadsection{
            border-bottom:1px solid #000000; 
            width:233px;
        }
        .underlineel{
            border-bottom:1px solid #000000; 
            width:356px;
        }
        .underlineadmitted{
            border-bottom:1px solid #000000; 
            width:438px;
        }
        .underlinedate{
            border-bottom:1px solid #000000; 
            width:200px;
        }
        .underlinegenave{
            border-bottom:1px solid #000000; 
            width:52px;
        }


	</style>
  </head>
  <body>
    <div class="left-card">
		<!-- content for area 1 goes here -->
		<p>{{$student->fullname}}</p>
        <h4 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 14px;">REPORT ON LEARNING PROGRESS AND ACHIEVEMENT</h4>

        <h4 style="font-size: 12px;"><b>First Semester</b></h4>
        <div class="table-container">
            <table class="tablegrade">
                
                <tr>
                    <th style="width: 80px;" class="center" rowspan="2"></th>
                    <th style="width: 230px;" rowspan="2">SUBJECTS</th>
                    <th style="width: 30px;" class="center" colspan="2">QUARTER</th>
                    
                    <th style="width: 50px;" class="center" rowspan="2">FINAL GRADE</th>
                    <th style="width: 60px;" class="center" rowspan="2">Remarks</th>
                </tr>
                <tr>
                    <th style="width: 40px;" class="center" >1</th>
                    <th style="width: 40px;"class="center" >2</th>
                </tr>
                <tbody>
                    @foreach($grades as $grade)
                        @if($grade->semester->semester == "First")
                        <tr>
                            <td class="center">{{$grade->curriculum->level}}</td>
                            <td style="padding-left:5px;padding-top:2px;padding-bottom:2px;">{{$grade->curriculum->name}}</td>
                            <td class="center">{{$grade->q1}}</td>
                            <td class="center">{{$grade->q2}}</td>
                            <td class="center">{{$grade->final}}</td>
                            @if($grade->remarks == 'PASSED')
                                <td class="center">{{$grade->remarks}}</td>
                            @else
                                <td class="center">{{$grade->remarks}}</td>
                            @endif
                        </tr>
                        @endif
                    @endforeach
                        <tr>
                            <td style="padding:3px;" class="right" colspan="4"><b>General Average for the Semester<b></td>
                            <td class="center">{{$firstGWA}}</td>
                            <td></td>
                        </tr>
                </tbody>

            </table>
        </div>

        <h4 style="font-size: 12px; padding-top:5px;"><b>Second Semester</b></h4>
        <div class="table-container">
            <table class="tablegrade">
                
                <tr>
                    <th style="width: 80px;" class="center" rowspan="2"></th>
                    <th style="width: 230px;" rowspan="2">SUBJECTS</th>
                    <th style="width: 30px;" class="center" colspan="2">QUARTER</th>
                    
                    <th style="width: 50px;" class="center" rowspan="2">FINAL GRADE</th>
                    <th style="width: 60px;" class="center" rowspan="2">Remarks</th>
                </tr>
                <tr>
                    <th style="width: 40px;" class="center" >1</th>
                    <th style="width: 40px;"class="center" >2</th>
                </tr>
                <tbody>
                    @foreach($grades as $grade)
                        @if($grade->semester->semester == "Second")
                        <tr>
                            <td class="center">{{$grade->curriculum->level}}</td>
                            <td style="padding-left:5px;padding-top:2px;padding-bottom:2px;">{{$grade->curriculum->name}}</td>
                            <td class="center">{{$grade->q1}}</td>
                            <td class="center">{{$grade->q2}}</td>
                            <td class="center">{{$grade->final}}</td>
                            @if($grade->remarks == 'PASSED')
                                <td class="center">{{$grade->remarks}}</td>
                            @else
                                <td class="center">{{$grade->remarks}}</td>
                            @endif
                        </tr>
                        @endif
                    @endforeach
                        <tr>
                            <td style="padding:3px;" class="right" colspan="4"><b>General Average for the Semester<b></td>
                            @if($secondGWA != 0)
                                <td class="center">{{$secondGWA}}</td>
                            @else
                                <td></td>
                            @endif
                            <td></td>
                        </tr>
                </tbody>

            </table>
        </div>

        <h4 style="padding-top: 10px; font-size: 12px; display: inline-block;"><b><em>General Average for the School Year</em></b></h4>
        @if($secondGWA == 0)
        <label class="underlinegenave" for="genave" style="padding-top: 10px; margin-left: 216px; font-family: 'Open Sans', sans-serif; font-size: 12px; font-style:bold; text-align: center;  display: inline-block;"> </label>   
        @else
        <label class="underlinegenave" for="genave" style="padding-top: 10px; margin-left: 216px; font-family: 'Open Sans', sans-serif; font-size: 12px; font-style:bold; text-align: center;  display: inline-block;">{{$syGWA}}</label>
        @endif
       
        

        <br><br><br>
        <div style="display: inline-block;">
                <table class="tablegrade">
                    <tr>
                        <th style="width: 80px;" class="center" rowspan="6">HOMEROOM GUIDANCE</th>
                        <th style="width: 150px;">FIRST SEMESTER</th>
                        <th style="width: 70px;" class="center">REMARKS</th>
                        
                    </tr>
                    <tr>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center" >1st Quarter</th>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center"></th>
                    </tr>
                    <tr>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center" >2nd Quarter</th>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center" ></th>
                    </tr>
                    <tr>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center" >SECOND SEMESTER</th>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center" >REMARKS</th>
                    </tr>
                    <tr>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center" >3rd Quarter</th>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center"></th>
                    </tr>
                    <tr>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center" >4th Quarter</th>
                        <th style="padding-top:2px; padding-bottom:2px;" class="center"></th>
                    </tr>
                </table></div>
                <div style="display: inline-block;">
                <table class="noborder">
                        <tr>
                            <th class="center">Marking</th>
                            <th style="padding-left:8px;" class="left">Description</th>
                        </tr>
                        <tr>
                            <th class="center">NO</th>
                            <th style="padding-left:8px;" class="left">No Chance to Observe</th>
                        </tr>
                        <tr>
                            <th class="center">NI</th>
                            <th style="padding-left:8px;" class="left">Needs Improvement</th>
                        </tr>
                        <tr>
                            <th class="center">D</th>
                            <th style="padding-left:8px;" class="left">Developing</th>
                        </tr>
                        <tr>
                            <th class="center">SD</th>
                            <th style="padding-left:8px;" class="left">Sufficiently Developed</th>
                        </tr>
                        <tr>
                            <th class="center">DC</th>
                            <th style="padding-left:8px;" class="left">Developed and Commendable</th></h6>
                        </tr>
                        
                </table>
                
        
            

            

        </div>
    </div>



	<div class="right-card">
        <div style="float:left; margin-left:25px; margin-top:45px;">
            <img src="<?php echo $pic1 ?>" style="width:70px;">
        </div>
        <div style="float:right; margin-right:25px; margin-top:45px;">
            <img src="<?php echo $pic2 ?>" style="width:70px;">
        </div>

		<!-- content for area 2 goes here -->
		<p class="right" style="margin-top:10px; margin-bottom:0; font-weight: normal;">SCHOOL FORM 9</p>
        <h5 class="center">Republic of the Philippines<br>
                            Department of Education<br>
                            National Capital Region </h5>
        <h4 class="center">Division of Taguig City and Pateros<br>
                            SIGNAL VILLAGE NATIONAL HIGH SCHOOL </h4>
        <h3 class="center">SENIOR HIGH SCHOOL</h3>
        <h5 class="center">Ballecer St., Central Signal Village, Taguig City  </h5>
        <div style="text-align: center;">
            <label for="sy" style="font-family: 'Serif', Times New Roman; font-size: 13px; text-align: center; padding-top: 10px; display: inline-block;">School Year:</label>
            <label for="sy" style="font-family: 'Serif', Times New Roman; font-size: 13px; text-align: center; padding-top: 10px; display: inline-block; text-decoration: underline;">{{$year->year}}</label><br>
        </div>
 
        <label for="fullname" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:bold; display: inline-block;">NAME:</label>
        <label class="underlinename" for="fullname" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-left: 10px; padding-top: 10px; display: inline-block;">{{$student->fullname}}</label><br>
        
        <label for="lrn" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:bold; display: inline-block;">LRN:</label>
        <label class="underlinelrn" for="lrn" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-align: center; padding-left: 10px; display: inline-block;">{{$student->lrn}}</label>
        
        <label for="sex" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; display: inline-block;">SEX:</label>
        <label class="underlinesex" for="sex" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-align: center;  display: inline-block; ">{{$student->gender}}</label>
        
        <label for="age" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; display: inline-block;">AGE:</label>
        <label class="underlineage" for="age" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-align: center;  display: inline-block; ">{{$student->age}}</label>
        <br>

        <label for="grade" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:bold; display: inline-block;">GRADE:</label>
        <label class="underlinegrade" for="grade" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-align: center;  display: inline-block; ">{{$student->section->glevel}}</label>
        <label for="section" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; display: inline-block;">SECTION:</label>
        <label class="underlinesection" for="section" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-align: center;  display: inline-block; ">{{$student->section->name}}</label>
        <br>

        <label for="ts" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:bold; display: inline-block;">TRACK/STRAND:</label>
        <label class="underlinets" for="ts" style="font-family: 'Open Sans', sans-serif; font-size: 12px; font-style:bold; display: inline-block; ">{{$student->strand->track}} / {{$student->strand->name}}</label>
        
        <div style="margin-left: 20px;">
            <h5 style="margin: 0; padding: 0;"><b><em>Dear Parents:</em></b><br>

            <em style="font-weight: normal; margin-left: 45px;">This report card shows the ability and progress your child has made in the different learning areas as well as her core values.</em><br>
            <em style="font-weight: normal; margin-left: 45px;">This school welcomes you should you desire to know more about your child's progress. </em>
            </h5>

        </div>

        <div class="namecontainer">
            <div class="nameleft">
                <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-decoration: underline; padding-top: 10px;">{{$year->principal}}</h5>
                <h5 class="center" style=" font-size: 12px; font-style:normal;"><em>{{$year->title}}</em></h5>
            </div>

            <div class="nameright">
                <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-decoration: underline; padding-top: 10px;">{{$adviser}}</h5>
                <h5 class="center" style=" font-size: 12px; font-style:normal;"><em>Adviser</em></h5>
            </div>
        </div><br><br>

        <div>
            <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-top: 10px; padding-bottom: 5px;">REPORT ON ATTENDANCE</h5>
               
                    <table class="attendancetable" style="margin-left: 20px; font-family: 'Open Sans', sans-serif;">
                            <thead>
                                <tr>
                                    <th style="width: 90px;"></th>
                                    @foreach($userArr as $month => $num)
                                        <th style="width: 30px;"><b>{{$month}}</b></th>
                                    @endforeach
                                    <th style="font-size: 7px; width: 28px;">Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="font-size: 8px; padding-left: 5px;">No. of School Days</td>
                                    @foreach($userArr as $month => $num)
                                        <td style="text-align: center;">
                                            @if($num['total'] != 0)
                                                {{$num['total']}}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td style="text-align: center;">{{$totalAll}}</td>
                                </tr>
                                <tr>
                                    <td style="font-size: 8px; padding-left: 5px;">No. of Days Present</td>
                                    @foreach($userArr as $month => $num)
                                        <td style="text-align: center;">
                                            @if($num['attend'] != 0)
                                                {{$num['attend']}}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td style="text-align: center;"></td>
                                </tr>
                                <tr>
                                    <td style="font-size: 8px; padding-left: 5px;">No. of Days Absent</td>
                                    @foreach($userArr as $month => $num)
                                        <td style="text-align: center;">
                                            @if($num['total'] != 0 || $num['attend'] != 0)
                                                {{$num['absent']}}
                                            @endif
                                        </td>
                                    @endforeach
                                    <td style="text-align: center;"></td>
                                </tr>
                                
                            </tbody>

                    </table>
        </div>

        <div>
            <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-top: 10px; ">PARENT / GUARDIAN'S SIGNATURE</h5>
           
            <label for="q1" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 12px; font-style:normal; display: inline-block;">1ST QUARTER</label>
            <label class="underlineq1" for="q1" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-left: 10px; padding-top: 10px; display: inline-block;"></label><br>
            <label for="q2" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 12px; font-style:normal; display: inline-block;">2ND QUARTER</label>
            <label class="underlineq2" for="q2" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-left: 10px; padding-top: 10px; display: inline-block;"></label><br>
            <label for="q2" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 12px; font-style:normal; display: inline-block;">3RD QUARTER</label>
            <label class="underlineq3" for="q2" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-left: 10px; padding-top: 10px; display: inline-block;"></label><br>
            <label for="q2" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 12px; font-style:normal; display: inline-block;">4TH QUARTER</label>
            <label class="underlineq4" for="q2" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-left: 10px; padding-top: 10px; display: inline-block;"></label><br>
        
    
        </div>


        <div>
            <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-top: 5px; padding-bottom: 5px;">CERTIFICATE OF TRANSFER</h5>
           
            <label for="grade" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:normal; display: inline-block;">Admitted to Grade:</label>
            <label class="underlineadgrade" for="grade" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:normal; text-align: center;  display: inline-block; "></label>
            <label for="section" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:normal; display: inline-block;">Section:</label>
            <label class="underlineadsection" for="section" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:normal; text-align: center;  display: inline-block; "></label>
            <br>
            <label for="q1" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:normal; display: inline-block;">Eligibility for Admission to: </label>
            <label class="underlineel" for="q1" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:normal; padding-left: 10px; padding-top: 10px; display: inline-block;"></label><br>
           
            <div class="namecontainer">
                <div class="nameleft">
                    <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-decoration: underline; padding-top: 10px;">{{$year->principal}}</h5>
                    <h5 class="center" style=" font-size: 12px; font-style:normal;"><em>{{$year->title}}</em></h5>
                </div>

                <div class="nameright">
                    <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-decoration: underline; padding-top: 10px;">{{$adviser}}</h5>
                    <h5 class="center" style=" font-size: 12px; font-style:normal;"><em>Adviser</em></h5>
                </div>
            </div>
            
    
        </div>

        <br><br>
      
        <div>
            <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; padding-top: 15px;">CANCELLATION OF ELIGIBILITY TO TRANSFER</h5>
           
            <label for="q1" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:normal; display: inline-block;">Admitted in: </label>
            <label class="underlineadmitted" for="q1" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:normal; padding-left: 10px; padding-top: 10px; display: inline-block;"></label><br>
            <label for="q1" style="font-family: 'Open Sans', sans-serif; margin-left: 20px; font-size: 13px; font-style:normal; display: inline-block;">Date: </label>
            <label class="underlinedate" for="q1" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:normal; padding-left: 10px; padding-top: 10px; display: inline-block;"></label><br>
           
            <div class="namecontainer">
                <div class="nameright">
                    <h5 class="center" style="font-family: 'Open Sans', sans-serif; font-size: 13px; font-style:bold; text-decoration: underline; padding-top: 10px;">{{$year->principal}}</h5>
                    <h5 class="center" style=" font-size: 12px; font-style:normal;"><em>{{$year->title}}</em></h5>
                </div>

            </div>
            
    
        </div>
      
       

	</div>

  </body>
</html>
