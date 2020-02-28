<?php
class Deduction{
public function __construct($uid){
  $this->uid = $uid;
  $this->month = date("m");
}
public function checkIfGraceApplied($day){
  $database = new DB;
  $handle = $database->connectToDb();
  $query = "SELECT * FROM grace WHERE uid='{$this->uid}' AND grace_override=0 AND  month='{$this->month}' AND day='{$day}'";
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
  return $mealRecord;
}
public function getDayRecord($day){
  $dayRecord = "";
  $database = new DB;
  $handle = $database->connectToDb();
  if ($this->checkIfGraceApplied($day)){
    $dayRecord = $dayRecord . "<div class='box'>
        <div class='columns'>
          <div class='column is-narrow is-2 has-text-centered'>
            <div class='box'>" . $day . "-". $this->month."</div></div>";
            $dayRecord = $dayRecord . "<div class='column has-text-centered'>
              <div class='box'>
                Grace taken
              </div>
            </div>
            <div class='column is-narrow is-2 has-text-centered'>
              <div class='box'>
                Rs: 0
              </div>
            </div>
          </div>
        </div>";
  }
  else{
    $dayRecord = $dayRecord ."<div class='box'><div class='columns'>";
    $dayRecord = $dayRecord . "<div class='column is-narrow is-2 has-text-centered'>
      <div class='box'>" . $day . "-". $this->month."</div></div>";
    $dayRecord = $dayRecord . $this->getMealRecord($day, 'Breakfast');
    $dayRecord = $dayRecord . $this->getMealRecord($day, 'Lunch');
    $dayRecord = $dayRecord . $this->getMealRecord($day, 'Snacks');
    $dayRecord = $dayRecord . $this->getMealRecord($day, 'Dinner');

    $dayRecord = $dayRecord . "<div class='column is-narrow is-2 has-text-centered'>
      <div class='box'>
        Rs: 121
      </div>
    </div></div></div>";
  }
  return $dayRecord;
}
public function getMonthlyDeduction(){
  for ($i = 1; $i <=date("d ") ; $i++){
    echo $this->getDayRecord($i);
  }
}
public function getTotalDeductionForUser(){
  $database = new DB;
  $handle = $database->connectToDb();
  $day = date("d");
  $query = "SELECT * FROM grace WHERE uid='{$this->uid}' AND month='{$this->month}' AND grace_override='False' AND day<'{$day}'";
  if ($result = $handle->query($query)){
    $graces = $result->num_rows;
    $totalDays = date("d")-1;
    $totalDaysBillable = $totalDays - $graces;
    $deductionData = [];
    $deductionData['deduction'] = $totalDaysBillable*121;
    $deductionData['graces'] = $graces;
    return $deductionData;
}
}
}
?>
