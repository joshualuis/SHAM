<html>
    <head>
        <style>
            /** Define the margins of your page **/
            @page {
                margin-top: 100px; 
                margin-left: 5px;
                margin-right: 5px;
                margin-bottom: 50px; 
            }

            
            header {
        position: fixed;
        top: -60px;
        left: 0px;
        right: 0px;
        height: 130px;
        width: 100%;
        margin-bottom:20px;
    }
  

    .header h5.center {
    font-weight: normal; /* make the first h5 not bold */
    margin: 0;
    }

    .header h4.center, h3.center {
        font-weight: bold; /* make h4 and h3 bold */
        margin: 0;
    }
    .header label{
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
    h3, h4, h5,  {
    margin: 0;
    padding: 0;
    }

           
            body {
                margin-top: 2cm;
                margin-left: 2cm;
                margin-right: 2cm;
                margin-bottom: 0.5cm;
            }
            .mtable{
        border-collapse: collapse;
        width: 100%;
        margin: auto;
        margin-top: 20px;
        border: 2px solid black;
        margin-bottom: 30px;
    }
    .mtable th, .mtable td {
    border: 1px solid black;
    margin-top: 0;
    margin-bottom: 0;
   
    }
    
    .mtable th{
        padding:3px;
        background-color: #D3d3d3;
        border: 2px solid black;
    }
    .mtable tr,td{
        padding:3px;

    }
    footer {
                position: fixed; 
                bottom: -30px; 
                left: 50px; 
                right: 0px;
                height: 50px;
            }
        </style>
    </head>
    <body>
        <!-- Define header and footer blocks before your content -->
        <header>
        <div style="float:left; margin-left:80px; margin-top:30px;">
            <img src="<?php echo $pic1 ?>" style="width:70px;">
        </div>
        <div style="float:right; margin-right:80px; margin-top:30px;">
            <img src="<?php echo $pic2 ?>" style="width:70px;">
        </div>
        <h5 class="center">Republic of the Philippines<br>
                            Department of Education<br>
                            National Capital Region </h5>
        <h4 class="center">Division of Taguig City and Pateros<br>
                            SIGNAL VILLAGE NATIONAL HIGH SCHOOL </h4>
        <h3 class="center">SENIOR HIGH SCHOOL</h3>
        <h5 class="center">Ballecer St., Central Signal Village, Taguig City  </h5>
        </header>

        <footer>
            <h5 class="left">Printed by: @if(Auth::user()->role == "admin")
                {{ Auth::user()->name }}
                @endif
                @if(Auth::user()->role == "student")
                {{ Auth::user()->student->lname }}
                @endif
                @if(Auth::user()->role == "teacher"|| 
                    Auth::user()->role == "ABM"||
                    Auth::user()->role == "ABM" || 
                    Auth::user()->role == "GAS" || 
                    Auth::user()->role == "HUMSS" || 
                    Auth::user()->role == "STEM" || 
                    Auth::user()->role == "CARE" ||
                    Auth::user()->role == "EIM" ||
                    Auth::user()->role == "HE" ||
                    Auth::user()->role == "ICT")
                {{ Auth::user()->teacher->lname }}
                @endif 
            </h5>
            
            <h5 class="left">Date: {{$currentDate}} </h5>
        </footer>

        <!-- Wrap the content of your PDF inside a main tag -->
        <main>
        <h3 class="center">APPLICANTS FOR SCHOOL YEAR: {{$year->year}} </h3><br>
    <h3 class="center">{{$strand}}</h3>
    <table class="mtable center">
        <thead class="center">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Strand</th>
                <th>Age</th>
                <th>Gender</th>
                <th>GWA</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @foreach ($app as $tao)
            <tr>
                <td>{{ $counter }}</td>
                <td>{{$tao->fullname}}</td>
                <td>{{$tao->firstchoice}}</td>
                <td>{{$tao->age}}</td>
                <td>{{$tao->gender}}</td>
                <td>{{$tao->gwa}}</td>
            </tr>
            @php $counter++; @endphp
            @endforeach
        </tbody>
    </table>
    <div style="page-break-after: always;"> </div>
    <h3 class="center">WAITING LIST</h3>
    <table class="mtable center">
        <thead class="center">
            <tr>
                <th>No.</th>
                <th>Name</th>
                <th>Strand</th>
                <th>Age</th>
                <th>Gender</th>
                <th>GWA</th>
            </tr>
        </thead>
        <tbody>
            @php $counter = 1; @endphp
            @foreach ($wait as $tao)
            <tr>
                <td>{{ $counter }}</td>
                <td>{{$tao->fullname}}</td>
                <td>{{$tao->firstchoice}}</td>
                <td>{{$tao->age}}</td>
                <td>{{$tao->gender}}</td>
                <td>{{$tao->gwa}}</td>
            </tr>
            @php $counter++; @endphp
            @endforeach
        </tbody>
    </table>

        </main>

    </body>

</html>