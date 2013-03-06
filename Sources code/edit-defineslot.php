<?php
/***************  SESSION START        **************/
ob_start();
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$obj1 = new functions();

$slotid = $_GET['slotid'];
/***************    DATABASE OPRATION        **************/
$rs3 = mysql_query("SELECT * FROM `eachdetail` WHERE `slotno`='$slotid'");
//echo "SELECT * FROM `event` WHERE `srno`='$eveid'";
$row3 = mysql_fetch_row($rs3);
$slotno = $row3[0];
$sdate = $row3[1];
$edate = $row3[2];
$sem = $row3[3];
/***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {
    $fname = $_POST['fname'];
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $semtype = $_POST['semtype'];
    $semyear=$_POST['semyear'];
    $val = 0;
    /***************    EROOR MESSAGAE        **************/
    if ($fname == '') {
        $errfname = "Slot number is missing";
        $val = 1;
    }if ($sdate == '') {
        $errsdate = "Starting date is missing";
        $val = 1;
    }if ($edate == '') {
        $erredate = "Ending date is missing";
        $val = 1;
    }if ($semtype == '') {
        $errsemtype = "Semister type is missing";
        $val = 1;
    }
/***************   WRITE DATABASE OPRATION        **************/
    if ($val == '0') {
        $rr=$semtype."".$semyear;
            mysql_query("UPDATE `eachdetail` SET `startdate` =  '$sdate',`enddate` =  '$edate',`slotyear` =  '$rr' WHERE  `slotno` ='$slotid';");
           // echo "UPDATE `eachdetail` SET `startdate` =  '$sdate',`enddate` =  '$edate',`slotyear` =  '$rr' WHERE  `slotno` ='$slotid';";
            echo "<script type='text/javascript'>alert('Your request have been successfuly updated !');</script>";
            header("location:edit-defineslot.php");
        
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
<form id="loginForm" name="loginForm" action="" method="POST">
    <table width="100%" border="0">
        <tr>
        <caption>Edit blank slot date</caption>
        <?php $obj1->userdetail(); ?>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <div id="divoverflow">
                    <table width="100%" border="1" cellpadding="4" >
                        <tr style="font-weight: bold;">
                            <td align="center">Slot Name</td>
                            <td align="center">Start Date</td>
                            <td align="center">End Date</td>
                            <td align="center">Academic Year</td>
                            <td align="center">Edit</td>
                            <td align="center">Delete</td>
                        </tr>
                        <?php
                        /***************    DATABASE OPRATION        **************/
                        $result = mysql_query("SELECT * FROM eachdetail");
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $row[0]; ?></td>
                                <td align="center"><?php echo $row[1]; ?></td>
                                <td align="center"><?php echo $row[2]; ?></td>
                                <td align="center"><?php echo $row[3]; ?></td>
                                <td align="center"><a href="edit-defineslot.php?slotid=<?php echo $row[0]; ?>"><strong>Edit</strong></a></td>
                                <td align="center"><strong>Delete</strong></td>
                            </tr>
                        <?php } ?>
                    </table>
                    <br><br>
                </div>
            </td>
        </tr>
        <tr>
            <td width="33%" align="right">Slot Number</td>
            <td width="33%"><input type="text" name="fname" value="<?php echo $slotno; ?>" readonly></td>
            <td width="33%"><?php echo $errfname; ?></td>
        </tr>
        <tr>
            <td width="33%" align="right"><strong>Sart Date</strong></td>
            <td width="33%"><input type="text" id="date" name="sdate" value="<?php echo $sdate; ?>"></td>
            <td width="33%"><?php echo $errfname; ?></td>
        </tr>
        <tr>
            <td width="33%" align="right"><strong>End Date</strong></td>
            <td width="33%"><div align="left"><input type="text" id="date1" name="edate" value="<?php echo $edate; ?>"></div></td>
        </tr>
        <tr>
            <td width="33%" align="right"><strong>Semister Type</strong></td>
            <td width="33%"><div align="left"> <select name="semtype" id="semtype" >
                        <option value="EVEN">EVEN</option>
                        <option value="ODD">ODD</option>
                    </select></td>
        </tr>
        <tr>
            <td width="33%" align="right"><strong>Semister Year</strong></td>
            <td width="33%"><div align="left">
                    <?php $dd = date('m/d/Y');
                    $year = explode("/", $dd);
                    ?>
                    <select name="semyear" id="semyear" >
                        <?php for ($i = $year[2]; $i < ($year[2] + 10); $i++) { ?>
                            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
<?php } ?>
                    </select></div></td>
        </tr>
        <tr style="border-collapse:0px;background-color:#FFFFFF;">
            <td colspan="3"align="center"><center><input type="submit" name="submit" value="submit" /></center></td>
        </tr>
    </table>
</form>
<?php 
/***************    FOOTER    **************/
$obj1->footer(); ?>