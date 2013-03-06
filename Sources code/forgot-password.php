<?php
/***************   INCLUDE FILE        **************/
include 'includes/header.php';
include 'includes/header-image.php';
//include 'includes/functions.php';
$obj1 = new functions();
$flag = 2;
 /***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {
    $flag = 0;
    $email = $_POST['emailid'];
    $val = 0;
    if ($email == '') {
        $emailidmsg = "Email ID Missing";
        $val = 1;
    }
    if (!eregi("^[_a-z0-9-]+(.[_a-z0-9-]+)*@[a-z0-9-]+(.[a-z0-9-]+)*(.[a-z]{2,3})$", $email)) {
        //$erremg = 'Invalid email';
    } else {
        /***************    DATABASE OPERATATION        **************/
        $sql = "SELECT * FROM login WHERE email='$email'";
        $result1 = mysql_query($sql);
        $no = mysql_num_rows($result1);
        if ($no > 0) {
            $randomno = mt_rand(0, 999999999);
            //$qry="SELECT * FROM login WHERE email='$uname' AND password='".md5($_POST['password'])."'";
            /***************   WRITE DATABASE OPRATION        **************/
            $qry = "UPDATE `login` SET `password` = '" . md5($randomno) . "' WHERE `login`.`email` ='$email'";
            //echo $qry;
            $result = mysql_query($qry);
            $row = mysql_fetch_assoc($result1);
            $fullname = $row['fname'] . " " . $row['lname'];
            $flag = 1;
            $msg = "<div width=10% align=center class=errorlabel style=overflow:hidden>Dear " . $fullname . "\n\n\nYour password has been successfully reset to :- " . $randomno . "\nLogin using this password and change to a new password.\n\n Thank you\n\n\n
                 -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480</div>";
            /***************   SEND EMAIL        **************/
            $obj1->sendmail($email, "Forgot password", $msg);
        } else {
            $errmsg = "Email Id not present";
        }
    }
}
?>
 <!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="background-color:#FFFFFF;">
    <tr>
        <td colspan="2"><caption>Forgot password</caption><br>
    <div align="center" style="text-decoration: blink;">If you already registrar Then <a href="index.php">click here</a></div>
    <?php
    if ($flag == 1) {
        ?>
        <div  align="center" style="color:green">Your Password has been Reseted successfully you will receive an email for the password </div>
        <?php
    } else if ($flag == 0) {
        ?>
        <div  align="center" style="color:red">Email Id Does Not Exist</div>
        <?php
    }
    ?>

    <table width="100%" border="0" style="background-color:#FFFFFF;">
        <tr>
            <td width="30%">&nbsp;</td>
            <td width="40%"></td>
            <td width="30%">&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>
                <div style="width:600px;height:130px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#333333;color:#FFFFFF;" align="center"><br /><br />
                    <form id="loginForm" name="loginForm" method="POST" action="">

                        <table  border="0" align="center" cellpadding="5" cellspacing="5" style="color:#FFFFFF;background-color:#333333;">
                            <tr>
                                <td ><b>Enter your email ID </b></td>
                                <td ><input name="emailid" type="text" class="textfield" id="emailid"  size="30"/></td>
                                <td style="color: #FFFFFF"><b><?php echo $emailidmsg . "<br>" . $errmsg . "<br>" . $erremg; ?> </b></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" name="submit" value="submit" /></td>
                                <td>&nbsp;</td>
                            </tr>
                        </table>
                    </form></div></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
    </table>
</td>
</tr>
</table>
<?php
/***************    FOOTER    **************/
$obj1->footer();
?>