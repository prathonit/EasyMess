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
               Total amount deducted:
               <br>
               Total number of graces taken:
               <br>
               Number of days eaten in mess:
               <br>
               Amount deducted per day:
             </div>
           </article>
         </div>
         <div class="box">
           <article class="message">
             <div class="message-header">
               Daywise mess summary
             </div>
             <div class="message-body">
               <div class="box">
                 <div class="columns">
                   <div class="column is-narrow is-2 has-text-centered">
                     <div class="box">
                       12/02
                     </div>
                   </div>
                   <div class="column has-text-centered">
                     <div class="box">
                       hi
                     </div>
                   </div>
                   <div class="column">
                     <div class="box">
                       
                     </div>
                   </div>
                 </div>
               </div>
             </div>
           </article>
         </div>

       </div>
     </section>
  </body>
</html>
