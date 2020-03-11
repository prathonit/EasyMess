<?php
session_start();
if (!isset($_SESSION['uid'])){
  header("Location:index.php");
}
include 'config/dependencies.php';
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
  <style>
      /* In order to place the tracking correctly */
      canvas.drawing, canvas.drawingBuffer {
          position: absolute;
          left: 0;
          top: 0;
      }
  </style>
</head>
  <?php
    include 'assets/includes/head.php';
  ?>

  <body>
    <?php
    include 'assets/includes/home-nav.php';
     ?>
     <br><!-- Div to show the scanner -->
     <center>
     <div id="scanner-container" >

     </div>
     <h1 class="title">Welcome <?php echo $_SESSION['uid']; ?>, scan the barcode in the mess to continue ..</h1>
     <button type="button" id="btn" class="button is-primary" name="ticket-button" style="padding:50px;height:50%;width:50%;"><h1 class="title">|||||||<br>Scan</h1></button>

     <script src="assets/js/quagga.js"></script>

     <script>
         var _scannerIsRunning = false;

         function startScanner() {
             Quagga.init({
                 inputStream: {
                     name: "Live",
                     type: "LiveStream",
                     target: document.querySelector('#scanner-container'),
                     constraints: {
                         width: 500,
                         height: 320,
                         facingMode: "environment",
                     },
                 },
                 decoder: {
                     readers: [
                         "code_128_reader",
                         "ean_reader",
                         "ean_8_reader",
                         "code_39_reader",
                         "code_39_vin_reader",
                         "codabar_reader",
                         "upc_reader",
                         "upc_e_reader",
                         "i2of5_reader"
                     ],
                     debug: {
                         showCanvas: true,
                         showPatches: true,
                         showFoundPatches: true,
                         showSkeleton: true,
                         showLabels: true,
                         showPatchLabels: true,
                         showRemainingPatchLabels: true,
                         boxFromPatches: {
                             showTransformed: true,
                             showTransformedBox: true,
                             showBB: true
                         }
                     }
                 },

             }, function (err) {
                 if (err) {
                     console.log(err);
                     return
                 }

                 console.log("Initialization finished. Ready to start");
                 Quagga.start();

                 // Set flag to is running
                 _scannerIsRunning = true;
             });

             Quagga.onProcessed(function (result) {
                 var drawingCtx = Quagga.canvas.ctx.overlay,
                 drawingCanvas = Quagga.canvas.dom.overlay;

                 if (result) {
                     if (result.boxes) {
                         drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
                         result.boxes.filter(function (box) {
                             return box !== result.box;
                         }).forEach(function (box) {
                             Quagga.ImageDebug.drawPath(box, { x: 0, y: 1 }, drawingCtx, { color: "green", lineWidth: 2 });
                         });
                     }

                     if (result.box) {
                         Quagga.ImageDebug.drawPath(result.box, { x: 0, y: 1 }, drawingCtx, { color: "#00F", lineWidth: 2 });
                     }

                     if (result.codeResult && result.codeResult.code) {
                         Quagga.ImageDebug.drawPath(result.line, { x: 'x', y: 'y' }, drawingCtx, { color: 'red', lineWidth: 3 });
                     }
                 }
             });


             Quagga.onDetected(function (result) {
               var code = result.codeResult.code;
                 xhttp = new XMLHttpRequest();
                 xhttp.onreadystatechange = function(){
                   if (this.status ==200 && this.readyState ==4){
                       document.getElementById('ticket-content').innerHTML = xhttp.responseText;

                       document.getElementById('modal').classList = "modal is-active";
                   }
                 };
                 xhttp.open("GET","ajaxify/attendance.php?user=" + '<?php echo $_SESSION['uid']; ?>' + "&code="+ result.codeResult.code + "&t="+Math.random(), true);
                 xhttp.send();
             });
         }


         // Start/stop scanner
         document.getElementById("btn").addEventListener("click", function () {
             if (_scannerIsRunning) {
                 Quagga.stop();

             } else {
                 startScanner();
                 document.getElementById('btn').style = "display:none;";

             }
         }, false);
     </script>
     <div class="modal" id="modal">
     <div class="modal-background"></div>
     <div class="modal-card">
       <header class="modal-card-head">
         <p class="modal-card-title">Ticket</p>
         <button class="delete" onclick="hideModal()" aria-label="close"></button>
       </header>
       <section class="modal-card-body" id="ticket-content">

       </section>
       <footer class="modal-card-foot">
         <button class="button is-success" onclick="hideModal()" type="submit">Close</button>
         <script type="text/javascript">
         function hideModal(){
           document.getElementById('modal').style = "display:none;";
         }

         </script>

       </footer>
     </div>
   </div>
     <br>
  </body>
</html>
