<?php
class Attendance{
  public function __construct($uid){
    $this->uid = $uid;
    $this->day = date("d");
    $this->month = date("m");
    $this->time = date("H-i");
    $this->hour = date("H");
    $this->minute = date("i");
  }
  public function checkIfGraceApplied(){
    $database = new DB;
    $handle = $database->connectToDb();
    $query = "SELECT * FROM grace WHERE uid='{$this->uid}' AND month='{$this->month}' AND day='{$this->day}'";
    if ($result = $handle->query($query)){
      if ($result->num_rows > 0){
        return True;
      }
      else{
        return False;
      }
    }
  }
  public function getMeal(){
    if ($this->hour >= 7 && $this->hour <= 10){
      return "Breakfast";
    }
    elseif ($this->hour >= 11 && $this->hour <= 14){
      return "Lunch";
    }
    else if ($this->hour >= 16 && $this->hour < 19){
      return "Snacks";
    }
    else if ($this->hour >= 19 && $this->hour <= 22){
      return "Dinner";
    }
  }
  public function checkIfMealTaken(){
    $database = new DB;
    $handle = $database->connectToDb();
    $query = "SELECT * FROM attendance WHERE uid='{$this->uid}' AND month='{$this->month}' AND day='{$this->day}' AND meal='{$this->getMeal()}' ";
    if ($result = $handle->query($query)){
      if ($result->num_rows > 0){
        return True;
      }
      else{
        return False;
      }
    }
  }

  public function addAttendance(){
    if (!$this->checkIfGraceApplied()){
      if (!$this->checkIfMealTaken()){
        $database = new DB;
        $handle = $database->connectToDb();
        $query = "INSERT INTO attendance (uid, month, day, meal, time) VALUES ('{$this->uid}','{$this->month}', '{$this->day}', '{$this->getMeal()}', '{$this->time}')";
        if ($result = $handle->query($query)){
          return True;
        }
        else{
          return False;
        }
      }
    }
    else{

    }
  }
  public function __destruct(){
    $this->addAttendance();
  }
}
 ?>
