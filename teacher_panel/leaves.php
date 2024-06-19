<?php include('partials/_header.php') ?>




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
                <h1>Leaves</h1>
                <ul class="breadcrumb">
                    <li><a href="#">

                        </a></li>

                </ul>
            </div>

        </div>




        <div class="container">
            <div class="row g-4">
                <div class="col-lg-5 col-md-6 col-sm-12 mb-30">
                    <div class="card" style="border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title mb-4">
                                <?php if (isset($_GET['id'])) {
                                    echo "Edit Leave";
                                } else {
                                    echo "New Leave";
                                }   ?>

                            </h5>

                            <?php if (!isset($_GET['id'])) { ?>
                                <div>
                                    <form class="needs-validation" id="leave-form" action="#" method="post">
                                        <div class="px-3">
                                            <div class="mb-3">
                                                <label for="leave-type" class="form-label">Leave Type</label>
                                                <select class="form-select" style="width: 100%;" name="leave-type" id="leave-type" required>
                                                    <option selected disabled value="">--select--</option>
                                                    <option>Casual Leave</option>
                                                    <option>Medical Leave</option>
                                                    <option>Maternity Leave</option>
                                                    <option>Marriage Leave</option>
                                                    <option>Paternity Leave</option>
                                                    <option>Other Leave</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    required!
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="leave-desc" class="form-label">Leave Description </label>
                                                <textarea class="form-control" name="leave-desc" id="leave-desc" rows="3" required></textarea>
                                                <div class="invalid-feedback">
                                                    required!
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="start-date" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" name="start-date" id="start-date" placeholder="dd/mm/yyyy" required>
                                                <div class="invalid-feedback start-date-invalid-feedback">
                                                    required!
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="end-date" class="form-label">End Date</label>
                                                <input type="date" class="form-control" name="end-date" id="end-date" placeholder="dd/mm/yyyy" required>
                                                <div class="invalid-feedback">
                                                    required!
                                                </div>
                                            </div>

                                            <div class="d-flex w-100 mt-4">
                                                <button type="submit" id="submit-leave-btn" class="btn btn-primary ms-auto submit-leave-btn">
                                                    SUBMIT
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                            <?php } else { 
                                error_reporting(1);
                                $id = $_GET['id'];
                                $fetchDataQuery = "SELECT * FROM `leaves` WHERE `leaves`.`s_no` = ? AND `leaves`.`sender_id`= ? AND `leaves`.`status` = ?;";
                                
                                $pending = "pending";
                                $stmt1 = mysqli_prepare($conn, $fetchDataQuery);
                                mysqli_stmt_bind_param($stmt1, "iss", $id , $uid, $pending);
                                mysqli_stmt_execute($stmt1);
                                $result1 = mysqli_stmt_get_result($stmt1);
                                
                                if(!mysqli_num_rows($result1) > 0){
                                    echo "<script>window.location = 'leaves.php';</script>";
                                    die();
                                }

                                $dataRow = mysqli_fetch_assoc($result1);
                                mysqli_stmt_close($stmt1);
                                
                                ?>
                                <div>
                                    <form class="needs-validation" id="leave-form" action="#" method="post">
                                        <div class="px-3">
                                            <div class="mb-3">
                                                <label for="leave-type" class="form-label">Leave Type</label>
                                                <select class="form-select" style="width: 100%;" name="leave-type" id="leave-type" required>
                                                    <option selected disabled value="">--select--</option>
                                                    <option  <?php selectdCheck($dataRow['leave_type'],'Casual Leave'); ?>>Casual Leave</option>
                                                    <option <?php selectdCheck($dataRow['leave_type'],'Medical Leave'); ?>>Medical Leave</option>
                                                    <option <?php selectdCheck($dataRow['leave_type'],'Maternity Leave'); ?>>Maternity Leave</option>
                                                    <option <?php selectdCheck($dataRow['leave_type'],'Marriage Leave'); ?>>Marriage Leave</option>
                                                    <option <?php selectdCheck($dataRow['leave_type'],'Paternity Leave'); ?>>Paternity Leave</option>
                                                    <option <?php selectdCheck($dataRow['leave_type'],'Other Leave'); ?>>Other Leave</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    required!
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="leave-desc" class="form-label">Leave Description </label>
                                                <textarea class="form-control" name="leave-desc" id="leave-desc" rows="3" required><?php echo $dataRow['leave_desc']; ?></textarea>
                                                <div class="invalid-feedback">
                                                    required!
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="start-date" class="form-label">Start Date</label>
                                                <input type="date" class="form-control" name="start-date" id="start-date" placeholder="dd/mm/yyyy"
                                                value="<?php echo  date('Y-m-d',strtotime($dataRow["start_date"])) ?>"
                                                required>
                                                <div class="invalid-feedback start-date-invalid-feedback">
                                                    required!
                                                </div>
                                            </div>
                                            <div class="mb-3">
                                                <label for="end-date" class="form-label">End Date</label>
                                                <input type="date" class="form-control" name="end-date" id="end-date" placeholder="dd/mm/yyyy" 
                                                value="<?php echo  date('Y-m-d',strtotime($dataRow["end_date"])) ?>"
                                                required>
                                                <div class="invalid-feedback">
                                                    required!
                                                </div>
                                            </div>

                                            <div class="d-flex w-100 mt-4">
                                            <input type="hidden" name="s_no" value="<?php echo $dataRow['s_no']; ?>">
                                                <button type="submit" class="btn btn-primary ms-auto submit-leave-btn">
                                                    UPDATE
                                                </button>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7 col-md-6 col-sm-12 mb-30">


                    <div class="card display-leave-card" style="border-radius: 10px;">
                        <div class="card-body">
                            <h5 class="card-title mb-4 d-flex align-items-center"><i class='bx bxs-hourglass-top'></i> Leaves</h5>

                            <div class="px-3" id="available-leaves">

                                <div class="accordion accordion-flush" id="leave-accordion">

                                </div>

                                <div class="d-grid gap-2 d-md-flex justify-content-md-end leave-pagination">
                                    <div class="btn-group" role="group" aria-label="Basic example">
                                        <button type="button" class="btn btn-secondary" id="prev-page-btn">prev</button>
                                        <a class="btn btn-secondary disabled" role="button" aria-disabled="true" id="page-number">1</a>
                                        <button type="button" class="btn btn-secondary" id="next-page-btn">next</button>
                                    </div>
                                </div>
                            </div>
                            <div class="dataNotAvailable" id="No-leaves">

                                <div class="_flex-container box-hide">

                                    <div class="no-data-box">
                                        <div class="no-dataicon">
                                            <i class='bx bxs-file'></i>
                                        </div>
                                        <p>No Leaves</p>
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


<div class="modal fade" id="delete-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you really want to delete this Leave?</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" onclick="deleteLeave()">Delete</button>
            </div>
        </div>
    </div>
</div>

<script src="../assets/js/teacher-leave.js"></script>
<?php include('partials/_footer.php'); ?>


<?php 
// helper function 
function selectdCheck($value1,$value2)
   {
     if ($value1 == $value2) 
     {
      echo 'selected="selected"';
     } else 
     {
       echo '';
     }
     return;
   }
?>






