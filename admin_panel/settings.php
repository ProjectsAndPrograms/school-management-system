
<?php include("../assets/noSessionRedirect.php"); ?>
<?php include("./verifyRoleRedirect.php"); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="icon" type="image/x-icon" href="images/1.png">
    <title>School Management</title>


    <link rel="icon" type="image/x-icon" href="../images/1.png">
    <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"> -->
    
    
    <link rel="stylesheet" href="css/bootstrap.css">


    <link href="https://unpkg.com/gijgo@1.9.14/css/gijgo.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css" />
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" />

    <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://unpkg.com/gijgo@1.9.14/js/gijgo.min.js" type="text/javascript"></script>

    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="settings-style.css">

</head>

<body>

<div class="modal fade" id="edit-confirmation-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog  modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body">
                <strong>Do you want to edit your profile.</strong>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                <button type="button" class="btn btn-danger" id="EditProfileBtn">Yes</button>
            </div>
        </div>
    </div>
</div>
 
<div class='toast-container position-fixed text-success bottom-0 end-0 p-3' style="z-index: 9000;">
    <div id='liveToast' class='toast' role='alert' aria-live='assertive' aria-atomic='true' style="color:black;">
    <div class='d-flex'>
      <div class='toast-body' id="toast-alert-message">
        
      </div>
      <button type='button' class='btn-close me-2 m-auto text-danger' data-bs-dismiss='toast' aria-label='Close'></button>
    </div>
    </div>
  </div>

    <!-- edit profile model -->
    <div class="modal" style="z-index: 2000;" id="edit-profile-model" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Profile</h1>
                    <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-x'></i></button>
                </div>

                <form class="needs-validation" id="editProfileForm" novalidate>
                <div class="modal-body">
                    <div class="container">
                    <div class="mb-2">
                            <label for="fullname" class="form-label">Full Name</label>
                            <div class="row">
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="First name"
                                        aria-label="First name" id="eidtFname" name="fname" required>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                                <div class="col">
                                    <input type="text" class="form-control" placeholder="Last name"
                                        aria-label="Last name" id="editLname" name="lname" required>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                            </div>
                        </div>

                       

                        <div class="mb-2">
                            <label for="editEmail" class="form-label">Email</label>
                            <input type="email" class="form-control" id="editEmail" name="email"
                                aria-describedby="emailHelp" required>

                                <div class="invalid-feedback">
                                        invalid email!
                                    </div>
                        </div>

                        <div class="mb-2">
                            <div class="row">
                                <div class="col-6">
                                    <label for="dob" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="editDOB" acceptaria-describedby="emailHelp"
                                        name="dob" required>
                                    <div class="invalid-feedback">
                                        required!
                                    </div>
                                </div>
                                <div class="col-6 student-image">

                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" id="editGender" name="gender" style="width:100%;" required>
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


                        <div class="mb-2">
                            <label for="editPhone" class="form-label">Phone Number</label>
                            <input type="tel" class="form-control" id="editPhone" name="phone"
                                placeholder="Enter phone number" required>
                            <div class="valid-feedback">
                            </div>
                            <div class="invalid-feedback" id="phone-mdg">
                                Please enter a valid 10-digit phone number.
                            </div>
                        </div>

                        <div class="mb-2">
                            <label for="editAddress" class="form-label">Address</label>
                            <textarea class="form-control" id="editAddress" name="address" rows="2" required></textarea>
                            <div class="invalid-feedback">
                                       this field can't be empty!
                                    </div>
                        </div>


                    </div>
                </div>
                <div class="modal-footer">

                    <button type="button" class="btn btn-primary" id="saveChangesBtn"></i><span>
                            <small>Save Changes</small></span>
                        </button>
                </div>

                </form>
            </div>
        </div>
    </div>
    </div>

    <!-- end of edit profile model-->

    <!--change pswd-->
    <div class="modal" style="z-index: 2000;" id="change-password" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Change Password</h1>
                    <button type="button" class="close mr-2" data-bs-dismiss="modal" aria-label="Close"><i
                            class='bx bx-x'></i></button>
                </div>
                <form class="needs-validation" id="changePasswordForm" novalidate>
                    <div class="modal-body">
                        <div class="container my-3">
                            <div class="mb-3">
                                <label for="currentPass" class="form-label">Current Password</label>
                                <input type="text" class="form-control" id="currentPass" name="currentPassword" required>
                                <div class="invalid-feedback invalidCurrentPassword">
                                    required!
                                 </div>
                               
                            </div>

                            <div class="mb-3">
                                <label for="newPass" class="form-label">New Password</label>
                                <input type="text" class="form-control" id="newPass" name="newPassword" required>
                                <div class="invalid-feedback invalidNewPassword">
                                    required!
                                 </div>
                            </div>


                            <div class="mb-3">
                                <label for="confirmPass" class="form-label">Confirm Password</label>
                                <input type="text" class="form-control" id="confirmPass" name="confirmPassword " required>
                                <div class="invalid-feedback invalidConfirmPassword">
                                    required!
                                 </div>
                            </div>


                            <div class="invalid-feedback notSamePasswords">
                                    new Password and confirm password must be same!
                                 </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="button" class="btn btn-primary" id="savePasswordBtn">
                            <div><i class='bx bxs-chevrons-right'></i><span> Save</span></div>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- end of change password-->

    <!-- Sidebar -->
    <?php include('partials/_sidebar.php') ?>
    <input type="hidden" value="12" id="checkFileName">
    <!-- End of Sidebar -->

    <!-- Main Content -->
    <div class="content">
        <!-- Navbar -->
        <?php include("partials/_navbar.php"); ?>

        <!-- End of Navbar -->

        <main>
            <div class="header">
                <div class="left">
                    <h1>Settings</h1>
                    <ul class="breadcrumb">
                        <li><a href="#">

                            </a></li>

                    </ul>
                </div>

            </div>
            <div class="bottom-data">

                <div class="orders">



                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane active" id="home" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                            <br>
                            <!-- Take attendence -->
                            <div class="attendenceTable" style="display: block;">
                                <div class="header">
                                    <i class='bx bx-receipt'></i>

                                    <h3>Profile Settings</h3>
                                    <div class="student-btns">

                                    <div class="dropdown dropdown-center">
                                    <a class="notif" data-bs-toggle="dropdown" aria-expanded="false" id="dropDownListForSubmit">
                                        <i class='bx bx-filter'></i>
                                    </a>

                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item submit-attendence" id="remove_pic" onclick="removeProfilePic()">Remove Profile Picture</a></li>
                                        <li><a class="dropdown-item reset-attendence" id="_change_password" >Change Password</a></li>
                                        <li><a class="dropdown-item reset-attendence" id="_change_profile" >Edit Profile</a></li>
                                    </ul>
                                </div>
                                    </div>
                                </div>
                                <hr>
                                <!-- general profile settinds -->


                                <div class="container p-0">
                                    <div class="row">
                                        <div class="col-md-5 col-xl-4">

                                            <div class="card">
                                                <div class="card-header" id="settings-card-header">
                                                    <h5 class="card-title mb-0">Profile Image</h5>
                                                </div>


                                                <div class="text-center mt-3 mb-3">

                                                    <div id="profileImageBox">
                                                    <img alt="Profile Pic" src="../images/user.png" class="rounded-circle img-responsive mt-2" width="128" height="128" id="profile-image-user">
                                                    </div>
                                                    <div class="mt-1 btn-container">
                                                        <div class="btn btn-primary upload-btn" style="cursor: default;">
                                                            <label for="upload-file">
                                                                <i class='bx bx-cloud-upload' style="cursor: pointer;"></i>
                                                            </label>
                                                            <input type="file" id="upload-file" style="display: none;width: 50px; height: 50px;cursor: pointer;" accept=".png, .jpeg, .jpg">
                                                        </div>

                                                    </div>
                                                    <small class="mb-3">For best results, use an image at
                                                        least 128px by 128px in .jpg
                                                        format</small>
                                                    <br>
                                                </div>
                                                <div class="list-group list-group-flush" role="tablist">

                                                </div>
                                            </div>

                                            <div class="setting-function-btns mt-8 mb-5">
                                                 <button class="btn btn-primary mb-3"  id="passwordDialogBtn" ><i
                                                            class='bx bxs-key'></i>&nbsp;<div>Change Password</div>
                                                        </button>

                                                 <button class="btn btn-primary mb-3" 
                                                 id="showEditDialogBtn"> <i
                                                            class='bx bx-edit-alt'></i>&nbsp;Edit Profile</button>
                                            </div>
                                        </div>

                                        <div class="col-md-7 col-xl-8 ">

                                            <div class="card" id="profile-data">
                                                <div class="card-header" id="settings-card-header">
                                                    <h5 class="card-title mb-0">Profile info</h5>
                                                </div>
                                                <div class="card-body">
                                                    <form>
                                                        <div class="row">
                                                            <div class="col-md-10">
                                                                
                                                                
                                                                   <div class="user-info ">
                                                                    <h4 class="_flex-container"> <i class='bx bxs-cuboid'></i>&nbsp;&nbsp;UID </h4>
                                                                    <h3>-</h3>
                                                                    <p id="teacher_id">_ _ _ _</p>
                                                                </div>

                                                                <div class="user-info ">
                                                                    <h4 class="_flex-container"> <i class='bx bxs-user-rectangle'></i> &nbsp;&nbsp;Name</h4>
                                                                    <h3>-</h3>
                                                                    <p id="userName">_ _ _ _</p>
                                                                </div>
                                                                <div class="user-info">
                                                                    <h4  class="_flex-container"><i class='bx bxs-calendar'></i>&nbsp;&nbsp;BirthDay </h4>
                                                                    <h3>-</h3>
                                                                    <p id="userDOB">_ _ _ _</p>
                                                                </div>

                                                                <div class="user-info">
                                                                    <h4  class="_flex-container"><i class='bx bx-envelope' ></i>&nbsp;&nbsp;Email </h4>
                                                                    <h3>-</h3>
                                                                    <p id="userEmail">_ _ _ _</p>
                                                                </div>

                                                                <div class="user-info">
                                                                    <h4  class="_flex-container"><i class='bx bx-phone-call' ></i>&nbsp;&nbsp;Phone</h4>
                                                                    <h3>-</h3>
                                                                    <p id="userPhone">_ _ _ _</p>
                                                                </div>

                                                                <div class="user-info">
                                                                    <h4  class="_flex-container"><i class='bx bx-male-female' ></i>&nbsp;&nbsp;Gender </h4>
                                                                    <h3>-</h3>
                                                                    <p id="userGender">_ _ _ _</p>
                                                                </div>


                                                                <div class="user-info">
                                                                    <h4  class="_flex-container"><i class='bx bxs-home-alt-2' ></i>&nbsp;&nbsp;Address</h4>
                                                                    <h3>-</h3>
                                                                    <p id="userAddress">_ _ _ _</p>
                                                                </div>

                                                            </div>
                                                            <!-- <div class="col-md-4">

                                                            </div> -->
                                                        </div>
                                                        <br>

                                                    </form>

                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                </div>

                                <!-- end of general profile settinds -->
                                <hr>
                            </div>



                            <!-- end of Take attendence -->
                        </div>







                    </div>

                </div>


            </div>

        </main>

    </div>



    <script src="../assets/js/settings.js"></script>
    <?php include('partials/_footer.php'); ?>