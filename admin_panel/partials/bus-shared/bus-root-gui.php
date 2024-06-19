 <div class="d-flex justify-content-between">
     
       <div class="bus-selection mb-2">
         <select class="form-select select-bus" id="select-bus-for-root" aria-label="Default select example">
             <option selected disabled value="">--select--</option>
           
         </select>
         <small class="text-warning" id="loading-bus-select" style="display: none;user-select: none;">loading...</small>
     </div>

 <ul class="nav nav-pills mb-3 d-flex justify-content-right" id="pills-tab" role="tablist">
         <li class="nav-item" role="presentation">
             <button class="nav-link active px-2" id="view-root-tab" data-bs-toggle="pill" data-bs-target="#view-root" type="button" role="tab" aria-controls="view-root" aria-selected="true">VIEW</button>
         </li>
         <li class="nav-item" role="presentation">
             <button class="nav-link px-2" id="edit-root-tab" data-bs-toggle="pill" data-bs-target="#edit-root" type="button" role="tab" aria-controls="edit-root" aria-selected="false">EDIT</button>
         </li>
     </ul>

 </div>
 



 <div class="tab-content" id="pills-tabContent">

     <div class="tab-pane fade  show active" id="view-root" role="tabpanel" aria-labelledby="view-root-tab" tabindex="0">

         <div class="bus-root-gui" id="bus-root-view-mode">

         </div>

     </div>

     <div class="tab-pane fade" id="edit-root" role="tabpanel" aria-labelledby="edit-root-tab" tabindex="0">

         <div class="edit-bus-root">

             <div class="bus-root-gui" id="bus-root-edit-mode">

             </div>
         </div>

     </div>
 </div>

 <div class="dataNotAvailable" id="No-root-available">

     <div class="_flex-container box-hide">

         <div class="no-data-box">
             <div class="no-dataicon">
                 <i class='bx bxs-bus'></i>
             </div>
             <p>No Roots</p>
         </div>
     </div>
 </div>

 <!-- Modals -->

 <div class="modal fade" id="add-bus-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog  modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bus</h1>
                 <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
             </div>
             <form class="needs-validation" id="add-bus-form" novalidate>
                 <div class="modal-body">
                     <div class="px-2">
                         <div class="mb-3">
                             <label for="bus-title-new" class="form-label">Title</label>
                             <input type="text" class="form-control" id="bus-title-new" aria-describedby="emailHelp" name="bus-title" required>
                             <div class="invalid-feedback">
                                 required!
                             </div>
                         </div>

                         <div class="mb-3">
                             <label for="bus-number-new" class="form-label">Bus Number</label>
                             <input type="text" class="form-control" id="bus-number-new" aria-describedby="emailHelp" name="bus-number" required>
                             <div class="invalid-feedback">
                                 required!
                             </div>
                         </div>

                         <div class="mb-3">
                             <div class="row">
                                 <div class="col">
                                     <label for="driver-name-new" class="form-label">Driver Name</label>
                                     <input type="text" class="form-control" placeholder="Name" aria-label="First name" id="driver-name-new" name="driver-name" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                                 <div class="col">
                                     <label for="driver-contact-new" class="form-label">Contact</label>
                                     <input type="tel" class="form-control" placeholder="Contact" aria-label="Last name" id="driver-contact-new" name="driver-contact" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="mb-3">
                             <div class="row">
                                 <div class="col">
                                     <label for="helper-name-new" class="form-label">Helper Name</label>
                                     <input type="text" class="form-control" placeholder="Name" aria-label="First name" id="helper-name-new" name="helper-name" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                                 <div class="col">
                                     <label for="helper-contact-new" class="form-label">Conatct</label>
                                     <input type="tel" class="form-control" placeholder="Contact" aria-label="Last name" id="helper-contact-new" name="helper-contact" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                             </div>
                         </div>

                     </div>


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" id="add-bus-button" class="btn btn-primary">ADD</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <div class="modal fade" id="edit-bus-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog  modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5">Edit Bus</h1>
                 <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
             </div>
             <form class="needs-validation" id="update-bus-form" novalidate>
                 <div class="modal-body">
                     <div class="px-2">
                         <div class="mb-3">
                             <label for="bus-title-edit" class="form-label">Title</label>
                             <input type="text" class="form-control" id="bus-title-edit" aria-describedby="emailHelp" name="bus-title" required>
                             <div class="invalid-feedback">
                                 required!
                             </div>
                         </div>

                         <div class="mb-3">
                             <label for="bus-number-edit" class="form-label">Bus Number</label>
                             <input type="text" class="form-control" id="bus-number-edit" aria-describedby="emailHelp" name="bus-number" required>
                             <div class="invalid-feedback">
                                 required!
                             </div>
                         </div>

                         <div class="mb-3">
                             <div class="row">
                                 <div class="col">
                                     <label for="driver-name-edit" class="form-label">Driver Name</label>
                                     <input type="text" class="form-control" placeholder="Name" aria-label="First name" id="driver-name-edit" name="driver-name" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                                 <div class="col">
                                     <label for="driver-contact-edit" class="form-label">Contact</label>
                                     <input type="tel" class="form-control" placeholder="Contact" aria-label="Last name" id="driver-contact-edit" name="driver-contact" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                             </div>
                         </div>

                         <div class="mb-3">
                             <div class="row">
                                 <div class="col">
                                     <label for="helper-name-edit" class="form-label">Helper Name</label>
                                     <input type="text" class="form-control" placeholder="Name" aria-label="First name" id="helper-name-edit" name="helper-name" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                                 <div class="col">
                                     <label for="helper-contact-edit" class="form-label">Conatct</label>
                                     <input type="tel" class="form-control" placeholder="Contact" aria-label="Last name" id="helper-contact-edit" name="helper-contact" required>
                                     <div class="invalid-feedback">
                                         required!
                                     </div>
                                 </div>
                             </div>
                         </div>

                     </div>


                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" id="update-bus-btn" class="btn btn-primary">Update</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <div class="modal fade" id="add-bus-stop-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog  modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Add Bus Stop</h1>
                 <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
             </div>
             <form class="needs-validation" id="add-bus-stop-form" novalidate>
                 <div class="modal-body">
                     <div class="px-2">
                         <div class="mb-3">
                             <label for="stop-location-new" class="form-label">Location</label>
                             <input type="text" class="form-control" id="stop-location-new" aria-describedby="emailHelp" name="location" required>
                             <div class="invalid-feedback">
                                 required!
                             </div>
                         </div>
                         <div class="mb-3">

                             <label for="bus-title-edit" class="form-label">Arrival time</label>
                             <div class="input-group mb-3">
                                 <input type="text" id="arrival-time-new" class="form-control" name="arrival-time" disabled>

                                 <button class="btn btn-secondary border-0 d-flex align-items-center justify-content-center" type="button" id="new-arrival-toggler">
                                     <i class='bx bx-time-five'></i>
                                 </button>

                                 <div class="invalid-feedback" style="display: block;">

                                 </div>
                                 <div id="arrival-time-new-picker"></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" class="btn btn-primary" id="addBusStopButton">ADD</button>
                 </div>
             </form>
         </div>
     </div>
 </div>

 <div class="modal fade" id="edit-bus-stop-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Bus Stop</h1>
                 <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
             </div>
             <form class="needs-validation" id="edit-bus-stop-form" novalidate>
                 <div class="modal-body">
                     <div class="px-2">
                         <div class="mb-3">
                             <label for="stop-location-edit" class="form-label">Location</label>
                             <input type="text" class="form-control" id="stop-location-edit" aria-describedby="emailHelp" name="location" required>
                             <div class="invalid-feedback">
                                 required!
                             </div>
                         </div>
                         <div class="mb-3">

                             <label for="bus-title-edit" class="form-label">Arrival time</label>
                             <div class="input-group mb-3">
                                 <input type="text" id="arrival-time-edit" class="form-control" disabled aria-describedby="button-addon2" name="arrival-time">
                                 <button class="btn btn-secondary border-0 d-flex align-items-center justify-content-center" type="button" id="edit-arrival-toggler">
                                     <i class='bx bx-time-five'></i>
                                 </button>
                                 <div class="invalid-feedback">
                                     required!
                                 </div>
                                 <div id="arrival-time-edit-picker"></div>
                             </div>
                         </div>
                     </div>
                 </div>
                 <div class="modal-footer">
                     <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                     <button type="button" id="updateBusStopBtn" class="btn btn-primary">Update</button>
                 </div>
             </form>
         </div>
     </div>
 </div>


 <div class="modal fade" id="delete-bus-stop-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog  modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
             </div>
             <div class="modal-body">
                 <strong>Do you really want to delete this Bus Stop?</strong>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-danger" onclick="deleteBusStop()">Delete</button>
             </div>
         </div>
     </div>
 </div>

 <div class="modal fade" id="delete-bus-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog  modal-dialog-centered">
         <div class="modal-content">
             <div class="modal-header">
             </div>
             <div class="modal-body">
                 <strong>Do you really want to delete this Bus?</strong>
             </div>
             <div class="modal-footer">
                 <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                 <button type="button" class="btn btn-danger" onclick="deleteBus()">Delete</button>
             </div>
         </div>
     </div>
 </div>