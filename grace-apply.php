<?php
session_start();
if (!isset($_SESSION['uid'])){
  header("Location:index.php");
}
include 'config/dependencies.php';
$database = new DB;
$date = sanitize_input($_POST['grace-date']);
$month = date("m",strtotime($date));
$day = date("d",strtotime($date));
$request_date = date("Y-m-d-H-i");
$database = new DB;
if ($database->checkGraceEligibility($_SESSION['uid'], $month, $day, $request_date)){
  $database = $database->addGrace($_SESSION['uid'], $month, $day, $request_date);
}
else{
  die("No more graces are allowed");
}

?>
