<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$obj1 = new functions();
$resid = $_GET['memberid'];
/***************    DATABASE  OPERATION    **************/
$rs1 = mysql_query("SELECT `memberid`,type FROM `tempreservations` WHERE `resid`='$resid'");
$row1 = mysql_fetch_row($rs1);
$memberid = $row1[0];
$type = $row1[1];
//echo "==>" . $memberid;
/***************    DATABASE  OPERATION    **************/
$rs = mysql_query("SELECT `email`,`fname`,`lname` FROM `login` WHERE `memberid`='$memberid'");
//echo "<br>SELECT `email`,`fname`,`lname` FROM `login` WHERE `memberid`='$memberid'";
$row = mysql_fetch_row($rs);
$email = $row[0];
$fname = $row[1];
$lname = $row[2];

//echo $email . "<<>>" . $fname . "<<>>" . $lname;
$sub = "Event Sechude";
$msgbody = "Dear " . $fname . " " . $lname . "\nYour proposed event ".$type.", has been scheduled.\n\n Thank you";
/***************    SEND EMAIL    **************/
$obj1->sendmail($email, $sub, $msgbody);
/***************    DATABASE  OPERATION    **************/
$rs3 = mysql_query("SELECT * FROM `tempreservations` WHERE `resid`='$resid'");
$row3 = mysql_fetch_row($rs3);
$event = $row3[8];

$memberid= $row3[1];	
$machid= $row3[2];	
$startdate= $row3[3];	
$enddate= $row3[4];	
$starttime= $row3[5];	
$endtime= $row3[6];	
$speakername= $row3[7];	
$title= $row3[9];	
$summary= $row3[13];	

$msg="Dear all,\n\n".$event." Event has been scheduled on date ".date("d/m/Y",$startdate)."\n\n Time : ".$starttime.
        "-".$starttime."\n\n Title : ".$title.
        "\n\n Spekar Name : ".$speakername.
        "\n\n Vanue : ".  idtovanue($machid).
        "\n\n Abstract : ".  $summary."
           
-- 
\nRegards,
Office of the Head
Department of Biosciences & Bioengineering
IIT Bombay, Powai, Mumbai- 400076.
Tele:- 25767771
Fax: - 25723480
\n\nPlease click following link for unsuscribe http://localhost/NewMod/unsucsribe.php
";
/***************    SEND MAIL    **************/
$obj1->send_not($event,$msg);

$result = event_approve($resid);
if ($result) {
    //@header("location: approve-event.php");
} else {
    
}
?>
<?php
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];
if ($_SESSION['ACC_TYPE'] == '2') {
    include 'menu.php';
}
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="border:0;background-color: white" >
    <caption>Event Approval</caption>

     <?php $obj1->userdetail(); ?>
    <td>
        <hr>
    </td>
    <td>
        <hr>
    </td>
    <tr>

        <td valign="top">
            <form id="permisssion" name="permisssion" action="" method="post">

                <table width="100%" border="1" align="center" cellpadding="2" cellspacing="2"  >


                    <thead>
                        <tr>
                            <td style="text-align: center;"><strong>Spekar Name</strong></td>
                              <td style="text-align: center;"><strong>End Date</strong></td>
                            <td style="text-align: center;"><strong>Start Time</strong></td>
                          
                            <td style="text-align: center;"><strong>End Time</strong></td>
                            <td style="text-align: center;"><strong>Event Titile</strong></td>
                            <td style="text-align: center;"><strong>Event Vanue</strong></td>
                            <td style="text-align: center;"><strong>Accept</strong></td>
                            <td style="text-align: center;"><strong>Reject</strong></td>
                             <td style="text-align: center;"><strong>Moreinfo</strong></td>
                        </tr>
                    </thead>
                    <?php
                    /***************    DATABASE  OPERATION    **************/
                    $qry = "SELECT * FROM `tempreservations`";
                    $result = mysql_query($qry);
                    while ($row = mysql_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['speakername']; ?></td>
                             <td><?php echo date("d/m/Y",$row['startdate']); ?></td>
                            <td><?php echo $row['starttime']; ?></td>
                            <td><?php echo $row['endtime']; ?></td>
                            <td><?php echo $row['title']; ?></td>
                            <td><?php echo idtovanue($row['machid']); ?></td>
                            <td align="center"><a href="approve-event.php?memberid=<?php echo $row['resid']; ?>"><strong>Approve</strong></a></td>
                            <td align="center"><a href="reject-user.php?eventmemberid=<?php echo $row['resid']; ?>"><strong>Reject</strong></a></td>
                            <?php
                            $kk=$obj1->geteventflag($row['resid']);
                            if($kk=='0'){
                            ?>
                            <td align="center"><a href="javascript:void(0)" onclick="moreinfoevent(<?php echo $row['resid']; ?>)">Get Info</a></td>
                            <?php }else{ ?>
                            <td align="center"><a href="javascript:void(0)" onclick="showmoreinfoevent(<?php echo $row['resid']; ?>)"><strong>Show Info</strong></a></td>
                            <?php } ?>
                        </tr>
                    <?php } ?>


                </table>

            </form>
        </td>
    </tr>
</table>
<?php 
/***************    FOOTER    **************/
include 'includes/footer.php' ?>