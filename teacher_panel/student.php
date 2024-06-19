<?php include('partials/_header.php') ?>

<!-- confirm edit alert modal-->
<div class="modal fade" id="edit-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to Edit Student Details?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirm-edit-btn">Edit</button>
            </div>
        </div>
    </div>
</div>
<!-- end of onfirm edit alert modal-->

<!-- alert to delete teacher  -->
<div class="modal fade" id="delete-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to delete Student?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteTeacherWithIdSeted()">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- end of alert to delete teacher -->
<!--add new student model -->


<div class="modal" style="z-index: 2000;" id="addTeacherModal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Student Details</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="general-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">
                        <div class="mb-3">
                            <label for="fullname" class="form-label">Full Name</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="First name"
                                        aria-label="First name" id="fname" name="fname" required>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name"
                                        aria-label="Last name" id="lname" name="lname" required>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                            </div>
                        </div>



                        <div class="mb-3">
                            <label for="father" class="form-label">Father name</label>
                            <input type="text" class="form-control" id="father" aria-describedby="emailHelp"
                                name="father" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="dob" aria-describedby="emailHelp"
                                        name="dob" required>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                                <div class="col-6 student-image">

                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="gender" name="gender" style="width:100%;" required>
                                        <option selected disabled value="">--select--</option>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="row">
                                <div class="col-6">
                                    <label for="class" class="form-label">Class</label>
                                    <select class="form-select" id="class" name="class" style="width:100%;" required>

                                        <!-- <option selected disabled value="">---select--</option>
                                        <option value="12">12</option>
                                        <option value="11">11</option>
                                        <option value="10">10</option>
                                        <option value="9">9</option>
                                        <option value="8">8</option>
                                        <option value="7">7</option>
                                        <option value="6">6</option>
                                        <option value="5">5</option>
                                        <option value="4">4</option>
                                        <option value="3">3</option>
                                        <option value="2">2</option>
                                        <option value="1">1</option>
                                        <option value="pg">pg</option>
                                        <option value="lkg">lkg</option>
                                        <option value="ukg">ukg</option> -->
                                        <?php
                                            $id = $_SESSION['uid'];
                                            $query = "SELECT * FROM teachers where id = '$id'";
                                            $result = mysqli_query($conn,$query);
                                            $row = mysqli_fetch_assoc($result);
                                            if($row["class"]=="12s"){
                                                echo '<option selected value="'.$row["class"].'">Class 12 Science</option>';
                                            }
                                            else if($row["class"]=="12c"){
                                                echo '<option selected value="'.$row["class"].'">Class 12 Commerce</option>';
                                            }
                                           
                                            else if($row["class"]=="11s"){
                                                echo '<option selected value="'.$row["class"].'">Class 11 Scinece</option>';
                                            }
                                            else if($row["class"]=="11c"){
                                                echo '<option selected value="'.$row["class"].'">Class 11 Commerce</option>';
                                            }
                                            
                                            else{
                                                echo '<option selected value="'.$row["class"].'">'.$row["class"].'</option>';
                                            }
                                         ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                                <div class="col-6">
                                    <label for="section" class="form-label">Section</label>
                                    <select class="form-select" id="section" name="section" style="width:100%;"
                                        required>
                                        <option selected disabled value="">--select--</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="C">C</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3" id="uploadImageField">
                            <div class="mb-3">
                                <label for="image" class="form-label">Photo</label>
                                <input class="form-control" type="file" id="uploadImage" name="image" placeholder="file"
                                    accept=".png, .jpeg, .jpg">

                            </div>

                        </div>


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="general-info-btn">
                        <div><i class='bx bxs-chevrons-right'></i><span> next</span></div>
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<!-- personal information -->
<div class="modal" style="z-index: 2000;" id="personalInformationModal" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Address Details</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="personal-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone number</label>
                            <input type="tel" class="form-control" id="phone" name="phone"
                                placeholder="Enter phone number" required>
                            <div class="valid-feedback">
                            </div>
                            <div class="invalid-feedback" id="phone-mdg">
                                Please enter a valid 10-digit phone number.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp"
                                name="email" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <input type="text" class="form-control" id="address" aria-describedby="emailHelp"
                                name="address" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">City</label>
                            <div class="row">
                                <div class="col">
                                <input type="text" class="form-control" id="city" aria-describedby="emailHelp"
                                name="city" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                                </div>
                                <div class="col">
                                <input type="text" class="form-control" id="zip" aria-describedby="emailHelp"
                                name="zip" placeholder="ZIP" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="state" class="form-label">State</label>
                            <select class="form-select" aria-label="Default select example" id="state" name="state"
                                required>
                                <option selected disabled value="">--select--</option>
                                <option value="Hariyana">Hariyana</option>
                                <option value="UP">UP</option>
                                <option value="Delhi">Delhi</option>
                                <option value="Panjab">Panjab</option>
                                <option value="Gujrat">Gujrat</option>
                            </select>
                            <div class="invalid-feedback">
                                required!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" onclick="backToStudentDetail()">
                        <div><i class='bx bxs-chevrons-left'></i><span>Back</span></div>
                    </button>
                    <button type="button" class="btn btn-primary" id="personal-info-btn">
                        <div><i class='bx bxs-chevrons-right'></i><span> next</span></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of personal information-->

<!-- Guardian information -->
<div class="modal" style="z-index: 2000;" id="guardian_information" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Emergency Contact Details</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="guradian-form" novalidate>
                <div class="modal-body">

                    <div class="container my-3">
                        <div class="mb-3">
                            <label for="guardian" class="form-label">Guardian name</label>
                            <input type="text" class="form-control" id="guardian" aria-describedby="emailHelp"
                                name="guardian" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gphone" class="form-label">Phone number</label>
                            <input type="tel" class="form-control" id="gphone" name="gphone"
                                placeholder="Enter phone number" required>
                            <div class="valid-feedback">
                            </div>
                            <div class="invalid-feedback" id="phone-g">
                                Please enter a valid 10-digit phone number.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="gaddress" class="form-label">Address</label>
                            <input type="text" class="form-control" id="gaddress" aria-describedby="emailHelp"
                                name="gaddress" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="city-info" class="form-label">City</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="City name"
                                        aria-label="First name" id="gcity" name="gcity" required>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Zip code"
                                        aria-label="Last name" id="gzip" name="gzip" requireds>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="mb-3">
                            <label for="relation" class="form-label">Relationship to Student</label>
                            <input type="text" class="form-control" id="relation" aria-describedby="emailHelp"
                                name="relation" required>
                            <div class="invalid-feedback">
                                required!
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" onclick="backToAddressDetail()">
                        <div><i class='bx bxs-chevrons-left'></i><span>Back</span></div>
                    </button>
                    <button type="button" class="btn btn-primary" id="guardian-form-btn"><span>Submit </span></button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of Guardian information-->


<!-- end of add new student model -->

<!-- Remove student model -->
<div class="modal removeTeacherModal" style="z-index: 2000;" id="removeStudentModel" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title text-danger fs-5" id="exampleModalLabel">Delete Student</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="remove-student-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">

                        <div class="mb-3">
                            <label for="student-id" class="form-label">Student ID</label>
                            <input type="text" class="form-control remove_student_id" id="student-id" aria-describedby="" required>
                            <div class="invalid-feedback">
                                Please provide a valid Student ID.
                            </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-danger" id="remove-student-btn">
                        <div><span>Delete Student</span></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- end of Remove student model -->

<!-- Sidebar -->
<?php include('partials/_sidebar.php') ?>
<input type="hidden" value="2" id="checkFileName">
<!-- End of Sidebar -->

<!-- Main Content -->
<div class="content">
    <!-- Navbar -->
    <?php include("partials/_navbar.php"); ?>

    <!-- End of Navbar -->

    <main>
        <div class="header">
            <div class="left">
                <h1>Students</h1>
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
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link active " id="addStudentTab" data-bs-toggle="tab" data-bs-target="#home" onclick="AddStudentBtnClick()" type="button" role="tab" aria-controls="home" aria-selected="true">Add Students</button>
                    </li>
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link" id="view-students-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" onclick="showStudents()">Show
                            Students</button>
                    </li>
                    <li class="nav-item me-1" role="presentation">
                        <button class="nav-link" id="feedback-students-tab" data-bs-toggle="tab" data-bs-target="#feedback" type="button" role="tab" aria-controls="feedback" aria-selected="false">Feedback</button>
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
                                <h3>Students</h3>
                                <div class="student-btns">

                                    <!-- <a class="add-btns"> <i class='bx bx-filter'></i></a> -->
                                    
                                    <div class="dropdown dropdown-center">
                                    <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                        <i class='bx bx-filter'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item reset-attendence" id="add_student_dropdown" data-bs-toggle="modal" data-bs-target="#addTeacherModal">Add Student</a></li>
                                        <li><a class="dropdown-item submit-attendence" id="remove_student_dropdown" data-bs-toggle="modal" data-bs-target="#removeStudentModel">Remove Student</a></li>
                                    </ul>
                                </div>

                                </div>
                            </div>
                            <hr>
                            <br>

                            <div class="container add-remove">
                                <ul class="insights">
                                    <a class="addlink" data-bs-toggle="modal" data-bs-target="#addTeacherModal"
                                        id="addTeacherButton">
                                        <li class="additem">
                                            <!-- <i class='bx bx-calendar-check'></i> -->
                                            <i class='bx bxs-user-plus'></i>
                                            <span class="info">
                                                <h3>
                                                    Add
                                                </h3>
                                                <h3>Student</h3>
                                            </span>
                                        </li>
                                    </a>
                                    <!-- model add student -->





                                    <!-- end of model add student -->

                                    <a class="removelink" id="remove-student-jumbo-btn" data-bs-toggle="modal" data-bs-target="#removeStudentModel">
                                        <li class="removeitem">
                                            <i class='bx bxs-user-minus'></i>
                                            <span class="info">
                                                <h3>
                                                    Remove
                                                </h3>
                                                <h3>Student</h3>
                                            </span>
                                        </li>
                                    </a>
                                </ul>
                            </div>

                            <br>
                            <hr>
                        </div>

                        <!-- end of Take attendence -->
                    </div>
                    <br>
                    <div class="tab-pane" id="profile" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                        <div class="showAttendence">
                            <br>
                            <div class="header">
                                <i class='bx bx-list-ul'></i>
                                <h3>Students List</h3>

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
                                            id="search-class">
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
                                            id="search-section">
                                            <option selected>A</option>
                                            <option>B</option>
                                            <option>C</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <br>

                            <div class="container">
                                <a class="find" onclick="findAndshowStudents()">
                                <i class='bx bx-search-alt'></i>
                                    <span>Find</span>
                                </a>

                            </div>
                            <br>
                            <hr>



                            <!-- Attendence on Specific date  -->
                            <div class="container">
                                <br>
                                <!-- Take attendence -->
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-list-ul'></i>
                                        <h3>Students List</h3>

                                        <!-- <a href="#" class="excel">
                                            <i class="fa fa-file-excel-o" aria-hidden="true"></i>
                                            <span>EXCEL</span>
                                        </a>

                                        <a href="#" class="report">
                                            <i class='bx bxs-file-pdf'></i>
                                            <span>PDF</span>
                                        </a> -->

                                        <div class="_flex-container">
                                        <input class="form-control me-2" type="search" placeholder="Search" style="max-width: 225px;height: 40px;" id="search-teacher-name"
                                            aria-label="Search">
                                        <button class="btn btn-success" type="button" id="searchTeacherByNameBtn" disabled><i class='bx bx-search-alt'></i></button>
                                    </div>

                                    </div>
                                    <hr class="text-danger">

                                    <div class="container" style="display: flex;">



                                     
                                    </div>
                                 

                                    <!--table-->
                                    <div class="students-table">
                                        <table class="remove-cursor-pointer">
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="thead col-2">#</th>
                                                    <th scope="col" class="thead col-2">Student ID</th>
                                                    <th scope="col" class="thead col-5">Name</th>
                                                    <th scope="col" class="thead col-3">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody id="teacher-table-body">
                                                <!-- content come form database -->
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

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary" id="prev-page-btn">prev</button>
                                        <a class="btn btn-secondary disabled" role="button" aria-disabled="true"
                                            id="page-number">1</a>
                                        <button type="button" class="btn btn-secondary" id="next-page-btn">next</button>
                                    </div>
                                </div>


                            </div>
                            <!-- Attendence on Specific date  -->

                        </div>
                    </div>

                    <div class="tab-pane" id="feedback" role="tabpanel" aria-labelledby="feedback-tab" tabindex="0">

                        <?php include('partials/student-shared/feedback-tab.php')  ?>

                    </div>

                </div>

            </div>


        </div>

    </main>


</div>


<script src="../assets/js/student.js"></script>
<?php include('partials/_footer.php'); ?>