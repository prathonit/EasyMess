<?php
session_start();
if (!isset($_SESSION['uid'])){
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
    include 'assets/includes/home-nav.php';
     ?>
     <form class="form" action="home.php" method="post">
       <fieldset>
         <div class="field">
           <div class="control">
             <input type="text" class="input" value="<?php echo $_SESSION['uid']; ?>">
           </div>
         </div>
         <div class="field">
           <div class="control">
             <input type="submit" name="" value="Sumit" class="button is-info">
           </div>
         </div>
       </fieldset>
     </form>
  </body>
</html>
<?php
  if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    $attendance = new Attendance($_SESSION['uid']);
  }
?>
