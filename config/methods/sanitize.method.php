<?php
function sanitize_input($input){
  $input = htmlspecialchars($input);
  $input = stripslashes($input);
  $input = trim($input);
  $input = filter_var($input, FILTER_SANITIZE_STRING);
  return $input;
}
?>
