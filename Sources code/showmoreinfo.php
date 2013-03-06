<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$mmmemberid = $_GET['mmmemberid'];

$resid = $_GET['resid'];

if ($mmmemberid == '') {
    
} else {
    /***************  INTO DATABASE      **************/
    //echo "=======>>EMIAL";
    //echo "SELECT email FROM `templogin` WHERE `memberid`='$mmmemberid'";
    echo "<div style='color:#FF0000' align=center><h3>More information of user :</h3><div>";
    $result1 = mysql_query("SELECT email FROM `templogin` WHERE `memberid`='$mmmemberid'");
    $row1 = mysql_fetch_row($result1);
    $mobile1 = $row1[0];
  //  echo "SELECT info FROM `moreinfo` WHERE `email`='$mobile1'";
    $result = mysql_query("SELECT info FROM `moreinfo` WHERE `email`='$mobile1'");
    $row = mysql_fetch_row($result);
    $mobile = $row[0];
}

if ($resid == '') {
    
} else {
    //echo "=======>>RES";
    echo "<div style='color:#FF0000' align=center><h3>More information of Event :</h3><div>";
    $result1 = mysql_query("SELECT info FROM `moreinfoevent` WHERE `resid`='$resid'");
    $row1 = mysql_fetch_row($result1);
    $mobile1 = $row1[0];
}
?>
  <!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" align="center" cellpadding="5" cellspacing="5">

    <tr>
        <td align="right">Body</td>
        <td><textarea rows="10" cols="50" name="body" >
                <?php
                if ($resid != '') {
                    echo $mobile1;
                }
                 if ($mmmemberid != '') {
                    echo $mobile;
                }
                ?>
            </textarea></td>
    </tr>

</table>
