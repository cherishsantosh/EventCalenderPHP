<?php
/***************   SESSION START     **************/
ob_start();
/***************   INCLUDE FILE       **************/
include 'includes/header.php';
$obj1 = new functions();
$regmemberid = $_GET['regmemberid'];
$eventmemberid = $_GET['eventmemberid'];
/***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {
    $remark = $_POST['remark'];
    if ($regmemberid == '') {
    } else {
        /***************  DATABASE OPRATION        **************/
        $rs = mysql_query("SELECT * FROM `templogin` WHERE memberid=$regmemberid");
        $row = mysql_fetch_row($rs);
        /***************   WRITE DATABASE OPRATION        **************/
        mysql_query("INSERT INTO `rejectlogin` (`memberid`, `email`, `password`, `fname`, `lname`, `position`, `is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`, `date`, `time`, `remark`) VALUES (NULL, '$row[1]', '$row[2]', '$row[3]', '$row[4]','$row[5]', '$row[6]', '$row[7]', '$row[8]', '$row[9]', '$row[10]', '$row[11]', '$row[12]', '$row[13]', '$row[14]', '$row[15]', '$remark');");
        $result = reject_user($regmemberid);
        header("location: approve-user.php");
    }



    if ($eventmemberid == '') {
        
    } else {
        /***************   DATABASE OPRATION        **************/
        $rs = mysql_query("SELECT * FROM `tempreservations` WHERE resid=$eventmemberid");
        $row = mysql_fetch_row($rs);
        /***************   WRITE DATABASE OPRATION        **************/
        mysql_query("INSERT INTO `rejectreservations` (`resid`, `memberid`, `machid`, `startdate`, `enddate`, `starttime`, `endtime`, `speakername`, `type`, `title`, `capacity`, `priority`, `invite_users`, `summary`, `datetime`, `activation_status`, `isblackout`, `remark`) VALUES (NULL, '$row[1]', '$row[2]', '$row[3]', '$row[4]', '$row[5]', '$row[6]', '$row[7]', '$row[8]', '$row[9]', '$row[10]', '$row[11]', '$row[12]', '$row[13]', '$row[14]', '$row[15]', '$row[16]', '$remark');");
        $result = reject_event($eventmemberid);
        header("location: approve-event.php");
    }
}

ob_flush();
?>
<?php
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];
if ($_SESSION['ACC_TYPE'] == '2') {
    include 'menu.php';
}
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<form action="" method="POST">
    <table width="100%" border="0" style="border:0;background-color: white" >
        <caption>Approve Users </caption>

        <tr>
            <td colspan="4" align="left" valign="top" ><div style="width:100%;height:23px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#0075CE;font-family:Arial, Helvetica, sans-serif;font-size:12px;" align="center">
                    <div align="left">
                        <table width="100%" border="0" style="background: none;border:0">
                            <tr> 
                                <td width="33%" style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome<a href="edit-member-profile.php" style="text-decoration:none;font-weight:bold;"><?php echo "<strong>          " . $_SESSION['FULL_NAME'] . "</strong>          "; ?></a></td>
                                <td width="17%" style="color:#FFFFFF;"><?php echo "<strong>" . $str . "</strong>"; ?></td>
                                <td width="40%" align="right" valign="top">
                                </td>
                                <td width="10%"> 

                                    <div align="center"><strong><a href="logout.php" style="color:#FFFFFF;text-decoration:none;">Logout </a></strong></div>
                                    </div>
                                    </div>
                                    <div align="left"></div></td>
                            </tr>
                        </table>
                        <br />
                    </div>
                </div></td>

        </tr>
        <tr> <td align="center">
                Remark
            </td>
            <td align="center">
                <textarea name="remark" cols="30" rows="5">  </textarea>
            </td>

        </tr>
        <tr>
            <td align="center" colspan="2">
                <input type="submit" name="submit" value="Submit">
            </td>
        </tr>
    </table>
</form>
<?php 
/***************    FOOTER    **************/
include 'includes/footer.php' ?>