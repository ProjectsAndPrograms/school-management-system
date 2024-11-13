<?php include("../assets/noSessionRedirect.php"); ?>

<?php include("./verifyRoleRedirect.php"); ?>

<?php 

    // session_start();
    include('../assets/config.php');
 error_reporting(0);
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
        body{overflow: hidden;}
        header{position: relative;}
        .exam{
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            height: 80vh;
            width: 80%;
            margin: auto;
        }
        .btn {
  background-color: DodgerBlue;
  border: none;
  color: white;
  padding: 10px 20px;
  cursor: pointer;
  font-size: 10px;
  border-radius: 3px;
  text-decoration: none;
}





body {
    -ms-overflow-style: none;  /* Internet Explorer 10+ */
    scrollbar-width: none;  /* Firefox */
}
body::-webkit-scrollbar { 
    display: none;  /* Safari and Chrome */
}

/* Darker background on mouse-over */
.btn:hover {
  background-color: RoyalBlue;
}

.btn a{
    color: white;
    font-size: 20px;
}

        /* General Styles */
        body {
            overflow-y: scroll;
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        /* Quiz Form Styling */
        #quizForm, #quizForm1, #quizForm2 {
            width: 90%;
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            background-color: #f9f9f9;
            box-sizing: border-box;
        }
        
        h1, h2, h3 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            padding: 5px 0;
        }

        button {
            padding: 10px 15px;
            margin-top: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Result Box Styling */
        .result-box {
            width: 90%;
            max-width: 600px;
            margin: 15px auto;
            padding: 15px;
            font-weight: bold;
            border: 1px solid #4CAF50;
            border-radius: 8px;
            background-color: #e7f3e7;
            color: #2a7f2a;
            box-sizing: border-box;
        }

        .incorrect {
            border-color: #e74c3c;
            background-color: #f9e1e0;
            color: #c0392b;
        }
    </style>
    </style>
</head>
<body style="overflow-y: scroll;">
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
            <a href="timetable.php">
                <span class="material-icons-sharp">today</span>
                <h3>Time Table</h3>
            </a> 
            <a href="exam.php">
                <span class="material-icons-sharp">grid_view</span>
                <h3>Examination</h3>
            </a>
            <a href="workspace.php" >
                <span class="material-icons-sharp">description</span>
                <h3>Workspace</h3>
            </a>
            <a href="security_edu.php" class="active">
                <span class="material-icons-sharp">security</span>
                <h3>Security Education</h3>
            </a>
            <a href="password.php">
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



    <body>

    <h1>Cybersecurity Quiz</h1>

<form id="quizForm">
    <h2>1. Which of these is the best practice for creating a strong password?</h2>
    <label><input type="radio" name="q1" value="A"> Using your pet's name</label>
    <label><input type="radio" name="q1" value="B"> 123456</label>
    <label><input type="radio" name="q1" value="C"> A long passphrase with numbers, symbols, and letters</label>
    <button type="button" onclick="checkAnswers()">Submit</button>
</form>

<div id="result" class="result-box" style="display: none;"></div>

<form id="quizForm1">
    <h2>2. What is a firewall?</h2>
    <label><input type="radio" name="q2" value="A"> A wall made of fire.</label>
    <label><input type="radio" name="q2" value="B"> A part of a system or network that blocks unauthorized communications</label>
    <label><input type="radio" name="q2" value="C"> Something hackers use.</label>
    <button type="button" onclick="checkAnswers1()">Submit</button>
</form>

<div id="result1" class="result-box" style="display: none;"></div>

<form id="quizForm2">
    <h3>3. An attack on a computer system that exploits how people will behave and respond in certain situations is called ________ engineering.</h3>
    <label><input type="radio" name="q3" value="A"> Software</label>
    <label><input type="radio" name="q3" value="B"> Cyber</label>
    <label><input type="radio" name="q3" value="C"> Social</label>
    <button type="button" onclick="checkAnswers2()">Submit</button>
</form>

<div id="result2" class="result-box" style="display: none;"></div>

<script>
    function checkAnswers() {
        const answer = document.querySelector('input[name="q1"]:checked');
        const result = document.getElementById('result');
        if (answer) {
            if (answer.value === 'C') {
                result.textContent = 'Correct! A strong password uses a mix of characters in a passphrase.';
                result.className = "result-box";
            } else {
                result.textContent = 'Incorrect. Using your pet’s name or 123456 is not secure!';
                result.className = "result-box incorrect";
            }
            result.style.display = 'block';
        }
    }

    function checkAnswers1() {
        const answer = document.querySelector('input[name="q2"]:checked');
        const result1 = document.getElementById('result1');
        if (answer) {
            if (answer.value === 'B') {
                result1.textContent = 'Correct! A firewall blocks unauthorized access to networks.';
                result1.className = "result-box";
            } else {
                result1.textContent = 'Incorrect. A firewall is not a literal wall of fire!';
                result1.className = "result-box incorrect";
            }
            result1.style.display = 'block';
        }
    }

    function checkAnswers2() {
        const answer = document.querySelector('input[name="q3"]:checked');
        const result2 = document.getElementById('result2');
        if (answer) {
            if (answer.value === 'C') {
                result2.textContent = 'Correct! Social engineering attacks exploit human behavior.';
                result2.className = "result-box";
            } else {
                result2.textContent = 'Incorrect. Social engineering is not a type of software or cyber attack.';
                result2.className = "result-box incorrect";
            }
            result2.style.display = 'block';
        }
    }

</script>
</body>
</html>











