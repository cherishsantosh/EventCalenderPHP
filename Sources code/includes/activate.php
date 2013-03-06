<?php
include 'query.php';
include 'functions.php';
include 'operaterelay.php';
if($_GET['status'] == 'Activate')
{
    
    $q = get_reservation_id($_GET['resid']);
    $row = mysql_fetch_assoc($q);
    $machrow = get_resource_activatation($row['machid']);
    $ip = $machrow['relay_ipaddress'];
    $switchno = $machrow['relay_switch_number'];
    $resid = $_GET['resid'];
    $getCheck = checkTime($resid,$machrow['activation_status']);
    if($getCheck=='OK')
    {
        if($ip != "" && $switchno != "")            
        {
         
            OperateRelays("SR",$ip,$switchno);
        }
      
      
        $sql = "update resources set activation_status=0 where machid=".$row['machid'];
        mysql_query($sql);
        mysql_query("update reservations set activation_status=0 where resid=$resid");
      
    }
    else
    {
       //header("location:index.php?error=$getCheck&j=".$_GET['j']);
        ?>
        <?php echo $getCheck ?>
        <?php
    }
}

?>
