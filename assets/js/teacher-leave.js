
let LEAVE_LIMIT = 5;

let pageNumber = 1;
let cursorPoint = 0;
let totalLeaveCount = 0;

let deleteID = 0;

(() => {
  'use strict';

  const submitLeaveBtn = document.querySelectorAll('.submit-leave-btn');
  const leaveForm = document.querySelector('#leave-form');

  submitLeaveBtn.forEach((element)=>{
    element.addEventListener('click', event => {
      document.querySelector(".start-date-invalid-feedback").innerHTML = "required";
      validateGeneralForm();
  
      event.preventDefault();
      event.stopPropagation();
    }, false);
  })
  
  
  

  function validateGeneralForm() {
    if (leaveForm.checkValidity()) {

      let startDate = document.querySelector("#start-date").value;
      let endDate = document.querySelector("#end-date").value;
      let startDateInvalid = document.querySelector(".start-date-invalid-feedback");

      if (startDate >= endDate) {
        startDateInvalid.innerHTML = "Start date must be less than end date!";
        startDateInvalid.style.display = "block";
      } else {
        submitLeaveApplicationFrom(leaveForm);
      }

    } else {
      leaveForm.classList.add('was-validated');
    }
  }
})()

document.getElementById("start-date").addEventListener("change", () => {
  let startDateInvalid = document.querySelector(".start-date-invalid-feedback");
  startDateInvalid.style.display = "none";
});
document.getElementById("end-date").addEventListener("change", () => {
  let startDateInvalid = document.querySelector(".start-date-invalid-feedback");
  startDateInvalid.style.display = "none";
});

function submitLeaveApplicationFrom(formElement) {

  let formData = new FormData(formElement);

  let toastObject = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  fetch("../assets/submitLeave.php", {
    method: 'POST',
    body: formData,
  })
    .then(response => response.json())
    .then(data => {      

      if (data['status'] === "success") {
        cleanForm(formElement);
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();
        
        getPreviousLeaves();
        
      }else if(data['status'] === "updated"){
        cleanForm(formElement);
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();
        
        window.location = "../teacher_panel/leaves.php";
      }      
      else {
        liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();
      }

    })
    .catch(error => {
      console.error("Error:", error);
    });

}

function cleanForm(form) {
  form.classList.remove("was-validated");
  Array.from(form.elements).forEach(function (element) {
    element.value = "";
  });
}

document.addEventListener("DOMContentLoaded", getPreviousLeaves);


function getPreviousLeaves() {

  let preBtn = document.getElementById("prev-page-btn");
  let nextBtn = document.getElementById("next-page-btn");

  if (pageNumber <= 1 || cursorPoint < LEAVE_LIMIT) {
    preBtn.disabled = true;
  } else {
    preBtn.disabled = false;
  }

  fetch("../assets/getPreviousLeavesForTeacher.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "cursorPoint=" + encodeURIComponent(cursorPoint),
  })
    .then(response => response.json())
    .then(data => {

      document.getElementById("page-number").innerHTML = pageNumber;

      totalLeaveCount = data['leave-count'];
      if ((cursorPoint > (totalLeaveCount - LEAVE_LIMIT)) ||
        ((totalLeaveCount / LEAVE_LIMIT) <= pageNumber)) {
        nextBtn.disabled = true;
      } else {
        nextBtn.disabled = false;
      }


      if (data['status'] === "success") {
        document.getElementById("No-leaves").style.display = "none";
        document.getElementById("available-leaves").style.display = "block";
        document.getElementById("leave-accordion").innerHTML = data['data'];
      }
      else {
        document.getElementById("available-leaves").style.display = "none";
        document.getElementById("No-leaves").style.display = "block";
      }

    })
    .catch(error => {
      console.error("Error:", error);
    });
}

document.getElementById("prev-page-btn").addEventListener("click", () => {
  if (cursorPoint >= LEAVE_LIMIT) {
    cursorPoint -= LEAVE_LIMIT;
    pageNumber -= 1;
    getPreviousLeaves();
  }

});

document.getElementById("next-page-btn").addEventListener("click", () => {
  if (cursorPoint < (totalLeaveCount - LEAVE_LIMIT)) {
    cursorPoint += LEAVE_LIMIT;
    pageNumber += 1;
    getPreviousLeaves();
  }
});

function openDeleteConfirmationDialog(s_no) {
  $("#delete-confirmation-modal").modal("show");
  deleteID = s_no;
}

function deleteLeave() {
  $("#delete-confirmation-modal").modal("hide");

  let toastObject = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  fetch("../assets/deleteLeave.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "s_no=" + encodeURIComponent(deleteID),
  })
    .then(response => response.json())
    .then(data => {

      if(data['status'] === "success"){
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();

        getPreviousLeaves();
      }else{
         liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();
      }


    })
    .catch(error => {
      console.error("Error:", error);
    });
}

function editingMode(s_no){
  window.location = "../teacher_panel/leaves.php?id="+s_no;
}
