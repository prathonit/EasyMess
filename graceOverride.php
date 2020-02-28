<?php
include 'config/dependencies.php';
$grace_id = sanitize_input($_POST['gids']);
$reason = sanitize_input($_POST['reason']);
session_start();
$mail = new Mail($_SESSION['adminuid'], " ");
$mail->sendGraceOverrideMail($grace_id, $reason);

$grace = new Grace($_SESSION['adminuid']);
$grace->setGraceOverride($grace_id, $_SESSION['adminuid'], $reason);

?>
