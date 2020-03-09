<?php
date_default_timezone_set('Asia/Kolkata');
include '../config/classes/attendance.class.php';
include '../config/classes/grace.class.php';
include '../config/classes/user.class.php';
include '../config/classes/database.class.php';

$uid = $_REQUEST['user'];
$code = $_REQUEST['code'];
$database = new DB;
$handle = $database->connectToDb();
$query = "SELECT * FROM barcode WHERE code = '{$code}' LIMIT 1";
if (($result = $handle->query($query))&& $result->num_rows>0){
  $row = $result->fetch_array();
  $mess = $row['adminuid'];
  $attendance = new Attendance($uid);
  if ($attendance->getMessOfUser() == $mess[4]){
    if (!$attendance->checkIfGraceApplied()){
      if (!$attendance->checkIfMealTaken()){
        $meal = $attendance->getMeal();
        $ticket = $attendance->addAttendance();
        echo "69";  
      }
      else{
        echo "3";
      }
    }else{
      echo "4";
    }
  }else{
    echo "5";
  }
}else{
  echo "6";
}

?>
