<?php
include 'query.php';
$q = cancel_reservation($_GET['resid']);
header("location:../member-index.php?date=".$_GET['date']."&machid=".$_GET['machid']."");
?>
