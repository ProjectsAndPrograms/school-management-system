<?php include('partials/_header.php') ?>

<!-- confirm edit alert modal-->
<div class="modal fade" id="edit-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to Edit this subject?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirm-edit-btn">Edit</button>
            </div>
        </div>
    </div>
</div>
<!-- end of onfirm edit alert modal-->

<!-- alert to delete subject  -->
<div class="modal fade" id="delete-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to delete this Subject?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteSubject()">Delete</button>
            </div>
        </div>
    </div>
</div>
<!-- end of alert to delete subject -->

<!-- add subject modal-->
<div class="modal modal-md" style="z-index: 2000;" id="add-subject" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Subject</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="create-subject-form" novalidate>
                <div class="modal-body">
                    <div class="container my-3">

                        <div class="mb-3">
                            <label for="class" class="form-label">Class</label>
                            <select class="form-select" aria-label="Default select example" name="class" id="class"
                                required>
                                <!-- <option selected disabled value="">--select--</option>
                                <option>12</option>
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
                                <option>ukg</option>
                            </select> -->
                            <?php include('partials/select_classes.php') ?>
                            <div class="invalid-feedback">
                                Please select class.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label">Subject Name</label>
                            <input type="text" class="form-control" name="subject" id="newSubjectName"
                                aria-describedby="emailHelp" required>
                            <div class="invalid-feedback">
                                This field can't be empty!
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="add-subject-btn">
                        <div><i class='bx bx-book-add'></i>&nbsp;&nbsp;<span>Add</span></div>
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- end of upload syllabus label-->

<!-- edit uploaded notes -->
<div class="modal modal-md" style="z-index: 2000;" id="edit-subject" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Subject</h1>
                <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                        class='bx bx-x'></i></button>
            </div>
            <form class="needs-validation" id="editSubjectForm" novalidate>
            <div class="modal-body">
                <div class="container my-3">




                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject Name</label>
                        <input type="text" class="form-control" id="subject-edited-name"  name="subject" aria-describedby="emailHelp" required>
                        <div class="invalid-feedback">
                                Please select class.
                            </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">

                <button type="button" class="btn btn-primary" id="save-new-subject-name">
                    <div><span>Save</span></div>
                </button>

            </div>
        </form>
        </div>
    </div>
</div>
<!-- end of edit uploaded notes-->
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
                <h1>Subjects</h1>
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
                                <h3>Subjects </h3>
                                <a href="#" class="add" data-bs-toggle="modal" data-bs-target="#add-subject"
                                    onclick="removeValidations()">
                                    <i class='bx bx-plus'></i>
                                    <span>Add</span>
                                </a>
                            </div>

                            <hr><br>
                            <div class="container" style="display: flex;">

                                <div class="row g-3 align-items-center">
                                    <div class="col-auto">
                                        <label for="class" class="col-form-label">Class </label>
                                    </div>
                                    <div class="col-auto">
                                        <select class="form-select" aria-label="Default select example" name="class"
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
                            <div class="container">
                                <a class="find" id="find-btn">
                                <i class='bx bx-search-alt'></i>
                                    <span>Find</span>
                                </a>
                            </div>


                            <hr class="text-danger">

                            <div class="container">
                                <br>
                                <!-- Take attendence -->
                                <div class="attendenceTable" style="display: block;">
                                    <div class="header">
                                        <i class='bx bx-list-ul'></i>
                                        <h3 id="subject-table-header">Class 12 Subjects</h3>





                                    </div>

                                    <hr class="text-danger">
                                    <!--table-->
                                    <div class="students-table subject-table">
                                        <table>
                                            <thead>
                                                <tr>
                                                    <th scope="col" class="thead col-4">#</th>
                                                    <th scope="col" class="thead col-5">Subject</th>
                                                    <th scope="col" class="thead col-3">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody id="subject-table-body">

                                            </tbody>
                                        </table>
                                    </div>
                                    <!--END table-->
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
                                </div>



                            </div>

                            <hr class="text-danger">
                        </div>
                    </div>


                </div>

            </div>


        </div>

    </main>

</div>


<script src="../assets/js/subjects.js"></script>
<?php include('partials/_footer.php'); ?>