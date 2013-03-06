<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$obj1 = new functions();
$memberid = $_GET['memberid'];

/***************    DATABASE OPRATION        **************/
$rs = mysql_query("SELECT `email`,`fname`,`lname` FROM `templogin` WHERE `memberid`='$memberid'");
//echo "SELECT `email`,`fname`,`lname` FROM `templogin` WHERE `memberid`='$memberid';
$row = mysql_fetch_row($rs);
$email = $row[0];
$fname = $row[1];
$lname = $row[2];

$sub = "Registration Accepted";
$msgbody = "Dear " . $fname . " " . $lname . ",\nYour event is successfuly schedule by administrator.\nNow you can login in your account and access you desktop and mobile aaplication.\n\n Thank you\n\n\n
     -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480";

/***************    SEND MAIL        **************/
$obj1->sendmail($email, $sub, $msgbody);
$result = user_approve($memberid);
if ($result) {
    @header("location: manage-user.php");
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
    <caption>Registration Approval</caption>

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
                            <td style="text-align: center;"><strong>Name</strong></td>
                            <td style="text-align: center;"><strong>Email</strong></td>
                            <td style="text-align: center;"><strong>Roll no</strong></td>
                            <td style="text-align: center;"><strong>Mobile no</strong></td>
                            <td style="text-align: center;"><strong>Register Date</strong></td>
                            <td style="text-align: center;"><strong>Register Time</strong></td>
                            <td style="text-align: center;"><strong>Approve</strong></td>
                            <td style="text-align: center;"><strong>Reject</strong></td>
                            <td style="text-align: center;"><strong>More Info</strong></td>
                        </tr>
                    </thead>
                    <?php
                    $qry = "SELECT * FROM `templogin`";
                    $result = mysql_query($qry);
                    while ($row = mysql_fetch_array($result)) {
                        ?>
                        <tr>
                            <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['rollno']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td><?php echo $row['date']; ?></td>
                            <td><?php echo $row['time']; ?></td>
                            <td align="center"><a href="approve-user.php?memberid=<?php echo $row['memberid']; ?>"><strong>Approve</strong></a></td>
                            <td align="center"><a href="reject-user.php?regmemberid=<?php echo $row['memberid']; ?>"><strong>Reject</strong></a></td>
                            <?php
                            $ee = $row['mobile'];
                            $kk=$obj1->getflag($row['memberid']);
                            //echo "=========".$kk;
                            if($kk=='0'){
                            ?>
                            <td align="center"><a href="javascript:void(0)" onclick="moreinfo(<?php echo $row['memberid']; ?>)">Get Info</a></td>
                            <?php }else{ ?>
                            <td align="center"><a href="javascript:void(0)" onclick="showmoreinfo(<?php echo $row['memberid']; ?>)"><strong>Show Info</strong></a></td>
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