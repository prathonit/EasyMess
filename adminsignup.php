<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="adminsignup.php" method="post">
      <input type="text" name="adminuid">
      <br>
      <input type="password" name="adminpassword">
      <input type="submit" value="submit">
    </form>
  </body>
</html>
<?php
include 'config/dependencies.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
$database = new DB;
$handle = $database->connectToDb();
$password_hash = hashPassword($_POST['adminpassword']);
$query = "INSERT INTO admin (adminuid, adminpassword) VALUES ('{$_POST['adminuid']}','{$password_hash}')";
if ($handle->query($query)){
  echo "Login";
}
else{
  echo "not login";
}
}
 ?>
