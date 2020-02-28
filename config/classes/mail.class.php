<?php
class Mail{
    public function __construct($admin, $senderMail){
      $this->adminuid = $admin;
      $this->from = $senderMail;
      $this->database = new DB;
      $this->handle = $this->database->connectToDb();
    }
    public function sendGraceOverrideMail($graceId, $comment){
      $handle = $this->handle;
      $query = "SELECT * FROM grace WHERE grace_id = '{$graceId}'";
      if ($result = $handle->query($query)){
        $time = date("H-i");
        $date = date("d/m");
        $graceData = $result->fetch_array(MYSQLI_ASSOC);
        $to = $graceData['uid'] . "@hyderabad.bits-pilani.ac.in";
        $from = $this->from;
        $subject = "Grace Override Notice";
        $headers = "From: " . $this->from . "\r\n";
        $headers .= "BCC: smc@hyderabad.bits-pilani.ac.in \r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
        $msg = "<html><body>";
        $msg .= "<p>Dear". $graceData['uid'] . "<br>";
        $msg .= "Your grace for" .  $graceData['day'] ."-" . $graceData['month'] . "was overridden by" . $this->adminuid . "at
        <b>" . $time . "</b> on <b>" . $date . "</b> for the following reason <br>";
        $msg .= "<i>" . $comment .  "</i> <br>";
        $msg .= "For any query please contact the mess administration.";
        mail($to, $from , $msg, $headers);
      }
    }
}
 ?>
