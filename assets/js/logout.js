

function logout() {
    var xhr = new XMLHttpRequest();
    xhr.open('POST', '../assets/logout.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');

    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4) {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);

                if (data.status === 'success') {
                    window.location.href = '../login.php';
                    return;
                } else {
                    console.error('Logout failed:', data.message);
                }
            } else {
              window.location.href = '../errors/error.html';
            }
        }
    };

    xhr.send();

}

