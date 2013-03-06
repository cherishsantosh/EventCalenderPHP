<?php
/* * *************    SESSION START        ************* */
ob_start();

/* * *************    INCLUDE FILE        ************* */
include 'includes/header.php';

/* * *************    CREATE OBJECT OF CLASS        ************* */
$obj1 = new functions();

$equpid = $_GET['equpid'];

/* * *************    DATABASE  OPERATION    ************* */
$rs3 = mysql_query("SELECT * FROM `equipment` WHERE `srno`='$equpid'");
//echo "SELECT * FROM `faculty` WHERE `member_id`='$facid'";
$row3 = mysql_fetch_row($rs3);
$fname = $row3[1];

/* * *************    FORM SUBMIT ACTION        ************* */
if (isset($_POST["submit"])) {

    $fname = $_POST['fname'];
    $val = 0;
    /*     * *************    ERROR MESSAGAE        ************* */
    if ($fname == '') {
        $errfname = "Equipment name is missing";
        $val = 1;
    }
    /*     * *************    WRITE INTO DATABASE      ************* */
    if ($val == '0') {
        if ($equpid == '') {
            mysql_query("INSERT INTO `equipment` (`srno`, `name`) VALUES (NULL, '$fname');");
            //echo "INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES (NULL, '$fname', '$lname', '$eid', '$mob', '$email', '$nacl');";
            echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
            header("location: add-equipment.php");
        } else {
            mysql_query("UPDATE `equipment` SET `name` =  '$fname' WHERE  `equipment`.`srno` ='$equpid';");
            //echo "INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES (NULL, '$fname', '$lname', '$eid', '$mob', '$email', '$nacl');";
            echo "<script type='text/javascript'>alert('you have successfully updated !');</script>";
            header("location: add-equipment.php");
        }
    }
}
ob_flush();
?>
<?php
/* * *************    INCLUDE MENU IF {Admin login}        ************* */
$_SESSION['ACC_TYPE'];
if ($_SESSION['ACC_TYPE'] == '2') {
    include 'menu.php';
}
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<form id="loginForm" name="loginForm" action="" method="POST">
    <table width="100%" border="0">
        <tr>
            <!--   ****************   FORM TITLE       ****************  -->
        <caption>Add Equipment</caption>
        <?php
        /*         * *************    TYPE OF USER AND LOGOUT        ************* */
        $obj1->userdetail();
        ?>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <div id="divoverflow">
                    <table width="100%" border="1" cellpadding="4" >
                        <tr style="font-weight: bold;">
                            <td align="center">Equipment Name</td>

                            <td align="center">Edit</td>
                            <td align="center">DeleteL</td>

                        </tr>
                        <?php
                        /*                         * *************    DATABASE  OPERATION    ************* */
                        $result = mysql_query("SELECT * FROM equipment");
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $row[1]; ?></td>

                                <td align="center"><a href="add-equipment.php?equpid=<?php echo $row['srno']; ?>"><strong>Edit</strong></a></td>
                                <td align="center"><strong>Delete</strong></td>

                            </tr>
<?php } ?>
                    </table>
                    <br><br>
                </div>
            </td>

        </tr>
        <tr>
            <td width="33%" align="right">Equipment Name</td>
            <td width="33%"><input type="text" name="fname" value="<?php echo $fname; ?>"></td>
            <td width="33%"><?php echo $errfname; ?></td>
        </tr>

        <tr style="border-collapse:0px;background-color:#FFFFFF;">
            <td colspan="3"><center><input type="submit" name="submit" value="submit" /></center></td>
        </tr>
    </table>
</form>
<?php
/* * *************    FOOTER      ************* */
$obj1->footer();
?>