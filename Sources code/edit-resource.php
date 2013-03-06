<?php
/***************    SESSION START        **************/
ob_start();
/***************   INCLUDE FILE        **************/
include 'includes/header.php';
//include 'includes/header-image.php';
$obj1 = new functions();
$machid = $_GET['mechid'];
  /***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {

      $ename = $_POST['ename'];
    $iswork = $_POST['iswork'];
    $sconfig = $_POST['sconfig'];
    $aconfig = $_POST['aconfig'];
    $loc = $_POST['loc'];
    $rphone = $_POST['rphone'];
    $ripa = $_POST['ripa'];
    $rip = $_POST['rip'];
    $val = 0;
     /***************    EROOR MESSAGAE        **************/
    if ($ename == '') {
        $enamemsg = "Equipment Name Missing";
        $val = 1;
    }
    if ($loc == '') {
        $locmsg = "Location is Missing";
        $val = 1;
    } if ($rphone == '') {
        $rphonemsg = "Phone No is Missing";
        $val = 1;
    }if (!is_numeric($rphone)) {
        $rphoneisanummsg = "Please set numaric data";
        $val = 1;
    } 
    

    if ($val == '0') {
/***************   WRITE DATABASE OPRATION        **************/
        $sql = "UPDATE `resources` SET `name` ='$ename', `isworking`='$iswork', `schedule_config`='$sconfig', `activationtime_config`='$aconfig', `location`='$loc', `rphone`='$rphone', `relay_ipaddress`='$rip', `relay_switch_number`='$ripa' WHERE machid='$machid'";
        //echo $sql;
        $res = mysql_query($sql);
        if ($res) {
            header("location: manage-resource.php");
        } else {
            die("Query failed");
        }
    }
}
?>
 <!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="border:0;background-color: white" >
    <tr>
        <td width="15%" style="background-color:#f6f6f6;">
           <?php include 'includes/logo.php'; ?>
        </td>
        <td width="80%" style="background-color: lightsteelblue" align="center"></td>
    </tr>
    <td>
            <hr>
        </td>
        <td>
            <hr>
        </td>
    <tr>
        <td width="15%" style="background-color: lightsteelblue" valign="top">
            <?php include 'includes/left.php' ?>
        </td>
        <td valign="top">

<form id="loginForm" name="loginForm" action="edit-resource.php?mechid=<?php echo $machid; ?>" method="POST">
    <table width="70%" border="0" align="center" cellpadding="5" cellspacing="5">
        <?php
        $query = "SELECT * FROM resources WHERE machid = '$machid'";
        //echo $query;
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            ?>
            <caption>Resource Detail</caption>
            <tr>
                <td align="right">Equipment name</td>
                <td><input type="hidden" name="mechidd" value="<?php echo $_GET['mechid']; ?>" />
                    <input type="text" name="ename" value="<?php echo $row['name']; ?>" /></td>
                <td align="center" class="errorlabel"><?php echo $enamemsg; ?></td>
            </tr>
             <tr>
            <td align="right">Equipment Working</td>
            <td>

                <select name="iswork">
                    <?php if ($row['isworking'] == '0') { ?>
                        <option value="0" selected>Working</option>
                        <option value="1" >Not Working</option>
                    <?php } else { ?>
                        <option value="0" >Working</option>
                        <option value="1" selected >Not Working</option>
                    <?php } ?>
                </select>

            </td>
            <td align="center" class="errorlabel"><?php ?></td>
        </tr>
        <tr>
            <td align="right">Schedule Config</td>
            <td>

                <select name="sconfig">
                    <?php if ($row['schedule_config'] == '15') { ?>
                        <option value="15" selected>15</option>
                        <option value="30" >30</option>
                        <option value="45" >45</option>
                        <option value="60" >60</option>
                    <?php } elseif ($row['schedule_config'] == '30') { ?>
                        <option value="15" >15</option>
                        <option value="30" selected>30</option>
                        <option value="45" >45</option>
                        <option value="60" >60</option>
                    <?php } elseif ($row['schedule_config'] == '45') { ?>
                        <option value="15" >15</option>
                        <option value="30" >30</option>
                        <option value="45" selected>45</option>
                        <option value="60" >60</option>
                    <?php } elseif ($row['schedule_config'] == '60') { ?>
                        <option value="15" >15</option>
                        <option value="30" >30</option>
                        <option value="45" >45</option>
                        <option value="60" selected >60</option>
                    <?php } elseif ($row['schedule_config'] == '45') { ?>
                        <option value="15" >15</option>
                        <option value="30" >30</option>
                        <option value="45" selected>45</option>
                        <option value="60" >60</option>
                    <?php } elseif ($row['schedule_config'] == '60') { ?>
                        <option value="15" >15</option>
                        <option value="30" >30</option>
                        <option value="45" >45</option>
                        <option value="60" selected >60</option>
                    <?php } else { ?>
                        <option value="15" >15</option>
                        <option value="30" selected >30</option>
                        <option value="45" >45</option>
                        <option value="60"  >60</option>
                    <?php } ?>
                </select>
                Min
            </td>
            <td align="center" class="errorlabel"><?php ?></td>
        </tr>
        <tr>
            <td align="right">Activation Time Config</td>
            <td>

                <select name="aconfig">
                    <?php if ($row['activationtime_config'] == '05') { ?>
                        <option value="05" selected>05</option>
                        <option value="10" >10</option>
                        <option value="15" >15</option>
                        <option value="20" >20</option>
                        <option value="25" >25</option>
                        <option value="30" >30</option>
                    <?php } elseif ($row['activationtime_config'] == '10') { ?>
                        <option value="05" >05</option>
                        <option value="10" selected>10</option>
                        <option value="15" >15</option>
                        <option value="20" >20</option>
                        <option value="25" >25</option>
                        <option value="30" >30</option>
                    <?php } elseif ($row['activationtime_config'] == '15') { ?>
                        <option value="05" >05</option>
                        <option value="10" >10</option>
                        <option value="15" selected>15</option>
                        <option value="20" >20</option>
                        <option value="25" >25</option>
                        <option value="30" >30</option>
                    <?php } elseif ($row['activationtime_config'] == '20') { ?>
                        <option value="05" >05</option>
                        <option value="10" >10</option>
                        <option value="15" >15</option>
                        <option value="20" selected >20</option>
                        <option value="25" >25</option>
                        <option value="30" >30</option>
                    <?php } elseif ($row['activationtime_config'] == '25') { ?>
                        <option value="05" >05</option>
                        <option value="10" >10</option>
                        <option value="15" >15</option>
                        <option value="20" >20</option>
                        <option value="25" selected>25</option>
                        <option value="30" >30</option>
                    <?php } elseif ($row['activationtime_config'] == '30') { ?>
                        <option value="05" >05</option>
                        <option value="10" >10</option>
                        <option value="15" >15</option>
                        <option value="20" >20</option>
                        <option value="25" >25</option>
                        <option value="30" selected >30</option>
                    <?php } else { ?>
                        <option value="05" >05</option>
                        <option value="10" >10</option>
                        <option value="15" >15</option>
                        <option value="20" >20</option>
                        <option value="25" >25</option>
                        <option value="30" selected >30</option>
                    <?php } ?>
                </select>
                Min
            </td>
            <td align="center" class="errorlabel"><?php ?></td>
        </tr>
        <tr>
            <td align="right">Location of equipment </td>
            <td><input type="text" name="loc" value="<?php echo $row['location']; ?>" /></td>
            <td align="center" class="errorlabel"><?php echo $locmsg; ?></td>
        </tr>
        <tr>
            <td align="right">Lab Phone No</td>
            <td><input type="text" name="rphone" value="<?php echo $row['rphone']; ?>" /></td>
            <td align="center" class="errorlabel"><?php echo $rphonemsg . " " . $rphoneisanummsg; ?></td>
        </tr>
        <tr>
            <td align="right">Relay IP Address</td>
            <td><input type="text" name="rip" value="<?php echo $row['relay_ipaddress']; ?>" /></td>
            <td align="center" class="errorlabel"><?php  ?></td>
        </tr>
        <tr>
            <td align="right">Relay Switch Number</td>
            <td>
                <select name="ripa">
                    <?php if ($row['relay_switch_number'] == '1') { ?>
                        <option value="1" selected>1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                    <?php } elseif ($row['relay_switch_number'] == '2') { ?>
                        <option value="1" >1</option>
                        <option value="2" selected>2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                    <?php } elseif ($row['relay_switch_number'] == '3') { ?>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" selected>3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                    <?php } elseif ($row['relay_switch_number'] == '4') { ?>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" selected>4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                    <?php } elseif ($row['relay_switch_number'] == '5') { ?>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" selected>5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                    <?php } elseif ($row['relay_switch_number'] == '6') { ?>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" selected>6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                    <?php } elseif ($row['relay_switch_number'] == '7') { ?>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" selected >7</option>
                        <option value="8" >8</option>
                    <?php } elseif ($row['relay_switch_number'] == '8') { ?>
                        <option value="1" >1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" selected >8</option>
                    <?php } else { ?>
                        <option value="1" selected>1</option>
                        <option value="2" >2</option>
                        <option value="3" >3</option>
                        <option value="4" >4</option>
                        <option value="5" >5</option>
                        <option value="6" >6</option>
                        <option value="7" >7</option>
                        <option value="8" >8</option>
                    <?php } ?>
                </select>
            </td>
            <td align="center" class="errorlabel"><?php echo $ripamsg . " " . $ripaisanummsg; ?></td>
        </tr>
        <tr>

            <td colspan="2" align="center"><input type="submit" name="submit" value="submit" /></td>
        </tr>
    </table>
  <?php } ?>
    <br>
</form>
        </td>
    </tr>
</table>
<?php 
/***************    FOOTER    **************/
$obj1->footer(); ?>