<?php
session_start();
if (!isset($_SESSION['uid'])){
  header("Location:index.php");
}
include 'config/dependencies.php';
$attendance = new Attendance($_SESSION['uid']);
?>
<?php
$attendance->checkIfMealTaken();
?>
