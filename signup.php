<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <form class="" action="signup.php" method="post">
      <input type="text" name="username">
      <br>
      <input type="password" name="password">
      <input type="submit" value="submit">
    </form>
  </body>
</html>
<?php
include 'config/dependencies.php';
if ($_SERVER['REQUEST_METHOD']=='POST'){
$database = new DB;
$handle = $database->connectToDb();
$password_hash = hashPassword($_POST['password']);
$query = "INSERT INTO members (username, password) VALUES ('{$_POST['username']}','{$password_hash}')";
$handle->query($query); 
}
 ?>
