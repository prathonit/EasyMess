<!-- Written on 25-02-2020 by Prathmesh Srivastava https://github.com/prathonit -->
<?php
class User{
  function __construct($uid,$password){
    $this->uid = $uid;
    $this->password = $password;
  }
  public function getMessOfUser(){
    $database = new DB;
    $handle = $database->connectToDb();
    $query = "SELECT mess FROM members WHERE uid='{$this->uid}'";
    if ($result = $handle->query($query)){
      return $result->fetch_array(MYSQLI_ASSOC)['mess'];
    }
  }
  public function authenticateUser(){
    $database = new DB;
    $userdata = $database->selectUserFromDb($this->uid);
    return checkPassword($this->password, $userdata['password']);
  }
  public function loginUser(){
    session_start();
    $_SESSION['uid'] = $this->uid;
    $_SESSION['mess'] = $this->getMessOfUser();
  }
}
?>
