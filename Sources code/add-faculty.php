<?php
/***************    SESSION START        **************/
ob_start();
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$obj1 = new functions();

$facid = $_GET['facid'];
/***************    DATABASE  OPERATION    **************/
$rs3 = mysql_query("SELECT * FROM `faculty` WHERE `member_id`='$facid'");
//echo "SELECT * FROM `faculty` WHERE `member_id`='$facid'";
$row3 = mysql_fetch_row($rs3);
$fname = $row3[1];
$lname = $row3[2];
$mob = $row3[4];
$email = $row3[5];
$nacl = $row3[6];
$eid = $row3[3];

/***************    FORM SUBMIT ACTION        **************/
if (isset($_POST["submit"])) {

    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $mob = $_POST['mob'];
    $email = $_POST['email'];
    $nacl = $_POST['nacl'];
    $eid = $_POST['eid'];
    /***************    ERROR MESSAGAE        **************/
    $val = 0;
    if ($fname == '') {
        $errfname = "First name is missing";
        $val = 1;
    } elseif ($lname == '') {
        $errlname = "Last name is missing";
        $val = 1;
    } elseif ($mob == '') {
        $errmob = "Mobile no  is missing";
        $val = 1;
    } elseif ($email == '') {
        $erremail = "Capacity is missing";
        $val = 1;
    } elseif ($nacl == '') {
        $errnacl = "NACL is missing";
        $val = 1;
    } elseif ($eid == '') {
        $erreid = "Employee Id is missing";
        $val = 1;
    }

    /***************    WRITE INTO DATABASE      **************/
    if ($val == '0') {
        if ($facid == '') {
            mysql_query("INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES (NULL, '$fname', '$lname', '$eid', '$mob', '$email', '$nacl')");
            //echo "INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES (NULL, '$fname', '$lname', '$eid', '$mob', '$email', '$nacl');";
            echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
            header("location: add-faculty.php");
        } else {
            mysql_query("UPDATE `faculty` SET `firstname` =  '$fname',`lastname` =  '$lname',`empid` =  '$eid',`mobno` =  '$mob',`email` =  '$email',`nikname` =  '$nacl' WHERE  `faculty`.`member_id` ='$facid';");
            //echo "INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES (NULL, '$fname', '$lname', '$eid', '$mob', '$email', '$nacl');";
            echo "<script type='text/javascript'>alert('you have successfully updated !');</script>";
            header("location: add-faculty.php");
        }
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
        <caption>Add Faculty</caption>
        <?php $obj1->userdetail(); ?>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <div id="divoverflow">
                    <table width="100%" border="1" cellpadding="4" >
                        <tr style="font-weight: bold;">
                            <td align="center">First Name</td>
                            <td align="center">Last Name</td>
                            <td align="center">Employee ID</td>
                            <td align="center">Mobile no</td>
                            <td align="center">Email Id</td>
                            <td align="center">NACL</td>
                            <td align="center">Edit</td>
                            <td align="center">DeleteL</td>

                        </tr>
                        <?php
                        /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM faculty");
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $row[1]; ?></td>
                                <td align="center"><?php echo $row[2]; ?></td>
                                <td align="center"><?php echo $row[3]; ?></td>
                                <td align="center"><?php echo $row[4]; ?></td>
                                <td align="center"><?php echo $row[5]; ?></td>
                                <td align="center"><?php echo $row[6]; ?></td>
                                <td align="center"><a href="add-faculty.php?facid=<?php echo $row['member_id']; ?>"><strong>Edit</strong></a></td>
                                <td align="center"><strong>Delete</strong></td>

                            </tr>
                        <?php } ?>
                    </table>
                    <br><br>
                </div>
            </td>

        </tr>
        <tr>
            <td width="33%" align="right">First Name</td>
            <td width="33%"><input type="text" name="fname" value="<?php echo $fname; ?>"></td>
            <td width="33%"><?php echo $errfname; ?></td>
        </tr>
        <tr>
            <td align="right">Last Name</td>
            <td><input type="text" name="lname" value="<?php echo $lname; ?>"></td>
            <td><?php echo $errlname; ?></td>
        </tr>
        <tr>
            <td align="right">Employee ID</td>
            <td><input type="text" name="eid" value="<?php echo $eid; ?>"></td>
            <td><?php echo $erreid; ?></td>
        </tr>
        <tr>
            <td align="right">Mobile no</td>
            <td><input  name="mob" type="text" id="mob" size="10"  value="<?php echo $mob; ?>" onblur="validatemobile();"></td>
            <td><?php echo $errmob; ?></td>
        </tr>
        <tr>
            <td align="right">Email Id</td>
            <td><input type="text" id="email" name="email" value="<?php echo $email; ?>" onBlur="javascript:return validateemail('loginForm','email');" ></td>
            <td><?php echo $erremail; ?></td>
        </tr>
        <tr>
            <td align="right">NACL</td>
            <td><input type="text" name="nacl" value="<?php echo $nacl; ?>"></td>
            <td><?php echo $errnacl; ?></td>
        </tr>
        <tr style="border-collapse:0px;background-color:#FFFFFF;">
            <td colspan="3"><center><input type="submit" name="submit" value="submit" /></center></td>
        </tr>
    </table>
</form>

<?php 
/***************    FOOTER      **************/
$obj1->footer(); ?>