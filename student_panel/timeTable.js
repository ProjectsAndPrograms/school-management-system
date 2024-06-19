const Sunday =[
    {   
        start_time: 'Sunday',
        end_time: 'Holiday',
        subject: 'No class Available',
        
    }
]
let Monday =[
    {   
        start_time: '09-10 AM',
        end_time: '38-718',
        subject: 'DBMS130',
        
    },
    {   
        start_time: '10-11 AM',
        end_time: '38-718',
        subject: 'MTH166',
    },
    {   
        start_time: '12-01 PM',
        end_time: '38-718',
        subject: 'NS200',
    }
]
let Tuesday =[
    {   
        start_time: '09-10 AM',
        end_time: '27-304Y',
        subject: 'MTH166',
    },
    {   
        start_time: '11-12 AM',
        end_time: '28-107',
        subject: 'CS849',
    },
    {   
        start_time: '12-01 PM',
        end_time: '28-107',
        subject: 'CS849',
    },
    {   
        start_time: '02-03 PM',
        end_time: '38-718',
        subject: 'NS200',
    }
]

let Wednesday =[
    {   
        start_time: '10-11 AM',
        end_time: '33-309',
        subject: 'DBMS130',
    },
    {   
        start_time: '11-12 AM',
        end_time: '38-719',
        subject: 'CS200',
    }
]

let Thursday =[
    {   
        start_time: '11-12 AM',
        end_time: '33-309',
        subject: 'MTH166',
    },
    {   
        start_time: '01-02 PM',
        end_time: '38-719',
        subject: 'CS849',
    },
    {   
        start_time: '02-03 PM',
        end_time: '38-718',
        subject: 'NS200',
    }
]

let Friday =[
    {   
        start_time: '10-11 AM',
        end_time: '33-309',
        subject: 'MEC103',
    },
    {   
        start_time: '11-12 AM',
        end_time: '33-309',
        subject: 'MEC103',
    },
    {   
        start_time: '02-03 PM',
        end_time: '33-601',
        subject: 'CS849',
    },

]

let Saturday =[
    {   
        start_time: '09-10 AM',
        end_time: '34-604',
        subject: 'DBMS130',

    },
    {   
        start_time: '10-11 AM',
        end_time: '34-604',
        subject: 'DBMS130',
    },
    {   
        start_time: '01-02 PM',
        end_time: '33-309',
        subject: 'MTH166',
    }
]


var message = "lskjf";

 fetch('fetchTimetable.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'message=' + encodeURIComponent(message),
    })
        .then(response => response.json())
        .then(data => {
          
             Monday = data['data']['mon'];
             Tuesday = data['data']['tue'];
             Wednesday = data['data']['wed'];
             Thursday = data['data']['thu'];
             Friday = data['data']['fri'];
             Saturday = data['data']['sat'];

            setData(day);

        })
        .catch(error => {
            console.error('Error:', error);
        });

