<!DOCTYPE html>
  <head>
      <meta charset='utf-8'>
      <meta http-equiv='X-UA-Compatible' content='IE=edge'>
	  <link rel="icon" type="image/png" sizes="96x96" href="../../../../../../../../assets/img/SHAM-Logo.png">
      <title>Senior High Access Module</title>
      <meta name='viewport' content='width=device-width, initial-scale=1'>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
      <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">

      <link rel='stylesheet' type='text/css' media='screen' href='../../../assets/css/landing.css'>
      
  </head>
  <body>

    <!-- header -->

    <header class="header">

      <a href="#" class="logo"><img src="../../assets/img/logowithname.png" alt="Logo"></a>
      
      
      <div class="fas fa-bars"></div>
      
      
      <nav class="navbar">
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#about">SHS</a></li>
            <li><a href="#strand">Strands</a></li>
            <li><a href="#contact">Contact Us</a></li>
            
            @if(Auth::user())
            <li><a href="/getProfile" class="login_btn">Profile</a></li>
            @else
            <li><a href="/ticket">Application Status</a></li>
            <li><a href="/login" class="login_btn">Login</a></li>
            <li><a href="/applicants/create" class="register_btn">Register</a></li>
            @endif
            
            
        </ul>
      </nav>
      
      
      </header>


      <!-- Home starts here--> 

      
    <section id="home" class="home">
      <div class="logos"> <img src="../assets/img/svnhsLogo.png"> 
        <img src="../assets/img/shsLogo.png"> </div>
     
      <h1 class="banner">SENIOR HIGH ACCESS MODULE</h1>
      <h3 class="slogan">Signal Village National High School</h3>
      <h3 class="slogan">Senior High School</h3>
      
      
      <div class="wave wave1"></div>
      <div class="wave wave2"></div>
      <div class="wave wave3"></div>
      
      <div class="fas fa-sun nut1"></div>
      <div class="fas fa-sun nut2"></div>

   
    </section>


      <!-- Home ends here--> 

    <!-- SHS starts here  -->
    <section id="about" class="about">

      <h1 class="heading">Senior High School</h1>
      <br><br><br>
      <div class="row">
      
        <div class="content">
          <h3>Signal Village National High School</h3>
          <h3>Senior High School</h3>
          <p>Signal Village National High School (SVNHS) is a public secondary school located in Signal Village, Taguig City. Established in 1976, the school was once called the Fort Bonifacio High School Signal Annex. By 1995, it was converted into an independent school through Republic Act 8039.
<br><br>
At present, SVNHS is a certified K-12-ready institution, offering Junior High as well as Senior High School (SHS) programs recognized by the Department of Education (DepEd). Students who intend to pursue their SHS education in this institution may school from strands under the Academic and Technical-Vocational-Livelihood (TVL) tracks.   </p>
          
        </div>
      
        <div class="image">
          <img src="../../../assets/img/svnhs.jpg" alt="">
        </div>
      
      </div>
      
      
    </section>
    <!-- SHS ends here  -->
  

    <!-- MVC starts here  -->
    <section id="mvc" class="mvc">

    <h1 class="heading">MISSION, VISION & CORE VALUES</h1>
    
    <div class="row">
    
    <div class="card">
      <div class="image">
        <i class="fa fa-bullseye"></i>
      </div>
      <div class="info">
        <h3>VISION</h3><br>
        <span>SVNHS provides holistic education to all types of individuals through a caring professional 
          school climate and responsible governance.</span>
      </div>
    </div>

    <div class="card">
      <div class="image">
        <i class="fa fa-book"></i>
      </div>
      <div class="info">
        <h3>MISSION</h3><br>
        <span>SVNHS is a premier school with supportive stakeholders manned by competent and dedicated 
          teachers geared towards nurturing filipino youths who are God fearing, skillful and globally 
          competitive.</span>
      </div>
    </div>
    
    <div class="card">
      <div class="image">
        <i class="fa fa-cog"></i>
      </div>
      <div class="info">
        <h3>CORE VALUES</h3><br>
        <span><p>God loving <br><br> Commitment <br><br> Competence</p></span>
        </div>
      </div>
    </div>
    
    </div>
    
    
    </section>
    <!-- MVC ends here  -->


    <!-- tracks starts here  -->
    <section id="strand" class="strand">

    <h1 class="heading">STRANDS</h1>
    
    <div class="row">
    
      <div class="image">
        <a href="https://www.freepik.com/free-vector/tiny-people-preparing-invoice-computer-isolated-flat-illustration_11235935.htm#from_view=detail_alsolike"> <img src="../../../assets/img/abm_vector.jpg" alt=""></a>
      </div>
      <div class="content"> 
        <img src="../../../assets/img/abmLogo.png" alt="">
        <h3>Accountancy, Business and Management</h3>
        <p>The Accountancy, Business and Management (ABM) strand would focus on the basic concepts of financial 
          management, business management, corporate operations, and all things that are accounted for.</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
    
    </div>
    
    <div class="row">
    
      <div class="content">
        <img src="../../../assets/img/gasLogo.png" alt="">
        <h3>General Academic</h3>
        <p>The strand aims to provide the students with a framework of liberal education equipping them with 
          a knowledge and skills to facilitate intellectual and physical growth, to pursue their studies in 
          college or university and contribute to the improvement of the community in which they live.</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
      <div class="image">
        <a href="https://www.freepik.com/free-vector/business-partners-meeting-businesspeople-meeting-signing-contract-flat-vector-illustration-employment-deal-partnership_10172442.htm#from_view=detail_alsolike"><img src="../../../assets/img/gas_vector.jpg" alt=""></a>
      </div>
    
    </div>

    <div class="row">
    
      <div class="image">
      <a href="https://www.freepik.com/free-vector/person-keeping-social-distance-avoiding-contact-woman-separating-from-crowd-meditating-transparent-bubble_11235815.htm?query=vectors%20people#from_view=detail_alsolike"><img src="../../../assets/img/humss_vector.png" alt=""></a>
      </div>
      <div class="content"> 
        <img src="../../../assets/img/humssLogo.png" alt="">
        <h3>Humanities and Social Sciences</h3>
        <p>The strand offers a course of study that exposes the students to a variety of subjects that develop 
          them how to reason, question and communicate more effectively, discover how to solve problems creatively.</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
    
    </div>
    
    <div class="row">
    
      <div class="content">
        <img src="../../../assets/img/stemLogo.png" alt="">
        <h3>Science, Technology, Engineering and Mathematics</h3>
        <p>This strand will develop the students' ability to evaluate simple to complex societal problems 
          and be responsive and active in the formulation of its solution through the application and 
          integration of scientific, technological, engineering, and mathematical concepts.</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
      <div class="image">
      <a href="https://www.freepik.com/free-vector/biology-scientists-doing-research-fruits-people-cultivating-plants-lab-vector-illustration-gmo-food-agriculture-science-concept_10606172.htm#query=vectors%20stem%20people&position=0&from_view=search&track=ais"><img src="../../../assets/img/stem_vector.jpg" alt=""></a>
      </div>
    
    </div>


    <div class="row">
    
      <div class="image">
      <a href="https://www.freepik.com/free-vector/group-doctors-standing-hospital-building-team-practitioners-ambulance-car_12291026.htm#query=vectors%20people%20nurse&position=0&from_view=search&track=ais"> <img src="../../../assets/img/care_vector.jpg" alt=""></a>
      </div>
      <div class="content"> 
        <img src="../../../assets/img/careLogo.png" alt="">
        <h3>Caregiving (Nursing Arts)</h3>
        <p>Caregiving is one of the specialized subjects under the technical-vocational livelihood (TVL) 
          career track. You will learn Care and Support to Infants and Toddlers, Care and Support to 
          Children, and Social, Intellectual, Creative, and Emotional Development of Children.</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
    
    </div>
    
    <div class="row">
    
      <div class="content">
        <img src="../../../assets/img/eimLogo.png" alt="">
        <h3>Electrical Installation and Maintenance</h3>
        <p>The strand aims to prepare students with skills and abilities when it comes to electrical industry. 
          This strand consists of laboratory activities to show the effectiveness of developing the Electrical 
          Installation and Maintenance students' skills essential to the field of electrical.</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
      <div class="image">
      <a href="https://www.freepik.com/free-vector/solar-power-plant-maintenance-utility-workers-repairing-electric-installations-boxes-towers-power-lines-electric-network-operation-city-service-renewable-energy-topics_10173574.htm#query=vectors%20people%20electrical&position=36&from_view=search&track=ais"><img src="../../../assets/img/eim_vector.jpg" alt=""></a>
      </div>
    
    </div>

    <div class="row">
    
      <div class="image">
      <a href="https://www.freepik.com/free-vector/chef-preparing-food-popular-tv-show-isolated-flat-vector-illustration-cartoon-people-cooking-fruit-salad-camera_10172491.htm#page=3&position=25&from_view=author"><img src="../../../assets/img/he_vector.jpg" alt=""></a>
      </div>
      <div class="content"> 
        <img src="../../../assets/img/heLogo.png" alt="">
        <h3>Home Economics</h3>
        <p>Home Economics can also lead to National certifications based on TESDA standards. 
          You will be taking up courses on barbering, bartending, beauty care, bread and pastry, caregiving, 
          cookery, dressmaking, food and beverage, housekeeping, tourism, handicrafts among others</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
    
    </div>
    
    <div class="row">
    
      <div class="content">
        <img src="../../../assets/img/ictLogo.png" alt="">
        <h3>Information and Communications Technology</h3>
        <p>The ICT strand is best for students who want to take computer science and its related degrees 
          in college. In fact, this is perfect for tech-savvy students who are fond of using technological tools to foster their skills.</p>
        <a href="#"><button class="btn">read more</button></a>
      </div>
      <div class="image">
      <a href="https://www.freepik.com/free-vector/office-workers-organizing-data-storage-file-archive-server-computer-cartoon-illustration_12699172.htm#from_view=detail_alsolike"><img src="../../../assets/img/ict_vector.jpg" alt=""></a>
      </div>
    
    </div>

    </section>
    <!-- tracks ends here  -->


   <!-- contact starts here  -->
   <section id="contact" class="contact">

  <h1 class="heading">contact us</h1>


  <div class="row">

    <div class="image">
      <img src="../../../assets/img/contact2.png" alt="">
    </div>

    <div class="form-container">
      <form action="/contactUs" method="POST">

        <div class="inputBox">
          <input type="text" name="fname" placeholder="first name">
          <input type="text" name="lname" placeholder="last name">
        </div>

        <input type="email" name="email" placeholder="email"> 
        <textarea name="message" id="message" cols="30" rows="10" placeholder="message"></textarea>
        <input type="submit" value="send">

      </form>
    </div>

  </div>

  </section>
  <!-- contact ends here  -->


    <footer class="footer">
      <div class="container">
        <div class="roww">
          <div class="footer-col">
            <h4>Senior High Access Module</h4>
            <ul>
              <li><a href="#">Lorem Ipsum Dolor Sit Amet, Consectetur Adipisicing Elit. Ea Amet Iure Deserunt Doloremque Voluptate Distinctio Rerum! Quas Sunt Inventore Illum Facere Minus Voluptas Fugit, Magni Quidem Cumque! Animi, Illo Magni.</a></li>
             
            </ul>
          </div>
          <div class="footer-col">
            <h4>Address</h4>
            <ul>
              <li><a href="https://www.google.com.ph/maps/place/Signal+Village+National+High+School/@14.511753,121.05637,17z/data=!3m1!4b1!4m6!3m5!1s0x3397cf4a1d73ce63:0xee3c515e804d53cb!8m2!3d14.511753!4d121.058564!16s%2Fg%2F11c702mzjn">Ballecer St., Central Signal Village, Taguig City, Metro Manila, Philippines</a></li>
              
            </ul>
          </div>
          <div class="footer-col">
            <h4>Navigate</h4>
            <ul>
              <li><a href="#home">Home</a></li>
              <li><a href="#about">SHS</a></li>
              <li><a href="#strand">Strands</a></li>
              <li><a href="#contact">Contact Us</a></li>
              <li><a href="/ticket">Check you Application Status</a></li>
              <li><a href="#">Download the Mobile App</a></li>
            </ul>
          </div>
          <div class="footer-col">
            <br>
            <h4>Have questions?</h4>
            <ul>
              <li><a href="#contact">Let us help you. Contact us.</a></li>
            </ul>
          </div>
        </div>
      </div>
   </footer>


      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.4/jquery.min.js" integrity="sha512-pumBsjNRGGqkPzKHndZMaAG+bir374sORyzM3uulLV14lN5LyykqNk8eEeUlUkB3U0M4FApyaHraT65ihJhDpQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
      <script src="../../../assets/js/landing.js"></script>
      @include('sweetalert::alert')
  </body>
  </html>