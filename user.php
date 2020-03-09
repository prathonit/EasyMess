<?php
$username = "prathonit";
$password = "pwdpwd";
$hostname = "localhost";
$database = "easymess";
$handle = new mysqli($hostname, $username , $password , $database);
if ($handle->connect_error){
  die("error");
}
$username = $_REQUEST['q'];

$query = "SELECT * FROM members WHERE uid LIKE '{$username}'";
$result = $handle->query($query);

if ($result->num_rows>0){
  echo "User exists";
}else{
  echo "User does not exist";
}


 ?>
