
let LEAVE_LIMIT = 10;
let STATUS_PAGE = 'pending';

let statusChangeId = 0;
let statusToBeChanged = "pending";

let delLeaveID = 0;

let LEAVE_PAGE_NUMBER = 1;
let CURSOR_POINT = 0;
let TOTAL_LEAVE_COUNT = 0;


document.addEventListener("DOMContentLoaded", ()=>{
  getLeaves(STATUS_PAGE);
});

document.getElementById("show-leave-tab").addEventListener("click", ()=>{
  getLeaves(STATUS_PAGE);
});

function getAndSetCardsData(){

  let toastObject = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

    fetch("../assets/fetchLeaveCardsData.php", {
        method: 'POST',
      })
        .then(response => response.json())
        .then(data => {

          if(data['status'] === "success"){
            document.getElementById("total-teacher-number").innerHTML = data['teachers-count'];
            document.getElementById("approved-leave-number").innerHTML = data['approved-count'];
            document.getElementById("pending-leave-number").innerHTML = data['pending-count'];
            document.getElementById("rejected-leave-number").innerHTML = data['rejected-count'];
          }else{
            liveToast.style.backgroundColor = "#FECDD3";
            liveToast.style.color = 'red';
            document.getElementById('toast-alert-message').innerHTML = data['message'];
            toastObject.show();
          }
    
    
        })
        .catch(error => {
          console.error("Error:", error);
        });
}

function getLeaves(status){

  let sendData = new FormData();
  sendData.append('status', status);
  sendData.append('limit', LEAVE_LIMIT);
  sendData.append('offset', CURSOR_POINT );

  let preBtn = document.getElementById("leave-prev-btn");
  let nextBtn = document.getElementById("leave-next-btn");

  if (LEAVE_PAGE_NUMBER <= 1 || CURSOR_POINT < LEAVE_LIMIT) {
    preBtn.disabled = true;
  } else {
    preBtn.disabled = false;
  }

  fetch("../assets/getAllLeavesForAdmin.php", {
    method: 'POST',
    body: sendData,
  })
    .then(response => response.json())
    .then(data => {

      document.getElementById("leave-page-number").innerHTML = LEAVE_PAGE_NUMBER;

      TOTAL_LEAVE_COUNT = data['count'];
      getAndSetCardsData();

      if ((CURSOR_POINT > (TOTAL_LEAVE_COUNT - LEAVE_LIMIT)) || 
          ((TOTAL_LEAVE_COUNT / LEAVE_LIMIT) <= LEAVE_PAGE_NUMBER) ) {
        nextBtn.disabled = true;
      } else {
        nextBtn.disabled = false;
      }

      if(data['status'] === "success"){

        document.getElementById("NoLeavesAvailable").style.display = 'none';
        document.getElementById("leave-pagination").style.display = 'block';
        document.getElementById("leaves-table").innerHTML = data['data'];
      }else{
        // TOTAL_LEAVE_COUNT = 0;
        document.getElementById("leaves-table").innerHTML = "";
        document.getElementById("NoLeavesAvailable").style.display = 'block';
        document.getElementById("leave-pagination").style.display = 'none';
      }

    })
    .catch(error => {
      console.error("Error:", error);
    });
}

document.getElementById("leave-prev-btn").addEventListener("click", ()=>{
  if (CURSOR_POINT >= LEAVE_LIMIT) {
    CURSOR_POINT -= LEAVE_LIMIT;
    LEAVE_PAGE_NUMBER -= 1;
    getLeaves(STATUS_PAGE);
  }

});

document.getElementById("leave-next-btn").addEventListener("click", ()=>{
  if (CURSOR_POINT < (TOTAL_LEAVE_COUNT - LEAVE_LIMIT)) {
    CURSOR_POINT += LEAVE_LIMIT;
    LEAVE_PAGE_NUMBER += 1;
    getLeaves(STATUS_PAGE);
  }
});

function openApproveConfirmationDialog(s_no){
  $("#approved-confirmation-modal").modal("show");
  statusChangeId = parseInt(s_no);
  statusToBeChanged = "approved";
}

function openRejectConfirmationDialog(s_no){
  $("#reject-confirmation-modal").modal("show");
  statusChangeId = parseInt(s_no);
  statusToBeChanged = "rejected";
}

function changeStatusOfLeave(){
  let sendData = new FormData();
  sendData.append("s_no", statusChangeId);
  sendData.append("status", statusToBeChanged);

  let toastObject = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  fetch("../assets/changeLeaveStatus.php", {
    method: 'POST',
    body: sendData,
  })
    .then(response => response.json())
    .then(data => {

      $("#approved-confirmation-modal").modal("hide");
      $("#reject-confirmation-modal").modal("hide");

      if(data['status'] ===  "success") {
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();

        getLeaves(STATUS_PAGE);
        
      }else{
        liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();
      }

    })
    .catch(error => {
      console.error("Error:", error);
    });
}

function tabButtonClicked(_status){

    let pendingTab = document.getElementById("pending-leave-tab");
    let approvedTab = document.getElementById("approved-leave-tab");
    let rejectedTab = document.getElementById("rejected-leave-tab");

    LEAVE_PAGE_NUMBER = 1;
    CURSOR_POINT = 0;

    if(_status === "pending"){
      approvedTab.classList.remove("active");
      rejectedTab.classList.remove("active");
      pendingTab.classList.add("active");
      STATUS_PAGE = "pending";
    }else if(_status === "approved"){
      rejectedTab.classList.remove("active");
      pendingTab.classList.remove("active");
      approvedTab.classList.add("active");
      STATUS_PAGE = "approved";
    }else if(_status === "rejected"){
      pendingTab.classList.remove("active");
      approvedTab.classList.remove("active");
      rejectedTab.classList.add("active");
      STATUS_PAGE = "rejected";
    }

  getLeaves(STATUS_PAGE);
}

function openLeaveDeleteConfirmationDialog(s_no){
  $("#delete-leave-confirmation-modal").modal("show");
  delLeaveID = parseInt(s_no);
}

function deleteLeave(){

  $("#delete-leave-confirmation-modal").modal("hide");

  let toastObject = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  fetch("../assets/deleteLeave.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "s_no=" + encodeURIComponent(delLeaveID),
  })
    .then(response => response.json())
    .then(data => {

      if(data['status'] === "success"){
        liveToast.style.backgroundColor = "#BBF7D0";
        liveToast.style.color = 'green';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();

        getLeaves(STATUS_PAGE);
        
      }else{
         liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();
      }
    })
    .catch(error => {
      console.error("Error:", error);
    });
}

function showLeaveDeatilsDialog(s_no){
  $("#view-leave-modal").modal("show");
  
  let toastObject = new bootstrap.Toast(document.getElementById('liveToast'));
  let liveToast = document.getElementById("liveToast");

  fetch("../assets/fetchLeaveDetails.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "s_no=" + encodeURIComponent(s_no),
  })
    .then(response => response.json())
    .then(data => {

      if(data['status'] === "success"){
        document.getElementById('no-data-view-modal-content').style.display = "none";
        document.getElementById('view-modal-content').style.display = "block";
        document.getElementById('view-modal-content').innerHTML = data['data'];
      }else{

        $("#view-leave-modal").modal("hide");  
        document.getElementById('view-modal-content').style.display = "none";
        document.getElementById('no-data-view-modal-content').style.display = "block";
        document.getElementById('view-modal-content').innerHTML = "";

        liveToast.style.backgroundColor = "#FECDD3";
        liveToast.style.color = 'red';
        document.getElementById('toast-alert-message').innerHTML = data['message'];
        toastObject.show();
      }


    })
    .catch(error => {
      console.error("Error:", error);
    });

}