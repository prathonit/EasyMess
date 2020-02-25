<?php
function hashPassword($password){
$hash = password_hash($password, PASSWORD_BCRYPT);
return $hash;
}
function checkPassword($userpassword, $hash){
$verify = password_verify($userpassword, $hash);
if ($verify ==1){
  return True;
}
else{
  return False;
}
}
?>
