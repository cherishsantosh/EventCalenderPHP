<?php
/***************   INCLUDE FILE       **************/
include 'includes/header.php';
$obj1 = new functions();
$email = $_GET['mememail'];

//echo "SELECT `flag`,`question` FROM `moreinfo` WHERE `email`='$email'";
/***************    DATABASE OPERATATION        **************/
$rs = mysql_query("SELECT `flag`,`question` FROM `moreinfo` WHERE `email`='$email'");
//echo "<br>SELECT `flag`,`question` FROM `moreinfo` WHERE `email`='$email'";
$row = mysql_fetch_row($rs);
$singleRow = $row[0];
$qt = $row[1];

/***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {
    $info = $_POST['info'];
     /***************   WRITE DATABASE OPRATION        **************/
    mysql_query("UPDATE `moreinfo` SET `info` = '$info',`flag` = '1' WHERE `email` = '$email'");
   //echo "UPDATE `moreinfo` SET `info` = '$info' AND `flag` ='1' WHERE `email` = '$email'";
    echo "<div style=color: #FF0000 ><h4>Your information has been sumited successfuly</h4></div>";
}

if ($singleRow == '1') {
    echo "<div style=color: #FF0000 ><h4>You have allredy submitted your information</h4></div>";
} else {
    ?>

<!--   ****************   HTML FORM CODE      ****************  -->
    <form action="" method="POST">
        <table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">
            <caption>Please answer following question</caption>
            <tr>
<td align="right">Your Question </td>
                <td ><textarea name="info" rows="7" cols="50" readonly=""><?php echo $qt;?></textarea></td>
            </tr>
            <tr>
                <td align="right">Your Information</td>
                <td><textarea name="info" rows="20" cols="50"></textarea></center></td>
            </tr>
            <tr>

                <td colspan="2"><center><input type="submit" name="submit" value="submit" /></center></td>
            </tr>
        </table>
    </form>

    <?php 
    /***************    FOOTER    **************/
    
    } $obj1->footer();
?>