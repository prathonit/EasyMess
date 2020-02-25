<?php
session_start();
if (!isset($_SESSION['username'])){
header("Location:index.php");
}
include 'config/dependencies.php';
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
<form class="" action="index.html" method="post">
 <fieldset>
   <div class="fields">
     <label for="">Select a date</label>
     <div class="control" style="width:50%;">
       <input type="date" name="grace-date" class="input">
     </div>
   </div><br>
   <div class="field">
     <div class="control">
       <center>
       <button class="button is-static">You have n graces available for this month</button>
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
          <th>Month</th>
          <th>Date</th>
        </thead>
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
