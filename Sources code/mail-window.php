<?php
/***************   INCLUDE FILE       **************/
include 'includes/header.php';
$memberid = $_GET['memberid'];
$mmmemberid = $_GET['mmmemberid'];
$resid = $_GET['resid'];
  /***************    DATABASE OPERATATION        **************/
if ($memberid == '') {
    
} else {
    $result = mysql_query("SELECT `mobile`,`email` FROM `login` WHERE `memberid`='$memberid'");
    $row = mysql_fetch_row($result);
    $mobile = $memberid;
    $email = $row[1];
    $result = mysql_query("");
}
if ($mmmemberid == '') {
    
} else {
    $result = mysql_query("SELECT `mobile`,`email` FROM `templogin` WHERE `memberid`='$mmmemberid'");
    $row = mysql_fetch_row($result);
    $mobile = $mmmemberid;
    $email = $row[1];
}

if ($resid == '') {
    
} else {
    $result = mysql_query("SELECT `resid`,`email` FROM login NATURAL JOIN tempreservations WHERE tempreservations.memberid = login.memberid AND tempreservations.resid='$resid'");
    $row = mysql_fetch_row($result);
    $mobile = $row[0];
    $email = $row[1];
}
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<form action="send-mail-exe.php" method="POST" name=myform>
    <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
        <tr>
            <td align="right">To </td>
            <td><input type="text" name="to" value="<?php echo $email ?>" readonly="" /></td>
        </tr>
        <tr> Select your Question :-<br>
        <select name=mylist multiple >
            <?php 
            /***************    DATABASE OPERATATION        **************/
             $result = mysql_query("SELECT * FROM question");
                    while ($row1 = mysql_fetch_array($result)) { 
              echo "<option value=".$row1['question'].">".$row1['question']."</option>"; }
            ?>

        </select></tr>
        <tr>
        <input type=button name=mybtn value="Copy" onclick="copy();"></tr>
        <tr> Question :-
        <textarea name=myarea rows=4 cols="25">
        </textarea></tr>
        </tr>
        <tr>
            <td align="right">Subject </td>
            <td><input type="text" name="sub" value="<?php
if ($mmmemberid != '') {
    echo "More information from user side";
}
if ($resid != '') {
    echo "More information regarding event";
}
?>" /></td>
        </tr>
        <tr>
            <td align="right">Body</td>
            <?php $msg = "Dear User,\n  http://www.bio.iitb.ac.in/eventcalendar/moreinfo.php?mememail=" . $email . "  \n\nThank you\n\n\n
                 -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480"; ?>
            <?php $msgevent = "Dear User,\n  http://www.bio.iitb.ac.in/eventcalendar/moreinfoevent.php?resid=" . $mobile . "  \n\nThank you\n\n\n
                 -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480"; ?>
            <td><textarea rows="10" cols="50" name="body" ><?php
            if ($resid != '') {
                echo $msgevent;
            }
            if ($mmmemberid != '') {
                echo $msg;
            }
            ?></textarea></td>
        </tr>
        <tr>
            <?php if ($resid != '') {
                echo "========= REDID :-".$mobile;
                ?>
        <input type="hidden" name="sres" id="sres" value="<?php echo $mobile; ?>">
            <?php
        }
        if ($mmmemberid != '') {
              echo "========= EMAILID:- ".$mobile;
            ?>
            <input type="hidden" name="semail" id="semail" value="<?php echo $mobile; ?>">
            <?php
        }
        ?></textarea></td>
        </tr>
        <tr>

            <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td>
        </tr>
    </table>
</form>