var preEditedData;
var postEditedData;

document.addEventListener("DOMContentLoaded", function () {


    showSubjects();
});

var editingSubjectId = "";
function openEditDialog(subjId) {
    editingSubjectId = subjId;

    setDataToForm(subjId);
    $('#edit-subject').modal('show');
}

function setDataToForm(sid) {

    fetch('../assets/fetchSubjectInfo.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'subject_id=' + encodeURIComponent(sid),
    })
        .then(response => response.json())
        .then(data => {
            preEditedData = new FormData();
            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    preEditedData.append(key, data[key]);
                }
            }
           


            document.getElementById("subject-edited-name").value = data['subject'];

        })
        .catch(error => console.error('Error:', error));
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(() => {
    'use strict'

    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    const addSubjectForm = document.getElementById("create-subject-form");
    const addSubjectBtn = document.getElementById("add-subject-btn");
    const editSubjectForm = document.getElementById("editSubjectForm");

    // Loop over them and prevent submission

    addSubjectBtn.addEventListener('click', event => {

        validateForm();

        event.preventDefault()
        event.stopPropagation()

    }, false);

    document.getElementById("subject-edited-name").addEventListener("keydown", function (event) {
        if (event.key === 'Enter') {
            saveBtnClicked();
        }
    }, false);

    document.getElementById('save-new-subject-name').addEventListener('click', event => {
        saveBtnClicked();

    }, false)

    function saveBtnClicked(){
        if (editSubjectForm.checkValidity()) {
            saveSubjectNewName();
        } else {
            editSubjectForm.classList.add('was-validated');
        }

        event.preventDefault()
        event.stopPropagation()

    }

    document.getElementById("newSubjectName").addEventListener("keydown", function (event) {
        if (event.key === 'Enter') {
            validateForm();

            event.preventDefault()
            event.stopPropagation()
        }
    }, false);



    function validateForm() {
        if (addSubjectForm.checkValidity()) {
            addSubject();
        } else {
            addSubjectForm.classList.add('was-validated');
        }
    }

    function addSubject() {
        var _class = document.getElementById("class").value;
        var subject = document.getElementById("newSubjectName").value;

        var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
        var liveToast = document.getElementById("liveToast");

    
        var newSubject = {
            class: _class,
            subject: subject
        };

        fetch("../assets/addSubject.php", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify(newSubject),
        })
            .then(response => response.text())
            .then(data => {
         

                if (data == "success") {
                    // clean the form 
                    var s = document.getElementById("create-subject-form");
                    cleanForm(s);

                    // hide add subject modal
                    $("#add-subject").modal("hide");

                    //showing success toast
                    liveToast.style.backgroundColor = "#BBF7D0";
                    liveToast.style.color = 'green';
                    document.getElementById('toast-alert-message').innerHTML = "Subject added successfully";
                    toastObject.show();
                } else {
                    liveToast.style.backgroundColor = "#FECDD3";
                    liveToast.style.color = 'red';
                    document.getElementById('toast-alert-message').innerHTML = data;
                    toastObject.show();

                }
                showSubjects();
               
            })
            .catch(error => {
                console.error("Error:", error);
            });

    }

    function cleanForm(form) {


        Array.from(form.elements).forEach(function (element) {
            element.value = "";
        });
    }

    function saveSubjectNewName() {

        var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
        var liveToast = document.getElementById("liveToast");

        var form = document.getElementById("editSubjectForm");
        postEditedData = new FormData(form);

        if (areFormDataEqual(postEditedData, preEditedData)) {
            liveToast.style.backgroundColor = "#BBF7D0";
            liveToast.style.color = 'green';
            document.getElementById('toast-alert-message').innerHTML = "Nothing edited";

           
        } else {

            postEditedData.append('subject_id', preEditedData.get('subject_id'));
           

            fetch("../assets/editSubject.php", {
                method: 'POST',
              
                body: postEditedData,
            })
                .then(response => response.text())
                .then(data => {
                    if(data === "success"){
                        liveToast.style.backgroundColor = "#BBF7D0";
                        liveToast.style.color = 'green';
                        document.getElementById('toast-alert-message').innerHTML = "Subject successfully edited!";
                    }else{
                        liveToast.style.backgroundColor = "#FECDD3";
                        liveToast.style.color = 'red';
                        document.getElementById('toast-alert-message').innerHTML = data;
                    }

                    showSubjects();

                })
                .catch(error => {
                    console.error("Error:", error);
                });

        }

        
       
        $("#edit-subject").modal("hide");
       

        toastObject.show();
       
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

function removeValidations() {
    const addSubjectForm = document.getElementById("create-subject-form");
    addSubjectForm.classList.remove('was-validated');
}

document.getElementById('find-btn').addEventListener('click', function () {
    showSubjects();
});

function showSubjects() {
    var _class = document.getElementById("search-class").value;
    var noDataIcon = document.getElementById("dataNotAvailable");

    fetch("../assets/fetchSubjects.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "class=" + encodeURIComponent(_class),
    })
        .then(response => response.json())
        .then(data => {


            if ((data[0]) === "No_Record" || data.length <= 0) {
                noDataIcon.style.display = "block";
                document.getElementById('subject-table-body').innerHTML = "";
            } else {

                noDataIcon.style.display = "none";
                var subjects = "";
                for (let i = 0; i < data.length; i++) {
                    subjects += data[i];
                }
                
                document.getElementById('subject-table-body').innerHTML = subjects;


                document.getElementById('subject-table-header').innerHTML = "Class " + _class + " Subjects";
            }

        })
        .catch(error => {
            console.error('Error:', error);
        });

    
}
var subjectId = "";
function openDeleteDialog(subjId) {
    subjectId = subjId;
    $("#delete-confirmation-modal").modal("show");
}

function deleteSubject() {

    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");


    fetch("../assets/deleteSubject.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "subjectId=" + encodeURIComponent(subjectId),
    })
        .then(response => response.text())
        .then(data => {
            

            if (data === 'success') {

                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = "Subject deleted successfully";
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data;

            }

            $("#delete-confirmation-modal").modal("hide");
            showSubjects();
            toastObject.show();

        })
        .catch(error => {
            console.error('Error:', error);
        });

}


