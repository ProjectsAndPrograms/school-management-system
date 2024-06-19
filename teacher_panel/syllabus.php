<?php include('partials/_header.php') ?>

<!-- upload syllabus label-->
<div class="modal" style="z-index: 2000;" id="upload-syllabus" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Syllabus</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="uploadSyllabusForm" novalidate>
                <div class="modal-body">
                    <div class="container">

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Class</label>
                            <div class="col-auto">
                                <select class="form-select" aria-label="Default select example" id="syllabus-class"
                                    name="class" required>
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

                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Subject</label>
                            <select class="form-select" aria-label="Default select example" id="subjectList"
                                name="subject" required>
                            </select>
                            <div id="validationServer04Feedback" class="invalid-feedback">
                                Please select a valid Subject.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload pdf file</label><small class="small">&nbsp;(max-size 200MB)</small>
                            <input class="form-control" type="file" id="formFile" name="file"
                                accept=".pdf, .png, .jpg, .jpeg" required>
                            <div class="invalid-feedback">Please choose a valid file.</div>
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
                    <button type="button" class="btn btn-primary" id="uploadSllybusBtn">
                        <div><i class='bx bxs-cloud-upload'></i></i><span> Upload</span></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of upload syllabus label-->
<!-- upload syllabus label when only file is needed-->
<div class="modal" style="z-index: 2000;" id="upload-syllabus-onlyFile" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Syllabus</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="change-syllabus-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">

                        <div class="mb-3">
                            <label for="formFile" class="form-label">Upload pdf file</label><small class="small">&nbsp;(max-size 200MB)</small>
                            <input class="form-control" type="file" id="changeFormFile" accept=".pdf, .png, .jpeg, .jpg"
                                required>
                            <div class="invalid-feedback">Please choose a valid file!</div>
                        </div>
                    </div>

                    <div class="container">
                    <div class="progress-box mb-0" style="height: 15px;">
                        <div class="progress-bar-hider" id="change-file-progress-hider">
                            <div class="progress" role="progressbar" aria-label="Animated striped example"
                                aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                    id="change-file-progress-pointer">
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="upload-new-syllabus">
                        <div><i class='bx bxs-cloud-upload'></i></i><span> Upload</span></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of upload syllabus label  when only file is needed-->
<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="6" id="checkFileName">
<!-- End of Sidebar -->



<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Syllabus</h1>
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
                                <h3>Syllabus </h3>

                                <a class="upload-syllabus" id="openUploadDialog">
                                    <i class='bx bx-cloud-upload'></i>
                                    <span>Upload Syllabus</span>
                                </a>
                            </div>

                            <hr><br>
                            <div class="container" style="display: flex;">

                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Class </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example" name=""
                                            id="selected-class">
                                           <!--  <option selected>12</option>
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

                            <div class="container">
                                <br>
                                <a class="find" id="find-btn">
                                <i class='bx bx-search-alt'></i>
                                    <span>Find</span>
                                </a>
                            </div>

                            <!-- Attendence on Specific date  -->
                            <div class="container">
                                <br>
                                <!-- Take attendence -->
                                <div class="attendenceTable" style="display: block;">

                                    <hr class="text-danger">
                                    <!--table-->
                                    <div class="syllabus-table">
                                        <table>
                                            <tr>
                                                <th scope="col" class="thead col-3">#</th>
                                                <th scope="col" class="thead col-3">Subject</th>
                                                <th scope="col" class="thead col-6">Syllabus</th>
                                            </tr>

                                            <tbody id="sllyabusTable">

                                            </tbody>

                                        </table>
                                    </div>
                                    <div id="dataNotAvailable">

                                        <div class="_flex-container box-hide">

                                            <div class="no-data-box">
                                                <div class="no-dataicon">
                                                    <i class='bx bx-data'></i>
                                                </div>
                                                <p>No Data</p>
                                            </div>
                                        </div>

                                    </div>
                                    <!--END table-->
                                </div>
                                <hr class="text-danger">



                            </div>
                            <!-- Attendence on Specific date  -->

                        </div>
                    </div>


                </div>

            </div>


        </div>

    </main>

</div>

<script src="../assets/js/sllyabus.js"></script>
<?php include('partials/_footer.php'); ?>