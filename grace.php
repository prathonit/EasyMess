<?php
session_start();
if (!isset($_SESSION['uid'])){
header("Location:index.php");
}
include 'config/dependencies.php';
$month = date('m');
$database = new DB;
$noOfOnlineGracesLeft = $database->getNoOfOnlineGracesLeft($_SESSION['uid'], $month);
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<?php
include 'assets/includes/head.php';
?>
<body>
<?php
include 'assets/includes/grace-nav.php';
?>
<section class="section">
<div class="container">
<h1 class="title">Mess Grace</h1>
<center>
<div class="box" style="padding:40px;">
<form class="" action="grace-apply.php" method="post">
 <fieldset>
   <div class="fields">
     <label for="">Select a date</label>
     <div class="control" style="width:50%;">
       <input type="date" name="grace-date" class="input" required>
     </div>
   </div><br>
   <div class="field">
     <div class="control">
       <center>
         <?php
         if ($noOfOnlineGracesLeft<=0){
           echo "<button class='button is-danger'>You are not eligible for more online graces</button>";
         }else{
           echo "<button class='button is-static'>You have ".$noOfOnlineGracesLeft ." online graces available for this month</button>";
         }
          ?>

      </center>
     </div>
   </div>
   <div class="fields">
     <div class="control">
       <center>
       <input type="submit" name="" value="Apply" class="button is-primary is-pulled-right">
        </center>
     </div>
   </div>
 </fieldset>
</form>

</div>
</div>
<br><br>
<div class="container">
  <div class="box">
    <center>
    <button class="button is-primary" onclick="showGraces()">See previous graces</button>
  </center>
  <div id="graces" style="display:none;">
    <div class="table-container">
      <table class="table is-striped" style="width:90%;">
        <thead>
          <th>Grace Id</th>
          <th>Date</th>
          <th>Request Date</th>
        </thead>
        <tbody>
          <?php
            $database = new DB;
            $gracesAll = $database->getAllGraces($_SESSION['uid']);
            echo $gracesAll;
          ?>
        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>
</section>
</body>
<script type="text/javascript">

  function showGraces(){
    document.getElementById('graces').style.display = 'block';
  }
</script>
</html>
