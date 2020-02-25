<?php
include 'config/dependencies.php';
$username = sanitize_input($_POST['username']);
$password = sanitize_input($_POST['password']);
$user = new User($username, $password);
if ($user->authenticateUser()){
  $user->loginUser();
  header("Location: home.php");
} else{
echo "y";
}

?>
