<?php
class Grace {
  public function __construct($uid){
    $this->uid = $uid;
    $this->database = new DB;
    $this->handle = $this->database->connectToDb();
  }
  public function getMessOfUser(){
    $handle = $this->handle;
    $query = "SELECT mess FROM members WHERE uid='{$this->uid}'";
    if ($result = $handle->query($query)){
      return $result->fetch_array(MYSQLI_ASSOC)['mess'];
    }
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
    $query = "INSERT INTO grace (uid, month, day, request_date, mess) VALUES('{$uid}',
    '{$month}', '{$day}', '{$request_date}', ({$this->getMessOfUser()}))";
    return $handle->query($query);
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
      $graceEligibility = False;
      $status = $status . "You have consumed all your online graces";
    }
    return $graceEligibility;
  }
  public function checkGraceValidity($date){
    $valid = True;
    $grace_date = date("d-m", strtotime($date));
    if ($grace_date < date("d-m")){
      $valid = False;
    }return $valid;
  }
  public function admingetListOfAllGraces($day,$mess){
    $handle = $this->handle;
    $query = "SELECT * FROM grace WHERE mess='{$mess}' AND day='{$day}' AND grace_override=0";
    if ($result=$handle->query($query)){
      $noOfGraces = $result->num_rows;
      echo "<b>Total no of Graces : " . $noOfGraces . "</b><br>";
      while ($graceData = $result->fetch_array()){
        $dataUid = $graceData['uid'];
        $dataGraceid = $graceData['grace_id'];
        $dataRequest_date = $graceData['request_date'];
        $function = "showModal('$dataUid','$dataGraceid')";
        $data = "";
        $data = $data . "<tr>";
        $data = $data . "<td>" . $dataUid . "</td>";
        $data = $data . "<td>" . $dataGraceid  . "</td>";
        $data = $data . "<td>" . "<button class='button is-primary'  onclick=$function>Override</button>" . "</td>";
        echo $data;
      }
    }
  }
  public function setGraceOverride($gid, $adminuid, $comment){
    $handle = $this->handle;
    $query = "UPDATE grace SET grace_override=1,comment='{$comment}' WHERE grace_id='{$gid}'";
    if ($result = $handle->query($query)){
      return True;
    }
    else{
      return False;
    }
  }
}

?>
