<?php

session_start();
//the isset function to check username is already loged in and stored on the session
if(!isset($_SESSION['userid'])){
header('location:attendance.php');	
}

require '../../include/db_conn.php';

$user_id = $_GET['id'];


$sql = "DELETE FROM attendance WHERE userid='".$_GET["id"]."'";
$res = $con->query($sql) ;


 $attend = "select * from users where userid = '$user_id'";
  $result_attend = $con->query($attend);
  $row_attend = mysqli_fetch_array($result_attend);
  $cnt = $row_attend['attendance_count'];
 $attend_count = $cnt;
      $sql1 = "update users set attendance_count ='$attend_count' where userid='$user_id'";
     $con->query($sql1) ;
?>
<script>
// alert("Delete Successfully");
window.location = "attendance.php";
</script>


 