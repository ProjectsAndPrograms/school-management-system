# 🍊 school-management-system 
PHP School management system developed for schools or small institutes. You can use this to maintain record's related to students, teachers, and other. [Click here to view a live demo](http://school-management-system.000.pe/?i=1)



## 🥏 Technolgies Used 
  1. PHP (8.1) 
  2. MySQL database  
  3. Bootstrap 5
  4. JQuery, JavaScript
  5. HTML, CSS

## 💡 FEATURES 
  1. student record management
  2. Teacher record management 
  3. Leave Management
  4. Notice Upload 
  5. Exam result upload
  6. Notes upload
  7. Bus Service  
  8. Syllabus upload / update
  9. Time table
  10. Attendence Management
  11. Password reset, Forgot password
  12. Front Page 
  13. Single login
  14. Dark theme support

## 🦤 SCREENSHOTS

### Pre-View
<div style="display: flex;flex-direction: column; grid-gap: 10px;">
     <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/1.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/2.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
</div>
<br>

### Admin View
<div style="display: flex;flex-direction: column; grid-gap: 10px;">
   <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/3.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/4.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
     <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/5.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/6.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
     <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/7.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/8.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
     <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/9.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/10.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
</div>
<br>

### Teacher View
<div style="display: flex;flex-direction: column; grid-gap: 10px;">
    <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/11.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/12.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
</div>
<br>

### Student View
<div style="display: flex;flex-direction: column; grid-gap: 10px;">
   <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/13.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/14.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
    <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/15.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/16.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
    <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/20.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
    
</div>
<br>


### Owner View
<div style="display: flex;flex-direction: column; grid-gap: 10px;">
    <div style="display: flex; grid-gap: 10px;">
        <img src="screenshots/17.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
        <img src="screenshots/19.png" alt="screenshots" width="49%" style="border: 2px solid lightgreen"/>
    </div>
    
</div>
<br>

## ✅ HOW TO USE?

  <b>Pre-requirement</b> : Make sure you have both php and MySQL installed on your PC. You can also use XAMPP which provide BOTH (php + MySQL).<br><br>

 <b>Step-1 :</b> Start XAMPP <br>
   Open XAMPP Control panel and start the Apache And MySQL Server  <br>

 <b>Step-2 :</b> Create Database <br>
   <b>The schema file of the database setup is available at database/_sms.sql </b>
   <br><br>
   From you xampp open phpmyadmin by clicking on admin button in front of MySQL -> create a database with the name '_sms' -> import the  database/_sms.sql file to complete the database setup.<br>

<b>Step-3 :</b> Placement <br>
   <b> If you have xampp installed on your PC you need to place the downloaded folder on 'htdocs directory' </b>
   <br><br>
   Copy the downloaded folder and place it into htdocs folder. Located at <i>C:\xampp\htdocs</i>
   <br><br>
   make sure your directory setup is like : <i>C:\xampp\htdocs\school-management-system\ </i> : and index.php file is available on the that location

<b>Step-4 :</b> Run the application <br>
   <b> visit on the url : <i>http://localhost/school-management-system</i> </b>
   <br> Visit to the given URL to see the running website

## 🔐 Emails and Passwords

The project comes with default user on each panel you can remove and update them also.<br>
The **Credentials** for default logins are

| Panel   |  Email             | Password |
| ----:   |  :---------------- | :------: |
| Admin   | admin@gmail.com    | 123      |
| Teacher | teacher@gmail.com  | 123      |
| Student | student@gmail.com  | 123      |
| Owner   | owner@gmail.com    | 123      |

- Note : **Password for New Teachers and Students:**  
   The default password for newly created teacher and student accounts is set to their **date of birth**.  
   - Example: If the date of birth is **12 July 2000**, the password would be **12072000**.

## ❤️ Contributing

Pull requests are welcome. For major changes, please open an issue first
to discuss what you would like to change.

Please make sure to update tests as appropriate.



