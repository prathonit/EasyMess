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
    public function selectAdminFromDb($adminuid){
      $handle = $this->connectToDb();
      $query = "SELECT * FROM admin WHERE adminuid = '{$adminuid}' LIMIT 1";
      if ($result = $handle->query($query)){
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data;
      }
      else{
        return "Admin does not exist";
      }
    }
  }

?>
