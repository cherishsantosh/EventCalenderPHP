<?php
/***************    SESSION START        **************/
ob_start();

/***************    SESSION START        **************/
include 'includes/header.php';
//include 'includes/header-image.php';
$obj1 = new functions();
/***************    FORM SUBMIT ACTION        **************/
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
        /***************    ERROR MESSAGAE        **************/
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
/***************    DATABASE  OPERATION    **************/
    if ($val == '0') {
        $sql = "INSERT INTO `resources` (`machid`, `name`, `make`, `model`, `serial_number`, `local_agent_name`, `local_agent_contact`, `actual_vendor_name`, `actual_vendor_contact`, `installation_date`, `footprint`, `tool_sop`, `policy_documents`, `standard_recipies`, `tool_facilites_requirements`, `isworking`, `schedule_config`, `activationtime_config`, `cost_of_usage`, `location`, `rphone`, `relay_ipaddress`, `relay_switch_number`, `activation_status`) VALUES (NULL, '$ename', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$iswork', '$sconfig', '$aconfig', NULL, '$loc','$rphone', '$rip', '$ripa', '1');";
        // echo "INSERT INTO `resources` (`machid`, `name`, `make`, `model`, `serial_number`, `local_agent_name`, `local_agent_contact`, `actual_vendor_name`, `actual_vendor_contact`, `installation_date`, `footprint`, `tool_sop`, `policy_documents`, `standard_recipies`, `tool_facilites_requirements`, `isworking`, `schedule_config`, `activationtime_config`, `cost_of_usage`, `location`, `rphone`, `relay_ipaddress`, `relay_switch_number`, `activation_status`) VALUES (NULL, '$ename', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$iswork', '$sconfig', '$aconfig', NULL, '$loc','$rphone', '$rip', '$ripa', '1');";
        echo "<script type='text/javascript'>alert('you have successfully updated !');</script>";
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
            <form id="loginForm" name="loginForm" action="" method="POST">
                <table width="70%" border="0" align="center" cellpadding="5" cellspacing="5">
                    <caption>Resource Detail</caption>
                    <tr>
                        <td align="right">Equipment name</td>
                        <td><input type="text" name="ename" value="<?php echo $ename; ?>" /></td>
                        <td align="center" class="errorlabel"><?php echo $enamemsg; ?></td>
                    </tr>
                    <tr>
                        <td align="right">Equipment Working</td>
                        <td>

                            <select name="iswork">
                                <?php if ($iswork == '0') { ?>
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
                                <?php if ($sconfig == '15') { ?>
                                    <option value="15" selected>15</option>
                                    <option value="30" >30</option>
                                    <option value="45" >45</option>
                                    <option value="60" >60</option>
                                <?php } elseif ($sconfig == '30') { ?>
                                    <option value="15" >15</option>
                                    <option value="30" selected>30</option>
                                    <option value="45" >45</option>
                                    <option value="60" >60</option>
                                <?php } elseif ($sconfig == '45') { ?>
                                    <option value="15" >15</option>
                                    <option value="30" >30</option>
                                    <option value="45" selected>45</option>
                                    <option value="60" >60</option>
                                <?php } elseif ($sconfig == '60') { ?>
                                    <option value="15" >15</option>
                                    <option value="30" >30</option>
                                    <option value="45" >45</option>
                                    <option value="60" selected >60</option>
                                <?php } elseif ($sconfig == '45') { ?>
                                    <option value="15" >15</option>
                                    <option value="30" >30</option>
                                    <option value="45" selected>45</option>
                                    <option value="60" >60</option>
                                <?php } elseif ($sconfig == '60') { ?>
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
                                <?php if ($aconfig == '05') { ?>
                                    <option value="05" selected>05</option>
                                    <option value="10" >10</option>
                                    <option value="15" >15</option>
                                    <option value="20" >20</option>
                                    <option value="25" >25</option>
                                    <option value="30" >30</option>
                                <?php } elseif ($aconfig == '10') { ?>
                                    <option value="05" >05</option>
                                    <option value="10" selected>10</option>
                                    <option value="15" >15</option>
                                    <option value="20" >20</option>
                                    <option value="25" >25</option>
                                    <option value="30" >30</option>
                                <?php } elseif ($aconfig == '15') { ?>
                                    <option value="05" >05</option>
                                    <option value="10" >10</option>
                                    <option value="15" selected>15</option>
                                    <option value="20" >20</option>
                                    <option value="25" >25</option>
                                    <option value="30" >30</option>
                                <?php } elseif ($aconfig == '20') { ?>
                                    <option value="05" >05</option>
                                    <option value="10" >10</option>
                                    <option value="15" >15</option>
                                    <option value="20" selected >20</option>
                                    <option value="25" >25</option>
                                    <option value="30" >30</option>
                                <?php } elseif ($aconfig == '25') { ?>
                                    <option value="05" >05</option>
                                    <option value="10" >10</option>
                                    <option value="15" >15</option>
                                    <option value="20" >20</option>
                                    <option value="25" selected>25</option>
                                    <option value="30" >30</option>
                                <?php } elseif ($aconfig == '30') { ?>
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
                        <td><input type="text" name="loc" value="<?php echo $loc; ?>" /></td>
                        <td align="center" class="errorlabel"><?php echo $locmsg; ?></td>
                    </tr>
                    <tr>
                        <td align="right">Lab Phone No</td>
                        <td><input type="text" name="rphone" value="<?php echo $rphone; ?>" /></td>
                        <td align="center" class="errorlabel"><?php echo $rphonemsg . " " . $rphoneisanummsg; ?></td>
                    </tr>
                    <tr>
                        <td align="right">Relay IP Address</td>
                        <td><input type="text" name="rip" value="<?php echo $rip; ?>" /></td>
                        <td align="center" class="errorlabel"><?php echo $ripmsg . " " . $ripisanummsg; ?></td>
                    </tr>
                    <tr>
                        <td align="right">Relay Switch Number</td>
                        <td>
                            <select name="ripa">
                                <?php if ($ripa == '1') { ?>
                                    <option value="1" selected>1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                <?php } elseif ($ripa == '2') { ?>
                                    <option value="1" >1</option>
                                    <option value="2" selected>2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                <?php } elseif ($ripa == '3') { ?>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" selected>3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                <?php } elseif ($ripa == '4') { ?>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" selected>4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                <?php } elseif ($ripa == '5') { ?>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" selected>5</option>
                                    <option value="6" >6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                <?php } elseif ($ripa == '6') { ?>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" selected>6</option>
                                    <option value="7" >7</option>
                                    <option value="8" >8</option>
                                <?php } elseif ($ripa == '7') { ?>
                                    <option value="1" >1</option>
                                    <option value="2" >2</option>
                                    <option value="3" >3</option>
                                    <option value="4" >4</option>
                                    <option value="5" >5</option>
                                    <option value="6" >6</option>
                                    <option value="7" selected >7</option>
                                    <option value="8" >8</option>
                                <?php } elseif ($ripa == '8') { ?>
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
                <br>
            </form>
        </td>
    </tr>
</table>
<?php 
/***************    FOOTER      **************/
$obj1->footer(); ?>