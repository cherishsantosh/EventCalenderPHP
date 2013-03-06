<?php
/***************    SESSION START        **************/
ob_start();
//include 'includes/functions.php';
/***************    SESSION START        **************/
include 'includes/header.php';
include 'includes/header-image.php';
$obj1=new functions();

/***************    FORM SUBMIT ACTION        **************/
if (isset($_POST["submit"])) {

    $val = 0;
    $email = $_POST['email'];
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $rollno = $_POST['rollno'];
    $course = $_POST['course'];
    $dept = $_POST['dept'];
    $pos = $_POST['pos'];
    $sup = $_POST['sup'];
    $cosup = $_POST['cosup'];
    $project = $_POST['project'];
    $mob = $_POST['mob'];
   
    $cpass = $_POST['cpass'];
    
   
/***************    ERROR MESSAGAE        **************/
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
    }

/***************    WRITE INTO DATABASE      **************/
    if ($val == '0') {
        $pp = user_exits($email);
       // echo "==========>" . $pp;
        if ($pp == 'true') {
            $idpresent = "Email Id Alredy in Use";
        } else {
            $date = date('m/d/Y');
            $time = date('H:i:s');
            $randomno = mt_rand(0, 999999999);
            $pass = md5($randomno);
            $res = reg_admin($email, $pass, $fname, $lname, $pos, $dept, $sup, $cosup, $project, $mob, $rollno, $course,$date,$time);
            
            $sub="New Administrator Registration";
            $msgbody="Dear ".$fname." ". $lname.",\nYou have been designated as a new Administrator.\nYour Username :- ".$email."\nPassword :- ".$randomno."\n\n Thank you";
            /***************    SEND EMAIL      **************/
            $obj1->sendmail($email, $sub, $msgbody);
            echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
            if ($res) {
                header("location: member-index.php");
            } else {
                die("Query failed");
            }
        }
    }
}
?>
<?php 
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];if($_SESSION['ACC_TYPE']=='2'){include 'menu.php'; } ?>
<!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="background-color:#FFFFFF;">
    <?php $obj1->userdetail(); ?>
    <tr>
       
        <td colspan="2">
            <p align="center"><caption>New Admin registration Form</caption></p><br>
           
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
                        <td align="right">* Rollno/Emp code   :</td>
                        <td><input type="text" id="rollno" name="rollno" value="<?php echo $rollno; ?>"/></td>
                        <td align="left" class="errorlabel"><?php echo $rollnomsg; ?></td>
                    </tr>
                    <tr>
                        <td align="right">* Course    :</td>
                        <td><input type="text" id="course" name="course" value="<?php echo $course; ?>"/></td>
                        <td align="left" class="errorlabel"><?php echo $coursemsg; ?></td>
                    </tr>
                    <tr>
                        <td align="right">* Department    :</td>
                        <td><input type="text" id="dept" name="dept" value="<?php echo $dept; ?>"/></td>
                        <td align="left" class="errorlabel"><?php echo $deptmsg; ?></td>
                    </tr>
                    <tr>
                        <td align="right">* Positions :</td>
                        <td><input type="text" id="pos" name="pos" value="<?php echo $pos; ?>"/></td>
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
                        <td align="right"> Mobile    :</td>
                        <td>+91 
                            <input name="mob" type="text" id="mob" size="10"  onblur="validatemobile();" value="<?php echo $mob; ?>"/></td>
                        <td align="left" class="errorlabel"><?php echo $mobsg; ?></td>
                    </tr>
                    
                  
                    <tr>
                        <td colspan="2"><center><input type="submit" name="submit" value="submit" /></center></td>
                    </tr>
                </table>
            </form>      </td>
     
    </tr>
</table>
<?php 
/***************    FOOTER      **************/

$obj1->footer(); ?>
