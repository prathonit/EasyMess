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
        $ticket_no = $attendance->addAttendance();
        echo "
        <img id ='status' src='assets/images/success.svg' height='100' width='100' alt=''><br>
        <h1 class='title' id='ticket-no'>{$ticket_no}</h1>
        ";
      }
      else{
        echo "
        <img id ='status' src='assets/images/failure.svg' height='100' width='100' alt=''><br>
        <h1 class='title' id='ticket-no'>You have already taken the meal.</h1>
        <br><br>
        <i>For any queries reach out to the mess admin</i>
        ";
      }
    }else{
      echo "
      <img id ='status' src='assets/images/failure.svg' height='100' width='100' alt=''><br>
      <h1 class='title' id='ticket-no'>
      A grace was applied for today.<br>
      Do you want to override the grace?<br><br><br>
      <button class='button is-danger'>Yes</button>&nbsp;
      <button class='button is-primary'>No</button>
      </h1>
      <br><br>
      <i>For any queries reach out to the mess admin</i>
      ";
    }
  }else{
    echo "
    <img id ='status' src='assets/images/failure.svg' height='100' width='100' alt=''><br>
    <h1 class='title' id='ticket-no'>Maybe you are in the wrong mess!</h1>
    <br><br>
    <i>For any queries reach out to the mess admin</i>
    ";
  }
}else{
  echo "Error 6";
}

?>
