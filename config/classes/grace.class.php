<?php
class Grace {
  public function __construct($uid){
    $this->uid = $uid;
    $this->database = new DB;
    $this->handle = $this->database->connectToDb();
  }
  public function getNoOfAllowedGraces($month){
    $handle = $this->handle;
    $query="SELECT * FROM gracelimit WHERE month='{$month}' LIMIT 1";
    if ($result = $handle->query($query)){
      $data = $result->fetch_array(MYSQLI_ASSOC);
      return $data;
    }
  }
  public function getNoOfOnlineGracesLeft($uid, $month){
    $graces = $this->getNoOfAllowedGraces($month);
    $handle = $this->handle;
    $query = "SELECT * FROM grace WHERE uid='{$uid}' AND month='{$month}'";
    if ($result = $handle->query($query)){
        $noOfOnlineGracesApplied = $result->num_rows;
        return $graces['online'] - $noOfOnlineGracesApplied;
    }
    else{
      return -1;
    }
  }
  public function addGrace($uid, $month, $day, $request_date){
    $handle = $this->handle;
    $query = "INSERT INTO grace (uid, month, day, request_date) VALUES('{$uid}',
    '{$month}', '$day', '$request_date')";
    if ($handle->query($query)){
      return True;
    }
    else{
      return False;
    }
  }
  public function getAllGraces(){
    $handle = $this->handle;
    $query = "SELECT * FROM grace WHERE uid='{$this->uid}' ORDER BY grace_id DESC";
    $gracesAll = "";
    if ($result = $handle->query($query)){
      while($data = $result->fetch_array(MYSQLI_ASSOC)){
        $gracesAll = $gracesAll ." ". "<tr><td>" .$data['grace_id'] . "</td>"."<td>".$data['day']."-".$data['month']."</td><td>".$data['request_date']."</td></tr>";
      }
      return $gracesAll;
    }
  }
  public function checkGraceEligibility($uid, $month, $day, $request_date){
    $handle = $this->handle;
    $graceEligibility = True;
    $status = "";
    $gracesLeft = $this->getNoOfOnlineGracesLeft($uid, $month);
    if ($gracesLeft<=0){
      $graceEligibility =False;
      $status = $status . "You have consumed all your online graces";
    }
    return $graceEligibility;
  }
  public function checkGraceValidity($date, $request_date){
    $valid = True;
    $request_date = date("d-m", strtotime($request_date));
    $grace_date = date("d-m", strtotime("$date"));
    if ($grace_date <= $request_date){
      $valid =False;
    }return $valid;
  }
}

?>
