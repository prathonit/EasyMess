<!-- Written on 25-02-2020 by Prathmesh Srivastava https://github.com/prathonit -->
<?php
class Admin{
  function __construct($adminuid,$adminpassword){
    $this->adminuid = $adminuid;
    $this->adminpassword = $adminpassword;
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
}
?>
