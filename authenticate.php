<?php
include 'config/dependencies.php';
$uid = sanitize_input($_POST['uid']);
$password = sanitize_input($_POST['password']);
$user = new User($uid, $password);
if ($user->authenticateUser()){
$user->loginUser();
header("Location:home.php");
}else{
header("Location:index.php");
}


?>
