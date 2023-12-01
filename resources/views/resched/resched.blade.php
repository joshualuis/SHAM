
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
                <li><a href="/">Home</a></li>
                @if(Auth::user())
                <li><a href="/getProfile" class="login_btn">Profile</a></li>
                @else
                <li><a href="/login" class="login_btn">Login</a></li>
                <li><a href="/applicants/create" class="register_btn">Register</a></li>
                @endif
            </ul>
        </nav>
        
        
        </header>

        <div class="content">
            <div class="container-fluid" style="display: absolute; justify-content: center; align-items: center; padding-top:50px;">

                <div class="row">
                
                    <div class="col-md-6 col-md-offset-3">
                        
                        
                        <div class="card">
                            <div class="">
                                <div class="card-header">
                                    <br>
                                    <h3 class="card-title text-center" ><b>RESCHEDULE INTERVIEW</b></h3><br>
                                    
                                    
                                </div>

                                <div class="card-content">
                                    <form action="/resched/edit" method="GET">

                                    <div class="text-center">
                                        <div class="navbar-form navbar-search-form" role="search">

                                            <h4 class="card-title text-center" >Application No.</h04>
                                            <input type="text" name="_id" value="" class="form-control" placeholder="Search..."><br>

                                            <h4 class="card-title text-center" >Birthday:</h04>
                                            <input type="date" name="birthdate" value="" class="form-control"><br><br>
                                
                                        
                                            <button type="submit" class="btn btn-wd btn-success btn-fill btn-magnify">
                                                    <span class="btn-label">
                                                        <i class="ti-search"></i>
                                                    </span>
                                                    Verify
                                            </button>
                                        </div>
                                    </div>
                                    <br>
                        
                                    <div class="text-center">
                                        @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        @endif

                                        @if(session('message'))
                                            <div class="text-center">
                                                {!! session('message') !!}
                                            </div>
                                        @endif
                                    </div>
                                    <br>

                                    </form>
                                
                    
                                </div><!-- END OF CARD-CONTENT -->
                                
                            </div>
                            
                    

                        
                        </div>

                    </div>
                </div>
            </div>
        </div>



        
        
        
        


	</div>
  </div>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  
  <script src="../../../../../../assets/js/registration.js"></script>
  
<script>

</script>



</body>

</html>