<?php
include 'config/dependencies.php';
$adminuid = sanitize_input($_POST['adminuid']);
$adminpassword = sanitize_input($_POST['adminpassword']);
$admin = new Admin($adminuid, $adminpassword);
if ($admin->authenticateAdmin()){
$admin->loginAdmin();
header("Location:adminhome.php");
}else{
header("Location:admin.php");
}
?>
