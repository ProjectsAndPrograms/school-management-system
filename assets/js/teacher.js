var fullFormData;
var generalFormData;
var personalFormData;
var guardianFormData;
var personalsNextBtnClicked = false;
var guardiansNextBtnClicked = false;
var editing = false;
var editingTeacherId = "";
var preEditedData;
var postEditedData;
var classTeacherValidated = false;


// page settings
var beginIndex = 0;
var limit = 10;
var counter = 1;

document.addEventListener('DOMContentLoaded', ()=>{
    showTeachers();
});

document.getElementById("class").addEventListener("change", function(){
    
    if(document.getElementById("class").value == "null"){
        document.getElementById("section").value = "null";
        document.getElementById("section").disabled = true;
    }else{
        document.getElementById("section").disabled = false;
    }
});

document.getElementById("section").addEventListener("change", function(){
    
    if(document.getElementById("section").value == "null"){
        document.getElementById("class").value = "null";
        
    }else{
    }
});


document.getElementById('addTeacherButton').addEventListener('click', function () {
    editing = false;
    cleanForm();
});


(() => {
    'use strict';

    const gInfoBtn = document.getElementById('general-info-btn');
    const genform = document.querySelector('#general-form');

    gInfoBtn.addEventListener('click', event => {
        validateGeneralForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateGeneralForm() {
        if (genform.checkValidity() && validateClassTeacherDetails()) {

            const formElement = document.querySelector('#general-form');
            generalFormData = Object.fromEntries(new FormData(formElement).entries());

            $("#addTeacherModal").modal("hide");
            $("#personalInformationModal").modal("show");
        } else {
            if(classTeacherValidated){

                genform.classList.add('was-validated');
            }
        }
    }

    function validateClassTeacherDetails(){
       let _class = document.getElementById('class').value;    
       let section = document.getElementById('section').value; 
      
       if(_class == "null" || section == "null"){
        if(_class == "null" && section == "null"){
            classTeacherValidated = true;
            document.getElementById("invaldClassteacher").style.display = "none";
            return true;
          }
          else{
            document.querySelector('#general-form').classList.remove('was-validated');
            classTeacherValidated = false;
            document.getElementById("invaldClassteacher").style.display = "block";
            console.log("here");
            return false;
          }
      }
      document.getElementById("invaldClassteacher").style.display = "none";
      classTeacherValidated = true;
      return true;
      

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
            guardianFormData = Object.fromEntries(new FormData(formElement2).entries());
            fullFormData = { ...generalFormData, ...personalFormData, ...guardianFormData };

            if (!editing) {
                sendDataToServer(fullFormData);

            } else {
               

                let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
                let liveToast = document.getElementById("liveToast");
                if (isObjectPropertiesSame(fullFormData, preEditedData)) {
                    liveToast.style.backgroundColor = "#BBF7D0";
                    liveToast.style.color = 'green';
                    document.getElementById('toast-alert-message').innerHTML = "Nothing edited!";
                    

                    $('#addTeacherModal').modal('hide');
                    myToast.show(); 
                } else {
                    postEditedData = fullFormData;
                    postEditedData["id"] = preEditedData['id'];
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
        fetch("../assets/editTeacher.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(postEditedData),
        })
            .then(response => response.text())
            .then(data => {
               

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
        showTeachers();

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


    function isObjectPropertiesSame(obj1, obj2) {

        for (let key in obj1) {
            if (obj1.hasOwnProperty(key) && !obj2.hasOwnProperty(key) || obj1[key] !== obj2[key]) {
                return false;
            }
        }
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
    var phpScript = "../assets/addTeacher.php";

    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch(phpScript, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(formData),
    })
        .then(response => response.text())
        .then(data => {
            // Handle the response from the PHP script

            if (data.indexOf("success") !== -1) {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Teacher successfully added";

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

    const removeTeacherBtn = document.getElementById('remove-teacher-btn');
    const removeTeacherForm = document.querySelector('#remove-teacher-form');

    removeTeacherBtn.addEventListener('click', event => {
        validateGeneralForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateGeneralForm() {
        if (removeTeacherForm.checkValidity()) {

            var id = document.getElementById('teacher-id').value;


            let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
            let liveToast = document.getElementById("liveToast");

            fetch('../assets/removeTeacher.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
                },
                body: 'teacherid=' + encodeURIComponent(id),
            })
                .then(response => response.text())
                .then(data => {
                    if (data.indexOf("success") != -1) {
                        liveToast.style.backgroundColor = "#BBF7D0";
                        liveToast.style.color = 'green';
                        document.getElementById('toast-alert-message').innerHTML = "Teacher removed successfully";
                    } else {
                        liveToast.style.backgroundColor = "#FECDD3";
                        liveToast.style.color = 'red';
                        document.getElementById('toast-alert-message').innerHTML = data;
                    }

                    document.getElementById("teacher-id").value = "";
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

var teacher_id = "";
function deleteTeacherWithId(id) {

    teacher_id = id;
    $('#delete-confirmation-modal').modal('show');

}
function deleteTeacherWithIdSeted() {
    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch('../assets/removeTeacher.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'teacherid=' + encodeURIComponent(teacher_id),
    })
        .then(response => response.text())
        .then(data => {
            if (data.indexOf("success") != -1) {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Teacher removed successfully";
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data;
            }

            $('#delete-confirmation-modal').modal('hide');
            showTeachers();
            myToast.show();

        })
        .catch(error => {
            console.error('Error:', error);
        });
}
//end of remove teacher with id used by show teachers 
//show teachers 


function showTeachers() {


    document.getElementById("next-page-btn").classList.add('disabled');
    document.getElementById("prev-page-btn").classList.add('disabled');

    var tablebody = document.getElementById("teacher-table-body");
    var name = document.getElementById("search-teacher-name").value;

    fetch('../assets/fetchTeachers.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'name=' + encodeURIComponent(name),
    })
        .then(response => response.json())
        .then(data => {
         
         
            document.getElementById("next-page-btn").classList.remove('disabled');
            document.getElementById("prev-page-btn").classList.remove('disabled');
         
           if((data + "") === "No_Record"){
           
                tablebody.innerHTML = "";
                document.getElementById("dataNotAvailable").style.display = 'block';
                document.getElementById("next-page-btn").classList.add('disabled');
                document.getElementById("prev-page-btn").classList.add('disabled');
                
                
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
            let teachers = "";
            let flag = 0;
            for (let i = beginIndex; i < data.length; i++) {
                if (flag >= limit) {
                    break;
                }
                teachers += data[i];
                flag += 1;
            }
            tablebody.innerHTML = teachers;
           }

            
        })
        .catch(error => {
            console.error('Error:', error);
        });


}
document.getElementById("search-teacher-name").addEventListener("keyup", searchFunction);
document.getElementById("search-teacher-name").addEventListener("search", searchFunction);
document.getElementById("searchTeacherByNameBtn").addEventListener('click', searchFunction);

function searchFunction(){
    beginIndex = 0;
    counter = 1;

    showTeachers();
}
// end of show teachers 

// edit teacher  
function editTeacher(tid){
    editTeacherById(tid);

    $('#addTeacherModal').modal('show');
}
function editTeacherById(tid) {
    cleanForm();
    editing = true;
    editingTeacherId = tid;

    fetch('../assets/fetchTeacherInfo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'id=' + encodeURIComponent(tid),
    })
        .then(response => response.json())
        .then(data => {
            preEditedData = data;

            document.getElementById("fname").value = data['fname'];
            document.getElementById("lname").value = data['lname'];

            document.getElementById("class").value = "null";
            document.getElementById("section").value = "null";
            document.getElementById("class").value = data['class'];
            document.getElementById("section").value = data['section'];

            document.getElementById("subject").value = data['subject'];
            
            document.getElementById("gender").value = data['gender'];
            document.getElementById("dob").value = data['dob'];

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
    showTeachers();
    counter -= 1;


});
document.getElementById("next-page-btn").addEventListener('click', function () {
    beginIndex += limit;
    showTeachers();
    counter += 1;
});
// end pagination 

function backToStudentDetail(){
    $("#personalInformationModal").modal('hide');
    $("#addTeacherModal").modal('show');
}

function backToAddressDetail(){
    $("#guardian_information").modal('hide');
    $("#personalInformationModal").modal('show');
}

