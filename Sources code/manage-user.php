<?php
/***************   INCLUDE FILE       **************/
include 'includes/header.php';
$obj1 = new functions();
$memberid = $_GET['memberid'];
$isadmin = $_GET['isadmin'];
$count = 0;
/***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {
    $normaluser = $_POST['normaluser'];
    for ($i = 0; $i < count($normaluser); $i++) {
          /***************    DATABASE OPERATATION        **************/
        $rs = mysql_query("SELECT `email`,`fname`,`lname` FROM `login` WHERE `memberid`='$normaluser[$i]'");
        $row = mysql_fetch_row($rs);
        $email = $row[0];
        $fname = $row[1];
        $lname = $row[2];
        $sub = "Account deleted : Event calender";
        $msgbody = "Dear " . $fname . " " . $lname . "\nYour  Biosciences and Bioengineering (BSBE) Event calender account has been deleted.\n\n Thank you\n\n\n
             -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480";
          /***************    SENDING MAIL        **************/
        $obj1->sendmail($email, $sub, $msgbody);
        del_user($normaluser[$i]);
        $count++;
    }

    //echo "".$count." User successfuly deleted";
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
    <caption>Manage Users Permissions</caption>

    <?php $obj1->userdetail(); ?>
    <tr>

        <td valign="top">
            <form id="permisssion" name="permisssion" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="post">

                <table width="100%" border="1" align="center" cellpadding="2" cellspacing="2"  >

                    <tr>
                        <td colspan="6" style="text-align: left;"><input type="checkbox" name="sAll" onclick="selectAll(this)" /> (Select all)</td>

                    </tr>
                    <thead>

                        <tr>
                            <td style="text-align: center;"><strong>Select User</strong></td>
                            <td style="text-align: center;"><strong>Name</strong></td>
                            <td style="text-align: center;"><strong>Email</strong></td>
                            <td style="text-align: center;"><strong>Roll no</strong></td>
                            <td style="text-align: center;"><strong>Mobile no</strong></td>
                            <td style="text-align: center;"><strong>Is Admin</strong></td>
                        </tr>
                    </thead>
                    <?php
                       /***************    DATABASE OPERATATION        **************/
                    $qry = "SELECT * FROM `login`";
                    $result = mysql_query($qry);
                    while ($row = mysql_fetch_array($result)) {
                        ?>
                        <tr>
                            <td> <input type="checkbox" name="normaluser[]" value="<?php echo $row['memberid']; ?>"/></td>
                            <td><?php echo $row['fname'] . " " . $row['lname']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['rollno']; ?></td>
                            <td><?php echo $row['mobile']; ?></td>
                            <td align="center"><a href="edit-member-profile.php?memberid=<?php echo $row['memberid']; ?>"><strong>EDIT</strong></a></td>
                        </tr>
                    <?php } ?>

                    <tr>
                        <td colspan="6" style="text-align: center;"><input type="submit" name="submit" value="Delete" /></td>

                    </tr>
                </table>

            </form>
        </td>
    </tr>
</table>
<?php 
/***************    FOOTER    **************/
include 'includes/footer.php' ?>