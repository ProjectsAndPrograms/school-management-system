<?php include('partials/_header.php') ?>



<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="5" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Attendence</h1>
                <ul class="breadcrumb">
                    <li><a href="#">

                        </a></li>

                </ul>
            </div>

        </div>
        <div class="bottom-data">

            <div class="orders">

                <!-- Nav tabs -->
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active " id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                            type="button" role="tab" aria-controls="home" aria-selected="true">Take
                            Attendence</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link showAttendenceBtn" id="profile-tab" data-bs-toggle="tab"
                            data-bs-target="#profile" type="button" role="tab" aria-controls="profile"
                            aria-selected="false">Date Wise
                            Attendence</button>
                    </li>

                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane attendenceTableContainer active" id="home" role="tabpanel"
                        aria-labelledby="home-tab" tabindex="0">
                        <br>
                        <!-- Take attendence -->
                        <div class="attendenceTable" style="display: block;">
                            <div class="header">
                                <i class='bx bx-receipt'></i>
                                <h3>Show Attendence </h3>
                                <i class='bx bx-filter'></i>
                            
                            </div>


                            <hr><br>

                            <div class="container" style="display: flex;">

                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">&nbsp;Class&nbsp; </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example" name="class"
                                            id="classTakeAttendence">
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
                            <div class="container" style="display: flex;">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Section </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example" name="section"
                                            id="sectionTakeAttendence">
                                            <!-- <option selected>A</option>

                                            <option>B</option>
                                            <option>C</option> -->
                                            <?php include('partials/selelct_section.php') ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="container">
                                <a class="find" id="findForAttendence">
                                <i class='bx bx-search-alt'></i>
                                    <span>Find</span>
                                </a>

                            </div>
                            <br>

                            <hr><br>
                            <div class="header">
                                <i class='bx bx-receipt'></i>
                                <h3>Student List </h3>




                                <div class="dropdown dropdown-center">
                                    <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                        <i class='bx bx-filter'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item reset-attendence">Reset Attendence</a></li>
                                        <li><a class="dropdown-item submit-attendence" id="submit_attendence_dropdown" >Submit Attendence</a></li>
                                    </ul>
                                </div>
                            </div>



                            <hr>
                            <!--table-->
                            <table>
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Roll No.</th>
                                        <th>&nbsp;&nbsp;Name</th>
                                        <th>Total Days</th>
                                        <th>Present</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody id="takeAttendenceTable">

                                   

                                </tbody>
                            </table>
                            <!--END table-->

                            <div id="dataNotAvailable">

                                <div class="_flex-container box-hide">

                                    <div class="no-data-box">
                                        <div class="no-dataicon" id="no-data-icon">

                                        </div>
                                        <p id="no-data-msg"></p>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <hr>

                        <div id="buttons">
                        <div class="d-grid gap-2 d-md-flex justify-content-md-end" id="bottom-btns">
                            <button type="button" class="btn btn-outline-warning" id="reset-attendence-btn">&nbsp;&nbsp;Reset&nbsp;&nbsp;</button>
                            <button type="button" class="btn btn-outline-success" id="submit-attendence-btn">Submit</button>
                        </div>
                    </div>


                        <!-- end of Take attendence -->
                    </div>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="showAttendence">
                            <br>
                            <div class="header">
                                <i class='bx bx-receipt'></i>
                                <h3>Information </h3>

                                <div class="limit">
                                    <div class="row g-3 align-items-center">


                                    </div>
                                </div>

                            </div>
                            <hr>
                            <br>

                            <div class="container" style="display: flex;">

                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">&nbsp;Class&nbsp; </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example"
                                            id="showAttendenceClass">
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
                            <div class="container" style="display: flex;">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6" class="col-form-label">Section </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example"
                                            id="showAttendenceSection">
                                            <!-- <option selected>A</option>
                                            <option>B</option>
                                            <option>C</option> -->
                                            <?php include('partials/selelct_section.php') ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="container" style="display: flex;">
                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="inputPassword6"
                                            class="col-form-label">Date&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </label>
                                    </div>
                                    <div class="col-auto">
                                        <input type="date" class="form-control" style="width: 400px;" id="dateInput"
                                            aria-describedby="emailHelp" data-date-format="DD MMMM YYYY">

                                        <div class="invalid-feedback invalid-date" id="edit-invalid-file">
                                            Please choose date here!
                                        </div>


                                    </div>
                                </div>
                            </div>

                            <br>

                            <div class="container">
                                <a class="find" id="find-attendence-btn">
                                <i class='bx bx-search-alt'></i>
                                    <span>Find</span>
                                </a>

                            </div>
                            <hr>
                            <!-- Attendence on Specific date  -->
                            <div class="container">
                                <br>
                                <!-- Take attendence -->
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-receipt'></i>
                                        <h3>Attendence Sheet</h3>

                                        <!-- <a href="#" class="excel">
                                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                            <span>EXCEL</span>
                                        </a>

                                        <a href="#" class="report">
                                            <i class='bx bxs-file-pdf'></i>
                                            <span>PDF</span>
                                        </a> -->

                                    </div>
                                    <hr class="text-danger">
                                    <!--table-->
                                    <table>
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Roll No.</th>
                                                <th>&nbsp;&nbsp;Name</th>
                                                <th>Attendence</th>
                                            </tr>
                                        </thead>
                                        <tbody id="showAttendenceTableBody">

                                        </tbody>
                                    </table>
                                    <div id="boxForNoData">

                                    </div>
                                    <!--END table-->
                                </div>
                                <hr class="text-danger">

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary" id="prevBtn">prev</button>
                                        <a class="btn btn-secondary disabled" role="button" aria-disabled="true"
                                            id="pageCount">1</a>
                                        <button type="button" class="btn btn-secondary" id="nextBtn">next</button>
                                    </div>
                                </div>


                            </div>
                            <!-- Attendence on Specific date  -->

                        </div>
                    </div>


                </div>

            </div>


        </div>

    </main>

</div>

<script src="../assets/js/attendenceShowToAdmin.js"></script>
<!-- <script src="../assets/js/attendence.js"></script> -->

<?php include('partials/_footer.php'); ?>