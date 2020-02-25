<!-- Written on 25-02-2020 by Prathmesh Srivastava https://github.com/prathonit -->
<?php
  class DB{
    public function connectToDb(){
      $handle = new mysqli('localhost','prathonit','pwdpwd','easymess');
      if ($handle->connect_error){
        return False;
      }
      return $handle;
    }
    public function selectUserFromDb($uid){
      $handle = $this->connectToDb();
      $query = "SELECT * FROM members WHERE uid = '{$uid}' LIMIT 1";
      if ($result = $handle->query($query)){
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data;
      }
      else{
        return "User does not exist";
      }
    }
    public function getNoOfAllowedGraces($month){
      $handle = $this->connectToDb();
      $query="SELECT * FROM gracelimit WHERE month='{$month}' LIMIT 1";
      if ($result = $handle->query($query)){
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data;
      }
    }
    public function getNoOfOnlineGracesLeft($uid, $month){
      $graces = $this->getNoOfAllowedGraces($month);
      $handle = $this->connectToDb();
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
      $handle = $this->connectToDb();
      $query = "INSERT INTO grace (uid, month, day, request_date) VALUES('{$uid}',
      '{$month}', '$day', '$request_date')";
      if ($handle->query($query)){
        return True;
      }
      else{
        return False;
      }
    }
    public function getAllGraces($uid){
      $handle = $this->connectToDb();
      $query = "SELECT * FROM grace WHERE uid='{$uid}' ORDER BY grace_id DESC";
      $gracesAll = "";
      if ($result = $handle->query($query)){
        while($data = $result->fetch_array(MYSQLI_ASSOC)){
          $gracesAll = $gracesAll ." ". "<tr><td>" .$data['grace_id'] . "</td>"."<td>".$data['day']."-".$data['month']."</td><td>".$data['request_date']."</td></tr>";
        }
        return $gracesAll;
      }
    }
    public function checkGraceEligibility($uid, $month, $day, $request_date){
      $graceEligibility = True;
      $status = "";
      $gracesLeft = $this->getNoOfOnlineGracesLeft($uid, $month);
      if ($gracesLeft<=0){
        $graceEligibility =False;
        $status = $status . "You have consumed all your online graces";
      }
      return $graceEligibility;
    }
  }

?>
