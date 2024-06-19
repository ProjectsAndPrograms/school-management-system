
let usersEmail = '';


const togglePassword = document.querySelector("#togglePassword");
const password = document.querySelector("#password");

togglePassword.addEventListener("click", function () {
    // toggle the type attribute
    const type = password.getAttribute("type") === "password" ? "text" : "password";
    password.setAttribute("type", type);
    
    // toggle the icon
    this.classList.toggle("bi-eye-slash-fill");
});

document.getElementById('login-form').addEventListener('submit', submitForm);

var errorbox = document.querySelector('.alert-box');
var error_msg = document.getElementById("error-msg");
var weakPswrd = document.getElementById('weakPasswordFeedback');
var notMatch = document.getElementById('passwordNotSame');


document.getElementById('loginEmail').addEventListener('keyup', ()=>{
    errorbox.style.display = 'none';
    error_msg.innerHTML = '';
});
document.getElementById('password').addEventListener('keyup', ()=>{
    errorbox.style.display = 'none';
    error_msg.innerHTML = '';
});
document.getElementById('forgotEmail').addEventListener('keyup', ()=>{
    errorbox.style.display = 'none';
    error_msg.innerHTML = '';
});
document.getElementById('otpCode').addEventListener('keyup', ()=>{
    errorbox.style.display = 'none';
    error_msg.innerHTML = '';
});
document.getElementById('newpassword').addEventListener('keyup', ()=>{
    errorbox.style.display = 'none';
    error_msg.innerHTML = '';
    weakPswrd.style.display = 'none';
    notMatch.style.display = 'none';
});
document.getElementById('confirmpassword').addEventListener('keyup', ()=>{
    errorbox.style.display = 'none';
    error_msg.innerHTML = '';
    weakPswrd.style.display = 'none';
    notMatch.style.display = 'none';
});


function submitForm(event) {
    event.preventDefault();

    var formData = new FormData(event.target);

    fetch('login-backend.php', {
        method: 'POST',
        body: formData
    })
    .then(response =>{
        if (!response.ok) {
            if (response.status === 500) {                
                window.location.href = './errors/internal_server_error.html';
            } 
            throw new Error('HTTP error');
        }    
        return response.json();
    })
    .then(data => {
        if(data.status === 'NO_CONNECTION'){
            window.location.href = '../errors/error.html';
            return;
        }
    
        error_msg.classList.remove('alert-danger', 'alert-success');
        error_msg.classList.add(data.status === "success" ? 'alert-success' : 'alert-danger');
        error_msg.innerHTML = data.status === "success" ? 'success' : '' + data.message;
    
        errorbox.style.display = 'block';
    
        if (data.role === "admin") {
            window.location.href = 'admin_panel/dashboard.php';
        } else if (data.role === "owner") {
            window.location.href = 'owner_panel/index.php';
        } else if (data.role === "teacher") {
            window.location.href = 'teacher_panel/dashboard.php';
        } else if (data.role === "student") {
            window.location.href = 'student_panel/index.php';
        }
    
    })
    .catch(error => {
        console.error('Error:', error);
        error_msg.classList.remove('alert-success');
        error_msg.classList.add('alert-danger');
        error_msg.innerHTML = '<strong>Error</strong> ' + error.message;
        errorbox.style.display = 'block';
    });
    
}


document.getElementById('forgotpassword').addEventListener('click', function(){
    hideLoginForm(true);
    hideVerifyOtpForm(true);
    hideforgotPasswordForm(false);
});


document.getElementById('backToLogin').addEventListener('click', function(){
    hideforgotPasswordForm(true);
    hideVerifyOtpForm(true);
    hideLoginForm(false);
});

document.getElementById('backToforgotPasswordForm').addEventListener('click', ()=>{
    hideLoginForm(true);
    hideVerifyOtpForm(true);
    hideforgotPasswordForm(false);
});



function hideLoginForm(hide){
    document.querySelector('.alert-box').style.display = 'none';

    document.getElementById('login-form').reset();
    document.getElementById('forgotPassword-form').reset();
    document.getElementById('otpVarification-form').reset();
    document.getElementById('createNewPassword-form').reset();
    if(hide){
        document.getElementById('login-form').style.display = 'none';
    }else{
        document.getElementById('login-form').style.display = 'block';
        document.getElementById('board-title').innerHTML = 'Login';
    }
}
function hideforgotPasswordForm(hide){

    document.getElementById('login-form').reset();
    document.getElementById('otpVarification-form').reset();
    document.getElementById('createNewPassword-form').reset();

    document.querySelector('.alert-box').style.display = 'none';
    if(hide){
        document.getElementById('forgotPassword-form').style.display = 'none';
    }else{
        document.getElementById('forgotPassword-form').style.display = 'block';
        document.getElementById('board-title').innerHTML = 'Forgot Password';
    }
}
function hideVerifyOtpForm(hide){

    document.getElementById('login-form').reset();
    document.getElementById('otpVarification-form').reset();
    document.getElementById('createNewPassword-form').reset();

    document.querySelector('.alert-box').style.display = 'none';
    if(hide){
        document.getElementById('otpVarification-form').style.display = 'none';
    }else{
        document.getElementById('otpVarification-form').style.display = 'block';
        document.getElementById('board-title').innerHTML = 'OTP Verfication';
    }
}

function hideCreateNewPasswordForm(hide){
    document.getElementById('login-form').reset();
    document.getElementById('otpVarification-form').reset();
    document.getElementById('forgotPassword-form').reset();

    document.querySelector('.alert-box').style.display = 'none';
    if(hide){
        document.getElementById('createNewPassword-form').style.display = 'none';
    }else{
        document.getElementById('createNewPassword-form').style.display = 'block';
        document.getElementById('board-title').innerHTML = 'Create New Password';
    }
}

document.getElementById('forgotPassword-form').addEventListener('submit', (event)=>{
    event.preventDefault();
    
    let email = document.getElementById('forgotEmail').value;

    document.querySelector('.alert-box').style.display = 'none';
    document.getElementById('forgotEmail').disabled = true;
    document.getElementById('backToLogin').style.display = 'none';
    document.getElementById('sendCodeBtn').disabled = true;
    document.getElementById('sendCodeBtn').innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">&nbsp;Processing...</span>';
    
    let sendData = new FormData();
    sendData.append('email', email);
    
    fetch("forgotPassword.php", {
        method: 'POST',
        body: sendData,
    })
    .then(response => response.json())
    .then(data => {
        
        document.getElementById('backToLogin').style.display = 'block';
        document.getElementById('forgotEmail').disabled = false;
        document.getElementById('sendCodeBtn').disabled = false;
        document.getElementById('sendCodeBtn').innerHTML = 'Send Code';

        

        if(data['status'] === 'success'){
            hideLoginForm(true);
            hideCreateNewPasswordForm(true);
            hideforgotPasswordForm(true);
            
            hideVerifyOtpForm(false);
            document.getElementById('otpDisabledEmail').value = data['email'] + '';
            document.getElementById('otpDisabledEmail').disabled = true;
            usersEmail = data['email'];
        }else{
            document.getElementById("error-msg").innerHTML = data['message'];
            document.querySelector('.alert-box').style.display = 'block';
        }

        })
        .catch(error => {
            console.error("Error:", error);
        });

    
});

document.getElementById("otpVarification-form").addEventListener('submit', (event)=>{
    event.preventDefault();

    document.querySelector('.alert-box').style.display = 'none';
    document.getElementById('verifyCodeBtn').innerHTML = '<span class="spinner-border spinner-border-sm" aria-hidden="true"></span><span role="status">&nbsp;Processing...</span>';

    document.getElementById('backToforgotPasswordForm').style.display = 'none';
    document.getElementById('resendOTP').style.display = 'none';
    document.getElementById('otpCode').disabled = true;
    document.getElementById('verifyCodeBtn').disabled = true;

    let email = document.getElementById('otpDisabledEmail').value;
    let otp = document.getElementById('otpCode').value;



    let sendData = new FormData();
    sendData.append('email', email);
    sendData.append('otp', otp);

    fetch("forgotPassword.php", {
        method: 'POST',
        body: sendData,
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('verifyCodeBtn').innerHTML = "Verify Code";
        
        document.getElementById('backToforgotPasswordForm').style.display = 'block';
        document.getElementById('resendOTP').style.display = 'block';
        document.getElementById('otpCode').disabled = false;
        document.getElementById('verifyCodeBtn').disabled = false;

        if(data['status'] === 'success'){
           hideLoginForm(true);
           hideVerifyOtpForm(true);
           hideforgotPasswordForm(true);


           hideCreateNewPasswordForm(false);
        }else{
            document.getElementById("error-msg").innerHTML = data['message'];
            document.querySelector('.alert-box').style.display = 'block';
        }

        })
        .catch(error => {
            console.error("Error:", error);
        });

});

document.getElementById('resendOTP').addEventListener('click', function(){
    document.querySelector('.alert-box').style.display = 'none';
    document.getElementById('verifyCodeBtn').innerHTML = '<div class="spinner-border  spinner-border-sm" role="status"><span class="visually-hidden"></span></div>&nbsp;Sending...';

    document.getElementById('backToforgotPasswordForm').style.display = 'none';
    document.getElementById('resendOTP').style.display = 'none';
    document.getElementById('otpCode').disabled = true;
    document.getElementById('verifyCodeBtn').disabled = true;

    let email = document.getElementById('otpDisabledEmail').value;
    
    let sendData = new FormData();
    sendData.append('email', email);

    fetch("forgotPassword.php", {
        method: 'POST',
        body: sendData,
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById('verifyCodeBtn').innerHTML = 'Verify Code';

        document.getElementById('resendOTP').innerHTML = 'OTP sended';
        setTimeout(()=>{
            document.getElementById('resendOTP').innerHTML = 'resend OTP?';
        }, 2000);
        
        document.getElementById('backToforgotPasswordForm').style.display = 'block';
        document.getElementById('resendOTP').style.display = 'block';
        document.getElementById('otpCode').disabled = false;
        document.getElementById('verifyCodeBtn').disabled = false;


        if(data['status'] === 'success'){
            hideLoginForm(true);
            hideCreateNewPasswordForm(true);
            hideforgotPasswordForm(true);
            
            hideVerifyOtpForm(false);
            document.getElementById('otpDisabledEmail').value = data['email'] + '';
            document.getElementById('otpDisabledEmail').disabled = true;
            usersEmail = data['email'];
        }else{
            document.getElementById("error-msg").innerHTML = data['message'];
            document.querySelector('.alert-box').style.display = 'block';
        }

        })
        .catch(error => {
            console.error("Error:", error);
        });
});

document.getElementById('createNewPassword-form').addEventListener('submit', (event)=>{
    event.preventDefault();


    var errorBox = document.querySelector('.alert-box');
    var error_message = document.getElementById("error-msg");

    if(isStrongPassword()){
        let newPassword = document.getElementById('newpassword').value;
        let confirmPassword = document.getElementById('confirmpassword').value;

        if(newPassword === confirmPassword){
            document.getElementById('weakPasswordFeedback').style.display = 'none';
            document.getElementById('passwordNotSame').style.display = 'none';

            document.getElementById('newpassword').disabled = true;
            document.getElementById('confirmpassword').disabled = true;
            document.getElementById('changePasswordBtn').disabled = true;
            
            let sendData = new FormData();
            sendData.append('email', usersEmail);
            sendData.append('password', newPassword);
        
            fetch("forgotPassword.php", {
                method: 'POST',
                body: sendData,
            })
            .then(response => response.json())
            .then(data => {
              
                
        
                if(data['status'] === 'update_success'){
                    error_message.classList.remove('alert-danger', 'alert-success');
                    error_message.classList.add('alert-success');
                    error_message.innerHTML = data['message'];
                    errorBox.style.display = 'block';
                   
                   
                   setTimeout(() => {
                    error_message.classList.remove('alert-danger', 'alert-success');
                    error_message.classList.add('alert-danger');
                    error_message.innerHTML = '';
                    errorBox.style.display = 'none';

                    window.location.href = './';
                   }, 1000);
                  
                   
                }else{

                    document.getElementById('newpassword').disabled = false;
                    document.getElementById('confirmpassword').disabled = false;
                    document.getElementById('changePasswordBtn').disabled = false;

                    error_message.classList.remove('alert-danger', 'alert-success');
                    error_message.classList.add('alert-danger');
                    document.getElementById("error-msg").innerHTML = data['message'];
                    errorBox.style.display = 'block';
                }
        
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            

        }else{
            document.getElementById('weakPasswordFeedback').style.display = 'none';
            document.getElementById('passwordNotSame').style.display = 'block';
        }
    }

    let newPassword = document.getElementById('newpassword').value;
    let confirmPassword = document.getElementById('confirmpassword').value;

    let sendData = new FormData();
    sendData.append("newpassword", newPassword);
    sendData.append("confirmpassword", confirmPassword);


});



function isStrongPassword() {
    document.getElementById('passwordNotSame').style.display = 'none';

      var password = document.getElementById('newpassword').value;
      var weakBadge = document.getElementById('weakPasswordFeedback');

      var minLength = 8;

      // Check password length
      if (!(password.length >= minLength)) {
          weakBadge.innerHTML = "Password must contain minimum 8 characters!";
          weakBadge.style.display = 'block';
          return false;
      }
      else if (!(password.match(/([A-Z])/))) {
        weakBadge.innerHTML = "Password must contain atleast one uppercase letter.";
        weakBadge.style.display = 'block';
        return false;
      }
      else if (!(password.match(/([a-z])/))) {
        weakBadge.innerHTML = "Password must contain atleast one lowercase letter.";
        weakBadge.style.display = 'block';
        return false;
      }
      else if (!(password.match(/([0-9])/))) {
        weakBadge.innerHTML = "Password must contain atleast one number.";
        weakBadge.style.display = 'block';
        return false;
      }
      else if (!(password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))) {
        weakBadge.innerHTML = "Password must contain atleast one special character.";
        weakBadge.style.display = 'block';
        return false;
      }
      else{
        weakBadge.innerHTML = "";
        weakBadge.style.display = 'none';
        return true;
      }

     
    }


    document.getElementById('showPasswords').addEventListener('click', function(){

        let newPassword = document.getElementById('newpassword');
        let confirmPassword = document.getElementById('confirmpassword');
        let label = document.getElementById('showPasswordLabel');

        if(this.checked){
            newPassword.setAttribute('type', 'text');
            confirmPassword.setAttribute('type', 'text');
            label.innerHTML = 'Hide password';
        }else{
            newPassword.setAttribute('type', 'password');
            confirmPassword.setAttribute('type', 'password');
            label.innerHTML = 'Show password';
        }
    });