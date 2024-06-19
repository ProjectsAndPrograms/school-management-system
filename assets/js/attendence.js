var beginPoint = 0;
var limit = 15;
var pageCount = 1;
var totalNotices = 0;


document.addEventListener("DOMContentLoaded", showStudentsForAttendence);
document.getElementById("findForAttendence").addEventListener("click", showStudentsForAttendence);

function showStudentsForAttendence() {

  var div = document.getElementById("bottom-btns");
  var buttons = div.getElementsByTagName('button');
  for (var i = 0; i < buttons.length; i++) {
    buttons[i].disabled = true;
  }

  var _class = document.getElementById("classTakeAttendence").value;
  var _section = document.getElementById("sectionTakeAttendence").value;

  var _object_ = {
    class: _class + "",
    section: _section + ""
  };

  fetch("../assets/fetchStudentsForAttendence.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(_object_),
  })
    .then(response => response.json())
    .then(data => {
      if(data[2]==="SWITCH"){
         document.getElementById("buttons").style.display="block";
      }
      else if(data[2]==="PERCENTAGE"){
          document.getElementById("buttons").style.display="none";
  
      }
      else{

      }
     
      if (data[0] === "READY_TO_TAKE") {
        if (data[1] === "No Data") {
          document.querySelector("#dropDownListForSubmit").disabled = true;

          document.getElementById("takeAttendenceTable").innerHTML = "";
          document.getElementById("no-data-icon").innerHTML = " <i class='bx bx-data'></i>";
          document.getElementById("no-data-msg").innerHTML = data[1];
          document.getElementById("dataNotAvailable").style.display = 'block';
        } else {
          document.querySelector("#dropDownListForSubmit").disabled = false;

          document.getElementById("dataNotAvailable").style.display = 'none';
          document.getElementById("takeAttendenceTable").innerHTML = data[1] + "";

          var div = document.getElementById("bottom-btns");
          var buttons = div.getElementsByTagName('button');
          for (var i = 0; i < buttons.length; i++) {
            buttons[i].disabled = false;
          }
        }
      } else {
        
        document.querySelector("#dropDownListForSubmit").disabled = true;
        document.getElementById("takeAttendenceTable").innerHTML = "";
        document.getElementById("no-data-icon").innerHTML = "<i class='bx bxs-error-alt' ></i>";
        document.getElementById("no-data-msg").innerHTML = data[1] + "";
        document.getElementById("dataNotAvailable").style.display = 'block';

      }


    })
    .catch(error => {
      console.error('Error:', error);
    });
}

document.querySelector(".submit-attendence").addEventListener("click", submitAttendence);
document.getElementById('submit-attendence-btn').addEventListener("click", submitAttendence);

function submitAttendence() {


  var div = document.querySelector(".attendenceTableContainer");
  disbableButtons(div, true);


  var dataRows = document.querySelectorAll("#takeAttendenceTable tr");
 
  var currentRow = 0;

  var attendenceObject = {};

  while (currentRow < dataRows.length) {
    var studentId = dataRows[currentRow].querySelector("td.student_id").innerHTML;
    var attendence = dataRows[currentRow].querySelector("input.attendenceCheckbox").checked ? 1 : 0;
    var _class = document.getElementById("classTakeAttendence").value;
    var _section = document.getElementById("sectionTakeAttendence").value;

    var object = {
      attendence: attendence,
      class: _class,
      section: _section
    }

    attendenceObject[studentId] = object;
    currentRow += 1;
  }


  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  fetch("../assets/submitAttendence.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
    },
    body: JSON.stringify(attendenceObject),
  })
    .then(response => response.text())
    .then(data => {

      if (data === "success") {
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = "Attendence Uploaded Successfully...";
        myToast.show();


      } else {
        liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = "Error - " + data;
        myToast.show();
      }
      showStudentsForAttendence();

      var div1 = document.querySelector(".attendenceTableContainer");
      disbableButtons(div1, false);

      var div = document.getElementById("bottom-btns");
      var buttons = div.getElementsByTagName('button');
      for (var i = 0; i < buttons.length; i++) {
        buttons[i].disabled = true;
      }

    })
    .catch(error => {
      console.error('Error:', error);
    });




}


function disbableButtons(div, bool) {

  if (bool) {
    // disable links 
    var links = div.getElementsByTagName('a');
    for (var i = 0; i < links.length; i++) {
      links[i].disabled = true;
    }
    // disable buttons
    var buttons = div.getElementsByTagName('button');
    for (var i = 0; i < buttons.length; i++) {
      buttons[i].disabled = true;
    }
    // disable select
    var select = div.getElementsByTagName('select');
    for (var i = 0; i < select.length; i++) {
      select[i].disabled = true;
    }
  } else {
    // disable links 
    var links = div.getElementsByTagName('a');
    for (var i = 0; i < links.length; i++) {
      links[i].disabled = false;
    }
    // disable buttons
    var buttons = div.getElementsByTagName('button');
    for (var i = 0; i < buttons.length; i++) {
      buttons[i].disabled = false;
    }
    // disable select
    var select = div.getElementsByTagName('select');
    for (var i = 0; i < select.length; i++) {
      select[i].disabled = false;
    }
  }


}

document.querySelector(".reset-attendence").addEventListener("click", resetAttendence);
document.getElementById("reset-attendence-btn").addEventListener("click", resetAttendence)

function resetAttendence() {
  var dataRows = document.querySelectorAll("#takeAttendenceTable tr");
  var currentRow = 0;
  while (currentRow < dataRows.length) {
    dataRows[currentRow].querySelector("input.attendenceCheckbox").checked = false;
    currentRow += 1;
  }

}


// ----------------------- start show  attendence-----------------------------


document.getElementById('find-attendence-btn').addEventListener("click", findAttendenceBtnClicked);
document.getElementById('dateInput').addEventListener("change", function(){
  var dateIsHere = document.getElementById("dateInput").value;
  if(dateIsHere === ""){
    document.querySelector("#edit-invalid-file").style.display = "block";
  }else{
    document.querySelector("#edit-invalid-file").style.display = "none";
  }
});

function findAttendenceBtnClicked(){
  var dateIsHere = document.getElementById("dateInput").value;
  if(dateIsHere === ""){
    document.querySelector("#edit-invalid-file").style.display = "block";
  }else{
    document.querySelector("#edit-invalid-file").style.display = "none";
    showAttendenceOnDate();
  }

}

function showAttendenceOnDate(){

  var _class = document.getElementById("showAttendenceClass").value; 
  var _section = document.getElementById("showAttendenceSection").value; 
  var _date = document.getElementById("dateInput").value; 
 

  var myobj = {
    limit: limit,
    begin: beginPoint,
    class: _class,
    section: _section,
    date: _date
  }

  document.getElementById("pageCount").innerHTML = pageCount;
  
  if ((beginPoint + limit) >= totalNotices) {
    // diable next btn
    document.getElementById("nextBtn").disabled = true;
    document.getElementById("prevBtn").disabled = false;
  } else {
    document.getElementById("nextBtn").disabled = false;
  }
  if ((beginPoint - limit) < 0) {
    document.getElementById("prevBtn").disabled = true;
    document.getElementById("nextBtn").disabled = false;
  } else {
    document.getElementById("prevBtn").disabled = false;
  }

  fetch("../assets/fetchAttendenceOnDate.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
   },
    body: JSON.stringify(myobj),
  })
    .then(response => response.json())
    .then(data => {



      if (data[0] === "No_Data") {
        document.getElementById("boxForNoData").innerHTML = '  <div id="dataNotAvailable" style="display: block;width: 100%;"><div class="_flex-container box-hide"><div class="no-data-box"> <div class="no-dataicon"> <i class="bx bx-data"></i> </div>   <p>No Data</p>     </div>  </div>   </div>';
        document.getElementById("showAttendenceTableBody").innerHTML = "";

        document.getElementById("prevBtn").disabled = true;
        document.getElementById("nextBtn").disabled = true;
      } else {
        document.getElementById("boxForNoData").innerHTML = "";
        totalNotices = data[0];

        let attendenceRows = "";
        for (let i = 1; i < data.length; i++) {
          attendenceRows += data[i];
        }
        document.getElementById("showAttendenceTableBody").innerHTML = attendenceRows;
      }


      if (totalNotices <= limit && beginPoint == 0) {
        document.getElementById("prevBtn").disabled = true;
        document.getElementById("nextBtn").disabled = true;
      }

    })
    .catch(error => {
      console.error('Error:', error);
    });


}

document.getElementById("prevBtn").addEventListener('click', function () {
  if (beginPoint >= limit) {
    beginPoint -= limit;
    pageCount -= 1;
    showAttendenceOnDate();
  }
});

document.getElementById("nextBtn").addEventListener('click', function () {
  if ((beginPoint + limit) < totalNotices) {
    beginPoint += limit;
    pageCount += 1;
    showAttendenceOnDate();
  }
});

document.querySelector(".showAttendenceBtn").addEventListener("click", function(){


  var date = new Date();
  var dateFormated = date.toISOString().substring(0,10);

  document.getElementById("dateInput").value = dateFormated;
  showAttendenceOnDate();
});

// ----------------------- end show  attendence-----------------------------
