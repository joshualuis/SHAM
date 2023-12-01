<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Document</title>
</head>
<body>
   
<style>
table, th, td {
  border:1px solid black;
}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content/Box */
.modal-content {
  background-color: #fefefe;
  margin: 15% auto; /* 15% from the top and centered */
  padding: 20px;
  border: 1px solid #888;
  width: 80%; /* Could be more or less, depending on screen size */
}

/* The Close Button */
.close1 {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close1:hover,
.close1:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}

.close2 {
  color: #aaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close2:hover,
.close2:focus {
  color: black;
  text-decoration: none;
  cursor: pointer;
}
</style>
   <a href="applicants/create" class="btn btn-primary">Add Applicant</a>
<table>
    <thead>
      <th>checkbox</th>
      <th>ID</th>
      <th>Applicant Name</th>
      <th>1st Choice</th>
      <th>Track</th>
      <!-- <th>Section</th> -->
      <th>Father</th>
      <th>City</th> 
      <th>Action</th>
   </thead>
   <tbody>
         <?php
            $arr = array();
         ?>
      <form action="/api/shortlisteds" method="POST">
   
      @foreach($applicants as $applicant)
      <tr> 
         <td><input type="checkbox" name="toEnlist[]" value="{{$applicant->id}}"></td>
         <td class="applicant_id"><?php echo $applicant->id ?></td>
         <!-- <td>{{$applicant -> id}}</td> -->
         <td>{{$applicant -> fname}}</td>
         <td>{{$applicant -> firstchoice}}</td>
         <td>{{$applicant -> track}}</td>
         <!-- <td>{{$applicant -> section}}</td> -->
         <td>{{$applicant -> fathername}}</td>
         <td>{{$applicant -> city}}</td>

         <td align="center">

         <a href="/api/shortlisteds/" class="btn btn-primary">
         <button><i class="" style="font-size:15px; color:red" ></i>Edit</button></td></a></td>
         
         <!--<td align="center">
             <a href="#" class="view_btn">View</a>
         <button id="Btn2"><i class="view_btn" style="font-size:15px; color:red" ></i>Shortlist</button></td></a></td> -->

         <!-- <td align="center">
         <a href="/api/applicants/{{$applicant->_id}}/edit">
         <button><i class="" style="font-size:15px; color:red" ></i>Edit</button></td></a></td>
         <td align="center">
         {!! Form::open(array('route' => array('applicants.destroy', $applicant->_id),'method'=>'DELETE')) !!}
         <button><i class="" style="font-size:15px; color:red" ></i>Delete</button></td></a></td>
         {!! Form::close() !!}  -->
      </tr>
      @endforeach
      
      <button type="submit" class="btn btn-primary">Enlist</button>
      </form>
      </tbody>
</table>

<!-- 
<button id="Btn1">Multiple</button>
<div id="Modal1" class="modal">
  <div class="modal-content">
    <span class="close1">&times;</span>
    <p>Multiple Enlistment</p>
  </div>
</div>


<button id="Btn2">Individual</button>
<div id="Modal2" class="modal">
  <div class="modal-content">
   <span class="close2">&times;</span>

      <div class="col-md-6 pr-1">
         <div class="form-group">
            <label for="">{{$applicant -> fname}}</label>
         </div>
      </div>

      <div class="col-md-6 pr-1">
         <div class="form-group">
            <label for="strand_name">Strand</label>
            {!! Form::select('strand_id', $strands, null, ['placeholder' => 'Select a Strand', 'class' => 'form-control']) !!}
         </div>
      </div>

      <div class="col-md-6 pr-1">
         <div class="form-group">
            <label for="strand_name">Section</label>
            {!! Form::select('strand_id', $strands, null, ['placeholder' => 'Select a Strand', 'class' => 'form-control']) !!}
         </div>
      </div>
  </div>
</div> -->

<!-- 
<script src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
<script>

$(document).ready(function () {
   $('.view_btn').click(function (e) {
      e.preventDefault();
      // alert('Hello');

      var applicant_id = $(this).closest('tr').find('.applicant_id').text();
      console.log(applicant_id);
   });
});
// Mulitple Modal
var modal1 = document.getElementById("Modal1");
var btn1 = document.getElementById("Btn1");
var span1 = document.getElementsByClassName("close1")[0];

var modal2 = document.getElementById("Modal2");
var btn2 = document.getElementById("Btn2");
var span2 = document.getElementsByClassName("close2")[0];

btn1.onclick = function() {
   modal1.style.display = "block";
}

btn2.onclick = function() {
   modal2.style.display = "block";
}

span1.onclick = function() {
   modal1.style.display = "none";
}

span2.onclick = function() {
   modal2.style.display = "none";
}

window1.onclick = function(event) {
  if (event.target == modal1) {
   modal1.style.display = "none";
  }
}

window2.onclick = function(event) {
  if (event.target == modal2) {
   modal2.style.display = "none";
  }
}


</script> -->
</body>
</html>