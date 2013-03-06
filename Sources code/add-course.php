<?php
/***************    SESSION START        **************/
ob_start();

/***************    INCLUDE FILE        **************/
include 'includes/header.php';

/***************    CREATE OBJECT OF CLASS        **************/
$obj1 = new functions();

$courseid = $_GET['courseid'];
/***************    DATABSE OPERATION        **************/
$rs3 = mysql_query("SELECT * FROM `SubjectCodeName` WHERE `srno`='$courseid'");
//echo "SELECT * FROM `faculty` WHERE `member_id`='$facid'";
$row3 = mysql_fetch_row($rs3);
$cid = $row3[1];
$cname = $row3[2];

/***************    FORM SUBMIT ACTION        **************/

if (isset($_POST["submit"])) {

    $cid = $_POST['cid'];
    $cname = $_POST['cname'];
   
/***************    ERROR MESSAGAE        **************/
    $val = 0;
    if ($cid == '') {
        $errcid = "Course ID is missing";
        $val = 1;
    } 
    if ($cname == '') {
        $errcname = "Course name is missing";
        $val = 1;
    } 

    /***************    WRITE INTO DATABASE      **************/
    if ($val == '0') {
        if ($courseid == '') {
            mysql_query("INSERT INTO `SubjectCodeName` (`srno`, `subcode`, `subname`) VALUES (NULL, '$cid', '$cname');");
            //echo "INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES (NULL, '$fname', '$lname', '$eid', '$mob', '$email', '$nacl');";
            echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
            header("location: add-course.php");
        } else {
            mysql_query("UPDATE `SubjectCodeName` SET `subcode` =  '$cid',`subname` =  '$cname' WHERE  `SubjectCodeName`.`srno` ='$courseid';");
            //echo "INSERT INTO `faculty` (`member_id`, `firstname`, `lastname`, `empid`, `mobno`, `email`, `nikname`) VALUES (NULL, '$fname', '$lname', '$eid', '$mob', '$email', '$nacl');";
            echo "<script type='text/javascript'>alert('Your request have been successfuly updated !');</script>";
            header("location: add-course.php");
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
<!-- HTML FORM CODE  -->
<form id="loginForm" name="loginForm" action="" method="POST">
    <table width="100%" border="0">
        <tr>
        <caption>Add Course</caption>
        <?php 
        /***************    TYPE OF USER AND LOGOUT        **************/
        $obj1->userdetail(); ?>
        </tr>
        <tr>
            <td colspan="3" align="center">
                <div id="divoverflow">
                    <table width="100%" border="1" cellpadding="4" >
                        <tr style="font-weight: bold;">
                            <td align="center">Course Code</td>
                          <td align="center">Course Name</td>
                            <td align="center">Edit</td>
                            <td align="center">DeleteL</td>

                        </tr>
                        <?php
                        /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM SubjectCodeName");
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <tr>
                                <td align="center"><?php echo $row[1]; ?></td>
                                 <td align="center"><?php echo $row[2]; ?></td>
                                <td align="center"><a href="add-course.php?courseid=<?php echo $row['srno']; ?>"><strong>Edit</strong></a></td>
                                <td align="center"><strong>Delete</strong></td>

                            </tr>
                        <?php } ?>
                    </table>
                    <br><br>
                </div>
            </td>

        </tr>
        <tr>
            <td width="33%" align="right">Course Id</td>
            <td width="33%"><input type="text" name="cid" value="<?php echo $cid; ?>"></td>
            <td width="33%"><?php echo $errcid; ?></td>
        </tr>
         <tr>
            <td width="33%" align="right">Course Name</td>
            <td width="33%"><input type="text" name="cname" value="<?php echo $cname; ?>"></td>
            <td width="33%"><?php echo $errcname; ?></td>
        </tr>
        
        <tr style="border-collapse:0px;background-color:#FFFFFF;">
            <td colspan="3"><center><input type="submit" name="submit" value="submit" /></center></td>
        </tr>
    </table>
</form>
<?php 
/***************    FOOTER      **************/
$obj1->footer(); ?>