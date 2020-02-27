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
                <th>Requested on </th>
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
                <th>Requested on </th>
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
      <!-- Content ... -->
    </section>
    <footer class="modal-card-foot">
      <button class="button is-success">Override</button>


      <button class="button" onclick="closeModal()">Cancel</button>
    </footer>
  </div>
</div>


</section>

</body>
<script type="text/javascript">
function showModal(){
  document.getElementById('modal').classList = "modal is-active";
  
}
function closeModal(){
  document.getElementById('modal').classList = "modal";
}
</script>
</html>
