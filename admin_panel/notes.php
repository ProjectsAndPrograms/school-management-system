<?php include('partials/_header.php') ?>

<!-- upload syllabus label-->
<div class="modal modal-md" style="z-index: 2000;" id="upload-notes" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Notes</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="uploadNotesForm" novalidate>

                <div class="modal-body">
                    <div class="container my-3">


                        <div class="row" style="">
                            <div class="col-md-5">
                                <label for="class" class="form-label">Class</label>
                                <select class="form-select" aria-label="Default select example" id="classOptions"
                                    name="class" style="width: 100% !important" required>
                                    <!-- <option selected>12</option>
                                    <option>11</option>
                                    <option>10</option>
                                    <option>9</option>
                                    <option>8</option>
                                    <option>7</option>
                                    <option>6</option>
                                    <option>5</option>
                                    <option>4</option>
                                    <option>3</option>
                                    <option>2</option>
                                    <option>1</option>
                                    <option>pg</option>
                                    <option>lkg</option>
                                    <option>ukg</option> -->
                                    <?php include('partials/select_classes.php') ?>
                                </select>
                            </div>

                            <div class="col-md-7">
                                <label for="subjectList" class="form-label">Subject</label>
                                <select class="form-select" aria-label="Default select example" id="subjectList"
                                    name="subject" style="width: 100% !important" required>
                                </select>
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    Please select a valid Subject.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="exampleInputEmail1" class="form-label">Title</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                name="title" required>
                            <div id="wrong-title" class="invalid-feedback">
                                Please select a valid Title.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                            <textarea class="form-control" id="Comment" rows="2" name="comment" required></textarea>
                            <div id="wrong-comment" class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="formFile" class="form-label">Upload file &nbsp; <small>(max-size
                                    200MB)</small></label>
                            <input class="form-control" type="file" id="formFile" name="file"
                                accept=".pdf, .png, .doc, .jpg, .jpeg, .zip, .tar, .gz" required>
                            <div id="wrong-comment" class="invalid-feedback file-size-error">
                            File is too large allowed limit is 200 MB!
                            </div>
                        </div>

                        <div class="progress-box mb-0" style="height: 15px;">
                            <div class="progress-bar-hider">
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-bar-striped progress-bar-animated"
                                        id="progress-pointer">
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="uploadNotes">
                        <div><i class='bx bxs-cloud-upload'></i>&nbsp;&nbsp;<span> Upload</span></div>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- end of upload syllabus label-->

<div class="modal fade" id="edit-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to Edit this Note?</strong>

                <br><br>
                <div class="progress-box mb-0" style="height: 15px;">
                            <div class="progress-bar-hider progress-bar-hider1">
                                <div class="progress" role="progressbar" aria-label="Animated striped example"
                                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                    <div class="progress-bar progress-pointer progress-bar-striped progress-bar-animated "
                                        id="progress-pointer">
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirm-edit-btn">Edit</button>
            </div>
        </div>
    </div>
</div>

<!-- alert to delete subject  -->
<div class="modal fade" id="delete-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to delete this Note?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteNote()">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- end of alert to delete subject -->
<!-- show notes info start-->
<div class="modal fade" id="showNotesInformation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="showFullTitle"></h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <div class="modal-body">
                <div class="container">
                    <p id="showFullComment"></p>
                    <br>


                </div>
            </div>
            <div class="modal-footer">
                <a class="btn btn-warning view-result-btn" target="_blank" id="view_file_btn">
                    <i class='bx bx-show-alt'></i> &nbsp;&nbsp;<span>View</span>
                </a>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- end of show notes info -->
<!-- edit uploaded notes -->
<div class="modal modal-md" style="z-index: 2000;" id="edit-uploaded-notes" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit uploaded notes</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            
            <form class="needs-validation" id="editNotesForm" novalidate>

                <div class="modal-body pb-0">
                    <div class="container my-3">


                        <div class="row" style="">
                            <div class="col-md-5">
                                <label for="class" class="form-label">Class</label>
                                <select class="form-select" aria-label="Default select example" id="editClassOption"
                                    name="class" style="width: 100% !important" required>
                                    <!-- <option selected>12</option>
                                    <option>11</option>
                                    <option>10</option>
                                    <option>9</option>
                                    <option>8</option>
                                    <option>7</option>
                                    <option>6</option>
                                    <option>5</option>
                                    <option>4</option>
                                    <option>3</option>
                                    <option>2</option>
                                    <option>1</option>
                                    <option>pg</option>
                                    <option>lkg</option>
                                    <option>ukg</option> -->
                                    <?php include('partials/select_classes.php') ?>
                                </select>
                            </div>

                            <div class="col-md-7">
                                <label for="subjectList" class="form-label">Subject</label>
                                <select class="form-select" aria-label="Default select example" id="editSubjectList"
                                    name="subject" style="width: 100% !important" required>
                                </select>
                                <div id="validationServer04Feedback" class="invalid-feedback">
                                    Please select a valid Subject.
                                </div>
                            </div>
                        </div>

                        <div class="mb-3 mt-3">
                            <label for="exampleInputEmail1" class="form-label">Title</label>
                            <input type="text" class="form-control editTitle" id="editTitle"
                                aria-describedby="emailHelp" name="title" required>
                            <div id="wrong-title" class="invalid-feedback">
                                Please select a valid Title.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="exampleFormControlTextarea1" class="form-label">Comment</label>
                            <textarea class="form-control edited-comment" id="Comment" rows="2" name="comment"
                                required></textarea>
                            <div id="wrong-comment" class="invalid-feedback">
                                This field is required.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="file" class="form-label">File</label><br>
                            <div class="btn btn-primary upload-btn" id="edit_upload_btn">
                                <label for="upload-file">
                                    <i class='mt-1 bx bx-cloud-upload' style="cursor:pointer;"></i>
                                </label>
                                <input type="file" class="new-upload-file" id="upload-file" name="file"
                                    class="edit-upload-file" accept=".pdf, .png, .doc, .jpg, .jpeg, .zip, .tar, .gz"
                                    style="display: none;width: 100%;">
                            </div>

                            <a class="mx-3" id="view-current-file" target="_blank">
                                <div class="btn btn-primary upload-btn edit-view-btn" id="edit-view-btn">

                                    <i class='mt-1 bx bx-show-alt' style="color: black;cursor:pointer;"></i>

                                </div>
                            </a>
                            <p id="edit-file-errorDisplay"></p>
                            <div class="invalid-feedback" id="edit-invalid-file">
                                File is too large allowed limit is 200 MB!
                            </div>

                        </div>
                        <div class="mt-3" style="display: flex; flex-direction: row-reverse;">
                            <small class="last-editor mb-0"></small>
                        </div>
                     

                    </div>
                </div>
                <div class="modal-footer pt-0">

              
                    <button type="button" class="btn btn-primary" id="editNote">
                        <div><i class='bx bxs-cloud-upload'></i>&nbsp;&nbsp;<span> Edit</span></div>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
<!-- end of edit uploaded notes-->
<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="9" id="checkFileName">
<!-- End of Sidebar -->



<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>
    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Notes</h1>
            </div>
        </div>
        <div class="bottom-data">

            <div class="orders">
                <!-- Tab panes -->
                <div class="tab-content">

                    <div class="tab-pane active" id="profile" role="tabpanel" aria-labelledby="profile-tab"
                        tabindex="0">
                        <div class="showAttendence">
                            <br>
                            <div class="header">
                                <i class='bx bx-receipt'></i>
                                <h3>Notes </h3>

                                <a class="upload-syllabus" id="showUploadDialog">
                                    <i class='bx bx-cloud-upload'></i>
                                    <span>Upload Notes</span>
                                </a>
                            </div>

                            <hr><br>
                            <div class="container" style="display: flex;">

                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Class </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example"
                                            id="notes-class">
                                            <!-- <option selected>12</option>
                                            <option>11</option>
                                            <option>10</option>
                                            <option>9</option>
                                            <option>8</option>
                                            <option>7</option>
                                            <option>6</option>
                                            <option>5</option>
                                            <option>4</option>
                                            <option>3</option>
                                            <option>2</option>
                                            <option>1</option>
                                            <option>pg</option>
                                            <option>lkg</option>
                                            <option>ukg</option> -->
                                            <?php include('partials/select_classes.php') ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="container">
                                <a class="find" id="find-notes-btn">
                                <i class='bx bx-search-alt'></i>
                                    <span>Find</span>
                                </a>
                            </div>


                            <hr class="text-danger">
                            <!-- Attendence on Specific date  -->
                            <div class="container">
                                <br>
                                <!-- Take attendence -->
                                <div class="attendenceTable" style="display: block;">

                                    <!--cards of notice-->

                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 row-cols-xl-4 row-cols-sm-2 g-4"
                                        id="notes">





                                    </div>
                                </div>
                                <!-- end of card's of notice-->
                            </div>
                            <!-- Attendence on Specific date  -->
                            <hr class="text-danger">

                            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn btn-light" id="prevBtn">prev</button>
                                    <a class="btn btn-secondary disabled" role="button" aria-disabled="true"
                                        id="pageNumber">1</a>
                                    <button type="button" class="btn btn-light" id="nextBtn">next</button>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>

            </div>


        </div>

    </main>

</div>

<script src="../assets/js/notes.js"></script>
<?php include('partials/_footer.php'); ?>