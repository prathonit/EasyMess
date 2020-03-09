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
    include 'assets/includes/admin-barcode-nav.php';
     ?>
     <?php
        $database = new DB;
        $handle = $database->connectToDb();
        $query = " SELECT * FROM barcode WHERE adminuid = '{$_SESSION['adminuid']}'";
        if ($result = $handle->query($query)){
          $row = $result->fetch_array();
          $day = date('d');
          if ($row['date']!=$day){
            $code = rand(1234,9999);
            $query = "UPDATE barcode SET code = '{$code}', date = '{$day}' WHERE adminuid = '{$_SESSION['adminuid']}'";
            $result = $handle->query($query);
          }
          else{
            $code = $row['code'];
          }
        }
      ?>
<section class="section">
  <div class="container">
    <div class="columns">
      <div class="column">
        <br><br><br><br>
        <div class="box">
          <h1 class="title">Scan the barcode</h1>
          <center>
          <script type="text/javascript" src="assets/js/JsBarcode.code128.min.js">
          </script>
          <svg id="barcode" style="width:100%;height:200px;"></svg>
          <script type="text/javascript">
            JsBarcode("#barcode", "<?php echo $code;   ?>", {
              displayValue: false,
            });
          </script>
        </div>
      </div>

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
