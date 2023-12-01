
const prevBtns = document.querySelectorAll(".btn-default");
const nextBtns = document.querySelectorAll(".btn-info");
const progress = document.getElementById("progress");
const formSteps = document.querySelectorAll(".form-step");
const progressSteps = document.querySelectorAll(".progress-step");

let formStepsNum = 0;
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

nextBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    const requiredFields = formSteps[formStepsNum].querySelectorAll('[required]');
    let isValid = true;

    requiredFields.forEach((field) => {
      if (field.type === 'select-one' && field.value === '') {
        if (isValid) {
          isValid = false;
          showNotification('top', 'right', 'Please select the appropriate answer before proceeding.');
        }
      } else if (field.type !== 'select-one' && field.value.trim() === '') {
        if (isValid) {
          isValid = false;
          showNotification('top', 'right', 'Please fill in the required fields before proceeding.');
        }
      }
    });

    if (isValid) {
      formStepsNum++;
      updateFormSteps();
      updateProgressbar();
    }
  });
});

prevBtns.forEach((btn) => {
  btn.addEventListener("click", () => {
    formStepsNum--;
    updateFormSteps();
    updateProgressbar();
  });
});

function updateFormSteps() {
  formSteps.forEach((formStep) => {
    formStep.classList.contains("form-step-active") &&
      formStep.classList.remove("form-step-active");
  });

  formSteps[formStepsNum].classList.add("form-step-active");
}

function updateProgressbar() {
  progressSteps.forEach((progressStep, idx) => {
    if (idx < formStepsNum + 1) {
      progressStep.classList.add("progress-step-active");
    } else {
      progressStep.classList.remove("progress-step-active");
    }
  });

  const progressActive = document.querySelectorAll(".progress-step-active");

  progress.style.width =
    ((progressActive.length - 1) / (progressSteps.length - 1)) * 100 + "%";
}




function grades() {
  let math = document.getElementById("mathgrade").value;
  let science = document.getElementById("sciencegrade").value;
  var s2 = document.getElementById('s2');
  var s3 = document.getElementById('s3');
  var s4 = document.getElementById('s4');
      if(math >= 85 && science >= 85){
          var opt1 = document.createElement('option');
          var opt2 = document.createElement('option');
          var opt3 = document.createElement('option');
          var opt4 = document.createElement('option');
          var opt5 = document.createElement('option');
          var opt6 = document.createElement('option');
          var opt7 = document.createElement('option');
          var opt8 = document.createElement('option');
          var opt11 = document.createElement('option');
          var opt12 = document.createElement('option');
          var opt13 = document.createElement('option');
          var opt14 = document.createElement('option');
          var opt15 = document.createElement('option');
          var opt16 = document.createElement('option');
          var opt17 = document.createElement('option');
          var opt18 = document.createElement('option');
          var opt21 = document.createElement('option');
          var opt22 = document.createElement('option');
          var opt23 = document.createElement('option');
          var opt24 = document.createElement('option');
          var opt25 = document.createElement('option');
          var opt26 = document.createElement('option');
          var opt27 = document.createElement('option');
          var opt28 = document.createElement('option');
          var optacad1 = document.createElement('optgroup');
          var optacad2 = document.createElement('optgroup');
          var optacad3 = document.createElement('optgroup');
          var opttvoc1 = document.createElement('optgroup');
          var opttvoc2 = document.createElement('optgroup');
          var opttvoc3 = document.createElement('optgroup');
          
          opt1.value = "Accountancy, Business and Management";
          opt2.value = "General Academic";
          opt3.value = "Humanities and Social Sciences";
          opt4.value = "Science, Technology, Engineering and Mathematics";
          opt5.value = "Caregiving (Nursing Arts)";
          opt6.value = "Electrical Installation and Maintenance";
          opt7.value = "Home Economics";
          opt8.value = "Information and Communications Technology";
          opt11.value = "Accountancy, Business and Management";
          opt12.value = "General Academic";
          opt13.value = "Humanities and Social Sciences";
          opt14.value = "Science, Technology, Engineering and Mathematics";
          opt15.value = "Caregiving (Nursing Arts)";
          opt16.value = "Electrical Installation and Maintenance";
          opt17.value = "Home Economics";
          opt18.value = "Information and Communications Technology";
          opt21.value = "Accountancy, Business and Management";
          opt22.value = "General Academic";
          opt23.value = "Humanities and Social Sciences";
          opt24.value = "Science, Technology, Engineering and Mathematics";
          opt25.value = "Caregiving (Nursing Arts)";
          opt26.value = "Electrical Installation and Maintenance";
          opt27.value = "Home Economics";
          opt28.value = "Information and Communications Technology";
          
          opt1.innerHTML = "Accountancy, Business and Management";
          opt2.innerHTML = "General Academic";
          opt3.innerHTML = "Humanities and Social Sciences";
          opt4.innerHTML = "Science, Technology, Engineering and Mathematics";
          opt5.innerHTML = "Caregiving (Nursing Arts)";
          opt6.innerHTML = "Electrical Installation and Maintenance";
          opt7.innerHTML = "Home Economics";
          opt8.innerHTML = "Information and Communications Technology";
          opt11.innerHTML = "Accountancy, Business and Management";
          opt12.innerHTML = "General Academic";
          opt13.innerHTML = "Humanities and Social Sciences";
          opt14.innerHTML = "Science, Technology, Engineering and Mathematics";
          opt15.innerHTML = "Caregiving (Nursing Arts)";
          opt16.innerHTML = "Electrical Installation and Maintenance";
          opt17.innerHTML = "Home Economics";
          opt18.innerHTML = "Information and Communications Technology";
          opt21.innerHTML = "Accountancy, Business and Management";
          opt22.innerHTML = "General Academic";
          opt23.innerHTML = "Humanities and Social Sciences";
          opt24.innerHTML = "Science, Technology, Engineering and Mathematics";
          opt25.innerHTML = "Caregiving (Nursing Arts)";
          opt26.innerHTML = "Electrical Installation and Maintenance";
          opt27.innerHTML = "Home Economics";
          opt28.innerHTML = "Information and Communications Technology";

          document.getElementById("s2").innerHTML = '';
          document.getElementById("s3").innerHTML = '';
          document.getElementById("s4").innerHTML = '';
          
          optacad1.setAttribute("label", "Academic Track");
          optacad2.setAttribute("label", "Academic Track");
          optacad3.setAttribute("label", "Academic Track");
          opttvoc1.setAttribute("label", "Technical-Vocational-Livelihood Track");
          opttvoc2.setAttribute("label", "Technical-Vocational-Livelihood Track");
          opttvoc3.setAttribute("label", "Technical-Vocational-Livelihood Track");
          
          optacad1.appendChild(opt1);
          optacad1.appendChild(opt2);
          optacad1.appendChild(opt3);
          optacad1.appendChild(opt4);
          opttvoc1.appendChild(opt5);
          opttvoc1.appendChild(opt6);
          opttvoc1.appendChild(opt7);
          opttvoc1.appendChild(opt8);
          optacad2.appendChild(opt11);
          optacad2.appendChild(opt12);
          optacad2.appendChild(opt13);
          optacad2.appendChild(opt14);
          opttvoc2.appendChild(opt15);
          opttvoc2.appendChild(opt16);
          opttvoc2.appendChild(opt17);
          opttvoc2.appendChild(opt18);
          optacad3.appendChild(opt21);
          optacad3.appendChild(opt22);
          optacad3.appendChild(opt23);
          optacad3.appendChild(opt24);
          opttvoc3.appendChild(opt25);
          opttvoc3.appendChild(opt26);
          opttvoc3.appendChild(opt27);
          opttvoc3.appendChild(opt28);
          
          s2.options.add(optacad1);
          s2.options.add(opttvoc1);
          s3.options.add(optacad2);
          s3.options.add(opttvoc2);
          s4.options.add(optacad3);
          s4.options.add(opttvoc3);
          
      }
      else{
          var opt1 = document.createElement('option');
          var opt2 = document.createElement('option');
          var opt3 = document.createElement('option');
          var opt5 = document.createElement('option');
          var opt6 = document.createElement('option');
          var opt7 = document.createElement('option');
          var opt8 = document.createElement('option');
          var opt11 = document.createElement('option');
          var opt12 = document.createElement('option');
          var opt13 = document.createElement('option');
          var opt15 = document.createElement('option');
          var opt16 = document.createElement('option');
          var opt17 = document.createElement('option');
          var opt18 = document.createElement('option');
          var opt21 = document.createElement('option');
          var opt22 = document.createElement('option');
          var opt23 = document.createElement('option');
          var opt25 = document.createElement('option');
          var opt26 = document.createElement('option');
          var opt27 = document.createElement('option');
          var opt28 = document.createElement('option');
          var optacad1 = document.createElement('optgroup');
          var optacad2 = document.createElement('optgroup');
          var optacad3 = document.createElement('optgroup');
          var opttvoc1 = document.createElement('optgroup');
          var opttvoc2 = document.createElement('optgroup');
          var opttvoc3 = document.createElement('optgroup');
          
          opt1.value = "Accountancy, Business and Management";
          opt2.value = "General Academic";
          opt3.value = "Humanities and Social Sciences";
          opt5.value = "Caregiving (Nursing Arts)";
          opt6.value = "Electrical Installation and Maintenance";
          opt7.value = "Home Economics";
          opt8.value = "Information and Communications Technology";
          opt11.value = "Accountancy, Business and Management";
          opt12.value = "General Academic";
          opt13.value = "Humanities and Social Sciences";
          opt15.value = "Caregiving (Nursing Arts)";
          opt16.value = "Electrical Installation and Maintenance";
          opt17.value = "Home Economics";
          opt18.value = "Information and Communications Technology";
          opt21.value = "Accountancy, Business and Management";
          opt22.value = "General Academic";
          opt23.value = "Humanities and Social Sciences";
          opt25.value = "Caregiving (Nursing Arts)";
          opt26.value = "Electrical Installation and Maintenance";
          opt27.value = "Home Economics";
          opt28.value = "Information and Communications Technology";
          
          opt1.innerHTML = "Accountancy, Business and Management";
          opt2.innerHTML = "General Academic";
          opt3.innerHTML = "Humanities and Social Sciences";
          opt5.innerHTML = "Caregiving (Nursing Arts)";
          opt6.innerHTML = "Electrical Installation and Maintenance";
          opt7.innerHTML = "Home Economics";
          opt8.innerHTML = "Information and Communications Technology";
          opt11.innerHTML = "Accountancy, Business and Management";
          opt12.innerHTML = "General Academic";
          opt13.innerHTML = "Humanities and Social Sciences";
          opt15.innerHTML = "Caregiving (Nursing Arts)";
          opt16.innerHTML = "Electrical Installation and Maintenance";
          opt17.innerHTML = "Home Economics";
          opt18.innerHTML = "Information and Communications Technology";
          opt21.innerHTML = "Accountancy, Business and Management";
          opt22.innerHTML = "General Academic";
          opt23.innerHTML = "Humanities and Social Sciences";
          opt25.innerHTML = "Caregiving (Nursing Arts)";
          opt26.innerHTML = "Electrical Installation and Maintenance";
          opt27.innerHTML = "Home Economics";
          opt28.innerHTML = "Information and Communications Technology";

          document.getElementById("s2").innerHTML = '';
          document.getElementById("s3").innerHTML = '';
          document.getElementById("s4").innerHTML = '';
          
          optacad1.setAttribute("label", "Academic Track");
          optacad2.setAttribute("label", "Academic Track");
          optacad3.setAttribute("label", "Academic Track");
          opttvoc1.setAttribute("label", "Technical-Vocational-Livelihood Track");
          opttvoc2.setAttribute("label", "Technical-Vocational-Livelihood Track");
          opttvoc3.setAttribute("label", "Technical-Vocational-Livelihood Track");
          
          optacad1.appendChild(opt1);
          optacad1.appendChild(opt2);
          optacad1.appendChild(opt3);
          opttvoc1.appendChild(opt5);
          opttvoc1.appendChild(opt6);
          opttvoc1.appendChild(opt7);
          opttvoc1.appendChild(opt8);
          optacad2.appendChild(opt11);
          optacad2.appendChild(opt12);
          optacad2.appendChild(opt13);
          opttvoc2.appendChild(opt15);
          opttvoc2.appendChild(opt16);
          opttvoc2.appendChild(opt17);
          opttvoc2.appendChild(opt18);
          optacad3.appendChild(opt21);
          optacad3.appendChild(opt22);
          optacad3.appendChild(opt23);
          opttvoc3.appendChild(opt25);
          opttvoc3.appendChild(opt26);
          opttvoc3.appendChild(opt27);
          opttvoc3.appendChild(opt28);
          
          s2.options.add(optacad1);
          s2.options.add(opttvoc1);
          s3.options.add(optacad2);
          s3.options.add(opttvoc2);
          s4.options.add(optacad3);
          s4.options.add(opttvoc3);
      }
  }

 
