
document.addEventListener("DOMContentLoaded", onloadFunction);
function onloadFunction() {
    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");


    fetch("../assets/getDashboardCardNums.php", {
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {


            if (data['status'] === "success") {

                document.getElementById("studentCount").innerHTML = parseInt(data['studentCount']).toLocaleString();
                document.getElementById("teacherCount").innerHTML = parseInt(data['teacherCount']).toLocaleString();
                document.getElementById("noticeCount").innerHTML = parseInt(data['noticeCount']).toLocaleString();
                document.getElementById("classCount").innerHTML = parseInt(data['classCount']).toLocaleString();

            } else {

                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });


    fetch("../assets/getNoticeForDashboard.php", {
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {

            var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
            var liveToast = document.getElementById("liveToast");

            if (data['status'] === "success") {
                document.getElementById("noticeTableBody").innerHTML = data['message'] + "";

            } else {

                document.getElementById("noticeTableBody").innerHTML = "";

                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}


function showTeacherList(){
    window.location.href = 'teacher.php#showTeacherTab';
}

function showStudentList(){
    window.location.href = 'student.php#view-students-tab';
}
function showNotesList(){
    window.location.href = 'notes.php';
}
function showNoticeList(){
    window.location.href = 'noticeboard.php#show-notice-tab';
}







var textarea = document.getElementById("reminder-msg");
if (textarea != null) {
    textarea.addEventListener("keydown", function (event) {
        if (event.key === 'Enter') {
            addReminder();
            document.getElementById("reminder-msg").value = "";
        }
    });
}

function addReminder() {
    var msg = document.getElementById("reminder-msg").value + "";


    if (msg.trim() != "") {
        //(msg);
        fetch('../assets/addReminder.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
            },
            body: 'msg=' + encodeURIComponent(msg),
        })
            .then(response => response.text())
            .then(data => {
            })
            .catch(error => {
                console.error('Error:', error);
            });




        document.querySelector(".reminder-error").style.display = "none";
        document.getElementById("reminder-msg").value = "";
        $("#reminder-modal").modal("hide");
    } else {

        document.querySelector(".reminder-error").style.display = "block";
    }
}

function showReminders() {

    var reminderList = document.getElementById("all-reminders");
    var reminderString = "";
    if (reminderList != null) {

        fetch('../assets/fetchReminders.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            //   body: JSON.stringify(postData),
        })
            .then(response => response.json())
            .then(data => {

                for (var i = 0; i < data.length; i++) {
                    reminderString = reminderString + data[i];
                }

                reminderList.innerHTML = reminderString;

            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

}

setInterval(showReminders, 1000);

function deleteReminder(lineNumber, itemNumber) {

    var list = document.getElementById('all-reminders');
    var items = list.getElementsByTagName('li');

    fetch('../assets/deleteReminder.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'dbLine=' + encodeURIComponent(lineNumber + ""),
    })
        .then(response => response.text())
        .then(data => {
            if (data === "deleted") {

                for (var i = 0; i < items.length; i++) {
                    var currentItem = items[i];
                    if (i == (itemNumber)) {
                        currentItem.remove();
                    }
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

}


function changeReminderStatus(lineNumber) {
    //("line number : " + lineNumber);

    fetch('../assets/changeReminderStatus.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'dbLine=' + encodeURIComponent(lineNumber + ""),
    })
        .then(response => response.text())
        .then(data => {
            //('php data is : ' + data);

        })
        .catch(error => {
            console.error('Error:', error);
        });

}
