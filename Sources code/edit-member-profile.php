<?php
/***************    SESSION START        **************/
ob_start();
/***************   INCLUDE FILE        **************/
include 'includes/header.php';
//include 'includes/header-image.php';
$obj1 = new functions();
if(!isset($_GET['memberid']))
{
    $memberid = $_SESSION['SESS_MEMBER_ID'];
}
else
{
 $memberid = $_GET['memberid'];
}
$obj1 = new functions();
  $val = 0;
  /***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {

  
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
    $pass = $_POST['pass'];
    $cpass = $_POST['cpass'];
    
/***************    EROOR MESSAGAE        **************/
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
 
/***************   WRITE DATABASE OPRATION        **************/
      $memberid = $_POST['memberid'];  
    if ($val == '0') {
        $result1=update_member_profile($fname, $lname, $pos, $rollno, $course, $dept, $sup, $cosup, $project, $mob, $memberid);
        
        if($result1){
        header("location: member-index.php");
        }else{
             //echo "jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj";
        }
        

    }
}
if(!isset($_SESSION['FULL_NAME']))
{
   ?>
<div style="color:red" align="center"> <h3>Please Kindly Login To Continue!!</h3></div><br>
<div align="center" ><a href="index.php">Login  >></a></div>

    <?php
}
else
{
?>
<?php 
/***************    INCLUDE MENU IF {Admin login}        **************/

$_SESSION['ACC_TYPE'];if($_SESSION['ACC_TYPE']=='2'){include 'menu.php'; } ?>
 <!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="border:0;background-color: white" >
    <tr>
        <caption>Edit Memeber Profile  </caption>
      
          <?php $obj1->userdetail(); ?>
    <tr>
       
        <td valign="top">
<table width="100%" border="0" style="background-color:#FFFFFF;">
   
    <tr>
        <td colspan="4" >
            
        </td>
    </tr>
    <tr>
        <td width="100%"colspan="4">
            <form id="loginForm" name="loginForm" action="edit-member-profile.php" method="POST">
                 <a href="member-index.php"><strong>Home</strong></a> | <a href="member-profile.php"><strong>change password</strong></a>
                <table width="100%" border="0" style="background:#FFFFFF;">
                    <tr>
                        <td width="15%">&nbsp;</td>
                        <td width="70%">
                            <div style="width:100%;height:3	5px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#333333;" align="center"><br />

                                <table width="100%" border="0" style="background:none;color:#FFFFFF;">
                                    <tr>
                                        <td colspan="2"><p align="center" style="color:#FF0000;" ><strong>all fields marked with * are mandatory</strong></p><br /><br /></td>
                                    </tr>
                                    <tr>
                                        <?php
                                           /***************    DATABASE OPRATION        **************/
                                        $query = "SELECT * FROM login WHERE memberid = $memberid";
                                        $result = mysql_query($query);
                                        while ($row = mysql_fetch_array($result)) {
                                            ?>
                                    
                                            <td align="right">* Email address (this will be your login)    :</td>
                                            <td ><input type="hidden" id="memberid" name="memberid" value="<?php echo $memberid; ?>"/><input type="text" id="email" name="email" onBlur="javascript:return validateemail('loginForm','email');" value="<?php echo $row['email']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $emailmsg; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">* Last Name    :</td>
                                            <td><input type="text" id="fname" name="fname" value="<?php echo $row['fname']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $fnamemsg; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">* First/Middle Name :</td>
                                            <td><input type="text" id="lname" name="lname" value="<?php echo $row['lname']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $lnamemsg; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">* Rollno/Emp code   :</td>
                                            <td><input type="text" id="rollno" name="rollno" value="<?php echo $row['rollno']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $rollnomsg; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">* Course    :</td>
                                            <td><input type="text" id="course" name="course" value="<?php echo $row['course']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $coursemsg; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">* Department    :</td>
                                            <td><input type="text" id="dept" name="dept" value="<?php echo $row['department']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $deptmsg; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">* Positions :</td>
                                            <td><input type="text" id="pos" name="pos" value="<?php echo $row['position']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $posmsg; ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">Supervisor and dept :</td>
                                            <td><input type="text" id="sup" name="sup" value="<?php echo $row['supervisor']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">Co-supervisor (if any) and dept :</td>
                                            <td><input type="text" id="cosup" name="cosup" value="<?php echo $row['cosupervisor']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">Project name and description    :</td>
                                            <td><textarea name="project" ><?php echo $row['project']; ?></textarea></td>
                                            <td align="left" class="errorlabel"><?php  ?></td>
                                        </tr>
                                        <tr>
                                            <td align="right">* Mobile    :</td>
                                            <td>+91 
                                                <input name="mob" type="text" id="mob" size="10"  onblur="validatemobile();" value="<?php echo $row['mobile']; ?>"/></td>
                                            <td align="left" class="errorlabel"><?php echo $mobsg; ?></td>
                                        </tr>

                                        <tr>
                                            <td colspan="3"><center><input type="submit" name="submit" value="submit" /></center></td>
                                        </tr>
                                    <?php } ?>
                                </table>

                            </div>

                        </td>
                        <td width="15%"></td>
                    </tr>
                </table>

            </form>
        </td>
    </tr>
</table>
        </td>
    </tr>
</table>
<?php
}
/***************    FOOTER    **************/
$obj1->footer();
ob_flush();
?>
