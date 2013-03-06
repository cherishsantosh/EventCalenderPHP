<?php
/***************    SESSION START        **************/
include 'includes/header.php';
$obj1 = new functions();
/***************    SESSION START        **************/
$vanueid = $_GET['vanueid'];
//echo "=>".$vanueid;
/***************    DATABASE  OPERATION    **************/
$rs3 = mysql_query("SELECT `name`,`activationtime_config` FROM `resources` WHERE `machid`='$vanueid'");
//echo "SELECT `name`,`activationtime_config` FROM `resources` WHERE `machid`='$vanueid'";
$row3 = mysql_fetch_row($rs3);
$v1 = $row3[0];
$c1 = $row3[1];

/***************    FORM SUBMIT ACTION        **************/
if (isset($_POST["submit"])) {

    $v1 = $_POST['v1'];
    $c1 = $_POST['c1'];
    $res = $_POST['drop1'];

    for ($i = 0; $i < count($res); $i++) {
        if ($str == '')
            $str = $res[$i];
        else
            $str = $str . "," . $res[$i];
    }
   // echo $str;
     /***************    ERROR MESSAGAE        **************/
    $val = 0;
    if ($v1 == '') {
        $errv1 = "Vanue is missing";
        $val = 1;
    } elseif ($c1 == '') {
        $errc1 = "Capacity is missing";
        $val = 1;
    } elseif ($str == '') {
        $errres = "Resources is missing";
        $val = 1;
    }

    /***************    WRITE INTO DATABASE      **************/
    if ($val == '0') {
        if ($vanueid == '') {
            mysql_query("INSERT INTO `resources` (`machid`, `name`, `make`, `model`, `serial_number`, `local_agent_name`, `local_agent_contact`, `actual_vendor_name`, `actual_vendor_contact`, `installation_date`, `footprint`, `tool_sop`, `policy_documents`, `standard_recipies`, `tool_facilites_requirements`, `isworking`, `schedule_config`, `activationtime_config`, `cost_of_usage`, `location`, `rphone`, `relay_ipaddress`, `relay_switch_number`, `activation_status`)VALUES (NULL, '$v1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '30', '$c1', NULL,'$str', NULL, NULL, NULL, '1');");
            //echo "INSERT INTO `resources` (`machid`, `name`, `make`, `model`, `serial_number`, `local_agent_name`, `local_agent_contact`, `actual_vendor_name`, `actual_vendor_contact`, `installation_date`, `footprint`, `tool_sop`, `policy_documents`, `standard_recipies`, `tool_facilites_requirements`, `isworking`, `schedule_config`, `activationtime_config`, `cost_of_usage`, `location`, `rphone`, `relay_ipaddress`, `relay_switch_number`, `activation_status`)VALUES (NULL, '$v1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '0', '30', '$c1', NULL,'$str', NULL, NULL, NULL, '1');";
            echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
            header("location: member-index.php");
        } else {
            mysql_query("UPDATE  `resources` SET  `name` =  '$v1',`activationtime_config` =  '$c1',`location` =  '$str' WHERE  `resources`.`machid` ='$vanueid';");
            //echo "UPDATE  `resources` SET  `name` =  '$v1',`activationtime_config` =  '$c1',`location` =  '$str' WHERE  `resources`.`machid` ='$vanueid';";
            echo "<script type='text/javascript'>alert('you have successfully updated !');</script>";
            header("location: member-index.php");
        }
    }
}
?>
<?php
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];
if ($_SESSION['ACC_TYPE'] == '2') {
    include 'menu.php';
}
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<form method="POST" action="">
    <table width="100%" border="0">
        <tr>
        <caption>Add Venue</caption>
<?php $obj1->userdetail(); ?>
        </tr>

        <tr>
            <td colspan="3" align="center">
                <div id="divoverflow">
                    <table width="100%" border="1" cellpadding="4" >
                        <tr style="font-weight: bold;">
                            <td align="center">Vanue Name</td>
                            <td align="center">Capacity Vanue</td>
                            <td align="center">Edit Vanue</td>
                            <td align="center">Delete Vanue</td>

                        </tr>
<?php
$result = mysql_query("SELECT name,activationtime_config,machid FROM resources");
while ($row = mysql_fetch_array($result)) {
    ?>
                            <tr>
                                <td align="center"><?php echo $row[0]; ?></td>
                                <td align="center"><?php echo $row[1]; ?></td>
                                <td align="center"><a href="add-vanue.php?vanueid=<?php echo $row['machid']; ?>"><strong>Edit</strong></a></td>
                                <td align="center"><a href="#"><strong>Delete</strong></a></td>

                            </tr>
<?php } ?>
                    </table>
                    <br><br>
                </div>
            </td>

        </tr>
        <tr>
            <td align="right">Vanue Name</td>
            <td align="center"><input type="text" name="v1" value="<?php echo $v1; ?>"></td>
            <td><?php echo $errv1; ?></td>
        </tr>
        <tr>
            <td align="right">Capacity</td>
            <td align="center"><input type="text" name="c1" value="<?php echo $c1; ?>"></td>
            <td><?php echo $errc1; ?></td>
        </tr>
        <tr>
            <td align="right">Resources</td>
            <td align="center">
                <select name="drop1[]" id="drop1[]" size="4" multiple="multiple">
<?php
$result = mysql_query("SELECT * FROM equipment");
while ($row = mysql_fetch_array($result)) {
    ?>
                        <option value="<?php echo $row[1]; ?>" selected><?php echo $row[1]; ?></option>
                    <?php } ?> 

                </select>
            </td>
            <td><?php echo $errres; ?></td>
        </tr>
        <tr style="border-collapse:0px;background-color:#FFFFFF;">
            <td align="center" colspan="3"><center><input type="submit" name="submit" value="submit" /></center></td>
        </tr>
    </table>
</form>
<?php 
/***************    FOOTER      **************/
$obj1->footer(); ?>