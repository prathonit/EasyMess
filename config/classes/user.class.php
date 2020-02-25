<!-- Written on 25-02-2020 by Prathmesh Srivastava https://github.com/prathonit -->
<?php
class User{
  public $username;
  function __construct($username,$password){
    $this->username = $username;
    $this->password = $password;
  }
  public function authenticateUser(){
    $database = new DB;
    $userdata = $database->selectUserFromDb($this->username);
    return checkPassword($this->password, $userdata['password']);
  }
  public function loginUser(){
    session_start();
    $_SESSION['username'] = $this->username;
  }
}
?>
