<?php
date_default_timezone_set('Asia/Kolkata');
include '../../config/classes/database.class.php';
include '../../config/classes/grace.class.php';
include '../../config/methods/sanitize.method.php';
$uid = $_REQUEST['u'];
$grace = new Grace($uid);
$date = sanitize_input($_REQUEST['gracedate']);
$month = date("m",strtotime($date));
$day = date("d",strtotime($date));
$request_date = date("Y-m-d-H-i");
$grace = new Grace($uid);
if ($grace->checkGraceEligibility($uid, $month, $day, $request_date)){
  if ($grace->checkGraceValidity($date)){
    $grace->addGrace($uid, $month, $day, $request_date);
    echo "grace applied successfully";
  }else{
    echo ("Grace invalid");
  }
}
else{
  echo ("No more graces are allowed");
}
?>
