
var generalFormData;
var personalFormData;
var guardianFormData;
var personalsNextBtnClicked = false;
var guardiansNextBtnClicked = false;
var editing = false;
var editingTeacherId = "";
var preEditedData;
var postEditedData;

// page settings
var beginIndex = 0;
var limit = 10;
var counter = 1;


document.addEventListener('DOMContentLoaded', function(){
    showStudents();
});


document.getElementById('addTeacherButton').addEventListener('click', function () {
    editing = false;
    cleanForm();
});
document.getElementById("add_student_dropdown").addEventListener("click", function(){
    editing = false;
    cleanForm();
});
document.getElementById("remove-student-jumbo-btn").addEventListener("click", function(){
    document.querySelector(".remove_student_id").value = "";
});
document.getElementById("remove_student_dropdown").addEventListener("click", function(){
    document.querySelector(".remove_student_id").value = "";
});



(() => {
    'use strict';

    let gInfoBtn = document.getElementById("general-info-btn");
    let genform = document.querySelector('#general-form');

    gInfoBtn.addEventListener('click', event => {
        validateGeneralForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateGeneralForm() {
        if (genform.checkValidity()) {

            const input = document.getElementById('uploadImage');
            const file = input.files[0];
        
            const formElement = document.querySelector('#general-form');
           
            const formData = new FormData(formElement);
            const imageInput = document.getElementById('uploadImage');
            const imageFile = imageInput.files[0];
            if (imageFile) {
                formData.append('image', imageFile);
            }
            generalFormData = formData;
        
            $("#addTeacherModal").modal("hide");
            $("#personalInformationModal").modal("show");
        } else {
            genform.classList.add('was-validated');
        }
    }

    const pInfoBtn = document.getElementById('personal-info-btn');
    const personalform = document.querySelector('#personal-form');

    pInfoBtn.addEventListener('click', event => {
        validatePhoneNumber("phone");
        validatePersonalForm();

        personalsNextBtnClicked = true;
        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validatePersonalForm() {
        if (personalform.checkValidity()) {

            const formElement1 = document.querySelector('#personal-form');
            personalFormData = Object.fromEntries(new FormData(formElement1).entries());

            const formData1 = new FormData(formElement1);
            personalFormData = formData1;
            
         
            $("#personalInformationModal").modal("hide");
            $("#guardian_information").modal("show");
        } else {
            personalform.classList.add('was-validated');
        }
    }

    const guardianBtn = document.getElementById('guardian-form-btn');
    const guardianform = document.querySelector('#guradian-form');

    guardianBtn.addEventListener('click', event => {
        validatePhoneNumber("gphone");
        validateGuradianForm();

        guardiansNextBtnClicked = true;
        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateGuradianForm() {
        if (guardianform.checkValidity()) {

            const formElement2 = document.querySelector('#guradian-form');
            // guardianFormData = Object.fromEntries(new FormData(formElement2).entries());

            const formData1 = new FormData(formElement2);
            guardianFormData = formData1;

            if(editing){
                generalFormData.delete("image");
            }

          
           let fullFormData = new FormData();


            for (const [key, value] of generalFormData.entries()) {
                fullFormData.append(key, value);
            }
            for (const [key, value] of personalFormData.entries()) {
                fullFormData.append(key, value);
            }
            for (const [key, value] of guardianFormData.entries()) {
                fullFormData.append(key, value);
            }
            

            // fullFormData = { ...generalFormData, ...personalFormData, ...guardianFormData };

            if (!editing) {
                sendDataToServer(fullFormData);

            } else {
              
                let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
                let liveToast = document.getElementById("liveToast");

                // printing form data objects
                // if (areFormDataEqual(fullFormData, preEditedData)) {

                if(areFormDataEqual(fullFormData, preEditedData)){
                    liveToast.style.backgroundColor = "#BBF7D0";
                    liveToast.style.color = 'green';
                    document.getElementById('toast-alert-message').innerHTML = "Nothing edited!";
                    
                    $('#addTeacherModal').modal('hide');
                    myToast.show(); 
                } else {
                    postEditedData = fullFormData;

                    postEditedData.append('id',preEditedData.get('id'));
                     


                    $('#guardian_information').modal("hide"); 
                    $("#edit-confirmation-modal").modal("show");

                }

                editTeacherById(editingTeacherId);
                $("#guardian_information").modal("hide");
                cleanForm();
            }
            $("#guardian_information").modal("hide");


        } else {
            guardianform.classList.add('was-validated');
        }
    }
    document.getElementById("confirm-edit-btn").addEventListener('click', event => {



        let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
        let liveToast = document.getElementById("liveToast");
        fetch("../assets/editStudent.php", {
            method: 'POST',
            // headers: {
            //     'Content-Type': 'application/json'
            // },
            body: postEditedData,
        })
            .then(response => response.text())
            .then(data => {
                // Handle the response from the PHP script
            

                if (data.indexOf("success") !== -1) {
                    liveToast.style.backgroundColor = "#BBF7D0";
                    liveToast.style.color = 'green';
                    document.getElementById('toast-alert-message').innerHTML = "Details edited successfully";

                    cleanForm();
                }
                else {
                    liveToast.style.backgroundColor = "#FECDD3";
                    liveToast.style.color = 'red';
                    document.getElementById('toast-alert-message').innerHTML = data;
                    $("#personalInformationModal").modal("show");
                }

                myToast.show();

            })
            .catch(error => {

                console.error("Error:", error);
            });

        $("#edit-confirmation-modal").modal("hide");
        showStudents();

    }, false);

    function validatePhoneNumber(id) {
        var phoneNumberInput = document.getElementById(id);
        var phoneNumberRegex = /^\d{10}$/; // Assumes a 10-digit phone number

        if (phoneNumberRegex.test(phoneNumberInput.value)) {
            phoneNumberInput.setCustomValidity('');

            phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = '';

        } else {
            // Phone number is invalid
            phoneNumberInput.setCustomValidity('Please enter a valid 10-digit phone number.');
            phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = 'Please enter a valid 10-digit phone number.';

            phoneNumberInput.reportValidity();
        }
    }



    function areFormDataEqual(formDataSubset, formDataSuperset) {
        for (const entry of formDataSubset.entries()) {
            const [key, value] = entry;
    
            if (!formDataSuperset.has(key)) {
                return false;
            }

            if (formDataSuperset.get(key) !== value) {
                return false;
            }
        }
    
        // All key-value pairs from the first FormData are present in the second FormData (with the same values)
        return true;
    }
})();

document.getElementById("phone").addEventListener('keyup', function () {
    if (personalsNextBtnClicked) {
        validatePhoneNumber("phone");
    }
});
document.getElementById("gphone").addEventListener('keyup', function () {
    if (guardiansNextBtnClicked) {
        validatePhoneNumber("gphone");
    }
});

function validatePhoneNumber(id) {
    var phoneNumberInput = document.getElementById(id);
    var phoneNumberRegex = /^\d{10}$/; // Assumes a 10-digit phone number

    if (phoneNumberRegex.test(phoneNumberInput.value)) {
        phoneNumberInput.setCustomValidity('');
        phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = '';

    } else {
        phoneNumberInput.setCustomValidity('Please enter a valid 10-digit phone number.');
        phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = 'Please enter a valid 10-digit phone number.';
        phoneNumberInput.reportValidity();
    }
}

function sendDataToServer(formData) {
    var phpScript = "../assets/addStudent.php";

    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch(phpScript, {
        method: 'POST',
        // headers: {
        //     'Content-Type': 'application/json'
        // },
        body: formData,
    })
        .then(response => response.text())
        .then(data => {
            // Handle the response from the PHP script

           

            if (data.indexOf("success") !== -1) {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Student successfully added";

                cleanForm();
            }
            else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data;
                $("#personalInformationModal").modal("show");
            }

            myToast.show();

        })
        .catch(error => {

            console.error("Error:", error);
        });
}

function cleanForm() {
    var genForm = document.getElementById('general-form');
    var perForm = document.getElementById('personal-form');
    var gurForm = document.getElementById('guradian-form');

    Array.from(genForm.elements).forEach(function (element) {
        element.value = "";
    });
    Array.from(perForm.elements).forEach(function (element) {
        element.value = ""
    });
    Array.from(gurForm.elements).forEach(function (element) {
        element.value = "";
    });
    genForm.classList.remove('was-validated');
    perForm.classList.remove('was-validated');
    gurForm.classList.remove('was-validated');
}


// remove teacher start
(() => {
    'use strict';

    const removeTeacherBtn = document.getElementById('remove-student-btn');
    const removeTeacherForm = document.querySelector('#remove-student-form');

    removeTeacherBtn.addEventListener('click', event => {
        validateGeneralForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateGeneralForm() {
        if (removeTeacherForm.checkValidity()) {

            var id = document.getElementById('student-id').value;


            let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
            let liveToast = document.getElementById("liveToast");

            fetch('../assets/removeStudent.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
                },
                body: 'studentid=' + encodeURIComponent(id),
            })
                .then(response => response.text())
                .then(data => {
                    if (data.indexOf("success") != -1) {
                        liveToast.style.backgroundColor = "#BBF7D0";
                        liveToast.style.color = 'green';
                        document.getElementById('toast-alert-message').innerHTML = "Student removed successfully";
                    } else {
                        liveToast.style.backgroundColor = "#FECDD3";
                        liveToast.style.color = 'red';
                        document.getElementById('toast-alert-message').innerHTML = data;
                    }

                    document.getElementById("student-id").value = "";
                    $(".removeTeacherModal").modal("hide");
                    myToast.show();

                })
                .catch(error => {
                    console.error('Error:', error);
                });

        } else {
            removeTeacherForm.classList.add('was-validated');
        }
    }
})();
// remove teacher end
// remove teacher with id used by show teachers 

var student_id = "";
function deleteStudentWithId(id) {

    student_id = id;
    $('#delete-confirmation-modal').modal('show');

}
function deleteTeacherWithIdSeted() {
    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch('../assets/removeStudent.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'studentid=' + encodeURIComponent(student_id),
    })
        .then(response => response.text())
        .then(data => {
            if (data.indexOf("success") != -1) {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Student removed successfully";
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data;
            }

            $('#delete-confirmation-modal').modal('hide');
            showStudents();
            myToast.show();

        })
        .catch(error => {
            console.error('Error:', error);
        });
}
//end of remove teacher with id used by show teachers 
//show teachers 
function findAndshowStudents(){
    beginIndex = 0;
    counter = 1;
    showStudents();
}


function showStudents() {
 
 document.getElementById("next-page-btn").classList.add('disabled');
    document.getElementById("prev-page-btn").classList.add('disabled');
 
    var tablebody = document.getElementById("teacher-table-body");
    var name = document.getElementById("search-teacher-name").value;

    var _class = document.getElementById("search-class").value;
    var _section = document.getElementById("search-section").value;

    var requestData = {
        name: name, 
        as: _class,
        a: _section
    };
    fetch('../assets/fetchStudents.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',// or 'application/json' depending on your needs
        },
        body: JSON.stringify(requestData),
    })
        .then(response => response.json())
        .then(data => {
              
            document.getElementById("next-page-btn").classList.remove('disabled');
            document.getElementById("prev-page-btn").classList.remove('disabled');



           if((data[0] + "") === "No_Record"){
         
                tablebody.innerHTML = "";
                document.getElementById("dataNotAvailable").style.display = 'block';
                document.getElementById("next-page-btn").classList.add('disabled');
                document.getElementById("prev-page-btn").classList.add('disabled');
                document.getElementById("page-number").innerHTML = counter + "";
                
           }else{
               document.getElementById("dataNotAvailable").style.display = 'none';
          
            document.getElementById("prev-page-btn").classList.remove('disabled');
            document.getElementById("next-page-btn").classList.remove('disabled');
            document.getElementById("page-number").innerHTML = counter + "";

         
            if ((beginIndex + limit) >= data.length) {

                document.getElementById("next-page-btn").classList.add('disabled');
                document.getElementById("prev-page-btn").classList.remove('disabled');
                // make next btn deactive
            }
            else if (beginIndex <= 0) {
                document.getElementById("prev-page-btn").classList.add('disabled');
                document.getElementById("next-page-btn").classList.remove('disabled');
            }
            else { }

            if(beginIndex == 0){
                document.getElementById("prev-page-btn").classList.add('disabled');
            }
            let students = "";
            let flag = 0;
            for (let i = beginIndex; i < data.length; i++) {
                if (flag >= limit) {
                    break;
                }
                students += data[i];
                flag += 1;
            }
            tablebody.innerHTML = students;
           }

            
        })
        .catch(error => {
            console.error('Error:', error);
        });


}
document.getElementById("search-teacher-name").addEventListener("keyup", searchFunction);
document.getElementById("search-teacher-name").addEventListener("search", searchFunction);

function searchFunction(){
    beginIndex = 0;
    counter = 1;

    showStudents();
}
// end of show teachers 

// edit teacher  
function editStudent(tid){
    editTeacherById(tid);

    if(editing){
        document.getElementById("uploadImageField").style.display = "none";
    }

    $('#addTeacherModal').modal('show');
}
function editTeacherById(sid) {
    cleanForm();
    editing = true;
    editingTeacherId = sid;

    fetch('../assets/fetchStudentInfo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + encodeURIComponent(sid),
    })
        .then(response => response.json())
        .then(data => {
            preEditedData = new FormData();
            // preEditedData = data;

            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    preEditedData.append(key, data[key]);
                }
            }

            document.getElementById("fname").value = data['fname'];
            document.getElementById("lname").value = data['lname'];
            document.getElementById("father").value = data['father'];
            document.getElementById("gender").value = data['gender'];
            document.getElementById("dob").value = data['dob'];
            
            document.getElementById("class").value = data['class'];
            document.getElementById("section").value = data['section'];

            document.getElementById("phone").value = data['phone'];
            document.getElementById("email").value = data['email'];
            document.getElementById("address").value = data['address'];
            document.getElementById("city").value = data['city'];
            document.getElementById("zip").value = data['zip'];
            document.getElementById("state").value = data['state'];

            document.getElementById("guardian").value = data['guardian'];
            document.getElementById("gphone").value = data['gphone'];
            document.getElementById("gaddress").value = data['gaddress'];
            document.getElementById("gcity").value = data['gcity'];
            document.getElementById("gzip").value = data['gzip'];
            document.getElementById("relation").value = data['relation'];


        })
        .catch(error => console.error('Error:', error));
}
// end of edit teacher 

// start pagination 
document.getElementById("prev-page-btn").addEventListener('click', function () {
    beginIndex -= limit;
    showStudents();
    counter -= 1;


});
document.getElementById("next-page-btn").addEventListener('click', function () {
    beginIndex += limit;
    showStudents();
    counter += 1;
});
// end pagination 


function AddStudentBtnClick(){
    editing = false;
    if(!editing){
        document.getElementById("uploadImageField").style.display = "block";
    }
}



function backToStudentDetail(){
    $("#personalInformationModal").modal('hide');
    $("#addTeacherModal").modal('show');
}

function backToAddressDetail(){
    $("#guardian_information").modal('hide');
    $("#personalInformationModal").modal('show');
}


$(document).ready(function(){
    $("body").scrollTop(0);
 });

// feedback start


document.getElementById("feedback-search-class").addEventListener('change', () => {
    let classSection = getClassSectionForFeedback();
    getStudents(classSection['class'], classSection['section']);
});
document.getElementById("feedback-search-section").addEventListener('change', () => {
    let classSection = getClassSectionForFeedback();
    getStudents(classSection['class'], classSection['section']);
});
document.getElementById("feedback-students-tab").addEventListener('click', () => {
    let classSection = getClassSectionForFeedback();
    getStudents(classSection['class'], classSection['section']);
});

function getStudents(_class, _section) {

    let classSection = {
        class: _class + "",
        section: _section + ""
    }

    fetch("../assets/getStudentSelection.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(classSection),
    })
        .then(response => response.json())
        .then(data => {
            if (data['status'] === 'success') {
                document.getElementById("feedback-search-student").innerHTML = data['content'];
            }
            else {
                document.getElementById("feedback-search-student").innerHTML = "<option selected disabled value=''>--select--</option>";
            }
        })
        .catch(error => {

            console.error("Error:", error);
        });
}

function getClassSectionForFeedback() {
    let classSection = {
        class: document.getElementById("feedback-search-class").value,
        section: document.getElementById("feedback-search-section").value
    }
    return classSection;
}

function findStudentFeedback() {

    let id = document.getElementById("feedback-search-student").value;
    if (id === "") {
        document.getElementById("select-student-first").style.display = "block";
    } else {
        document.getElementById("select-student-first").style.display = "none";
        getStudentsFeedbacks(id);
    }

}

function getStudentsFeedbacks(id) {

    fetch('../assets/getStudentDetailsAndFeedback.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + encodeURIComponent(id),
    })
        .then(response => response.json())
        .then(data => {
            console.log("the data is ",data);

            if (data['status'] === 'success') {
                document.querySelector(".student-feedback").style.display = "block";
                document.getElementById("not-selected-feedbacks").style.display = "none";

                document.querySelector(".feedback-student-name").innerHTML = data['name'];
                document.getElementById("feedback-student-id").innerHTML = "<b>ID</b> - " + data['id'];
                document.getElementById("feedback-student-phone").innerHTML = "<b>Phone</b> - " + data['phone'];
                document.getElementById("feedback-student-dob").innerHTML = "<b>DOB</b> - " + data['dob'];

                document.getElementById("feedback-student-pic").src = data['image'];
                document.getElementById("reciver-student-id").value = data['id'];

                let msgbox = document.getElementById("feedback-message-box");
                msgbox.innerHTML = data['feedbacks'];
                msgbox.scrollTop = msgbox.scrollHeight;
            }
            else {
                document.querySelector(".student-feedback").style.display = "none";
                document.getElementById("not-selected-feedbacks").style.display = "block";
            }
            console.log(data['status']);

        })
        .catch(error => console.error('Error:', error));

}

document.getElementById('send-feedback-btn').addEventListener("click", function () {

    let msg = document.getElementById('feedback-msg').value + "";

    if (msg.trim() === "") {
        document.getElementById("empty-message-alert").style.display = "block";
    } else {

        let receiver = document.getElementById("reciver-student-id").value;
        sendFeedback(receiver, msg);

    }

   

});

function sendFeedback(receiver, msg) {

    let messageObject = {
        receiver: receiver + "",
        message: msg + ""
    }

    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch("../assets/sendFeedback.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(messageObject),
    })
        .then(response => response.json())
        .then(data => {

            console.log(data);

            if (data['status'] === 'success') {
                document.getElementById('feedback-msg').value = "";
            }
            else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['msg'];

                myToast.show();
            }       

            getStudentsFeedbacks(receiver);
        })
        .catch(error => {

            console.error("Error:", error);
        });

}

function deleteFeedback(feedbackid, receiverID){
    console.log("reciver id",receiverID);

    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch('../assets/deleteFeedbackWithId.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'feedbackid=' + encodeURIComponent(feedbackid),
    })
        .then(response => response.json())
        .then(data => {
            if (data['status'] === 'success') {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
            }
            else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
            }

            myToast.show();

            getStudentsFeedbacks(receiverID);
        })
        .catch(error => console.error('Error:', error));
}

document.getElementById("feedback-msg").addEventListener('keyup', function(){
    document.getElementById("empty-message-alert").style.display = 'none';
});


document.getElementById("feedback-students-tab").addEventListener("click", ()=>{
    document.querySelector(".student-feedback").style.display = "none";
    document.getElementById("not-selected-feedbacks").style.display = "block";
});
