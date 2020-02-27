<?php
session_start();
if (isset($_SESSION['adminuid'])){
  $redirect = True;
}
else{
  $redirect =False;
}
session_destroy();
if ($redirect){
  header("Location:admin.php");
}
else{
  header("Location:index.php");
}

?>
