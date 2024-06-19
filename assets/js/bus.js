let delBusId = 0;
let editBusId = 0;
let delBusStopId = 0;
let busStopIndex;
let editBusStopIndex;
let rootObjArray = [];

document.getElementById("open-add-bus-dailog").addEventListener("click", () => {
    $("#add-bus-modal").modal("show");
});

document.addEventListener('DOMContentLoaded', () => {
    showBuses();
    fetchAndSetSelectBus();
});

document.getElementById("select-bus-for-root").addEventListener('change', showBusRoot);

(() => {
    'use strict';

    let addBusBtn = document.getElementById("add-bus-button");
    let addBusForm = document.querySelector('#add-bus-form');

    addBusBtn.addEventListener('click', event => {
        validatePhoneNumber('driver-contact-new');
        validatePhoneNumber("helper-contact-new");
        validateAddBusForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateAddBusForm() {
        if (addBusForm.checkValidity()) {
            saveBus(new FormData(addBusForm));
            $("#add-bus-modal").modal("hide");
            cleanForm(addBusForm);
        } else {
            addBusForm.classList.add('was-validated');
        }
    }

    function validatePhoneNumber(id) {
        var phoneNumberInput = document.getElementById(id);
        var phoneNumberRegex = /^\d{10}$/;
        if (phoneNumberRegex.test(phoneNumberInput.value)) {
            phoneNumberInput.setCustomValidity('');
            phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = '';
        } else {
            phoneNumberInput.setCustomValidity('Please enter a valid 10-digit phone number.');
            phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = 'Please enter a valid 10-digit phone number.';
            phoneNumberInput.reportValidity();
        }
    }

    document.getElementById("driver-contact-new").addEventListener("keyup", () => {
        validatePhoneNumber("driver-contact-new");
    });
    document.getElementById("helper-contact-new").addEventListener("keyup", () => {
        validatePhoneNumber("helper-contact-new");
    });
})();

(() => {
    'use strict';

    let updateBusBtn = document.getElementById("update-bus-btn");
    let editBusForm = document.querySelector('#update-bus-form');

    updateBusBtn.addEventListener('click', event => {
        validatePhoneNumber('driver-contact-edit');
        validatePhoneNumber("helper-contact-edit");
        validateEditBusForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateEditBusForm() {
        if (editBusForm.checkValidity()) {
            let formData = new FormData(editBusForm)
            formData.append("bus_id", editBusId);
            saveBus(formData);
            $("#edit-bus-modal").modal("hide");
            cleanForm(editBusForm);
        } else {
            editBusForm.classList.add('was-validated');
        }
    }


    function validatePhoneNumber(id) {
        var phoneNumberInput = document.getElementById(id);
        var phoneNumberRegex = /^\d{10}$/;
        if (phoneNumberRegex.test(phoneNumberInput.value)) {
            phoneNumberInput.setCustomValidity('');
            phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = '';
        } else {
            phoneNumberInput.setCustomValidity('Please enter a valid 10-digit phone number.');
            phoneNumberInput.parentNode.querySelector('.invalid-feedback').innerHTML = 'Please enter a valid 10-digit phone number.';
            phoneNumberInput.reportValidity();
        }
    }

    document.getElementById("driver-contact-edit").addEventListener("keyup", () => {
        validatePhoneNumber("driver-contact-edit");
    });
    document.getElementById("helper-contact-edit").addEventListener("keyup", () => {
        validatePhoneNumber("helper-contact-edit");
    });
})();

function saveBus(formData) {
    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");

    fetch("../assets/saveBus.php", {
        method: 'POST',
        body: formData,
    })
        .then(response => response.json())
        .then(data => {

            if (data['status'] === "success") {

                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();


            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            }
            showBuses();
            fetchAndSetSelectBus();
        })
        .catch(error => {

            console.error("Error:", error);
        });

}

function showBuses() {

    fetch("../assets/showBuses.php", {
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {

            if (data['status'] === "success") {
                document.getElementById("No-Buses").style.display = "none";
                document.getElementById("accordion-bus-list").innerHTML = data['data'];
            } else {
                document.getElementById('accordion-bus-list').innerHTML = "";
                document.getElementById("No-Buses").style.display = "block";

            }

        })
        .catch(error => {
            console.error("Error:", error);
        });
}


function openEditBusDialog(busId) {
    editBusId = busId;
    setEditData(busId);
    $("#edit-bus-modal").modal('show');
}

function openDeleteConfirmationDialog(busId) {
    delBusId = busId;
    $("#delete-bus-modal").modal('show');
}

function deleteBus() {
    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");

    $("#delete-bus-modal").modal('hide');
    fetch("../assets/deleteBus.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "busId=" + encodeURIComponent(delBusId + ""),
    })
        .then(response => response.json())
        .then(data => {

            if (data['status'] === 'success') {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            }
            showBuses();
            fetchAndSetSelectBus();

        })
        .catch(error => {
            console.error("Error" + error);
        });
}

function cleanForm(form) {
    form.classList.remove("was-validated");
    Array.from(form.elements).forEach(function (element) {
        element.value = "";
    });
}

function setEditData(busId) {
    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");

    fetch("../assets/fetchBusDetails.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "busId=" + encodeURIComponent(busId + ""),
    })
        .then(response => response.json())
        .then(data => {

            let busTitle = document.getElementById("bus-title-edit");
            let busNumber = document.getElementById("bus-number-edit");
            let driverName = document.getElementById("driver-name-edit");
            let driverContact = document.getElementById("driver-contact-edit");
            let helperName = document.getElementById("helper-name-edit");
            let helperContact = document.getElementById("helper-contact-edit");

            if (data['status'] === "success") {
                busTitle.value = data['busTitle'];
                busNumber.value = data['busNumber'];
                driverName.value = data['driverName'];
                driverContact.value = data['driverContact'];
                helperName.value = data['helperName'];
                helperContact.value = data['helperContact'];
            } else {
                cleanForm(document.getElementById("update-bus-form"));
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            }

        })
        .catch(error => {
            console.error("Error" + error);
        });
}

function showBusRoot() {

    let selectElement = document.getElementById("select-bus-for-root");

    let busId = selectElement.value;
    selectElement.disabled = true;
    document.getElementById("loading-bus-select").style.display = "block";

    fetch("../assets/showBusRoot.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "busId=" + encodeURIComponent(busId + ""),
    })
        .then(response => response.json())
        .then(data => {
            selectElement.disabled = false;
            document.getElementById("loading-bus-select").style.display = "none";

            if (data['status'] === 'success') {
                document.getElementById("No-root-available").style.display = "none";
                document.getElementById("bus-root-view-mode").innerHTML = data['view-root'];
                document.getElementById("bus-root-edit-mode").innerHTML = data['edit-root'];

            } else {
                document.getElementById("bus-root-view-mode").innerHTML = "";
                document.getElementById("bus-root-edit-mode").innerHTML = "";
                document.getElementById("No-root-available").style.display = "block";
            }

        })
        .catch(error => {
            console.error("Error" + error);
        });
}

function fetchNewlyCreatedBusRoot() {
    let selectElement = document.getElementById("select-bus-for-root");
    for (let i = 0; i < selectElement.options.length; i++) {
        if (i === (selectElement.options.length - 1)) {
            selectElement.options[i].selected = true;
        } else {
            selectElement.options[i].selected = false;
        }
    }
}

function fetchAndSetSelectBus() {
    fetch("../assets/fetchAllBusesForSelect.php", {
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {

            if (data['status'] === "success") {
                document.getElementById("select-bus-for-root").innerHTML = data['buses'];
            } else {
                document.getElementById("select-bus-for-root").innerHTML = " <option selected disabled value=''>--select--</option>";
            }

            showBusRoot();

        })
        .catch(error => {
            console.error("Error:", error);
        });
}

function openBusRoot(busId) {
    let selectedEle = document.getElementById("select-bus-for-root");
    for (let i = 0; i < selectedEle.options.length; i++) {
        if (selectedEle.options[i].value === busId) {
            selectedEle.options[i].selected = true;
        } else {
            selectedEle.options[i].selected = false;
        }
    }
    var objControl=document.getElementById("busRootHeading");
    objControl.scrollTop = objControl.offsetTop;
    document.getElementById("busRootHeading").scrollIntoView({ behavior: "smooth" });
    showBusRoot();
}

function setAvailableStops() {
    rootObjArray.length = 0;
    let stops = document.querySelectorAll("#bus-root-edit-mode .bus-stop");

    for (let i = 0; i < stops.length; i++) {
        let location = stops[i].querySelector(".bus-location").innerHTML;
        let timeActions = stops[i].querySelector(".time-actions");

        let time = timeActions.querySelector('.arrival-time').innerHTML;

        rootObjArray[i] = {
            location: location,
            arrival: time
        }
    }
}

function openAddBusStopDialog(i) {
    busStopIndex = i;
    document.querySelector('#add-bus-stop-form').classList.remove("was-validated");
    $("#add-bus-stop-modal").modal("show");
}

function openEditBusStopDialog(i, serial){
    editBusStopIndex = i;
    getAndSetBusStopData(serial);
    document.querySelector('#edit-bus-stop-form').classList.remove("was-validated");
    $("#edit-bus-stop-modal").modal("show");
}

(() => {
    'use strict';

    let addBusStopBtn = document.getElementById("addBusStopButton");
    let addBusStopForm = document.querySelector('#add-bus-stop-form');

    addBusStopBtn.addEventListener('click', event => {

        validateAddBusForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateAddBusForm() {
        if (addBusStopForm.checkValidity() && isValiTime()) {

            let newBusLocation = document.getElementById('stop-location-new').value;
            let newBusArrivalTime = document.getElementById('arrival-time-new').value;

            setAvailableStops();
            rootObjArray.splice(busStopIndex, 0, {
                location: newBusLocation,
                arrival: newBusArrivalTime
            });
            saveAllBusStops();
            $("#add-bus-stop-modal").modal("hide");

            document.getElementById('stop-location-new').value = "";
            document.getElementById("arrival-time-new").value = "";
            addBusStopForm.classList.remove("was-validated");

        } else {
            addBusStopForm.classList.add('was-validated');
        }
    }

    function isValiTime() {
        
        let time = document.getElementById("arrival-time-new");
        if (time.value == "") {
            time.parentNode.querySelector('.invalid-feedback').innerHTML = 'required!';
            time.reportValidity();
            return false;
        } else if (time.value == 'Invalid Date') {
            time.value = "";
            time.parentNode.querySelector('.invalid-feedback').innerHTML = 'Invalid time!';
            time.reportValidity();
            return false;
        } else {
            time.parentNode.querySelector('.invalid-feedback').innerHTML = '';
            return true;
        }
    }

    document.getElementById("arrival-time-new").addEventListener("change", validateAddBusForm);
})();

(() => {
    'use strict';

    let editBusStopBtn = document.getElementById("updateBusStopBtn");
    let editBusStopForm = document.querySelector('#edit-bus-stop-form');

    editBusStopBtn.addEventListener('click', event => {

        validateAddBusForm();

        event.preventDefault();
        event.stopPropagation();
    }, false);

    function validateAddBusForm() {
        if (editBusStopForm.checkValidity() && isValiTime()) {

            let editedBusLocation = document.getElementById('stop-location-edit').value;
            let editedBusArrivalTime = document.getElementById('arrival-time-edit').value;

            setAvailableStops();
            
            rootObjArray[editBusStopIndex - 1] =  {
                location: editedBusLocation,
                arrival: editedBusArrivalTime
            };
            
            saveAllBusStops();
            $("#edit-bus-stop-modal").modal("hide");

            document.getElementById('stop-location-edit').value = "";
            document.getElementById("arrival-time-edit").value = "";
            editBusStopForm.classList.remove("was-validated");

        } else {
            editBusStopForm.classList.add('was-validated');
        }
    }

    function isValiTime() {
        let time = document.getElementById("arrival-time-edit");
        if (time.value == "") {
            time.parentNode.querySelector('.invalid-feedback').innerHTML = 'required!';
            time.reportValidity();
            return false;
        } else if (time.value == 'Invalid Date') {
            time.value = "";
            time.parentNode.querySelector('.invalid-feedback').innerHTML = 'Invalid time!';
            time.reportValidity();
            return false;
        } else {
            time.parentNode.querySelector('.invalid-feedback').innerHTML = '';
            return true;
        }
    }

    document.getElementById("arrival-time-new").addEventListener("change", validateAddBusForm);
})();

function saveAllBusStops() {

    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");

    let busID = document.getElementById("select-bus-for-root").value;

    let sendBusStopsObj = {
        rootsObjArray: rootObjArray,
        busId: busID,
    }

    fetch("../assets/saveAllBusStops.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(sendBusStopsObj),
    })
        .then(response => response.json())
        .then(data => {

            if (data['status'] === 'success') {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            }
            showBusRoot();

        })
        .catch(error => {
            console.error("Error" + error);
        });
}

function showDeleteBusStopConfirmationDialog(s_no) {
    delBusStopId = s_no;
    $('#delete-bus-stop-modal').modal("show");
}

function deleteBusStop() {

    $('#delete-bus-stop-modal').modal("hide");

    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");

    let s_no = delBusStopId;
    delBusStopId = 0; 

    fetch("../assets/deleteBusStop.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: "s_no=" + encodeURIComponent(s_no + ""),
    })
        .then(response => response.json())
        .then(data => {

            if (data['status'] === 'success') {
                liveToast.style.backgroundColor = "#BBF7D0";
                liveToast.style.color = 'green';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            } else {
                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
            }
            showBusRoot();

        })
        .catch(error => {
            console.error("Error" + error);
        });
  
}

function getAndSetBusStopData(serial){
    let busId = document.getElementById("select-bus-for-root").value;

    var toastObject = new bootstrap.Toast(document.getElementById("liveToast"));
    var liveToast = document.getElementById("liveToast");

    let sendData = new FormData();
    sendData.append("busId", busId);
    sendData.append("serial", serial);

    fetch("../assets/getBusStopDetails.php", {
        method: 'POST',
        body: sendData,
    })
        .then(response => response.json())
        .then(data => {
            if (data['status'] === 'success') {
                document.getElementById('stop-location-edit').value = data['location'];
                document.getElementById("arrival-time-edit").value = data['arrival_time'];
            } else {
                document.getElementById('stop-location-edit').value = "";
                document.getElementById("arrival-time-edit").value = "";

                liveToast.style.backgroundColor = "#FECDD3";
                liveToast.style.color = 'red';
                document.getElementById('toast-alert-message').innerHTML = data['message'];
                toastObject.show();
                $("#edit-bus-stop-modal").modal('hide');
            }
           

        })
        .catch(error => {
            console.error("Error" + error);
        });
}
