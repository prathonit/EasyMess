<?php
date_default_timezone_set('Asia/Kolkata');
include '../../config/classes/database.class.php';
include '../../config/classes/grace.class.php';
$uid = $_REQUEST['u'];
$grace = new Grace($uid);
$graceAll = $grace->getAllGraces();
echo $graceAll;
?>
