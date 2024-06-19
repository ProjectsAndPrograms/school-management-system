
const sideMenu = document.querySelector("aside");
const profileBtn = document.querySelector("#profile-btn");
const themeToggler = document.querySelector(".theme-toggler");
const nextDay = document.getElementById('nextDay');
const prevDay = document.getElementById('prevDay');

profileBtn.onclick = function () {
  sideMenu.classList.toggle('active');
}
window.onscroll = () => {
  sideMenu.classList.remove('active');
  if (window.scrollY > 0) { document.querySelector('header').classList.add('active'); }
  else { document.querySelector('header').classList.remove('active'); }
}

themeToggler.onclick = function () {
  document.body.classList.toggle('dark-theme');
  themeToggler.querySelector('span:nth-child(1)').classList.toggle('active')
  themeToggler.querySelector('span:nth-child(2)').classList.toggle('active')
}

let setData = (day) => {
  document.querySelector('table tbody').innerHTML = ' '; //To clear out previous table data;  
  let daylist = ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"]
  document.querySelector('.timetable div h2').innerHTML = daylist[day];
  switch (day) {
    case (0): day = Sunday; break;
    case (1): day = Monday; break;
    case (2): day = Tuesday; break;
    case (3): day = Wednesday; break;
    case (4): day = Thursday; break;
    case (5): day = Friday; break;
    case (6): day = Saturday; break;
  }
  var count = 1;
  day.forEach(sub => {

    var tr = document.createElement('tr');

    var trContent = `
                            <td>${sub.start_time}</td>
                             <td>${sub.end_time}</td>
                             <td>${sub.subject}</td>
                            
                        `;

    tr.innerHTML = trContent;
    document.querySelector('table tbody').appendChild(tr)

    if (count == 5) {
      var tr = document.createElement('tr');
      var trContent = `
                            <td></td>
                            <td>LUNCH</td>
                             <td></td>
                            
                        `;
      tr.innerHTML = trContent;
      document.querySelector('table tbody').appendChild(tr)
    }
    count++;

  });
}

let now = new Date();
let today = now.getDay(); // Will return the present day in numerical value; 
let day = today; //To prevent the today value from changing;

function timeTableAll() {
  document.getElementById('timetable').classList.toggle('active');
  setData(today);
  document.querySelector('.timetable div h2').innerHTML = "Today's Timetable";
}
nextDay.onclick = function () {
  day <= 5 ? day++ : day = 0;  // If else one liner
  setData(day);
}
prevDay.onclick = function () {
  day >= 1 ? day-- : day = 6;
  setData(day);
}

//To set the data in the table on loading window.
document.querySelector('.timetable div h2').innerHTML = "Today's Timetable"; //To prevent overwriting the heading on loading;
function myFunction() {
  // Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("myInput");
  filter = input.value.toUpperCase();
  table = document.getElementById("myTable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[0];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}


function handleShowAllSubjectMarks(examId) {

  document.getElementById("allResultList").classList.add("hide");
  document.querySelector(".marks-table-search-box").classList.add("hide");

  fetch("../assets/fetchSubjectiveResults.php", {
    method: 'POST',
    headers: {
      'Content-Type': 'application/x-www-form-urlencoded',
    },
    body: "exam_id=" + encodeURIComponent(examId + ""),
  })
    .then(response => response.json())
    .then(data => {
      console.log(data);

      if(data['status'] === "success"){
        document.getElementById("subjectiveResultTable").innerHTML = data ['data'];
      }else{
        document.getElementById("subjectiveResultTable").innerHTML="<h2 style='margin-top : 2rem;width: 100%; text-align: center;'>❌ Something went wrong!</h2>";
      }
      

    })
    .catch(error => {
      console.error("Error" + error);
    });


}

function hideSubjectiveListShowFullList(){
  document.getElementById("subjectiveResultTable").value = "";
  document.getElementById("allResultList").classList.remove("hide");
  document.querySelector(".marks-table-search-box").classList.remove("hide");
}

(document.querySelectorAll("no-submit")).forEach(element => {
  element.addEventListener("click", (event) => {
    event.preventDefault();
    event.stopPropagation();
  })
});

