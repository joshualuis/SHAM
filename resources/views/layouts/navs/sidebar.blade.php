<div class="sidebar-wrapper">
  <div class="user">
	    <div class="photo">
      @if(Auth::user()->role == "admin" || 
          Auth::user()->role == "student" || 
          Auth::user()->role == "teacher"|| 
          Auth::user()->role == "ABM"||
          Auth::user()->role == "ABM" || 
          Auth::user()->role == "GAS" || 
          Auth::user()->role == "HUMSS" || 
          Auth::user()->role == "STEM" || 
          Auth::user()->role == "CARE" ||
          Auth::user()->role == "EIM" ||
          Auth::user()->role == "HE" ||
          Auth::user()->role == "ICT")
        <img src="{{URL::asset(Session::get('image'))}}" />
      @endif
     
	    </div>
	    <div class="info">
				<a data-toggle="collapse" href="#collapseExample" class="collapsed">
        @if(Auth::user()->role == "admin")
          <span>{{ Auth::user()->name }}<b class="caret"></b></span>
        @endif
        @if(Auth::user()->role == "student")
          <span>{{ Auth::user()->student->lname }}<b class="caret"></b></span>
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
          <span>{{ Auth::user()->teacher->lname }}<b class="caret"></b></span>
        @endif
	        
	      </a>
				<div class="clearfix"></div>
        <div class="collapse" id="collapseExample">
	        <ul class="nav">
	          <li>
							<a href="/getProfile">
								<span class="sidebar-mini"><i class="ti-files"></i></span>
								<span class="sidebar-normal">My Profile</span>
							</a>
						</li>
            <li>
                <a class="" href="{{ route('logout') }}"
                    onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                                    <span class="sidebar-mini"><i class="ti-arrow-circle-right"></i></span>
								<span class="sidebar-normal">{{ __('Logout') }}</span>
                    
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
              
						</li>
	        </ul>
	      </div>
	    </div>
	</div>
	
  <ul class="nav">
        @if(Auth::user()->role == "admin" ||
          Auth::user()->role == "ABM" || 
          Auth::user()->role == "GAS" || 
          Auth::user()->role == "HUMSS" || 
          Auth::user()->role == "STEM" || 
          Auth::user()->role == "CARE" ||
          Auth::user()->role == "EIM" ||
          Auth::user()->role == "HE" ||
          Auth::user()->role == "ICT" )

          <li>
	          <a data-toggle="collapse" href="#dashboardOvervieww">
              <i class="ti-panel"></i>
              <p>SCHOOL YEAR<b class="caret"></b></p>
	          </a>
            <div class="collapse" id="dashboardOvervieww">
							<ul class="nav">
              @if(Auth::user()->role == "admin")
                <li>
                  <a href="/admin/years">
                    <span class="sidebar-mini"><i class="ti-ruler-pencil"></i></span>
                    <span class="sidebar-normal">Create a New School Year</span>
                  </a>
                </li>
              @else
              
              @endif

                @foreach(Session::get('years') as $year)
                <li>
                  <a href="/admin/schoolyear/{{$year->id}}">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">{{$year->year}}</span>
                  </a>
                </li>
                @endforeach
            
							
							</ul>
						</div>
	        </li>

          <li class="{{'admin/dashboard' == request()->path() ? 'active': ''}}">
	          <a href="/admin/dashboard">
	            <i class="ti-image"></i>
	              <p>Dashboard</p>
	          </a>
	        </li>          
          

          <li class="{{ Request::is('admin/applicants*', 'admin/applicants/emailed*', 'admin/shortlisteds*') ? 'active' : '' }}">
	          <a data-toggle="collapse" href="#registrationOvervieww">
	            <i class="ti-layout-tab"></i>
	              <p>REGISTRATION<b class="caret"></b>
                </p>
	          </a>
            <div class="{{ Request::is('admin/applicants*', 'admin/applicants/emailed*', 'admin/shortlisteds*') ? 'collapse in' : 'collapse' }}" id="registrationOvervieww">
							<ul class="nav">

                <li class="{{'admin/applicants' == request()->path() ? 'active': ''}}">
                  <a href="/admin/applicants">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Applicants</span>
                  </a>
                </li>
                
                <li class="{{'admin/applicants/emailed' == request()->path() ? 'active': ''}}">
                  <a href="/admin/applicants/emailed">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">For Interview</span>
      
                  </a>
                </li>
                <li class="{{'admin/shortlisteds' == request()->path() ? 'active': ''}}">
                  <a href="/admin/shortlisteds">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Shortlisteds</span>
      
                  </a>
                </li>

                <li class="{{'admin/applicant/unattended' == request()->path() ? 'active': ''}}">
                  <a href="/admin/applicant/unattended">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Unattended</span>
                  </a>
                </li>
								
							
							</ul>
						</div>
	        </li>

          @if(Auth::user()->role == "admin")
          <li class="{{ Request::is('admin/students') || Request::is('admin/sections') || Request::is('admin/curriculums') ? 'active' : '' }}">
	          <a data-toggle="collapse" href="#classesOvervieww">
	            <i class="ti-layout-list-thumb"></i>
	              <p>CLASSES<b class="caret"></b>
                </p>
	          </a>
            <div class="{{ Request::is('admin/students') || Request::is('admin/sections') || Request::is('admin/curriculums') ? 'collapse in' : 'collapse' }}" id="classesOvervieww">
							<ul class="nav">
                <li class="{{'admin/students' == request()->path() ? 'active': ''}}">
                  <a href="/admin/students">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Strands</span>
                  </a>
                </li>
                
                <li class="{{'admin/sections' == request()->path() ? 'active': ''}}">
                  <a href="/admin/sections">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Sections</span>
      
                  </a>
                </li>
                <li class="{{'admin/curriculums' == request()->path() ? 'active': ''}}">
                  <a href="/admin/curriculums">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Subjects</span>
      
                  </a>
                </li>
								
							
							</ul>
						</div>
	        </li>

        
            <li class="{{'admin/teachers' == request()->path() ? 'active': ''}}">
              <a href="/admin/teachers">
                <i class="ti-bookmark"></i>
                  <p>Teachers</p>
              </a>
            </li>
            
            <li class="{{'admin/allStudents' == request()->path() ? 'active': ''}}">
              <a href="/admin/allStudents">
                <i class="ti-medall"></i>
                  <p>Students</p>
              </a>
            </li>  


            <li class="{{ Request::is('admin/users/teachers') || Request::is('admin/users/students') ? 'active' : '' }}">
	          <a data-toggle="collapse" href="#usersOvervieww">
	            <i class="ti-user"></i>
	              <p>USERS<b class="caret"></b>
                </p>
	          </a>
            <div class="{{ Request::is('admin/users/teachers') || Request::is('admin/users/students') ? 'collapse in' : 'collapse' }}" id="usersOvervieww">
							<ul class="nav">
                <li class="{{'admin/users/teachers' == request()->path() ? 'active': ''}}">
                  <a href="/admin/users/teachers">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Teachers</span>
                  </a>
                </li>
                
                <li class="{{'admin/users/students' == request()->path() ? 'active': ''}}">
                  <a href="/admin/users/students">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">Students</span>
      
                  </a>
                </li>
							</ul>
						</div>
	        </li>


                <li class="{{'admin/reports' == request()->path() ? 'active': ''}}">
                  <a href="/admin/reports">
                    <i class="ti-bar-chart-alt"></i>
                      <p>Reports</p>
                  </a>
                </li> 

        @endif

         <!-- ------------FOR COORDINATOR AND TEACHER----------- -->
         @if(Auth::user()->role == "ABM" || 
          Auth::user()->role == "GAS" || 
          Auth::user()->role == "HUMSS" || 
          Auth::user()->role == "STEM" || 
          Auth::user()->role == "CARE" ||
          Auth::user()->role == "EIM" ||
          Auth::user()->role == "HE" ||
          Auth::user()->role == "ICT" 
          )

          <li class="{{'teacher/strands' == request()->path() ? 'active': ''}}">
	          <a href="/teacher/strands">
	            <i class="ti-layers-alt"></i>
	              <p>Strand ({{ Auth::user()->role }})</p>
	          </a>
	        </li> 
          
          <li class="{{'teacher/subjects' == request()->path() ? 'active': ''}}">
	          <a href="/teacher/subjects">
	            <i class="ti-layout-list-thumb"></i>
	              <p>Classes</p>
	          </a>
	        </li>  

          <li class="{{'teacher/teacherSchedule' == request()->path() ? 'active': ''}}">
            <a href="/teacher/teacherSchedule">
              <i class="ti-layout-cta-left"></i>
              <p>Schedule</p>
            </a>
          </li>

          <li class="{{'teacher/advisory' == request()->path() ? 'active': ''}}">
            <a href="/teacher/advisory">
              <i class="ti-layout-media-left"></i>
              <p>Advisory Class</p>
            </a>
          </li>

          <li class="{{'admin/reports' == request()->path() ? 'active': ''}}">
	          <a href="/admin/reports">
	            <i class="ti-bar-chart-alt"></i>
	              <p>Reports</p>
	          </a>
	        </li> 
          @endif


          @endif

          @if(Auth::user()->role == "teacher")
          <li>
	          <a data-toggle="collapse" href="#dashboardOvervieww">
              <i class="ti-panel"></i>
              <p>SCHOOL YEAR<b class="caret"></b></p>
	          </a>
            <div class="collapse" id="dashboardOvervieww">
							<ul class="nav">
                @foreach(Session::get('studyears') as $year)
                <li>
                  <a href="/admin/schoolyear/{{$year->id}}">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">{{$year->year}}</span>
                  </a>
                </li>
                @endforeach
							</ul>
						</div>
	        </li>

          <li class="{{'teacher/subjects' == request()->path() ? 'active': ''}}">
            <a href="/teacher/subjects">
              <i class="ti-layout-list-thumb"></i>
              <p>Classes</p>
            </a>
          </li>
          
          <li class="{{'teacher/teacherSchedule' == request()->path() ? 'active': ''}}">
            <a href="/teacher/teacherSchedule">
              <i class="ti-layout-cta-left"></i>
              <p>Schedule</p>
            </a>
          </li>
          

          <li class="{{'teacher/advisory' == request()->path() ? 'active': ''}}">
            <a href="/teacher/advisory">
              <i class="ti-layout-media-left"></i>
              <p>Advisory Class</p>
            </a>
          </li>

          @endif


          <!-- ------------FOR COORDINATOR AND TEACHER----------- -->

          
           



             

          @if(Auth::user()->role == "student")
          <li>
	          <a data-toggle="collapse" href="#dashboardOvervieww">
              <i class="ti-panel"></i>
              <p>SCHOOL YEAR<b class="caret"></b></p>
	          </a>
            <div class="collapse" id="dashboardOvervieww">
							<ul class="nav">
                @foreach(Session::get('studyears') as $year)
                <li>
                  <a href="/admin/schoolyear/{{$year->id}}">
                    <span class="sidebar-mini">O</span>
										<span class="sidebar-normal">{{$year->year}}</span>
                  </a>
                </li>
                @endforeach
							</ul>
						</div>
	        </li>

          <li class="{{'student/studentSchedule' == request()->path() ? 'active': ''}}">
            <a href="/student/studentSchedule/">
              <i class="ti-layout-cta-left"></i>
              <p>Schedule</p>
            </a>
          </li>
          <li class="{{'student/viewGrades' == request()->path() ? 'active': ''}}">
            <a href="/student/viewGrades">
              <i class="ti-layout-cta-left"></i>
              <p>Grades</p>
            </a>
          </li>
          
          @endif
          



        </ul>
      </div>