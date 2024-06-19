

<?php include("../assets/noSessionRedirect.php"); ?>
<?php include("./verifyRoleRedirect.php"); ?>
<?php 

  $id = $_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Sharp" rel="stylesheet">
    <link rel="shortcut icon" href="./images/logo.png">
    <link rel="stylesheet" href="style.css">

    <style>
        header{position: relative;}
        .change-password-container{
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            height: 90vh;
        }
        .change-password-container form{
            display: flex;
            flex-direction: column;
            justify-content: center;
            border-radius: var(--border-radius-2);
            padding : 3.5rem;
            background-color: var(--color-white);
            box-shadow: var(--box-shadow);
            width: 95%;
            max-width: 32rem;
        }
        .change-password-container form:hover{box-shadow: none;}
        .change-password-container form input[type=password]{
            border: none;
            outline: none;
            border: 1px solid var(--color-light);
            background: transparent;
            height: 2rem;
            width: 100%;
            padding: 0 .5rem;
        }
        .change-password-container form .box{
            padding: .5rem 0;
        }
        .change-password-container form .box p{
            line-height: 2;
        }
        .change-password-container form h2+p{margin: .4rem 0 1.2rem 0;} 
        .btn{
            background: none;
            border: none;
            border: 2px solid var(--color-primary) !important;
            border-radius: var(--border-radius-1);
            padding: .5rem 1rem;
            color: var(--color-white);
            background-color: var(--color-primary);
            cursor: pointer;
            margin: 1rem 1.5rem 1rem 0;
            margin-top: 1.5rem;
        }
        .btn:hover{
            color: var(--color-primary);
            background-color: transparent;
        }
    </style>

</head>
<body>
    <header>
        <div class="logo">
            <img src="./images/logo.png" alt="">
            <h2>E<span class="danger">R</span>P</h2>
        </div>
        <div class="navbar">
            <a href="index.php">
                <span class="material-icons-sharp">home</span>
                <h3>Home</h3>
            </a>
            <a href="timetable.php" onclick="timeTableAll()">
                <span class="material-icons-sharp">today</span>
                <h3>Time Table</h3>
            </a> 
            <a href="exam.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Examination</h3>
            </a>
            <a href="workspace.php">
                <span class="material-icons-sharp">description</span>
                <h3>Workspace</h3>
            </a>
            <a href="password.php" class="active">
                <span class="material-icons-sharp">password</span>
                <h3>Change Password</h3>
            </a>
            <a href="logout.php">
                <span class="material-icons-sharp">logout</span>
                <h3>Logout</h3>
            </a>
        </div>
        <div id="profile-btn" style="display: none;">
            <span class="material-icons-sharp">person</span>
        </div>
        <div class="theme-toggler">
            <span class="material-icons-sharp active">light_mode</span>
            <span class="material-icons-sharp">dark_mode</span>
        </div>
    </header>

    <div class="change-password-container">
        <form action="#" method="post">
            <h2>Create new password</h2>
            <p class="text-muted">Your new password must be different from previous used passwords.</p>
            <div class="box">
                <p class="text-muted">Current Password</p>
                <input type="password" id="currentpass" name="current">
            </div>
            <div class="box">
                <p class="text-muted">New Password</p>
                <input type="password" id="newpass" name="new">
            </div>
            <div class="box">
                <p class="text-muted">Confirm Password</p>
                <input type="password" id="confirmpass" name="repeat">
            </div>
            <div class="button">
                <input type="submit" value="Save" class="btn" name="submit">
                <a href="index.php" class="text-muted">Cancel</a>
            </div>
            <!--<a href="#"><p>Forget password?</p></a>-->
        </form> 
        <?php

            
               
             $password=$_POST['current'];
             $newpassword=$_POST['new'];
             $confirmnewpassword=$_POST['repeat'];
            $result = mysqli_query($conn,"SELECT password_hash FROM users WHERE id='$id'");
            if($result->num_rows > 0){
                $row = $result->fetch_assoc();

                $pass = $row['password_hash'];
                if(isset($_POST['submit'])){
                    if(password_verify($password, $pass)){
                    if($newpassword == $confirmnewpassword){
                          $newpasswordhash=password_hash($newpassword, PASSWORD_DEFAULT);
                        if(mysqli_query($conn,"UPDATE users SET password_hash='$newpasswordhash' where id='$id'")){
                                echo "<script>alert('Password Updated')</script>";
                        }else{
                            echo "<script>alert('unable to update')</script>";
                        }
                    }else{
                            echo "<script>alert('new password and confirm passsword are not same')</script>";
                    }
                }
                else{
                    echo "<script>alert('wrong current password...');</script>";
                }
            }
        }
       //  if(!$result)
       //  {
       //  echo "<script>alert('The username you entered does not exist')</script>";
       //  }
       //  else if($password!= $result->num_row)
       //  {
       //  echo "<script>alert('You entered an incorrect password')</script>";
       //  }

       //  if($newpassword=$confirmnewpassword)
       //  $sql=mysqli_query("UPDATE users SET password_hash='$newpassword' where id='$id'");
       //  if($sql)
       //  {
       //  echo "<script>alert('Congratulations You have successfully changed your password')</script>";
       //  }
       // else
       //  {
       // echo "<script>alert('Passwords do not match')</script>";
       // }
         ?>   
         </div>

</body>

<script src="app.js"></script>

</html>