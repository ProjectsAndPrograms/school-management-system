

let newExamResultHeaderData;
var totalMarks;

let sessionStartingYear = 2023;
document.addEventListener("DOMContentLoaded", function () {

  let dateObj = new Date();
  let currentYear = dateObj.getFullYear();
  let currentMonth = dateObj.getMonth();
  let sessionStartingYear = 2023;


  let sessions = "";
  let firstSelected = true;

  if (currentMonth >= 4) {
    while (currentYear >= sessionStartingYear) {
      let session = currentYear + "-" + ((currentYear + 1) + "").substring(2, 4);
      if (firstSelected) {
        sessions += ' <option value="' + currentYear + '" selected>' + session + '</option>';
        firstSelected = false;
      } else {
        sessions += '<option value="' + currentYear + '">' + session + '</option>'
      }
      currentYear -= 1;
    }
  } else {
    while (currentYear > sessionStartingYear) {
      let session = (currentYear - 1) + "-" + (currentYear + "").substring(2, 4);

      if (firstSelected) {
        sessions += ' <option value="' + (currentYear - 1) + '" selected>' + session + '</option>';
        firstSelected = false;
      } else {
        sessions += '<option value="' + (currentYear - 1) + '">' + session + '</option>'
      }
      currentYear -= 1;

    }
  }


  firstSelected = true;
  document.querySelector('#select-session').innerHTML = sessions;
});

(() => {
  'use strict'


  const form = document.getElementById('create-exam-form');

  document.getElementById("continue-btn").addEventListener('click', event => {

    document.querySelector(".invalid-exam-title").style.display = "none";
    document.querySelector(".passingGreaterTotalError").style.display = "none";
    document.querySelector(".invalid-total-marks").style.display = "none";
    document.querySelector(".invalid-passing-marks").style.display = "none";
    document.querySelector(".invalid-exam-subject-list").style.display = "none";

    if (validateUploadDialogForm()) {

      var _form = document.getElementById("create-exam-form");
      let formData = new FormData(_form);
      newExamResultHeaderData = formData;


      var _class = document.getElementById("exam-class").value;
      var section = document.getElementById("exam-section").value;
      var total_marks = document.getElementById("total-marks").value;
      var subject = document.getElementById("exam-subject-list").value;

      totalMarks = parseInt(total_marks);
      var myObject = {
        class: _class,
        section: section,
        totalMarks: total_marks,
        subject: subject
      };
      fetch("../assets/getStudentsForResult.php", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(myObject),
      })
        .then(response => response.json())
        .then(data => {

          if (data["status"] === "DATA") {
            document.getElementById("save-marks-btn").disabled = false;
            document.getElementById("dataNotAvailable").style.display = "none";
            document.getElementById("UploadTable").innerHTML = data["body"] + "";
            document.getElementById("UploadTableHead").innerHTML = data["head"] + "";

            document.getElementById("class-section").innerHTML = 'Class ' + data["class"] + ' ' + data["section"];


            const dataRows = document.querySelectorAll("#UploadTable tr");

            for (let currentRow = 0; currentRow < dataRows.length; currentRow++) {
              // const invalidMsg = dataRows[currentRow].querySelector("td .invalidMarks");
              const marksInputs = dataRows[currentRow].querySelectorAll("input.marks-input");

              marksInputs.forEach(marksInput => {

                marksInput.addEventListener("change", function () {
                  if (parseInt(this.value) > totalMarks) {
                    this.style.color = "red";
                    this.parentElement.querySelector(".invalidMarks").style.display = "block";
                  } else {
                    this.style.color = "green";
                    this.parentElement.querySelector(".invalidMarks").style.display = "none";
                  }
                });
                marksInput.addEventListener("keyup", function () {
                  if (parseInt(this.value) > totalMarks) {
                    this.style.color = "red";
                    this.parentElement.querySelector(".invalidMarks").style.display = "block";
                  } else {
                    this.style.color = "green";
                    this.parentElement.querySelector(".invalidMarks").style.display = "none";
                  }
                });


              });

            }



          } else {
            document.getElementById("UploadTable").innerHTML = "";
            document.getElementById("dataNotAvailable").style.display = "block";
            document.getElementById("save-marks-btn").disabled = true;


          }

        })
        .catch(error => {
          console.error("Error:", error);
        });


      document.getElementById("uploadMarksJumboBtn").style.display = "none";
      $("#addStudentModel").modal("hide");
      document.querySelector(".upload-marks-hider").style.display = "block";
    }

    event.preventDefault();
    event.stopPropagation();
  }, false);

  function validateUploadDialogForm() {
    var title = document.getElementById("exam-title").value;
    var total = document.getElementById("total-marks").value;
    var passing = document.getElementById("passing-marks").value;
    var subject = document.getElementById("exam-subject-list").value;

    if (title === '' || total === '' || passing === '' || parseInt(passing) > parseInt(total) || subject === '') {


      if (title === '') {
        document.querySelector(".invalid-exam-title").style.display = "block";
      }
      if (total === '') {
        document.querySelector(".passingGreaterTotalError").style.display = "none";
        document.querySelector(".invalid-total-marks").style.display = "block";

      }

      if (passing === '') {

        document.querySelector(".passingGreaterTotalError").style.display = "none";
        document.querySelector(".invalid-passing-marks").style.display = "block";
      }
      if (parseInt(passing) > parseInt(total)) {
        document.querySelector(".invalid-passing-marks").style.display = "none";
        document.querySelector(".invalid-total-marks").style.display = "none";
        document.querySelector(".passingGreaterTotalError").style.display = "block";
      }
      if (subject === '') {
        document.querySelector(".invalid-exam-subject-list").style.display = "block";

      }

      return false;
    }
    else {
      return form.checkValidity();
    }
  }
})();

document.getElementById("exam-title").addEventListener("keyup", function () {
  if (this.value === "") {
    document.querySelector(".invalid-exam-title").style.display = "block";
  } else {
    document.querySelector(".invalid-exam-title").style.display = "none";
  }
});


document.getElementById("total-marks").addEventListener("keyup", function () {
  if (this.value === "") {
    document.querySelector(".invalid-total-marks").style.display = "block";
  } else {
    document.querySelector(".invalid-total-marks").style.display = "none";
  }

  if (!(this.value === "") && parseInt(document.getElementById("passing-marks").value) > parseInt(this.value) && !(document.getElementById("passing-marks").value === "")) {
    document.querySelector(".invalid-passing-marks").style.display = "none";
    document.querySelector(".invalid-total-marks").style.display = "none";
    document.querySelector(".passingGreaterTotalError").style.display = "block";
  } else {
    document.querySelector(".passingGreaterTotalError").style.display = "none";
  }
});

document.getElementById("passing-marks").addEventListener("keyup", function () {
  if (this.value === "") {
    document.querySelector(".invalid-passing-marks").style.display = "block";
  } else {
    document.querySelector(".invalid-passing-marks").style.display = "none";
  }

  if (!(this.value === "") && parseInt(this.value) > parseInt(document.getElementById("total-marks").value) && !(document.getElementById("total-marks").value === "")) {
    document.querySelector(".invalid-passing-marks").style.display = "none";
    document.querySelector(".invalid-total-marks").style.display = "none";
    document.querySelector(".passingGreaterTotalError").style.display = "block";
  } else {
    document.querySelector(".passingGreaterTotalError").style.display = "none";
  }
});


document.getElementById("exam-subject-list").addEventListener("change", function () {
  if (this.value === "") {
    document.querySelector(".invalid-exam-subject-list").style.display = "block";
  } else {
    document.querySelector(".invalid-exam-subject-list").style.display = "none";
  }
});


document.getElementById("exam-class").addEventListener("change", getSubjectsFromDB);

function getSubjectsFromDB() {
  var _class = document.getElementById("exam-class").value;

  fetch("../assets/fetchSubjectOptions.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "class=" + encodeURIComponent(_class + ""),
  })
    .then(response => response.text())
    .then(data => {

      document.getElementById('exam-subject-list').innerHTML = ' <option selected disabled value="">--select--</option> <option value="ALL"> All Subjects </option>' + data;


    })
    .catch(error => {
      console.error("Error" + error);
    })
}

document.getElementById("showUploadResultDialog").addEventListener("click", function () {
  getSubjectsFromDB();
  var form = document.getElementById('create-exam-form');
  form.classList.remove('was-validated');
  form.reset();
});

document.getElementById("backToDialogBtn").addEventListener("click", function () {
  document.querySelector(".upload-marks-hider").style.display = "none";
  $("#addStudentModel").modal("show");
  document.getElementById("uploadMarksJumboBtn").style.display = "block";
});



(() => {
  'use strict';

  const form = document.getElementById('upload-marks-form');

  document.getElementById("save-marks-btn").addEventListener('click', event => {

    if (validateUploadDialogForm()) {

      disableHeaderForm(true);

      var HeaderObject = {}
      for (var pair of newExamResultHeaderData.entries()) {
        HeaderObject[pair[0]] = pair[1];
      }

      let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
      let liveToast = document.getElementById("liveToast");

      fetch("../assets/uploadExamTitle.php", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(HeaderObject),
      })
        .then(response => response.json())
        .then(data => {

          if (data["status"] === "success") {

            let examId = data["examId"];

            var uploadRows = document.querySelectorAll("#UploadTable tr");
            var currentRow = 0;
            var marksObject = {};

            while (currentRow < uploadRows.length) {
              var studentId = uploadRows[currentRow].querySelector("td.student_id").innerHTML;
              var marksInputs = uploadRows[currentRow].querySelectorAll("input.marks-input");

              let marks = {};

              marksInputs.forEach(markInput => {
                let subject = markInput.parentElement.querySelector(".subject-name").value;
                let mark = markInput.value;

                marks[subject] = mark;
              });

              var object = {
                examId: examId,
                marks: marks
              }

              marksObject[studentId] = object;
              currentRow += 1;
            }
            // start send marks to server 

            fetch("../assets/uploadMarks.php", {
              method: 'POST',
              headers: {
                'Content-Type': 'application/json',
              },
              body: JSON.stringify(marksObject),
            })
              .then(response => response.text())
              .then(data => {

                if (data === "success") {
                  liveToast.style.backgroundColor = "#BBF7D0";
                  liveToast.style.color = 'green';
                  document.getElementById('toast-alert-message').innerHTML = "Marks Uploaded successfully";
                  myToast.show();

                } else {
                  liveToast.style.backgroundColor = "#FECDD3";
                  liveToast.style.color = 'red';
                  document.getElementById('toast-alert-message').innerHTML = data;
                  myToast.show();
                }

              })
              .catch(error => {
                console.error('Error:', error);
              });

            // end send marks to server



          } else {
            liveToast.style.backgroundColor = "#FECDD3";
            liveToast.style.color = 'red';
            document.getElementById('toast-alert-message').innerHTML = data['message'];
            myToast.show();
          }

          disableHeaderForm(false);
          resetMarks();
          var form = document.getElementById('create-exam-form');
          form.classList.remove('was-validated');
          form.reset();

          document.querySelector(".upload-marks-hider").style.display = "none";
          document.getElementById("uploadMarksJumboBtn").style.display = "block";
        })
        .catch(error => {
          console.error("Error:", error);
        });
    }
    event.preventDefault();
    event.stopPropagation();


  }, false);

 
  function validateUploadDialogForm() {
    const dataRows = document.querySelectorAll("#UploadTable tr");

    let isValid = true;

    for (let currentRow = 0; currentRow < dataRows.length; currentRow++) {
        const marksInputs = dataRows[currentRow].querySelectorAll("input.marks-input");

        marksInputs.forEach(marksInput => {
            var marksInputValue = marksInput.value.replace(/^\s+|\s+$/g, '');

            if (marksInputValue === "" || parseInt(marksInputValue) > totalMarks || parseInt(marksInputValue) < 0) {
                marksInput.parentElement.querySelector(".invalidMarks").style.display = "block";
                isValid = false;
            } else {
                marksInput.parentElement.querySelector(".invalidMarks").style.display = "none";
            }
        });
    }

    if (!isValid) {
        return false;
    } else {
        return form.checkValidity(); // Adjust according to your form's ID
    }
}







  function disableHeaderForm(bool) {
    const dataRows = document.querySelectorAll("#UploadTable tr");
    for (let currentRow = 0; currentRow < dataRows.length; currentRow++) {
      let inputsContainer = dataRows[currentRow].querySelectorAll("input.marks-input");

      inputsContainer.forEach(inputElement => {
        inputElement.disabled = bool;
      });
    }
    document.getElementById("save-marks-btn").disabled = bool;
    document.getElementById('backToDialogBtn').disabled = bool;
  }
  function resetMarks() {
    const dataRows = document.querySelectorAll("#UploadTable tr");
    for (let currentRow = 0; currentRow < dataRows.length; currentRow++) {
      dataRows[currentRow].querySelector("td .invalidMarks").style.display = "none";
      dataRows[currentRow].querySelector("input.marks-input").value = "";
    }
  }


})();

document.getElementById("closeExamMarkTable").addEventListener("click", function () {
  document.getElementById("markSheerOffcanvas").style.display = "none";
  $('#markSheerOffcanvas').offcanvas('hide');
  document.getElementById("markSheerOffcanvas").style.display = "block";
});

document.querySelector(".view-marks-tab").addEventListener('click', getExamTitle);
document.getElementById("exam_findBtn").addEventListener("click", getExamTitle);

function getExamTitle() {

  var _class = document.getElementById("examClass_find").value;
  var _section = document.getElementById("examSection_find").value;
  var _session = document.getElementById("select-session").value;

  let myObjet = {
    class: _class,
    section: _section,
    session: _session
  }

  fetch("../assets/fetchExamsHeaders.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(myObjet),
  })
    .then(response => response.json())
    .then(data => {

      if (data['status'] === "success") {

        document.getElementById("noRecordAvailable").style.display = "none";
        document.getElementById("Exam-Titles").innerHTML = data['data'] + "";

      } else {
        document.getElementById("Exam-Titles").innerHTML = "";
        document.getElementById("noRecordAvailable").style.display = "block";
      }


    })
    .catch(error => {
      console.error("Error" + error);
    })

}

function showResultDialog(examId, subject) {
  document.getElementById("resultTable").innerHTML = "";
  $('#markSheerOffcanvas').offcanvas('show');

  fetch("../assets/fetchResultList.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "examId=" + encodeURIComponent(examId + "") + "&subject=" + encodeURIComponent(subject + ""),
  })
    .then(response => response.json())
    .then(data => {

      if (data['status'] === "success") {
        document.getElementById("noMarksAvailable").style.display = "none";
        document.getElementById("resultTable").innerHTML = data['data'];
      } else {
        document.getElementById("noMarksAvailable").style.display = "block";
        document.getElementById("resultTable").innerHTML = "";
      }


    })
    .catch(error => {
      console.error("Error" + error);
    })

}
