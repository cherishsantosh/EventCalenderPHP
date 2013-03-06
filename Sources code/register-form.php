<?php
/***************   SESSION START     **************/
ob_start();
/***************   INCLUDE FILE       **************/
//include 'includes/functions.php';
include 'includes/header.php';
include 'includes/header-image.php';
$obj1 = new functions();
/***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {

    $val = 0;
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $rollno = $_POST['rollno'];
    $course = "NULL";
    $dept = $_POST['dept'];
    $pos = $_POST['pos'];
    $sup = $_POST['sup'];
    $cosup = $_POST['cosup'];
    $project = $_POST['project'];
    $mob = $_POST['mob'];
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
/***************    ERROR MESSAGAE      **************/
    if ($email == '') {
        $val = 1;
        $emailmsg = "Email missing";
    }if ($fname == '') {
        $val = 1;
        $fnamemsg = "First name missing";
    }if ($lname == '') {
        $val = 1;
        $lnamemsg = "Last name missing";
    }if ($rollno == '') {
        $val = 1;
        $rollnomsg = "Rollno/Employee Id missing";
    }if ($course == '') {
        $val = 1;
        $coursemsg = "Course name missing";
    }if ($dept == '') {
        $val = 1;
        $deptmsg = "Department name missing";
    }if ($pos == '') {
        $val = 1;
        $posmsg = "Position missing";
    }if ($mob == '') {
        //$val = 1;
        //$mobsg = "Mobile name missing";
    }if ($pass == '') {
        $val = 1;
        $passmsg = "Password missing";
    }if ($cpass == '') {
        $val = 1;
        $cpassmsg = "Confirm password missing";
    }if (strcmp($cpass, $pass) != 0) {
        $val = 1;
        $passmatcherr = "Both Password Does Not Matched";
    }
/***************   WRITE DATABASE OPRATION        **************/
    if ($val == '0') {
        $pp = user_exits($email);
        $uu=user_exits2($email);
        // echo "==========>" . $pp;
        if (($pp == 'true') || ($uu == 'true') ) {
            $idpresent = "Email Id Alredy in Use";
        } else {
            $date = date('m/d/Y');
            $time = date('H:i:s');
            $res = reg_user($email, $pass, $fname, $lname, $pos, $dept, $sup, $cosup, $project, $mob, $rollno, $course, $date, $time);
            $sub = "Registration Submitted";
              echo "<script type='text/javascript'>alert('registration has been successfully submitted !');</script>";
            $msgbody = "Dear " . $fname . " " . $lname . ",\nYour registration has been successfully submitted.\n\n\n Thank you
            \n\n
            -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480";
           $obj1->sendmail($email, $sub, $msgbody);
            if ($res) {
                //header("location: index.php");
            } else {
                die("Query failed");
            }
        }
    }
}
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="background-color:#FFFFFF;">

    <tr>

        <td colspan="2">
            <p align="center"><caption>Registration Form</caption></p><br>
<div align="center" style="text-decoration: blink;">If you already registrar Then <a href="index.php">click here</a></div>

<form id="loginForm" name="loginForm" action="" method="POST">
    <table width="100%" border="0" cellpadding="5" cellspacing="5" style="background-color:#FFFFFF;">
        <tr>
            <th colspan="2" align="center" style="color: red;padding-top: 0px"><h2><?php echo $idpresent; ?></h2></th>
        </tr>
        <tr>
            <th colspan="2" align="center" style="color: red;padding-top: 0px"><h4></h4></th>
        </tr>
        <tr>
            <th colspan="2" align="center" style="color: red;padding-top: 0px"><h4>All fields marked with * are mandatory</h4></th>
        </tr>
        <tr>
            <td align="right">* Email address (this will be your login)    :</td>
            <td ><input type="text" id="email" name="email" onBlur="javascript:return validateemail('loginForm','email');" value="<?php echo $email; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $emailmsg; ?></td>
        </tr>
        <tr>
            <td align="right">* Last Name    :</td>
            <td><input type="text" id="fname" name="fname" value="<?php echo $fname; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $fnamemsg; ?></td>
        </tr>
        <tr>
            <td align="right">* First/Middle Name :</td>
            <td><input type="text" id="lname" name="lname" value="<?php echo $lname; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $lnamemsg; ?></td>
        </tr>
        <tr>
            <td align="right">* Rollno/Employee Code   :</td>
            <td><input type="text" id="rollno" name="rollno" value="<?php echo $rollno; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $rollnomsg; ?></td>
        </tr>

        <tr>
            <td align="right">* Department    :</td>
            <td><input type="text" id="dept" name="dept" value="<?php echo $dept; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $deptmsg; ?></td>
        </tr>
        <tr>
            <td align="right">* Positions :</td>
            <td>
                <select name="pos" id="pos" >
                   <?php 
                  /***************    DATABASE OPRATION         **************/
                   $result = mysql_query("SELECT * FROM position");
                    while ($row1 = mysql_fetch_array($result)) { 
                       echo "<option value=".$row1['position'].">".$row1['position']."</option>"; }?>
                </select>

            </td>
            <td align="left" class="errorlabel"><?php echo $posmsg; ?></td>
        </tr>
        <tr>
            <td align="right">Supervisor and dept :</td>
            <td><input type="text" id="sup" name="sup" value="<?php echo $sup; ?>"/></td>
            <td align="left" class="errorlabel"></td>
        </tr>
        <tr>
            <td align="right">Co-supervisor (if any) and dept :</td>
            <td><input type="text" id="cosup" name="cosup" value="<?php echo $cosup; ?>"/></td>
            <td align="left" class="errorlabel"></td>
        </tr>
        <tr>
            <td align="right">Project name and description    :</td>
            <td><textarea name="project" ><?php echo $project; ?></textarea></td>
            <td align="left" class="errorlabel"></td>
        </tr>
        <tr>
            <td align="right"> Mobile    : <span style="color: #FF0000;">(required if the user use
                    InstaMsg system)</span></td>
            <td>+91 
                <input name="mob" type="text" id="mob" size="10"  onblur="validatemobile();" value="<?php echo $mob; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $mobsg; ?></td>
        </tr>
        <tr>
            <td align="right">* Password  : </td>
            <td><input type="password" id="pass" name="pass" value="<?php echo $pass; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $passmsg; ?></td>
        </tr>
        <tr>
            <td align="right">* Re-Enter Password :</td>
            <td><input type="password" id="cpass" name="cpass" value="<?php echo $cpass; ?>"/></td>
            <td align="left" class="errorlabel"><?php echo $cpassmsg; ?></td>
        </tr>
        <tr>
            <td align="center" class="errorlabel" colspan="3"><?php echo $passmatcherr; ?></td>
        </tr>
        <tr>
            <td colspan="2"><center><input type="submit" name="submit" value="submit" /></center></td>
        </tr>
    </table>
</form>      </td>

</tr>
</table>

<?php 
/***************    FOOTER    **************/
$obj1->footer(); ?>