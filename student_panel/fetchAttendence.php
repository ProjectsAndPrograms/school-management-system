

<?php
error_reporting(0);
include('../assets/config.php');
     $response="";
     session_start();
       if($_SERVER['REQUEST_METHOD']=="POST"){
          

            $month = date('m');         

           $id=$_SESSION['uid'];
           $query="select * from attendence where (student_id='$id') AND (Month(`date`)='$month');";
          

           $result=$conn->query($query);
          if($result->num_rows>0){
           
            while($row = $result->fetch_assoc()){


               $status = "";
               if($row['attendence'] == "1"){
                    $status = " <td style='color:green;'>Present</td>";
               }else{
                    $status = " <td style='color:red;'>Absent</td>";
               }

                  $response .=' <tr>
                       <td>'.date("d-m-Y",strtotime($row['date']."")).'</td>
                      '.$status.'
                           </tr>';
             }
              }
              else{
                    
              }

       }
       else {
            $response="something went wrong";
       }
       echo $response;
 ?>