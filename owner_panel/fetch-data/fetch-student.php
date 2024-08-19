<?php
 include("../../assets/config.php");
 $sql="select * from students";
 $result=mysqli_query($conn,$sql);
 if(mysqli_num_rows($result)>0){
    while($row=mysqli_fetch_assoc($result)){
        echo "<tr>
      <th scope='row'>".$row['s_no']."</th>
      <td>".$row['fname']."  ".$row['lname']."</td>
      <td>".$row['class']." ".$row['section']."</td>
      <td><a href='modal-student.php?id=". $row['id'] ."'><button id='view-more' data-id='".$row['id']."' style='height: 35px; width: 100px; background-color: skyblue; color: white; border: none; border-radius: 8px; text-decoration: none;'>View More</button>

          </a>
      </td>
    </tr>";
    }
 }

?>