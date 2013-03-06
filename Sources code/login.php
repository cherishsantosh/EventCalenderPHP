<?php
/***************   SESSION START       **************/
ob_start();
/***************   INCLUDE FILE        **************/
include 'includes/header.php';
include 'includes/header-image.php';
//include 'includes/functions.php';

$obj1 = new functions();
$valflag = 0;
/***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {

    $login = $_POST['login'];
    $password = $_POST['password'];
    if ($login == '') {
        $valflag = 1;
        $loginmsg = "Login Name Missing";
    }if ($password == '') {
        $valflag = 1;
        $passmsg = "Password Is Missing";
    }

    $passwords = md5($_POST['password']);

    if ($valflag == '0') {

        $rr = login_exec($login, $passwords);
        if ($rr == 'true') {
            echo "Login successful";
            $date = date("m/d/Y");
            header("location: member-index.php?date=$date&machid=1");
        } else {
            $loginerrmsg = "You Are Not An Approved User";
        }
    }
}
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<table width="300" border="0" align="center" style="background: #FFFFFF;">
    <tr>
        <td colspan="2">  <caption>Login Form</caption></td>
</tr>
<tr>
    <td colspan="2">

        <table width="100%" border="0" style="background-color:#FFFFFF;"></
            <tr>
                <td colspan="2" align="center" ><span class="errorlabel"><?php echo $loginmsg; ?></span></td>
            </tr>
            <tr>
                <td colspan="2" align="center" ><span class="errorlabel"><?php echo $passmsg; ?></span></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><span class="errorlabel"><?php echo $loginerrmsg; ?></span></td>
            </tr>
        </table>


    </td>
</tr>
<tr>
    <td colspan="2">
        <div style="width:400px;height:170px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#333333;color:#FFFFFF;" align="center"><br /><br />
            <form id="loginForm" name="loginForm" action="" method="POST">
                <table width="300" border="0" align="center" cellpadding="5" cellspacing="5" style="color:#FFFFFF;background-color:#333333;">

                    <tr>
                        <td width="50%"><b>Email id</b></td>
                        <td width="50%"><input name="login" type="text" class="textfield" id="login"  size="25" /></td>
                    </tr>
                    <tr>
                        <td><b>Password</b></td>
                        <td><input name="password" type="password" class="textfield" id="password"  size="25"  /></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input type="submit" name="submit" value="submit" /></td>
                    </tr>

                </table>
            </form></div>
    </td>
</tr>

</table>
<table width="300" border="0" align="center" cellpadding="5" cellspacing="5" style="background: #FFFFFF;">
    <tr>
        <td><a href="register-form.php"><strong>New Registration</strong></a></td>
        <td><a href="forgot-password.php"><strong>forgot password?</strong></a></td>
    </tr>
</table>
<br><br>
<?php
/***************    FOOTER    **************/
$obj1->footer();
ob_flush();
?>