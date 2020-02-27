<!-- Written on 25-02-2020 by Prathmesh Srivastava https://github.com/prathonit -->
<?php
class Admin{
  function __construct($adminuid,$adminpassword){
    $this->adminuid = $adminuid;
    $this->adminpassword = $adminpassword;
    $this->database = new DB;
    $this->handle = $this->database->connectToDb();
  }
  public function getTotalRegisteredSInMess($mess){
    $handle = $this->handle;
    $query = "SELECT * FROM members WHERE mess='{$mess}'";
    if ($result = $handle->query($query)){
      return $result->num_rows;
    }
  }
  public function authenticateAdmin(){
    $database = new DB;
    $adminuserdata = $database->selectAdminFromDb($this->adminuid);
    return checkPassword($this->adminpassword, $adminuserdata['adminpassword']);
  }
  public function loginAdmin(){
    session_start();
    $_SESSION['adminuid'] = $this->adminuid;
    if ($this->adminuid == "mess1"){
      $_SESSION['mess'] = 1;
    }
    elseif($this->adminuid == "mess2"){
      $_SESSION['mess'] = 2;
    }
  }
  public function getTotalNoOfGraces($mess){
    $handle = $this->handle;
    $day = date("d");
    $query = "SELECT * FROM grace WHERE mess='{$mess}' AND day < $day ";
    if ($result = $handle->query($query)){
      return $result->num_rows;
    }
    else{
      return 9;
    }
  }
  public function getTotalAmountPayable($mess){
    $days = date("d")-1;
    return ($this->getTotalRegisteredSInMess($mess)*$days - $this->getTotalNoOfGraces($mess))*121;
  }
  public function getFootfallForDay($day, $mess){
    $handle = $this->handle;
    $query = "SELECT * FROM attendance WHERE mess='{$mess}' AND month=date('m') AND day=$day";
    $result = $handle->query($query);
    return $result->num_rows;
  }
  public function getTotalGracesForDay($day, $mess){
    $handle = $this->handle;
    $query = "SELECT * FROM grace WHERE mess='{$mess}' AND month=date('m') AND day='{$day}'";
    if ($result = $handle->query($query)){
      return $result->num_rows;
    }
    else{
      return 7;
    }
  }
  public function getAmountPayableDay($day, $mess){
    return ($this->getTotalRegisteredSInMess($mess) - $this->getTotalGracesForDay($day, $mess))*121;
  }
  public function getTotalFootfall($mess){
    $handle = $this->handle;
    $query = "SELECT * FROM attendance WHERE mess='{$mess}' AND month=date('m')";
    $result =  $handle->query($query);
    return $result->num_rows;
  }
  public function getMessSummary($mess){
    for ($i=1;$i<date("d");$i++){
      $data = "";
      $data = "<tr>";
      $data = $data . "<td>" .  $i . "</td><td>" . $this>getTotalGracesForDay($i,$mess). "</td>
      <td>" . $this->getFootfallForDay($i,$mess) . "</td><td>" . $this->getAmountPayableDay($i,$mess) . "</td></tr>";
      echo $data;
    }
  }
}
?>
