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
    include 'assets/includes/admin-accounts-nav.php';
     ?>
<section class="section">
  <div class="container">
    <h1 class="title">Accounts information for <i>Mess <b><?php echo $_SESSION['mess']; ?></b></i></h1>
    <i>Note: All information true as of one day yesterday</i>
    <div class="columns">
      <div class="column">
        <div class="box">
          <b>Brief Summary </b><br>
          Total Amount Payable: Rs : <?php
          $admin = new Admin($_SESSION['adminuid']," ");
          echo $admin->getTotalAmountPayable($_SESSION['mess']);
           ?> <br>
          Total numbers of Graces Taken: <?php
          echo $admin->getTotalNoOfGraces($_SESSION['mess']);
          ?><br>
          <b>Total footfall in mess: </b><?php
          echo $admin->getTotalFootfall($_SESSION['mess']);
           ?>
        </div>
      </div>
      <div class="column">
        <div class="box">
          <b>Detailed Daywise mess summary</b>
          <div class="table-container">
            <table class="table is-striped" style="width:100%;">
              <thead>
                <td>Day</td>
                <td>Graces</td>
                <td>Footfall</td>
                <td>Amount payable</td>
              </thead>
              <tbody>
                <?php
                $admin->getMessSummary($_SESSION['mess']);
                 ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

</body>
</html>
