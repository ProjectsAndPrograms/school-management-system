var maxFileSize = 201 * 1024 * 1024;
var delNoticeId = 0;
var preEditedData;
var postEditedData;

var beginPoint = 0;
var limit = 6;
var pageCount = 1;
var totalNotices = 0;



document.addEventListener("DOMContentLoaded", function(){
    showNotices();
});


(() => {
    'use strict'

    
    const noticeForms = document.getElementById("notice-form");
    var postBtn = document.getElementById('post-notice');

    postBtn.addEventListener('click', event => {
        if (validateNoticeForm()) {
            document.getElementById("invalid-body").style.display = "none";
            document.getElementById("invalid-title").style.display = "none";
            document.getElementById("invalid-file").style.display = "none";


            var c1 = document.getElementById("check1").checked;
            var c2 = document.getElementById("check2").checked;
            var c3 = document.getElementById("check3").checked;

            var checkedBtn = 1;
            if (c1) { checkedBtn = 1; }
            else if (c2) { checkedBtn = 2; }
            else if (c3) { checkedBtn = 3; }


            var formdata = new FormData(noticeForms);

            formdata.set("disks", checkedBtn);

           

            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {

                }
            };
            ajax.open("POST", "../assets/createNotice.php");
            ajax.send(formdata);
        }

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateNoticeForm() {
        const noticeBody = document.getElementById('notice-body').value;
        const noticeFile = document.getElementById('notice-file').value;
        const noticeTitle = document.getElementById('notice-title').value;
        var fileinput = document.getElementById("notice-file");
        var selectedFile = fileinput.files[0];
        var fileSize = 0;

        if (selectedFile) {
            fileSize = selectedFile.size;
        } else {
            fileSize = 0;
        }

        if (noticeBody === '' && noticeFile === '') {
            document.getElementById("invalid-body").style.display = "block";
            return false;
        }
        else if (noticeTitle === '') {
            document.getElementById("invalid-title").style.display = "block";

        }
        else if (fileSize > maxFileSize) {
            document.getElementById("invalid-file").style.display = "block";
        }
        else {
            noticeForms.classList.add('was-validated');
            return noticeForms.checkValidity();
        }
    }
})();

document.getElementById("notice-title").addEventListener('keyup', function () {
    if ((this.value).trim() === "") {
        document.getElementById("invalid-title").style.display = "block";
    } else {
        document.getElementById("invalid-title").style.display = "none";
    }
});

function _(el) {
    return document.getElementById(el);
}
function progressHandler(event) {
    var noticeForm = document.getElementById('notice-form');
    disabledForm(true, noticeForm);
    _("uploadbox").style.display = "block";
    // _("loaded_n_total").innerHTML = "Uploaded " + event.loaded + " bytes of " + event.total;
    var percent = (event.loaded / event.total) * 100;
    _("progress-indicator").style.width = Math.round(percent) + "%";
    _("status").style.color = "blue";
    _("status").innerHTML = Math.round(percent) + "% uploaded... please wait";
}

function completeHandler(event) {

    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");
    if (this.responseText === "success") {
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = "Notice uploaded successfully!";
        myToast.show();
        cleanForm();
    } else {
        liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = "Error- " + this.responseText;
        myToast.show();
    }

    var noticeForm = document.getElementById('notice-form');
    disabledForm(false, noticeForm);
    setTimeout(() => {
        _("status").innerHTML = "";
    }, 2000);

    _("progress-indicator").style.width = "0%";
    _("uploadbox").style.display = "none";
}

function errorHandler(event) {
    _("status").style.color = "red";
    _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
    _("status").style.color = "red";
    _("status").innerHTML = "Upload Aborted";
}


function cleanForm() {

    var noticeForm = document.getElementById('notice-form');

    noticeForm.classList.remove("was-validated");
    document.getElementById("invalid-body").style.display = "none";
    document.getElementById("invalid-title").style.display = "none";
    document.getElementById("invalid-file").style.display = "none";

    Array.from(noticeForm.elements).forEach(function (element) {
        element.value = "";
    });

    document.getElementById("check2").checked = false;
    document.getElementById("check3").checked = false;
    document.getElementById("check1").checked = true;


}
function disabledForm(disable, noticeForm) {


    if (disable) {

        Array.from(noticeForm.elements).forEach(function (element) {
            element.disabled = true;
        });

        document.getElementById("check2").disabled = true;
        document.getElementById("check3").disabled = true;
        document.getElementById("check1").disabled = true;
    }
    else {
        Array.from(noticeForm.elements).forEach(function (element) {
            element.disabled = false;
        });

        document.getElementById("check2").disabled = false;
        document.getElementById("check3").disabled = false;
        document.getElementById("check1").disabled = false;

        document.getElementById("check1").checked = true;
    }

}

function disabledEditForm(disable, noticeForm) {


    if (disable) {

        Array.from(noticeForm.elements).forEach(function (element) {
            element.disabled = true;
        });

        document.getElementById("edit-check2").disabled = true;
        document.getElementById("edit-check3").disabled = true;
        document.getElementById("edit-check1").disabled = true;
    }
    else {
        Array.from(noticeForm.elements).forEach(function (element) {
            element.disabled = false;
        });

        document.getElementById("edit-check2").disabled = false;
        document.getElementById("edit-check3").disabled = false;
        document.getElementById("edit-check1").disabled = false;
    }

}

// showing notices to noticeboard
document.getElementById("show-notice-tab").addEventListener("click", function () {
    showNotices();
});
function showNotices() {

    if ((beginPoint + limit) > totalNotices) {
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



    document.getElementById("pageNumber").innerHTML = pageCount;

    fetch("../assets/fetchNotices.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "begin=" + encodeURIComponent(beginPoint),
    })
        .then(response => response.json())
        .then(data => {

            

            if (data[0] === "No_Data") {
                document.getElementById("notice-box").innerHTML = '  <div id="dataNotAvailable" style="display: block;width: 100%;"><div class="_flex-container box-hide"><div class="no-data-box"> <div class="no-dataicon"> <i class="bx bx-data"></i> </div>   <p>No Data</p>     </div>  </div>   </div>';
            } else {
                totalNotices = data[0];

                let notices = "";
                for (let i = 1; i < data.length; i++) {
                    notices += data[i];
                }

                document.getElementById("notice-box").innerHTML = notices;
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


function openDeleteConfirmationDialog(messageId) {
    delNoticeId = messageId;
    $("#delete-confirmation-modal").modal('show');
}

function deleteNotice() {


    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

  
    fetch("../assets/deleteNotice.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "noticeId=" + encodeURIComponent(delNoticeId),
    })
        .then(response => response.text())
        .then(data => {
            if (data === "success") {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Notice removed successfully";
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data;
            }

            showNotices();
            myToast.show();
            $("#delete-confirmation-modal").modal('hide');
        })
        .catch(error => {
            console.error("Error" + error);
        })

}

// editing notice 

var existingFile = "";

function openEditDialog(messageId) {
    $("#edit-notice").modal('show');


    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch("../assets/fetchNoticeInfo.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "noticeId=" + encodeURIComponent(messageId),
    })
        .then(response => response.json())
        .then(data => {

            preEditedData = new FormData();
            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    preEditedData.append(key, data[key]);
                }
            }

            if (data['status'] === "success") {

                var viewIcon = document.getElementById("view-current-file");

                document.getElementById("edit-notice-title").value = data['title'];
                document.getElementById("edit-notice-body").value = data['body'];
                viewIcon.href = data['file'] + "";
                existingFile = data['file'];

              
                if (data['file'] == "") {
                    viewIcon.style.pointerEvents = "none";
                    document.getElementById("edit-view-btn").classList.add("diabledEditBtn");

                  
                } else {
                    viewIcon.style.pointerEvents = "";
                    document.getElementById("edit-view-btn").classList.remove("diabledEditBtn");

                }

                if (data['importance'] == "1") {
                    document.getElementById("edit-check1").checked = true;
                } else if (data['importance'] == "2") {
                    document.getElementById("edit-check2").checked = true;
                } else {
                    document.getElementById("edit-check3").checked = true;
                }
         

            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = "Error: " + data['status'];
                $("#edit-notice").modal('show');
                myToast.show();
            }

        })
        .catch(error => {
            console.error("Error" + error);
        })

}



var formdata;
(() => {
    'use strict'


    const noticeForms = document.getElementById("edit-notice-form");
    var saveBtn = document.getElementById('edit-save-notice-btn');

    saveBtn.addEventListener('click', event => {
        if (validateNoticeForm()) {
            document.getElementById("edit-invalid-title").style.display = "none";
            document.getElementById("edit-invalid-body").style.display = "none";
            document.getElementById("edit-invalid-file").style.display = "none";

            let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
            let liveToast = document.getElementById("liveToast");

            postEditedData = formdata;
            postEditedData.append('noticeId', preEditedData.get('noticeId'));

           

            var ajax = new XMLHttpRequest();
            ajax.upload.addEventListener("progress", progressHandler, false);
            ajax.addEventListener("load", completeHandler, false);
            ajax.addEventListener("error", errorHandler, false);
            ajax.addEventListener("abort", abortHandler, false);
            ajax.onreadystatechange = function () {
              
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText === "success") {
                        liveToast.style.backgroundColor = "#BBF7D0";
                        liveToast.style.color = 'green';
                        document.getElementById('toast-alert-message').innerHTML = "Changes Done successfully!";
                        showNotices();
                        myToast.show();
                    } else {
                        liveToast.style.backgroundColor = "#FECDD3";
                        liveToast.style.color = 'red';
                        document.getElementById('toast-alert-message').innerHTML = "Error- " + this.responseText;
                        myToast.show();
                    }
                    $("#edit-notice").modal('hide');

                }
            };



            ajax.open("POST", "../assets/editNotice.php");
            ajax.send(postEditedData);

        }

        event.preventDefault();
        event.stopPropagation();

    }, false);

    function validateNoticeForm() {
        const noticeBody = document.getElementById('edit-notice-body').value;
        const noticeTitle = document.getElementById('edit-notice-title').value;
        formdata = new FormData(noticeForms);


        var fileSize = 0;
        var havefile = document.querySelector(".edit-upload-file");
        var selectedFile;
        if (havefile.files.length > 0) {

            selectedFile = havefile.files[0];
            if (selectedFile) {
                fileSize = selectedFile.size;
                formdata.append("files", selectedFile);
            } else {
                fileSize = 0;
            }
        }


     
        if (noticeBody === '' && existingFile == "") {
            document.getElementById("edit-invalid-body").style.display = "block";
       
            return false;
        }
        else if (noticeTitle === '') {
            document.getElementById("edit-invalid-title").style.display = "block";

        }
        else if (fileSize > maxFileSize) {
            document.getElementById("edit-invalid-file").style.display = "block";
        }
        else {
            noticeForms.classList.add('was-validated');
            return noticeForms.checkValidity();
        }
    }
})();


function showFullNotice(noticeId) {
    document.getElementById("showFullTitle").innerHTML = "";
    document.getElementById("showFullbody").innerHTML = "";

    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch("../assets/fetchNoticeText.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "noticeId=" + encodeURIComponent(noticeId),
    })
        .then(response => response.json())
        .then(data => {
            if (data['status'] === "success") {
                
                document.getElementById("showFullTitle").innerHTML = data['title'];
                document.getElementById("showFullbody").innerHTML = data['body'];

                $("#staticBackdrop").modal("show");
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = "Error " + data['status'];
                myToast.show();
            }




        })
        .catch(error => {
            console.error("Error" + error);
        })

}

// pagination start


document.getElementById("prevBtn").addEventListener('click', function () {
    if (beginPoint >= limit) {
        beginPoint -= limit;
        pageCount -= 1;
        showNotices();
    }
});

document.getElementById("nextBtn").addEventListener('click', function () {
    if ((beginPoint + limit) < totalNotices) {
        beginPoint += limit;
        pageCount += 1;
        showNotices();
    }
});



// pagination end 