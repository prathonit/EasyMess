<?php
session_start();
if (!isset($_SESSION['adminuid'])){
  header("Location:admin.php");
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
    include 'assets/includes/admin-nav.php';
     ?>
<section class="section">
  <div class="container">
    <div class="columns">
      <div class="column">
        <div class="box">
          <h1 class="title has-text-weight-bold">Today</h1>
          <div class="table-container">
            <table class="table is-striped" style="width:100%;">
              <thead>
                <th>Uid</th>
                <th>Grace id </th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $grace = new Grace($_SESSION['adminuid']);
                $grace->admingetListOfAllGraces(date("d"),$_SESSION['mess']);
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="column">
        <div class="box">
          <h1 class="title has-text-weight-bold">Tomorrow</h1>
          <div class="table-container">
            <table class="table is-striped" style="width:100%;">
              <thead>
                <th>Uid</th>
                <th>Grace id</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $grace = new Grace($_SESSION['adminuid']);
                $grace->admingetListOfAllGraces(date("d",strtotime("Tomorrow")),$_SESSION['mess']);
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- <div class="modal" id="modal">
    <div class="modal-background"></div>
      <div class="modal-card">
        <header class="modal-card-header">
          <p class="modal-card-title">
            Override grace
          </p>
        </header>
      </div>
      <button class="modal-close is-large" aria-label="close" onclick="closeModal()"></button>
  </div> -->
  <div class="modal" id="modal">
  <div class="modal-background"></div>
  <div class="modal-card">
    <header class="modal-card-head">
      <p class="modal-card-title">Override Grace</p>
      <button class="delete" onclick="closeModal()" aria-label="close"></button>
    </header>
    <section class="modal-card-body">
      <form class="" action="graceOverride.php" method="post">
        <div class="field">
          <label for="uid"><b>Uid</b></label>
          <div class="control">
            <input type="text" name="uid" id="uids" class="button is-static" value="">
          </div>
        </div>
        <div class="field">
          <label for="gids"><b>Grace Id</b></label>
          <div class="control">
            <input type="text" name="gids" id="gids" class="button is-static" value="">
          </div>
        </div>
        <div class="field">
          <label for="reason"><b>Reason for overriding the grace</b></label>
          <div class="control">
            <textarea class="textarea" name="reason" placeholder="Briefly describe the reason for overriding the grace" rows="3" cols="80" required></textarea>
          </div>
        </div>
        <i>A mail will be sent to the student and SMC</i>

    </section>
    <footer class="modal-card-foot">
      <button class="button is-success" type="submit">Override</button>
      </form>
      <button class="button" onclick="closeModal()">Cancel</button>
    </footer>
  </div>
</div>
</section>

</body>
<script type="text/javascript">
function showModal(uid,graceId){


  document.getElementById('uids').setAttribute("value",uid);
  document.getElementById('gids').setAttribute("value",graceId);
  document.getElementById('modal').classList = "modal is-active";

}
function closeModal(){
  document.getElementById('modal').classList = "modal";
}
</script>
</html>
