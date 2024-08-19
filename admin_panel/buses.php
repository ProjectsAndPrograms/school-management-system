<?php include('partials/_header.php') ?>
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="11" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Bus service</h1>
                <ul class="breadcrumb">
                    <li><a href="#">
                        </a></li>
                </ul>
            
            <div class="d-flex mx-3 mb-3" style="grid-gap: 10px; flex-wrap: wrap;">
            <button type="button" class="btn btn-primary" id="bus-request" data-bs-toggle="modal" data-bs-target="#exampleModal">
                <i class="fas fa-bus"></i> Bus Requests
                </button>

                <button type="button" class="btn btn-success" id="bus-request" data-bs-toggle="modal" data-bs-target="#exampleModal2">
                <i class="fas fa-bus"></i> Accepted Requests
                </button>
            </div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Request for bus</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body" id="request">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
    </div>
  </div>
</div>

<!-- Modal 2 -->
<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Requests Accepted by Admin</h1>
        
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="form-outline" style="margin-left: 20px; margin-right: 20px; margin-bottom: 20px;" data-mdb-input-init>
  <input type="search" id="search" class="form-control" placeholder="Search From Name or id " aria-label="Search" />
</div>
      <div class="modal-body" id="request-accept">
          
          
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
         </div>
    </div>
  </div>
</div>


            </div>

        </div>




        <div class="container display-buses-card">
            <div class="row g-4 bus-card-row">

                <div class="col col-lg-5 col-md-6 col-sm-12 mb-30">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title mb-4 d-flex align-items-center">
                                    <i class='bx bxs-bus me-1'></i>
                                    Buses
                                </h5>
                                <span id="open-add-bus-dailog"><i class='bx bx-plus icon-hover-circle'></i></span>
                            </div>

                            <div class="px-1">
                                <div class="accordion accordion-flush" id="accordion-bus-list">
                                 
                                </div>
                            </div>
                            <div class="dataNotAvailable" id="No-Buses">

                                <div class="_flex-container box-hide">

                                    <div class="no-data-box">
                                        <div class="no-dataicon">
                                            <i class='bx bxs-bus'></i>
                                        </div>
                                        <p>No Buses</p>
                                    </div>
                                </div>
                            </div>
                            <br>
                        </div>
                    </div>
                </div>

                <div class="col col-lg-7 col-md-6 col-sm-12 mb-30">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            <div class="d-flex justify-content-between">
                                <h5 class="card-title mb-4 d-flex align-items-center" id="busRootHeading">
                                    <i class='bx bxs-map me-1'></i>
                                    Bus Root
                                </h5>
                            </div>
                            
                            <?php include("partials/bus-shared/bus-root-gui.php"); ?>

                            <div class="dataNotAvailable" id="No-Bus-selected">

                                <div class="_flex-container box-hide">

                                    <div class="no-data-box">
                                        <div class="no-dataicon">
                                            <i class='bx bxs-bus-school'></i>
                                        </div>
                                        <p>No Bus Root</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br><br>
    </main>
</div>

<script type="text/javascript">
   $(document).ready(function(){
    $.ajax({
        url: "partials/bus-requests.php",
        method: "post",
        success: function(data){
            $("#request").html(data);
        }
    });
    $.ajax({
        url: "partials/load-bus.php",
        method: "post",
        success: function(data){
            $("#request-accept").html(data);
        }
    });
});

   
   document.getElementById("search").addEventListener("keyup", function() {
    var val = this.value; // Retrieve the value of the input field

    // Create a FormData object to send data to the server
    var formData = new FormData();
    formData.append("val", val);

    // Make a fetch request
    fetch("partials/search-bus.php", {
        method: "POST",
        body: formData // Set the body of the request to the FormData object
    })
    .then(response => response.text()) // Parse the response as text
    .then(data => {
        // Update the content of the element with the id "request-accept"
        document.getElementById("request-accept").innerHTML = data;
    })
    .catch(error => {
        console.error("Error:", error); // Log any errors to the console
    });
});


</script>
<script src="../assets/js/bus.js"></script>
<script src="js/date-picker.min.js"></script>
<script>
    const newArrival = new DatePicker({
        el: '#arrival-time-new-picker',
        toggleEl: '#new-arrival-toggler',
        inputEl: '#arrival-time-new',
        type: 'HOUR'
    });

    const editArrival = new DatePicker({
        el: '#arrival-time-edit-picker',
        toggleEl: '#edit-arrival-toggler',
        inputEl: '#arrival-time-edit',
        type: 'HOUR'
    });
</script>
<?php include('partials/_footer.php'); ?>