
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
    
@yield('css')
</head>

<body>
	<div class="wrapper">
	    <div class="sidebar" data-background-color="brown" data-active-color="danger">
	    <!--
			Tip 1: you can change the color of the sidebar's background using: data-background-color="white | brown"
			Tip 2: you can change the color of the active button using the data-active-color="primary | info | success | warning | danger"
		-->
			<div class="logo" style="display: flex; justify-content: center; align-items: center;text-align: center;">
				<a href="https://seniorhigh-svnhs.com/">
					<img src="../../../../../assets/img/logowithname.png" alt="Logo" style="max-height: 80%; max-width: 80%;">
				</a>
			
			</div>

	    	
				@include('layouts.navs.sidebar')
	    </div>

	    <div class="main-panel">
	        <nav class="navbar navbar-default">
	            <div class="container-fluid">
					<div class="navbar-minimize">
						<button id="minimizeSidebar" class="btn btn-fill btn-icon"><i class="ti-more-alt"></i></button>
					</div>
	                <div class="navbar-header">
	                    <button type="button" class="navbar-toggle">
	                        <span class="sr-only">Toggle navigation</span>
	                        <span class="icon-bar bar1"></span>
	                        <span class="icon-bar bar2"></span>
	                        <span class="icon-bar bar3"></span>
	                    </button>
	                    <a class="navbar-brand" href="">@yield('pagetitle')</a>
	                </div>
	            </div>
	        </nav>

	        <div class="content">
            @yield('content')
	        </div>

	        <footer class="footer">
	            <div class="container-fluid">
	                <nav class="pull-left">
	                    <ul>

	                        <li>
	                            <a href="https://seniorhigh-svnhs.com/">
								Senior High Access Module
	                            </a>
	                        </li>
	                        <li>
	                            <a href="#">
	                               Home
	                            </a>
	                        </li>
	                        <li>
	                            <a href="#">
	                            	About
	                            </a>
	                        </li>
	                    </ul>
	                </nav>
	                <div class="copyright pull-right">
	                    &copy; <script>document.write(new Date().getFullYear())</script>, made with <i class="fa fa-heart heart"></i> by <a href="https://seniorhigh-svnhs.com/">Senior High Access Module</a>
	                </div>
	            </div>
	        </footer>
	    </div>
	</div>
 
	@include('sweetalert::alert')
</body>

@yield('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>




	<!--   Core JS Files. Extra: TouchPunch for touch library inside jquery-ui.min.js   -->
	<script src="../../../../../../../../../../../../../../../../assets/js/jquery.min.js" type="text/javascript"></script>
	<script src="../../../../../../../../../../../../../../../../assets/js/jquery-ui.min.js" type="text/javascript"></script>
	<script src="../../../../../../../../../../../../../../../../assets/js/perfect-scrollbar.min.js" type="text/javascript"></script>
	<script src="../../../../../../../../../../../../../../../../assets/js/bootstrap.min.js" type="text/javascript"></script>

	<!--  Forms Validations Plugin -->
	<script src="../../../../../../../../../../../../../../../../assets/js/jquery.validate.min.js"></script>

	<!-- Promise Library for SweetAlert2 working on IE -->
	<script src="../../../../../../../../../../../../../../../../assets/js/es6-promise-auto.min.js"></script>

	<!--  Plugin for Date Time Picker and Full Calendar Plugin-->
	<script src="../../../../../../../../../../../../../../../../assets/js/moment.min.js"></script>

	<!--  Date Time Picker Plugin is included in this js file -->
	<script src="../../../../../../../../../../../../../../../../assets/js/bootstrap-datetimepicker.js"></script>

	<!--  Select Picker Plugin -->
	<script src="../../../../../../../../../../../../../../../../assets/js/bootstrap-selectpicker.js"></script>

	<!--  Switch and Tags Input Plugins -->
	<script src="../../../../../../../../../../../../../../../../assets/js/bootstrap-switch-tags.js"></script>

	<!-- Circle Percentage-chart -->
	<script src="../../../../../../../../../../../../../../../../assets/js/jquery.easypiechart.min.js"></script>

	<!--  Charts Plugin -->
	<script src="../../../../../../../../../../../../../../../../assets/js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="../../../../../../../../../../../../../../../../assets/js/bootstrap-notify.js"></script>

	<!-- Sweet Alert 2 plugin -->
	<script src="../../../../../../../../../../../../../../../../assets/js/sweetalert2.js"></script>

	<!-- Vector Map plugin -->
	<script src="../../../../../../../../../../../../../../../../assets/js/jquery-jvectormap.js"></script>

	<!--  Google Maps Plugin    -->
	<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>

	<!-- Wizard Plugin    -->
	<script src="../../../../../../../../../../../../../../../../assets/js/jquery.bootstrap.wizard.min.js"></script>

	<!--  Bootstrap Table Plugin    -->
	<script src="../../../../../../../../../../../../../../../../assets/js/bootstrap-table.js"></script>

	<!--  Plugin for DataTables.net  -->
	<script src="../../../../../../../../../../../../../../../../assets/js/jquery.datatables.js"></script>

	<!--  Full Calendar Plugin    -->
	<script src="../../../../../../../../../../../../../../../../assets/js/fullcalendar.min.js"></script>

	<!-- Paper Dashboard PRO Core javascript and methods for Demo purpose -->
	<script src="../../../../../../../../../../../../../../../../assets/js/paper-dashboard.js"></script>

	<!-- Paper Dashboard PRO DEMO methods, don't include it in your project! -->
	<script src="../../../../../../../../../../../../../../../../assets/js/demo.js"></script>

	

</html>
