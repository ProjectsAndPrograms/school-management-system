var preEditedData;
var postEditedData;
var EditedDataToSend;


document.addEventListener("DOMContentLoaded", setProfileDetails);

function setProfileDetails() {

    let message = "msg";
    let myToast = new bootstrap.Toast(document.getElementById('liveToast'));
    let liveToast = document.getElementById("liveToast");

    fetch('../assets/fetchProfileDetails.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'message=' + encodeURIComponent(message),
    })
        .then(response => response.json())
        .then(data => {

            if (data['status'] === "success") {

                if(data['role'] === 'admin'){

                    document.getElementById("userName").innerHTML = data['fname'] + " " + data['lname'];

                
    
                    document.getElementById("navbar_profile_pic").innerHTML = ' <img  src="' + data['image'] + '" >';
    
                    document.getElementById("profileImageBox").innerHTML = '<img alt="Profile pic" src="' + data['image'] + '" class="rounded-circle img-responsive mt-2" width="128" height="128" id="profile-image-user">';
    
                    document.getElementById("userDOB").innerHTML = data['dob'];
                    document.getElementById("teacher_id").innerHTML = data['id'];
                    document.getElementById("userEmail").innerHTML = data['email'];
                    document.getElementById("userPhone").innerHTML = data['phone'];
                    document.getElementById("userGender").innerHTML = data['gender'];
                    document.getElementById("userAddress").innerHTML = data['address'];

                }else if(data['role'] === 'teacher'){
                    document.getElementById("userName").innerHTML = data['fname'] + " " + data['lname'];

                  
    
                    document.getElementById("navbar_profile_pic").innerHTML = ' <img  src="' + data['image'] + '" >';
    
                    document.getElementById("profileImageBox").innerHTML = '<img alt="Profile pic" src="' + data['image'] + '" class="rounded-circle img-responsive mt-2" width="128" height="128" id="profile-image-user">';
    
                    document.getElementById("userDOB").innerHTML = data['dob'];
                    document.getElementById("teacher_id").innerHTML = data['id'];
                    document.getElementById("userEmail").innerHTML = data['email'];
                    document.getElementById("userClass").innerHTML = data['class'];
                    document.getElementById("userSection").innerHTML = data['section'];
                    document.getElementById("userPhone").innerHTML = data['phone'];
                    document.getElementById("userGender").innerHTML = data['gender'];
                    document.getElementById("userAddress").innerHTML = data['address'];
                }else{
                    document.getElementById("userName").innerHTML = "_ _ _ _";
                    document.getElementById("teacher_id").innerHTML = "_ _ _ _";
                    document.getElementById("userDOB").innerHTML = "_ _ _ _";
                    document.getElementById("userEmail").innerHTML = "_ _ _ _";
                    document.getElementById("userPhone").innerHTML = "_ _ _ _";
                    document.getElementById("userGender").innerHTML = "_ _ _ _";
                    document.getElementById("userAddress").innerHTML = "_ _ _ _";
                    liveToast.style.backgroundColor = "#FECDD3";
                    liveToast.style.color = 'red';
                    document.getElementById('toast-alert-message').innerHTML = data['message'];
                    myToast.show();
                }
                

            } else {

                document.getElementById("userName").innerHTML = "_ _ _ _";
                document.getElementById("userDOB").innerHTML = "_ _ _ _";
                document.getElementById("userEmail").innerHTML = "_ _ _ _";
                document.getElementById("userPhone").innerHTML = "_ _ _ _";
                document.getElementById("userGender").innerHTML = "_ _ _ _";
                document.getElementById("userAddress").innerHTML = "_ _ _ _";
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                myToast.show();
            }

        })
        .catch(error => {
            console.error('Error:', error);
        });
}

// start change password 

document.getElementById("passwordDialogBtn").addEventListener("click", function () {

    document.getElementById("currentPass").value = "";
    document.getElementById("newPass").value = "";
    document.getElementById("confirmPass").value = "";


    document.querySelector(".invalidCurrentPassword").style.display = "none";
    document.querySelector(".invalidNewPassword").style.display = "none";
    document.querySelector(".invalidConfirmPassword").style.display = "none";
    document.querySelector(".notSamePasswords").style.display = "none";

    $("#change-password").modal("show");
});

(() => {
    'use strict'


    const form = document.getElementById('changePasswordForm')

    // Loop over them and prevent submission

    document.getElementById("savePasswordBtn").addEventListener('click', event => {

        if (validateForm(form)) {

            document.querySelector(".invalidCurrentPassword").style.display = "none";
            document.querySelector(".invalidNewPassword").style.display = "none";
            document.querySelector(".invalidConfirmPassword").style.display = "none";
            document.querySelector(".notSamePasswords").style.display = "none";


            let currentPass = document.getElementById("currentPass").value;
            let newPass = document.getElementById("newPass").value;
            let confirmPass = document.getElementById("confirmPass").value;
            let sendObject = {
                currentPass: currentPass,
                newPass: newPass,
                confirmPass: confirmPass
            };

       
            var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
            var liveToast = document.getElementById("liveToast");

            fetch("../assets/changePassword.php", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(sendObject),
            })
                .then(response => response.json())
                .then(data => {

                  

                    if (data['status'] === "success") {
                        document.querySelector(".invalidCurrentPassword").style.display = 'none';
                        $("#change-password").modal("hide");
                        liveToast.style.backgroundColor = "#BBF7D0";
                        liveToast.style.color = 'green';
                        document.getElementById('toast-alert-message').innerHTML = data['message'];
                        toastObject.show();
                    } else if (data['status'] === "Not_Match") {
                       
                        document.querySelector(".invalidCurrentPassword").innerHTML = data['message'];
                        document.querySelector(".invalidCurrentPassword").style.display = 'block';
                    } else {
                        document.querySelector(".invalidCurrentPassword").style.display = 'none';
                        $("#change-password").modal("hide");
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

        event.preventDefault()
        event.stopPropagation()
    }, false)


    function validateForm(form) {

        var currentPass = (document.getElementById("currentPass").value).trim();
        var newPass = (document.getElementById("newPass").value).trim();
        var confirmPass = (document.getElementById("confirmPass").value).trim();

        if (currentPass === "" || newPass === "" || confirmPass === "" || !(newPass === confirmPass)) {

            if (currentPass === "") {
                document.querySelector(".invalidCurrentPassword").innerHTML = "required!";
                document.querySelector(".invalidCurrentPassword").style.display = "block";
            }
            if (newPass === "") {
                document.querySelector(".invalidNewPassword").style.display = "block";
            }
            if (confirmPass === "") {
                document.querySelector(".invalidConfirmPassword").style.display = "block";
            }

            if (!(newPass === confirmPass)) {
                document.querySelector(".notSamePasswords").style.display = "block";
            }
            return false;
        } else {

            return form.checkValidity();
        }

    }
})()

document.getElementById("currentPass").addEventListener("keyup", function () {
    if (this.value === "") {
        document.querySelector(".invalidCurrentPassword").innerHTML = "required!";
        document.querySelector(".invalidCurrentPassword").style.display = "block";
    } else {
        document.querySelector(".invalidCurrentPassword").style.display = "none";
    }
});

document.getElementById("newPass").addEventListener("keyup", function () {


    if (this.value === "") {
        document.querySelector(".notSamePasswords").style.display = "none";
        document.querySelector(".invalidNewPassword").style.display = "block";
    }
    else {
        document.querySelector(".invalidNewPassword").style.display = "none";
    }
});

document.getElementById("confirmPass").addEventListener("keyup", function () {

    if (this.value === "") {
        document.querySelector(".notSamePasswords").style.display = "none";
        document.querySelector(".invalidConfirmPassword").style.display = "block";
    }
    else {
        document.querySelector(".invalidConfirmPassword").style.display = "none";

    }
});
// end change password


document.getElementById("showEditDialogBtn").addEventListener("click", function () {
    $('#edit-profile-model').modal('show');
    fillPreEditedDataToDialog();
});


function fillPreEditedDataToDialog() {
    var message = "example";
    fetch('../assets/fetchProfileDetails.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'message=' + encodeURIComponent(message),
    })
        .then(response => response.json())
        .then(data => {
            preEditedData = data;
        

            if (data['status'] === "success") {


                document.getElementById("eidtFname").value = data['fname'];
                document.getElementById("editLname").value = data['lname'];
                document.getElementById("editDOB").value = convertDateFormatToInput(data['dob']);
                document.getElementById("editEmail").value = data['email'];
                document.getElementById("editPhone").value = data['phone'];
                document.getElementById("editGender").value = data['gender'];
                document.getElementById("editAddress").value = data['address'];

            } else {

                document.getElementById("eidtFname").innerHTML = "";
                document.getElementById("editLname").innerHTML = "";
                document.getElementById("editDOB").innerHTML = "";
                document.getElementById("editEmail").innerHTML = "";
                document.getElementById("editPhone").innerHTML = "";
                document.getElementById("editGender").innerHTML = "";
                document.getElementById("editAddress").innerHTML = "";
                $('#edit-profile-model').modal('hide');

                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                myToast.show();
            }

        })
        .catch(error => {
            console.error('Error:', error);
        });
}


function convertDateFormatToInput(inputDate) {
    // Assuming inputDate is in the format 12/12/2022

    var parts = inputDate.split('/');
    if (parts.length === 3) {
        var year = parts[2];
        var month = parts[0];
        var day = parts[1];
        // Return date in the format YYYY-MM-DD
        return year + '-' + month + '-' + day;
    } else {
        // Invalid input format
        return null;
    }
}

function convertDateFormatFromInput(inputDate) {
    // Assuming inputDate is in the format 2012-12-12
    var parts = inputDate.split('-');
    if (parts.length === 3) {
        var year = parts[0];
        var month = parts[1];
        var day = parts[2];
        // Return date in the format MM/DD/YYYY
        return month + '/' + day + '/' + year;
    } else {
        // Invalid input format
        return null;
    }
}

(() => {
    'use strict'

    const form = document.getElementById('editProfileForm');

    document.getElementById('saveChangesBtn').addEventListener('click', event => {
        validatePhoneNumber("editPhone");
        validateProfileForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateProfileForm() {
        if (form.checkValidity()) {




            var form2 = document.getElementById("editProfileForm");

            var formData = new FormData(form2);
            var inputDate = formData.get('dob') + "";
            formData.set('dob', convertDateFormatFromInput(inputDate));

            var preEditedFormData = new FormData();
            for (var key in preEditedData) {
                if (preEditedData.hasOwnProperty(key)) {
                    preEditedFormData.append(key, preEditedData[key]);
                }
            }

            var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
            var liveToast = document.getElementById("liveToast");

            if (areFormDataEqual(formData, preEditedFormData)) {
                $("#edit-profile-model").modal("hide");
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Nothing Edited.";
                toastObject.show();
            } else {

                
                EditedDataToSend = formData;
                $("#edit-profile-model").modal("hide");
                $("#edit-confirmation-modal").modal("show");
            }


        } else {
            form.classList.add('was-validated');
        }
    }

    document.getElementById("editPhone").addEventListener("keydown", function () {
        validatePhoneNumber("editPhone");
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

    document.getElementById("EditProfileBtn").addEventListener("click", UpdateProfileAfterValidation);
    function UpdateProfileAfterValidation() {
        // var form2 = document.getElementById("editProfileForm");

        // var formData = new FormData(form2);
        // var inputDate = formData.get('dob') + "";
        // formData.set('dob', convertDateFormatFromInput(inputDate));

        // var preEditedFormData = new FormData();
        // for (var key in preEditedData) {
        //     if (preEditedData.hasOwnProperty(key)) {
        //         preEditedFormData.append(key, preEditedData[key]);
        //     }
        // }

        var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
        var liveToast = document.getElementById("liveToast");

        

        fetch("../assets/updateProfile.php", {
            method: 'POST',
            body: EditedDataToSend,
        })
            .then(response => response.json())
            .then(data => {
                if (data['status'] === "success") {
                    $("#edit-profile-model").modal("hide");
                    $("#edit-confirmation-modal").modal("hide");
                    liveToast.style.backgroundColor = "#BBF7D0";
                    liveToast.style.color = 'green';
                    document.getElementById('toast-alert-message').innerHTML = data['message'];
                    toastObject.show();
                    setProfileDetails();
                } else {
                    $("#edit-profile-model").modal("hide");
                    $("#edit-confirmation-modal").modal("hide");
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
        return true;
    }
})()



document.getElementById("upload-file").addEventListener("change", () => {

    var fileInput = document.getElementById('upload-file');

    if (fileInput.files.length > 0) {
        var imgFormData = new FormData();
        imgFormData.append('file', fileInput.files[0]);

        var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
        var liveToast = document.getElementById("liveToast");

        fetch('../assets/updateProfilePic.php', {
            method: 'POST',
            body: imgFormData,
        })
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data['status'] === "success") {
                    liveToast.style.backgroundColor = "#BBF7D0";
                    liveToast.style.color = 'green';
                    document.getElementById('toast-alert-message').innerHTML = data['message'];
                    toastObject.show();

                    setProfileDetails();
                } else {
                    liveToast.style.backgroundColor = "#FECDD3";
                    liveToast.style.color = 'red';
                    document.getElementById('toast-alert-message').innerHTML = data['message'];
                    toastObject.show();
                }

            })
            .catch(error => {
                // Handle errors
                console.error('Error:', error);
            });


    } else {
    }
});

function removeProfilePic() {

    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");

    fetch("../assets/removeProfilePic.php", {
        method: 'POST',
    })
        .then(response => response.text())
        .then(data => {


            if (data === 'success') {
                setProfileDetails();
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Profile picture removed successfully";
                toastObject.show();
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data;
                toastObject.show();
            }



        })
        .catch(error => {
            console.error('Error:', error);
        });

}

document.getElementById("_change_password").addEventListener("click", function () {
    $("#change-password").modal("show");
});

document.getElementById("_change_profile").addEventListener("click", function () {
    $('#edit-profile-model').modal('show');
    fillPreEditedDataToDialog();
});