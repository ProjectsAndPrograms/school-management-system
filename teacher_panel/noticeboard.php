<?php include('partials/_header.php') ?>




<!-- show full notice  -->

<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
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
                    <p id="showFullbody"></p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- end of sho full notice -->



<div class="modal" style="z-index: 2000;" id="edit-notice" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Notice</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="edit-notice-form" novalidate>
                <div class="modal-body">

                    <div class="m-3">
                        <div class="noticeform">
                            <div class="mb-3">
                                <label for="title" class="form-label">Notice
                                    Title</label>
                                <input type="text" class="form-control" id="edit-notice-title" name="title"
                                    placeholder="title of notice" required>
                                <div class="invalid-feedback" id="edit-invalid-title">
                                    You must have to add Title!
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="body" class="form-label">Notice
                                    Body</label>
                                <textarea class="form-control" id="edit-notice-body" name="body" rows="5"></textarea>
                                <div class="invalid-feedback" id="edit-invalid-body">
                                    Either Notice Body or Any file is required!
                                </div>
                            </div>


                            <div class="mb-3">
                                <label for="file" class="form-label">Any file</label><br>
                                <div class="btn btn-primary upload-btn">
                                    <label for="upload-file">
                                        <i class='mt-1 bx bx-cloud-upload' style="cursor:pointer;"></i>
                                    </label>
                                    <input type="file" id="upload-file" class="edit-upload-file"
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



                            <div class="mb-3">
                                <label for="exampleFormControlTextarea1" class="form-label">Importance</label>

                                <div class="flex-container">
                                    <label class="importance-disks">
                                        <input type="radio" name="disks" value="1" id="edit-check1" checked>
                                        <span class="checkmark ch1"></span>
                                    </label>
                                    <label class="importance-disks">
                                        <input type="radio" name="disks" value="2"
                                            style="-webkit-text-fill-color: black;" id="edit-check2">
                                        <span class="checkmark ch2"></span>
                                    </label>
                                    <label class="importance-disks">
                                        <input type="radio" name="disks" value="3" id="edit-check3">
                                        <span class="checkmark ch3"></span>
                                    </label>
                                </div>
                            </div>




                        </div>
                    </div>

                </div>
                <div class="modal-footer">



                    <button type="button" class="btn btn-primary" id="edit-save-notice-btn">
                        <div><span> Save</span></div>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>



<div class="modal fade" id="edit-notice-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit notice</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Edit</button>
            </div>
        </div>
    </div>
</div>
<!-- edit notice  -->


<!-- end of edit notice -->
<div class="modal fade" id="delete-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to delete this Notice?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteNotice()">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="4" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Notice Board</h1>
            </div>
        </div>

        <!-- Body -->
        <div class="bottom-data">

            <div class="orders">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active " id="createNoticeTab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Create
                            Notice</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="show-notice-tab" data-bs-toggle="tab" data-bs-target="#profile"
                            type="button" role="tab" aria-controls="profile" aria-selected="false">Notice
                            Board</button>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <div class="container">
                            <br>
                            <!-- Take attendence -->

                            <form class="needs-validation" id="notice-form" novalidate>
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-receipt'></i>
                                        <h3>Create Notice </h3>
                                        <i class='bx bx-filter'></i>
                                        
                                    </div>
                                    <hr><br>
                                    <!-- create notice -->

                                    <div class="center-element">
                                    <div class="noticeform">
                                        <div class="mb-3">
                                            <label for="title" class="form-label">Notice
                                                Title</label>
                                            <input type="text" class="form-control" id="notice-title" name="title"
                                                placeholder="title of notice" required>
                                            <div class="invalid-feedback" id="invalid-title">
                                                You must have to add Title!
                                            </div>
                                        </div>
                                        <br>

                                        <div class="mb-3">
                                            <label for="body" class="form-label">Notice
                                                Body</label>
                                            <textarea class="form-control" id="notice-body" name="body"
                                                rows="4"></textarea>
                                            <div class="invalid-feedback" id="invalid-body">
                                                Either Notice Body or Any file is required!
                                            </div>
                                        </div>

                                        <br>
                                        <div class="mb-3">
                                            <label for="file" class="form-label">Any file</label>
                                            <input type="file" class="form-control" accept="*" id="notice-file"
                                                name="file">
                                            <p id="errorDisplay"></p>
                                            <div class="invalid-feedback" id="invalid-file">
                                                File is too large allowed limit is 200 MB!
                                            </div>

                                        </div>


                                        <br>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1"
                                                class="form-label">Importance</label>

                                            <div class="flex-container">
                                                <label class="importance-disks">
                                                    <input type="radio" name="disks" value="1" id="check1" checked>
                                                    <span class="checkmark ch1"></span>
                                                </label>
                                                <label class="importance-disks">
                                                    <input type="radio" name="disks" value="2" id="check2">
                                                    <span class="checkmark ch2"></span>
                                                </label>
                                                <label class="importance-disks">
                                                    <input type="radio" name="disks" value="3" id="check3">
                                                    <span class="checkmark ch3"></span>
                                                </label>
                                            </div>


                                        </div>

                                    </div>
                                    </div>
                                  




                                    <br>
                                    <!--end create notice-->
                                </div>

                                <div class="uploadbox" id="uploadbox">
                                    <div class="progress" id="progress-bar-box" role="progressbar"
                                        aria-label="Animated striped example" aria-valuenow="75" aria-valuemin="0"
                                        aria-valuemax="100">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            id="progress-indicator" style="width: 0%;"></div>
                                    </div>
                                </div>
                                <small id="status"></small>

                                <hr>
                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <button type="button" class="btn btn-outline-warning" id="reset-notice"
                                        onclick="cleanForm()">&nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
                                    <button type="button" class="btn btn-outline-success" id="post-notice">Post</button>
                                </div>
                            </form>
                            <!-- end of Take attendence -->
                        </div>
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="container">
                            <div>
                                <br>

                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-clipboard'></i>
                                        <h3>Notice Board</h3>
                                        <a href="noticeboard.php"><i style="font-size:30px;font-weight:bold;" class='bx bx-plus'></i></a>
                                    </div>
                                    <hr class="text-danger">

                                    <!--cards of notice-->

                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-2 row-cols-xl-3 row-cols-sm-1 g-4"
                                        id="notice-box">




                                    </div>

                                 
                                    <!-- end of card's of notice-->
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
                                <!-- Attendence on Specific date  -->

                            </div>
                        </div>

                    </div>
                </div>

            </div>


        </div>

        <!-- end of body -->

    </main>

</div>


<script src="../assets/js/notice.js"></script>
<?php include('partials/_footer.php'); ?>