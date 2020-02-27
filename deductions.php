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
    include 'assets/includes/deductions-nav.php';
     ?>
     <section class="section">
       <div class="container">
         <div class="box">
           <h1 class="title">Mess Deductions for the month of <strong class="has-text-weight-bold"><?php echo date("F");?></</strong> </h1>
           <br>
           <article class="message">
             <div class="message-header">
               Brief Summary
             </div>
             <div class="message-body">
               Total amount deducted: Rs:  <?php
               $deduction = new Deduction($_SESSION['uid']);
               echo $deduction->getTotalDeductionForUser()['deduction'];
               ?>
               <br>
               Total number of graces taken: <?php echo $deduction->getTotalDeductionForUser()['graces'];?>
               <br>
               Number of days eaten in mess: <?php echo date("t") - $deduction->getTotalDeductionForUser()['graces'];?>
               <br>
               Amount deducted per day: Rs: 121
             </div>
           </article>
         </div>
         <div class="box">
           <article class="message">
             <div class="message-header">
               Daywise mess summary
             </div>
             <div class="message-body">
               <?php
               $deduction = new Deduction($_SESSION['uid']);
               $deduction->getMonthlyDeduction();
               ?>
             </div>
           </article>
         </div>

       </div>
     </section>
  </body>
</html>
