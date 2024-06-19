const sideLinks = document.querySelectorAll('.sidebar .side-menu li a:not(.logout)');



var closeSideBar = document.querySelector(".sidebar");
var w = window.innerWidth;


sideLinks.forEach(item => {
    const li = item.parentElement;
    item.addEventListener('click', () => {
        sideLinks.forEach(i => {
            i.parentElement.classList.remove('active');
        })
        li.classList.add('active');
    })
});


let menuBarBtns = document.querySelectorAll('.SidebarOpener');
const sideBar = document.querySelector('.sidebar');

let on = true;
let smallON = false;

menuBarBtns.forEach(function (menuBar) {
    menuBar.addEventListener('click', function () {

        console.log('something happen');
        if (w <= 600) {
            if (sideBar.classList.contains("close")) {
                sideBar.classList.remove("close");
            }
            if (sideBar.classList.contains("show")) {
                sideBar.classList.remove("show");
            }

            if (smallON == false) {
                sideBar.classList.add("show");
                smallON = !smallON;
            } else {
                sideBar.classList.add("close");
                smallON = !smallON;
            }



        }
        else {

            if (sideBar.classList.contains("close")) {
                sideBar.classList.remove("close");
            }
            if (sideBar.classList.contains("show")) {
                sideBar.classList.remove("show");
            }

            if (on == false) {
                sideBar.classList.add("show");
                on = !on;
            } else {
                sideBar.classList.add("close");
                on = !on;
            }

        }

    });
});



let checkFile = parseInt(document.getElementById("checkFileName").value);

let sideMenu = document.querySelector(".side-menu");
var listItems = sideMenu.querySelectorAll('li');


listItems.forEach(function (item) {
    if (item.classList.contains("acitve")) {
        item.classList.remove("active");
    }
});

let count = 1;

listItems.forEach(function (item) {
    if (checkFile === count) {
        item.classList.add("active");
    }
    count = count + 1;
});


const searchBtn = document.querySelector('.content nav form .form-input button');
const searchBtnIcon = document.querySelector('.content nav form .form-input button .bx');
const searchForm = document.querySelector('.content nav form');

searchBtn.addEventListener('click', function (e) {
    if (window.innerWidth < 576) {
        e.preventDefault;
        searchForm.classList.toggle('show');
        if (searchForm.classList.contains('show')) {
            searchBtnIcon.classList.replace('bx-search', 'bx-x');
        } else {
            searchBtnIcon.classList.replace('bx-x', 'bx-search');
        }
    }
});

window.addEventListener('resize', () => {
    if (window.innerWidth < 768) {
        sideBar.classList.add('close');
    } else {
        sideBar.classList.remove('close');
    }
    if (window.innerWidth > 576) {
        searchBtnIcon.classList.replace('bx-x', 'bx-search');
        searchForm.classList.remove('show');
    }
});

const toggler = document.getElementById('theme-toggle');

toggler.addEventListener('change', function () {
    var theme = 'light';
    if (this.checked) {
        document.body.classList.add('dark');
        theme = 'dark';
    } else {
        document.body.classList.remove('dark');
        theme = 'light';
    }

    fetch('../assets/themeSet.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'theme=' + encodeURIComponent(theme),
    })
        .then(response => response.text())
        .then(data => {

        })
        .catch(error => {
            console.error('Error:', error);
        });


});

window.addEventListener('DOMContentLoaded', function () {
    var theme = "";

    fetch('../assets/user_theme.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'value=' + encodeURIComponent('value'),
    })
        .then(response => response.text())
        .then(data => {

            theme = data;

            if (theme == 'dark') {
                document.getElementById("theme-toggle").checked = true;
                if (!document.body.classList.contains('dark')) {
                    document.body.classList.add('dark');
                }

            } else {
                document.getElementById("theme-toggle").checked = false;
                if (document.body.classList.contains('dark')) {
                    document.body.classList.remove('dark');
                }
            }

        })
        .catch(error => {
            console.error('Error:', error);
        });



}, true);


document.addEventListener("DOMContentLoaded", function () {
  
    fetch('../assets/loadProfilePic.php', {
        method: 'POST',
    })
        .then(response => response.json())
        .then(data => {
        
            if (data['status'] === "success") {
             
                document.getElementById("navbar_profile_pic").innerHTML = data['data'];
            } else {
                
                document.getElementById("navbar_profile_pic").innerHTML ='<img src="../images/user.png" >';
            }

        })
        .catch(error => {
            console.error('Error:', error);
        });
});

document.getElementById("topMostSearchBar").addEventListener("keydown", function (event) {
    if (event.key === 'Enter') {
        searchFunction();
    }
    document.getElementById("topMostSearchBar").classList.remove("redColorText");
});
document.getElementById("topMostSearchBarBtn").addEventListener('click', ()=>{
    searchFunction();
    document.getElementById("topMostSearchBar").classList.remove("redColorText");
});

function searchFunction(){
    var searchValue = ((document.getElementById("topMostSearchBar").value + "").toLowerCase()).trim();
    



    var currentUrl = window.location.href;
    fetch("searchFunction.php", {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded', // or 'application/json' depending on your needs
        },
        body: 'searchValue=' + encodeURIComponent(searchValue + ""),
    })
        .then(response => response.text())
        .then(data => {
            data = data.trim();
            data = data.replace("\n", "");
            
         

            if(data === "NOTFOUND"){
                document.getElementById("topMostSearchBar").classList.add("redColorText");
            }else{
                window.location.href = data;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

document.getElementById("unknowingForm").addEventListener('submit', function(event){
    event.preventDefault();
});