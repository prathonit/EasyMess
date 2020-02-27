<?php
session_start();
if (!isset($_SESSION['adminuid'])){
  header("Location:admin.php");
}
include 'config/dependencies.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <?php
    include 'assets/includes/head.php';
  ?>
  <body>
    <?php
    include 'assets/includes/admin-nav.php';
     ?>
  
     <br>


  </body>
</html>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $attendance = new Attendance($_SESSION['uid']);
  }
?>
