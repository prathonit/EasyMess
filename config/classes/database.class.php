<?php
  class DB{
    public function connectToDb(){
      $handle = new mysqli('localhost','prathonit','pwdpwd','easymess');
      if ($handle->connect_error){
        return False;
      }
      return $handle;
    }
    public function selectUserFromDb($username){
      $handle = $this->connectToDb();
      $query = "SELECT * FROM members WHERE username = '{$username}' LIMIT 1";
      if ($result = $handle->query($query)){
        $data = $result->fetch_array(MYSQLI_ASSOC);
        return $data['password'];
      }
      else{
        return "User does not exist";
      }
    }
  }

?>
