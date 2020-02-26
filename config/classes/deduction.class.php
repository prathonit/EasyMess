<?php
class Deduction{
public function __construct($uid){
  $this->uid = $uid;
  $this->month = date("m");
}
public function checkIfGraceApplied($day){
  $database = new DB;
  $handle = $database->connectToDb();
  $query = "SELECT * FROM grace WHERE uid='{$this->uid}' AND month='{$this->month}' AND day='{$day}'";
  if ($result = $handle->query($query)){
    if ($result->num_rows > 0){
      return True;
    }
    else{
      return False;
    }
  }
}
public function getMealRecord($day,$meal){
  $database = new DB;
  $handle = $database->connectToDb();
  $query = "SELECT * from attendance WHERE uid='{$this->uid}' AND month='{$this->month}' AND day='{$day}' AND meal='{$meal}'";
  if ($result = $handle->query($query)){
    if ($result->num_rows > 0){
      $data = $result->fetch_array(MYSQLI_ASSOC);
      $mealRecord =  "<div class='column has-text-centered'><div class='box has-background-primary'>" . $meal . "</div></div>";
    }
    else{
      $mealRecord = "<div class='column has-text-centered'><div class='box has-background-danger'>" . $meal . "</div></div>";
    }
  }
}
public function getDayRecord($day){
  $dayRecord = "";
  $database = new DB;
  $handle = $database->connectToDb();
  if (this->checkIfGraceApplied($day)){
    
  }
  else{

  }


}
public function getMonthlyDeduction($){
  for ($i = 1 ; $i < date("d")); $i++){

  }
}
}
?>
