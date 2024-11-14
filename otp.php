<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
        body { font-family: Arial, sans-serif; }
        .container { max-width: 400px; margin: auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        input[type="email"], input[type="number"] {
            width: 100%; padding: 8px; margin: 10px 0; border-radius: 4px; border: 1px solid #ccc;
        }
        button { padding: 10px 20px; background-color: #4CAF50; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background-color: #45a049; }
    </style>
</head>
<body>
    <div class="container">
        <h2>OTP Verification</h2>
        
        <!-- Form for entering email and requesting OTP -->
        <form id="otpForm">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
            
            <!-- "Get OTP" button triggers OTP generation -->
            <button type="button" onclick="getOTP()">Get OTP</button>
            
            <!-- OTP input field, hidden until OTP is requested -->
            <div id="otpSection" style="display:none;">
                <label for="otp">Enter OTP:</label>
                <input type="number" id="otp" name="otp" required>
                
                <button type="button" onclick="submitOTP()">Submit OTP</button>
            </div>
        </form>

        <!-- Message display -->
        <div id="message" style="color: red; margin-top: 10px;"></div>
    </div>

    <script>
        // Function to request OTP
        function getOTP() {
            const email = document.getElementById('email').value;
            
            if (!email) {
                document.getElementById("message").innerText = "Please enter your email address.";
                return;
            }

            // AJAX request to generate_otp.php
            fetch('generate_otp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `email=${encodeURIComponent(email)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById("message").style.color = "green";
                    document.getElementById("message").innerText = "OTP has been sent to your email.";
                    document.getElementById("otpSection").style.display = "block";
                } else {
                    document.getElementById("message").style.color = "red";
                    document.getElementById("message").innerText = data.message || "Error sending OTP.";
                }
            })
            .catch(error => {
                document.getElementById("message").innerText = "An error occurred. Please try again.";
            });
        }

        // Function to submit OTP
        function submitOTP() {
            const email = document.getElementById('email').value;
            const otp = document.getElementById('otp').value;

            if (!otp) {
                document.getElementById("message").innerText = "Please enter the OTP.";
                return;
            }

            // AJAX request to verify OTP
            fetch('verify_otp.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: `email=${encodeURIComponent(email)}&otp=${encodeURIComponent(otp)}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    document.getElementById("message").style.color = "green";
                    document.getElementById("message").innerText = "OTP verified successfully!";
                    document.getElementById("otpSection").style.display = "none";
                } else {
                    document.getElementById("message").style.color = "red";
                    document.getElementById("message").innerText = data.message || "Invalid OTP.";
                }
            })
            .catch(error => {
                document.getElementById("message").innerText = "An error occurred. Please try again.";
            });
        }
    </script>
</body>
</html>
