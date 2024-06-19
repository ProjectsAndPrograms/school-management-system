<?php include('partials/_header.php') ?>

<!-- start offcanvas marks table  -->
<div class="offcanvas offcanvas-end" tabindex="-1" id="markSheerOffcanvas" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasRightLabel"> <i class='bx bx-list-ul'></i> &nbsp;Students Result List
        </h5>
        <button type="button" id="closeExamMarkTable" class="close mr-2"><i class='bx bx-x'></i></button>
    </div>
    <div class="offcanvas-body scrollable" style="height: 100%;min-height: max-content;overflow-y: scroll;">
        <div>
            <div class="students-table">
                <table class="table table-bordered table-striped border-success">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Roll No.</th>
                            <th scope="col">Name</th>
                            <th scope="col">Obtained</th>

                        </tr>
                    </thead>
                    <tbody id="resultTable">


                    </tbody>
                </table>
            </div>

            <div class="dataNotAvailable" id="noMarksAvailable">

                <div class="_flex-container box-hide">

                    <div class="no-data-box">
                        <div class="no-dataicon">
                            <i class='bx bx-data'></i>
                        </div>
                        <p>No Record</p>
                    </div>
                </div>

            </div>
            <br><br><br>
        </div>

    </div>
</div>
<!-- end offcanvas marks table -->



<!--add new student model -->

<div class="modal" style="z-index: 2000;" id="addStudentModel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Upload Result</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i class='bx bx-x'></i></button>
            </div>

            <form class="needs-validation" id="create-exam-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">



                        <div class="mb-3">
                            <label for="title" class="form-label">Exam Title</label>
                            <input type="text" class="form-control" id="exam-title" name="title" aria-describedby="emailHelp" required>
                            <div class="invalid-feedback invalid-exam-title">
                                Please choose a exam Title.
                            </div>
                        </div>




                        <div class="row mb-3" style="">
                            <div class="col-md-6">
                                <label for="class" class="form-label">Class</label>
                                <select class="form-select" aria-label="Default select example" id="exam-class" name="class" style="width: 100% !important" required>
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
                                <div class="invalid-feedback invalid-exam-class">
                                    Please choose a exam class.
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="section" class="form-label">Section</label>
                                <select class="form-select" aria-label="Default select example" id="exam-section" name="section" style="width: 100% !important" required>
                                    <option selected>A</option>
                                    <option>B</option>
                                    <option>C</option>
                                </select>
                                <div id="validationServer04Feedback" class="invalid-feedback invalid-exam-section">
                                    Please select a exam Subject.
                                </div>
                            </div>
                        </div>



                        <div class="row mb-3" style="">
                            <div class="col-md-6">
                                <label for="total" class="form-label">Total Marks</label>
                                <input type="number" class="form-control" id="total-marks" name="total" aria-describedby="emailHelp" required>
                                <div class="invalid-feedback invalid-total-marks">
                                    Invalid Total marsks!
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label for="passing" class="form-label">Passing Marks</label>
                                <input type="number" class="form-control" id="passing-marks" aria-describedby="emailHelp" name="passing">
                                <div class="invalid-feedback invalid-passing-marks">
                                    Invalid Passing marks!
                                </div>
                            </div>

                            <div class="invalid-feedback passingGreaterTotalError">
                                passing marks must less than total marks!
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject</label>
                            <select class="form-select" name="subject" id="exam-subject-list" aria-label="Default select example" required>

                            </select>
                            <div class="invalid-feedback invalid-exam-subject-list">
                                Please select exam subject.
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="continue-btn">
                        <div><i class='bx bxs-chevrons-right'></i><span>Continue</span></div>
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>



<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="10" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Marks</h1>
                <!-- <ul class="breadcrumb">
                    <li><a href="#">
                        </a></li>
                </ul> -->
            </div>

        </div>
        <div class="bottom-data">

            <div class="orders">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Upload Marks</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link view-marks-tab" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">View
                            Marks</button>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                        <br>
                        <!-- Take attendence -->
                        <div class="attendenceTable" style="display: block;">
                            <div class="header">
                                <i class='bx bx-receipt'></i>
                                <h3>Upload Marks</h3>
                                <div class="student-btns">

                                    <a class="add-btns"> <i class='bx bx-filter'></i></a>

                                </div>
                            </div>
                            <hr>


                            <div class="container add-remove" id="uploadMarksJumboBtn">
                                <br>
                                <ul class="insights">
                                    <a class="addlink" data-bs-toggle="modal" data-bs-target="#addStudentModel" id="showUploadResultDialog">
                                        <li class="additem">
                                            <!-- <i class='bx bx-calendar-check'></i> -->
                                            <i class='bx bx-upload'></i>
                                            <span class="info">
                                                <h3>
                                                    Upload
                                                </h3>
                                                <h3>Marks</h3>
                                            </span>
                                        </li>
                                    </a>
                                    <!-- model add student -->


                                </ul>
                            </div>



                            <div class="container upload-marks-hider">
                                <br>
                                <!-- Take attendence -->
                                <form class="needs-validation" id="upload-marks-form" novalidate>
                                    <div class="attendenceTable" style="display: block;">
                                        <div class="header">
                                            <i class='bx bx-list-ul'></i>
                                            <h3 id="class-section"></h3>


                                            <button type="button" class="btn btn-info" id="backToDialogBtn">Back</button>

                                        </div>
                                        <hr class="text-danger">
                                        <!--table-->
                                        <div class="students-table">
                                            <table class="remove-cursor-pointer remove_hover_table">
                                                <thead id="UploadTableHead">
                                                    <tr>
                                                        <th scope="col" class="thead col-1">#</th>
                                                        <th scope="col" class="thead col-2">Roll no</th>
                                                        <th scope="col" class="thead col-4">Name</th>
                                                        <th scope="col" class="thead col-2">Total Marks</th>
                                                        <th scope="col" class="thead col-2">Obtained Marks</th>
                                                    </tr>
                                                </thead>

                                                <tbody id="UploadTable">

                                                </tbody>
                                            </table>
                                        </div>
                                        <!--END table-->
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


                                    <hr>

                                    <div class="_flex-container">
                                        <button class="btn btn-success" id="save-marks-btn"> <i class='bx bxs-edit'></i>&nbsp;&nbsp;&nbsp;Save</button>
                                    </div>
                                </form>

                            </div>
                            <br>
                            <hr>
                        </div>


                        <!-- end of Take attendence -->
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="showAttendence">
                            <br>
                            <div class="header">
                                <i class='bx bx-receipt'></i>
                                <h3 id="h11">Information </h3>

                            </div>
                            <br>
                            <div class="container" style="display: flex;">

                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">&nbsp;Class&nbsp; </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example" name="class" id="examClass_find">
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
                            <br>
                            <div class="container" style="display: flex;">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Section </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example" name="section" id="examSection_find">
                                            <option selected>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="container" style="display: flex;">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Session </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example" name="section" id="select-session">

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="container">
                                <a class="find" id="exam_findBtn">
                                    <i class='bx bx-search-alt'></i>
                                    <span>Find</span>
                                </a>

                            </div>
                            <br>


                            <hr>

                            <br>
                            <div class="header">
                                <i class='bx bx-receipt'></i>
                                <h3>Exams</h3>

                            </div>

                            <hr>
                            <!-- <div class="accordion exam-titles"> -->
                            <div class="accordion accordion-flush" id="Exam-Titles">

                            </div>
                            <!-- </div> -->


                            <div class="dataNotAvailable" id="noRecordAvailable">

                                <div class="_flex-container box-hide">

                                    <div class="no-data-box">
                                        <div class="no-dataicon">
                                            <i class='bx bx-data'></i>
                                        </div>
                                        <p>No Record</p>
                                    </div>
                                </div>

                            </div>
                            <hr>


                        </div>
                    </div>


                </div>

            </div>


        </div>

    </main>

</div>
<span id="hiddenBOX" style="display:none;width:0px;height:0px;"></span>



<script src="../assets/js/marks.js"></script>
<?php include('partials/_footer.php'); ?>