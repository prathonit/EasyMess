<?php
session_start();
if (!isset($_SESSION['uid'])){
header("Location:index.php");
}
include 'config/dependencies.php';
$month = date('m');
$grace = new Grace($_SESSION['uid']);
$noOfOnlineGracesLeft = $grace->getNoOfOnlineGracesLeft($_SESSION['uid'], $month);
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
 <fieldset>
   <div class="fields">
     <label for="">Select a date</label>
     <div class="control" style="width:50%;">
       <input type="date" name="grace-date" class="input" id="gracedate" required>
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
       <input type="submit" name="" value="Apply" class="button is-primary is-pulled-right" onclick="applyGrace()">
        </center>
     </div>
   </div>
 </fieldset>


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
        <tbody id="graces-list">

        </tbody>
      </table>
    </div>
  </div>
  </div>
</div>
</section>
</body>
<script type="text/javascript">
var i = 0;
var uid = "<?php
              echo $_SESSION['uid'];
          ?>";
  function applyGrace(){
    var gracedate = document.getElementById("gracedate").value;
    xhttps = new XMLHttpRequest();
    xhttps.onreadystatechange = function(){
      if (this.status ==200 && this.readyState ==4){
        alert(this.responseText);
      }
    }
    xhttps.open("GET","ajaxify/grace/grace_apply_request.php?u=" + window.uid+"&gracedate="+gracedate);
    xhttps.send();
  }
  function showGraces(){
    if (i%2==0){
      xhttp = new XMLHttpRequest();
      xhttp.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
          document.getElementById('graces-list').innerHTML = this.responseText;
        }
      }
      xhttp.open("GET", "ajaxify/grace/grace_list_request.php?u=" + window.uid,true);
      xhttp.send();
      document.getElementById('graces').style.display = 'block';
      i++;
    }
    else{
      document.getElementById('graces').style.display = 'none';
      i++;
    }
  }
</script>
</html>
