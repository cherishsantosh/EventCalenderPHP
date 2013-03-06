<?php
/***************   INCLUDE FILE       **************/
include 'includes/header.php';
$obj1 = new functions();


$resid = $_GET['resid'];

//$result = mysql_query("SELECT `flag`,`question` FROM `moreinfoevent` WHERE `resid`='$resid'");
//echo "SELECT `flag`,`question` FROM `moreinfoevent` WHERE `resid`='$resid'";
//$singleRow = mysql_result($result, 0);
//$qt = $row[1];
/***************    DATABASE OPRATION         **************/
$rs = mysql_query("SELECT `flag`,`question` FROM `moreinfoevent` WHERE `resid`='$resid'");
//echo "<br>SELECT `flag`,`question` FROM `moreinfo` WHERE `email`='$email'";
$row = mysql_fetch_row($rs);
$singleRow = $row[0];
$qt = $row[1];

if (isset($_POST["submit"])) {
 /***************   WRITE DATABASE OPRATION        **************/
    $info = $_POST['info'];
    //echo "UPDATE `moreinfoevent` SET `info` = '$info' AND `flag` =1 WHERE `resid` = '$resid'";
    mysql_query("UPDATE `moreinfoevent` SET `info` = '$info',`flag` = '1' WHERE `resid` = '$resid'");
    echo "<div style=color: #FF0000 ><h4>Submit Sucessfuly</h4></div>";
}

if ($singleRow == '1') {
    echo "<div style=color: #FF0000 ><h4>You Allredy submitted your data</h4></div>";
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

    <?php } 
    /***************    FOOTER    **************/
    $obj1->footer();
?>