
var beginPoint = 0;
var limit = 6;
var pageCount = 1;
var totalNotices = 0;

var preEditedData ;
var postEditedData;

(() => {
  'use strict'

  var uploadSllybusForm = document.getElementById("uploadNotesForm");

  document.getElementById("formFile").addEventListener("change", function(){
    var fileInput = document.querySelector('#formFile');
    var maxSizeInBytes = 1024 * 1024 * 200; 
    var fileSizeInBytes = fileInput.files[0].size;

    if (fileSizeInBytes > maxSizeInBytes) {
      document.querySelector(".file-size-error").style.display = "block";
    }else{
      document.querySelector(".file-size-error").style.display = "none";
    }
  });

  document.getElementById("uploadNotes").addEventListener('click', event => {


    document.querySelector(".file-size-error").style.display = "none";

    var fileInput = document.querySelector('#formFile');
    var maxSizeInBytes = 1024 * 1024 * 200; // 1 MB (adjust as needed)
    var fileSizeInBytes = fileInput.files.length > 0 ? fileInput.files[0].size : 0;

  
    if (!uploadSllybusForm.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    } 
    else if (fileSizeInBytes > maxSizeInBytes) {
      document.querySelector(".file-size-error").style.display = "block";
      event.preventDefault();
      event.stopPropagation();
      return;
    }else {
      sendSyllabusToServer();
    }



    uploadSllybusForm.classList.add('was-validated')
  }, false)


  function sendSyllabusToServer() {

    var file = _("formFile").files[0];
    var form = document.getElementById("uploadNotesForm");
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
          $("#upload-notes").modal("hide");
          showNotes();
          liveToast.style.backgroundColor = "#BBF7D0";
          liveToast.style.color = 'green';
          document.getElementById('toast-alert-message').innerHTML = "uploaded successfully";
          myToast.show();
        } else {
          $("#upload-notes").modal("hide");
          liveToast.style.backgroundColor = "#FECDD3";
          liveToast.style.color = 'red';
          document.getElementById('toast-alert-message').innerHTML = data;
          myToast.show();
        }

        var form = document.getElementById("uploadNotesForm");
        cleanForm(form);


      }
    };


    function cleanForm(form) {

      form.classList.remove('was-validated');
      form.reset();
    }


    ajax.open("POST", "../assets/uploadNotes.php");
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

document.getElementById("showUploadDialog").addEventListener("click", function () {

  var form = document.getElementById("uploadNotesForm");
  form.classList.remove('was-validated');
  form.reset();

  var _class = document.getElementById("classOptions").value;
  fetchSubjects(_class);
  $("#upload-notes").modal("show");
});

document.getElementById("classOptions").addEventListener('change', function () {
  var _class = this.value;
  fetchSubjects(_class);
});

function fetchSubjects(_class) {
  fetch("../assets/fetchSubjectOptions.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "class=" + encodeURIComponent(_class + ""),
  })
    .then(response => response.text())
    .then(data => {
      
      document.getElementById('subjectList').innerHTML = ' <option selected disabled value="">--select--</option>' + data;


    })
    .catch(error => {
      console.error("Error" + error);
    })
}

document.addEventListener('DOMContentLoaded', function(){
  showNotes();
})

function showNotes() {

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

  var _class = document.getElementById("notes-class").value;
  const dataToSend = {
    begin: beginPoint,
    _class: _class,
  };

  fetch("../assets/fetchNotes.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json',
   },
    body: JSON.stringify(dataToSend),
  })
    .then(response => response.json())
    .then(data => {

    
      document.getElementById("pageNumber").innerHTML = pageCount + "";

      if (data[0] === "No_Data") {
          
        document.getElementById("nextBtn").classList.add('disabled');
        document.getElementById("prevBtn").classList.add('disabled');
          
        document.getElementById("notes").innerHTML = '  <div id="dataNotAvailable" style="display: block;width: 100%;"><div class="_flex-container box-hide"><div class="no-data-box"> <div class="no-dataicon"> <i class="bx bx-data"></i> </div>   <p>No Data</p>     </div>  </div>   </div>';

    
      } else {
          
        document.getElementById("nextBtn").classList.remove('disabled');
        document.getElementById("prevBtn").classList.remove('disabled');

          
          
        totalNotices = data[0];

        let notices = "";
        for (let i = 1; i < data.length; i++) {
          notices += data[i];
        }

        document.getElementById("notes").innerHTML = notices;
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
    showNotes();
  }
});

document.getElementById("nextBtn").addEventListener('click', function () {
  if ((beginPoint + limit) < totalNotices) {
    beginPoint += limit;
    pageCount += 1;
    showNotes();
  }
});

// start find by class
document.getElementById("find-notes-btn").addEventListener("click", function(){
  beginPoint = 0;
  pageCount = 1;    
    
  showNotes();
});
// end find by class

// show full notes 
function showNotesInfo(noteId){
  fetch("../assets/showNotesInfo.php", {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "noteId=" + encodeURIComponent(noteId),
})
    .then(response => response.json())
    .then(data => {
      
        document.getElementById("showFullTitle").innerHTML =data['title'];
        document.getElementById("showFullComment").innerHTML =data['comment'];
        document.getElementById("view_file_btn").href = data['file'];
       $("#showNotesInformation").modal("show");
    })
    .catch(error => {
        console.error("Error" + error);
    })
}

// end of show full notes

// start delete note

var deleteNoteId = 0;
function deleteConfirmDialog(noteId){
  deleteNoteId = noteId;
  $("#delete-confirmation-modal").modal("show");
}

function deleteNote(){

  noteId = deleteNoteId;
  $("#delete-confirmation-modal").modal("hide");
  
  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");
  fetch("../assets/deleteNote.php", {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "noteId=" + encodeURIComponent(noteId),
})
    .then(response => response.text())
    .then(data => {
       
      
      
      if(data == "success"){
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = "deleted successfully";
        myToast.show();

        showNotes();
       }else{
        liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = data;
        myToast.show();
       }
    })
    .catch(error => {
        console.error("Error" + error);
    })
}

// end delete note

// start edit notes 
function showEditDialog(editMsgId){

  document.getElementById("editNotesForm").reset();
  document.getElementById("editNotesForm").classList.remove('was-validated');
  
 
  document.getElementById("edit_upload_btn").style.backgroundColor = "#1976D2";
  document.getElementById("edit_upload_btn").style.borderColor = "#1976D2";
  document.getElementById("edit-invalid-file").style.display = "none";

  fetch("../assets/showNotesInfo.php", {
    method: 'POST',
    headers: {
        'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "noteId=" + encodeURIComponent(editMsgId),
})
    .then(response => response.json())
    .then(data => {
      
      preEditedData = new FormData();


      for (var key in data) {
        if (data.hasOwnProperty(key)) {
          preEditedData.append(key, data[key]);
        }
      }


      document.querySelector(".editTitle").value = data['title'];
      document.querySelector(".edited-comment").value = data['comment'];
      document.getElementById("editClassOption").value = data['class'];

      // fetching subjects realted to class
      fetch("../assets/fetchSubjectOptions.php", {
        method: 'POST',
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "class=" + encodeURIComponent(data['class'] + ""),
      })
        .then(response => response.text())
        .then(data1 => {
          
          document.getElementById('editSubjectList').innerHTML = ' <option selected disabled value="">--select--</option>' + data1;

          document.getElementById("editSubjectList").value = data['subject'];
    
    
        })
        .catch(error => {
          console.error("Error" + error);
        })

        document.getElementById("view-current-file").href = data['file'];
        document.querySelector(".last-editor").innerHTML = "Last Edited By " + data['editor'];


      

      $("#edit-uploaded-notes").modal("show");
    })
    .catch(error => {
        console.error("Error" + error);
    })

}


// end of edit notes

(() => {
  'use strict'

  var uploadSllybusForm = document.getElementById("editNotesForm");

  document.getElementById("upload-file").addEventListener("change", function(){
    var fileInput = document.querySelector('#upload-file');
    var maxSizeInBytes = 1024 * 1024 * 200; 
   

    if(fileInput.files.length > 0 && fileInput.files[0]!=undefined){
      document.getElementById("edit_upload_btn").style.backgroundColor = "green";
      document.getElementById("edit_upload_btn").style.borderColor = "green";
      var fileSizeInBytes = fileInput.files[0].size;
      if (fileSizeInBytes > maxSizeInBytes) {
        document.querySelector("#edit-invalid-file").style.display = "block";
      }else{
        document.querySelector("#edit-invalid-file").style.display = "none";
      }
    }else{
      document.querySelector("#edit-invalid-file").style.display = "none";
      document.getElementById("edit_upload_btn").style.backgroundColor = "#1976D2";
      document.getElementById("edit_upload_btn").style.borderColor = "#1976D2";
    }
    
  });

  document.getElementById("editNote").addEventListener('click', event => {
    if (!uploadSllybusForm.checkValidity()) {
      event.preventDefault()
      event.stopPropagation()
    } else {

      document.getElementById("edit-invalid-file").style.display = "none";
      var form = document.getElementById("editNotesForm");
      postEditedData = new FormData(form);

      preEditedData.delete('file');
      preEditedData.delete('editor');
      postEditedData.delete('file');

      postEditedData.append('noteId',preEditedData.get('noteId') + "");

        var fileInput = document.querySelector('.new-upload-file');

      if(isFormDataContained(postEditedData, preEditedData) && fileInput.files.length <= 0){
        let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
        let liveToast = document.getElementById("liveToast");

        $("#edit-uploaded-notes").modal("hide");

        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = "Nothing Edited...";
        myToast.show();

        
      }else{

        var maxSizeInBytes = 1024 * 1024 * 200; // 1 MB (adjust as needed)
        var fileSizeInBytes = fileInput.files[0].size;

      if (fileSizeInBytes > maxSizeInBytes) {
        document.getElementById("edit-invalid-file").style.display = "block";
        event.preventDefault();
        event.stopPropagation();
        return;
      }

        postEditedData.append('file', fileInput.files[0]);
        $("#edit-uploaded-notes").modal("hide");
        $("#edit-confirmation-modal").modal("show");
    
      }
      
    
    }


    uploadSllybusForm.classList.add('was-validated')
  }, false)

 

  document.getElementById("confirm-edit-btn").addEventListener("click", function(){
    sendEditedDataToServer();
  });

  function sendEditedDataToServer() {


    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    var ajax = new XMLHttpRequest();
    ajax.upload.addEventListener("progress", progressHandler1, false);
    ajax.addEventListener("load", completeHandler1, false);
    ajax.addEventListener("error", errorHandler1, false);
    ajax.addEventListener("abort", abortHandler1, false);
    ajax.onreadystatechange = function () {
      if (this.readyState == 4 && this.status == 200) {

        var data = this.responseText;
        if (data === "success") {
          showNotes();
          $("#edit-confirmation-modal").modal("hide");

          liveToast.style.backgroundColor = "#BBF7D0";
          liveToast.style.color = 'green';
          document.getElementById('toast-alert-message').innerHTML = "Successfully Edited";
          myToast.show();

        } else {
          $("#edit-confirmation-modal").modal("hide");
         
          $("#edit-uploaded-notes").modal("show");

          liveToast.style.backgroundColor = "#FECDD3";
          liveToast.style.color = 'red';
          document.getElementById('toast-alert-message').innerHTML = data;
          myToast.show();
        }

      
      
        var form = document.getElementById("uploadNotesForm");
        cleanForm(form);
      }
    };

    function cleanForm(form) {

      form.classList.remove('was-validated');
      form.reset();
    }
    ajax.open("POST", "../assets/editNotes.php");
    ajax.send(postEditedData);

 
  }

  function isFormDataContained(formDataToCheck, referenceFormData) {
    for (var pair of formDataToCheck.entries()) {
      var [key, value] = pair;
  
      // Check if the key-value pair exists in referenceFormData
      if (!referenceFormData.has(key) || referenceFormData.get(key) !== value) {
        return false;
      }
    }
  
    return true;
  }
})()



function progressHandler1(event) {
  document.querySelector(".progress-bar-hider1").style.display = "block";
  var percent = (event.loaded / event.total) * 100;
  document.querySelector(".progress-pointer").style.width = Math.round(percent) + "%";
}

function completeHandler1(event) {
  document.querySelector(".progress-bar-hider1").style.display = "none";
  document.querySelector(".progress-pointer").style.width = "0%";
}

function errorHandler1(event) {
  // _("status").innerHTML = "Upload Failed";
  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  $("#edit-confirmation-modal").modal("hide");
  liveToast.style.backgroundColor = "#FECDD3";
  liveToast.style.color = 'red';
  document.getElementById('toast-alert-message').innerHTML = "Something went wrong while uploading file!";
  myToast.show();
}

function abortHandler1(event) {
  let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  $("#edit-confirmation-modal").modal("hide");
  liveToast.style.backgroundColor = "#FECDD3";
  liveToast.style.color = 'red';
  document.getElementById('toast-alert-message').innerHTML = "File not uploaded successfully!";
  myToast.show();
}