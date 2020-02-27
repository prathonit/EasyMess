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
$grace = new Grace($_SESSION['uid']);
if ($grace->checkGraceEligibility($_SESSION['uid'], $month, $day, $request_date)){
  if ($grace->checkGraceValidity($date)){
    $grace->addGrace($_SESSION['uid'], $month, $day, $request_date);
  }else{
    die("Grace invalid");
  }
}
else{
  die("No more graces are allowed");
}
?>
