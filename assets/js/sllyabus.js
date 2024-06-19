(() => {
  'use strict'

  var uploadSllybusForm = document.getElementById("uploadSyllabusForm");

  document.getElementById("uploadSllybusBtn").addEventListener('click', event => {
    if (!uploadSllybusForm.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    } else {
      sendSyllabusToServer();
    }

    uploadSllybusForm.classList.add('was-validated')
  }, false)

  function sendSyllabusToServer() {

    var file = _("formFile").files[0];
    var form = document.getElementById("uploadSyllabusForm");
    var formdata = new FormData(form);
    formdata.append("file", file);



    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler, false);
    ajax.addEventListener("load", completeHandler, false);
    ajax.addEventListener("error", errorHandler, false);
    ajax.addEventListener("abort", abortHandler, false);
    ajax.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {


        var data = this.responseText;
        if (data === "success") {
          $("#upload-syllabus").modal("hide");
          liveToast.style.backgroundColor = "#BBF7D0";
          liveToast.style.color = 'green';
          document.getElementById('toast-alert-message').innerHTML = "uploaded successfully";
        

          var text = document.getElementById("selected-class").value;
        
          loadSyllabus(text);
          myToast.show();
        } else {
          $("#upload-syllabus").modal("hide");
          liveToast.style.backgroundColor = "#FECDD3";
          liveToast.style.color = 'red';
          document.getElementById('toast-alert-message').innerHTML = data;
          myToast.show();
        }

        var form = document.getElementById("uploadSyllabusForm");
        cleanForm(form);


      }
    };


    function cleanForm(form) {

      form.classList.remove('was-validated');
      form.reset();
    }


    ajax.open("POST", "../assets/uploadSllyabus.php");
    ajax.send(formdata);
  }

})()
function _(el) {
  return document.getElementById(el);
}
// creating upload progress working here

function progressHandler(event) {
  document.querySelector(".progress-bar-hider").style.display = "block";
  var percent = (event.loaded / event.total) * 100;
  _("progress-pointer").style.width = Math.round(percent) + "%";
}

function completeHandler(event) {
  document.querySelector(".progress-bar-hider").style.display = "none";
  _("progress-pointer").style.width = "0%";
}

function errorHandler(event) {
  // _("status").innerHTML = "Upload Failed";
  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  $("#upload-syllabus").modal("hide");
  liveToast.style.backgroundColor = "#FECDD3";
  liveToast.style.color = 'red';
  document.getElementById('toast-alert-message').innerHTML = "Something went wrong while uploading file!";
  myToast.show();
}

function abortHandler(event) {
  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  $("#upload-syllabus").modal("hide");
  liveToast.style.backgroundColor = "#FECDD3";
  liveToast.style.color = 'red';
  document.getElementById('toast-alert-message').innerHTML = "File not uploaded successfully!";
  myToast.show();
}
// upload progress working finished here

function loadSubjects(_className) {
  fetch("../assets/fetchSubjectOptions.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "class=" + encodeURIComponent(_className + ""),
  })
    .then(response => response.text())
    .then(data => {
      document.getElementById('subjectList').innerHTML = ' <option selected disabled value="">--select--</option>' + data;


    })
    .catch(error => {
      console.error("Error" + error);
    })
}
document.getElementById("syllabus-class").addEventListener("change", function () {

  var _className = this.value;
  fetch("../assets/fetchSubjectOptions.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "class=" + encodeURIComponent(_className + ""),
  })
    .then(response => response.text())
    .then(data => {
      document.getElementById('subjectList').innerHTML = ' <option selected disabled value="">--select--</option>' + data;


    })
    .catch(error => {
      console.error("Error" + error);
    })

});

document.getElementById("openUploadDialog").addEventListener("click", function () {
  var className = document.getElementById("syllabus-class").value;
  loadSubjects(className);

  $("#upload-syllabus").modal("show");
});

// show syllabus subject wise
document.addEventListener("DOMContentLoaded", function () {

  var text = document.getElementById("selected-class").value;
  loadSyllabus(text);
});

document.getElementById("find-btn").addEventListener("click", function () {

  var text = document.getElementById("selected-class").value;

  loadSyllabus(text);
});

function loadSyllabus(_class) {
  fetch("../assets/fetchSyllabus.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "class=" + encodeURIComponent(_class + ""),
  })
    .then(response => response.text())
    .then(data => {
  
      if (data === "No_data") {
        document.getElementById("sllyabusTable").innerHTML = "";
        document.getElementById("dataNotAvailable").style.display = "block";
      } else {
        document.getElementById("sllyabusTable").innerHTML = data;
        document.getElementById("dataNotAvailable").style.display = "none";
      }

    })
    .catch(error => {
      console.error("Error" + error);
    })
}


var sllyabusId = 0;
function openEditSllyabusFile(sllyabusIdNumber) {
  sllyabusId = sllyabusIdNumber;
  $("#upload-syllabus-onlyFile").modal('show');
}

//start working of upload new sllyabus
(() => {
  'use strict'

  var changeSllyabusForm = document.getElementById("change-syllabus-form");

  document.getElementById("upload-new-syllabus").addEventListener('click', event => {
    if (!changeSllyabusForm.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    } else {
      sendSyllabusToServer();
    }

    changeSllyabusForm.classList.add('was-validated')
  }, false)

  function sendSyllabusToServer() {

    var file = _("changeFormFile").files[0];
    var formdata = new FormData();
    formdata.append("file", file);
    formdata.append("sllyabusId", sllyabusId);

  

    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler2, false);
    ajax.addEventListener("load", completeHandler2, false);
    ajax.addEventListener("error", errorHandler2, false);
    ajax.addEventListener("abort", abortHandler2, false);
    ajax.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {

        var data = this.responseText;
        if (data === "success") {
          $("#upload-syllabus-onlyFile").modal('hide');
          liveToast.style.backgroundColor = "#BBF7D0";
          liveToast.style.color = 'green';

          var text = document.getElementById("selected-class").value;
          loadSyllabus(text);

          document.getElementById('toast-alert-message').innerHTML = "uploaded successfully";
          myToast.show();
        } else {
          $("#upload-syllabus-onlyFile").modal('hide');
          liveToast.style.backgroundColor = "#FECDD3";
          liveToast.style.color = 'red';
          document.getElementById('toast-alert-message').innerHTML = "Error-" + data;
          myToast.show();
        }

        var form = document.getElementById("change-syllabus-form");
        cleanForm(form);


      }
    };


    function cleanForm(form) {

      form.classList.remove('was-validated');
      form.reset();
    }


    ajax.open("POST", "../assets/changeSllyabus.php");
    ajax.send(formdata);
  }

})()


function progressHandler2(event) {
  document.getElementById("change-file-progress-hider").style.display = "block";
  var percent = (event.loaded / event.total) * 100;
  _("change-file-progress-pointer").style.width = Math.round(percent) + "%";
}

function completeHandler2(event) {
  document.querySelector("#change-file-progress-hider").style.display = "none";
  _("change-file-progress-pointer").style.width = "0%";
}

function errorHandler2(event) {
  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  $("#upload-syllabus-onlyFile").modal('hide');
  liveToast.style.backgroundColor = "#FECDD3";
  liveToast.style.color = 'red';
  document.getElementById('toast-alert-message').innerHTML = "Something went wrong while uploading file!";
  myToast.show();
}

function abortHandler2(event) {
  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  $("#upload-syllabus-onlyFile").modal('hide');
  liveToast.style.backgroundColor = "#FECDD3";
  liveToast.style.color = 'red';
  document.getElementById('toast-alert-message').innerHTML = "File not uploaded successfully!";
  myToast.show();
}

// end of working of upload new sllyabus