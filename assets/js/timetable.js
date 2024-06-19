var dayOfWeak = 1;

var _class = "";
let _section = "";
let days = ["MONDAY", "TUESDAY", 'WEDNESDAY', 'THURSDAY', 'FRIDAY', 'SATURDAY', 'SUNDAY'];

document.getElementById("editBtn").addEventListener("click", function () {
    document.querySelector('.editBtnBox').style.display = "none";
    document.querySelector('.saveBtnBox').style.display = "block";
});
document.getElementById("saveBtn").addEventListener("click", function () {
    document.querySelector('.saveBtnBox').style.display = "none";
    document.querySelector('.editBtnBox').style.display = "block";
});


document.addEventListener("DOMContentLoaded", function () {
    _class = document.getElementById("search-class").value;
    _section = document.getElementById("search-section").value;

    loadTimeTable();
});
document.getElementById("findTimeTableBtn").addEventListener("click", () => {
    _class = document.getElementById("search-class").value;
    _section = document.getElementById("search-section").value;

    loadTimeTable();
});
function loadTimeTable() {

    document.getElementById("findTimeTableBtn").disabled = true;
    let sendObject = {
        dayOfWeak: dayOfWeak,
        class: _class,
        section: _section
    }
  
    fetch('../assets/fetchTimeTable.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: JSON.stringify(sendObject),
    })
        .then(response => response.json())
        .then(data => {

            document.getElementById("findTimeTableBtn").disabled = false;
            document.getElementById('timeTableClassSection').innerHTML = "Class " + _class + " " + _section;
            document.getElementById("__day__").innerHTML = days[dayOfWeak - 1];


            if (data['status'] === 'success') {

                document.getElementById("lastEditor").innerHTML = data['editorName'];
                document.getElementById("editingTime").innerHTML = data['editingTime'];

                if (data['day'] === 'sunday') {
                    document.getElementById("timeTable_table1").innerHTML = "";
                    document.getElementById("timeTable_table2").innerHTML = "";
                    document.getElementById("lunch-alert").style.display = "none";
                    document.getElementById("dataNotAvailable").style.display = 'block';
                    document.getElementById("saveBtn").disabled = true;
                    document.getElementById("editBtn").disabled = true;

                } else {
                    document.getElementById("dataNotAvailable").style.display = 'none';
                    document.getElementById("timeTable_table1").innerHTML = data['table1Message'];
                    document.getElementById("lunch-alert").style.display = "block";
                    document.getElementById("timeTable_table2").innerHTML = data['table2Message'];
                    document.getElementById("saveBtn").disabled = false;
                    document.getElementById("editBtn").disabled = false;
                }


            }
            else if (data['status'] === "creating") {
                loadTimeTable();

            } else {
                document.getElementById("lunch-alert").style.display = "none";
                document.getElementById("timeTable_table1").innerHTML = "";
                document.getElementById("timeTable_table2").innerHTML = "";
                document.getElementById("lastEditor").innerHTML = "";
                document.getElementById("editingTime").innerHTML = "";
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });

}

document.getElementById('next-page-btn').addEventListener("click", () => {

    dayOfWeak += 1;
    if (dayOfWeak > 7) {
        dayOfWeak = 1;
    }

    loadTimeTable();

});

document.getElementById('prev-page-btn').addEventListener("click", () => {

    dayOfWeak -= 1;
    if (dayOfWeak < 1) {
        dayOfWeak = 7;
    }
    loadTimeTable();

});


// start going to make table editable

document.getElementById("editBtn").addEventListener('click', () => {
    const table1 = document.querySelectorAll("#timeTable_table1 td");

    for (let currentData = 0; currentData < table1.length; currentData++) {
        table1[currentData].querySelector(".tableInput").disabled = false;
    }

    const table2 = document.querySelectorAll("#timeTable_table2 td");

    for (let currentData = 0; currentData < table2.length; currentData++) {
        table2[currentData].querySelector(".tableInput").disabled = false;
    }

});

document.getElementById("saveBtn").addEventListener('click', () => {
    const table1 = document.querySelectorAll("#timeTable_table1 td");

    for (let currentData = 0; currentData < table1.length; currentData++) {
        table1[currentData].querySelector(".tableInput").disabled = true;
    }

    const table2 = document.querySelectorAll("#timeTable_table2 td");

    for (let currentData = 0; currentData < table2.length; currentData++) {
        table2[currentData].querySelector(".tableInput").disabled = true;
    }

    var sendingArray = [];
    var index = 0;
    const table1data = document.querySelectorAll("#timeTable_table1 tr");
    for (let currentData = 0; currentData < table1data.length; currentData++) {
        var start = table1data[currentData].querySelector(".srartTime_").value;
        var end = table1data[currentData].querySelector(".endTime_").value;
        var sub = table1data[currentData].querySelector(".subject_").value;

        var myObject = {
            startTime: start,
            endTime: end,
            subject: sub
        }

        sendingArray[currentData] = myObject;
        index = currentData;

    }
    const table2data = document.querySelectorAll("#timeTable_table2 tr");
    for (let currentData = 0; currentData < table2data.length; currentData++) {
        var start = table2data[currentData].querySelector(".srartTime_").value;
        var end = table2data[currentData].querySelector(".endTime_").value;
        var sub = table2data[currentData].querySelector(".subject_").value;

        var myObject = {
            startTime: start,
            endTime: end,
            subject: sub
        }

        sendingArray[index + 1] = myObject;
        index += 1;
    }
    

    var sendObject = {
        data: sendingArray,
        class: _class,
        section:_section,
        dayOfWeak: dayOfWeak
    }
   
    

    fetch('../assets/updateTimeTable.php', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
     
      },
      body: JSON.stringify(sendObject),
    })
      .then(response => response.text())
      .then(data => {
       
      })
      .catch(error => {
        console.error('Error:', error);
      });
    
});

function collectInputValues(nodeList) {
    const inputValues = [];
    nodeList.forEach(td => {
        const inputValue = td.querySelector(".tableInput").value;
        inputValues.push(inputValue);
    });
    return inputValues;
}
// end going to make table editable