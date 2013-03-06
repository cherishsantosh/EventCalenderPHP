<?php
include 'query.php';
include 'functions.php';
include 'operaterelay.php';
if($_GET['status'] == 'Deactivate')
{
    
    $q = get_reservation_id($_GET['resid']);
    $row = mysql_fetch_assoc($q);
    $machrow = get_resource_activatation($row['machid']);
    $ip = $machrow['relay_ipaddress'];
    $switchno = $machrow['relay_switch_number'];
    $resid = $_GET['resid'];
    OperateRelays("CR",$ip,$switchno);
    $sql = "update reservations set activation_status=1 where resid=$resid";
    mysql_query($sql);
    mysql_query("update resources set activation_status=1 where machid=".$row['machid']."");
    header("location:../member-index.php?date=".$_GET['date']."&machid=".$_GET['machid']);
}
?>
