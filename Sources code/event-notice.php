<?php
/***************   INCLUDE FILE        **************/
include 'includes/header.php';

$obj1 = new functions();
$_GET['interval'] = 15;
$_GET['starttime'] = 00;
$rr = $_GET['demo'];
//echo "===";
print_r($rr);
$fn = new functions();
/***************    POST SUBMISSION        **************/
if (isset($_POST['submit'])) {

    $type = $_POST['type'];
    $starttime = $_POST['starttime'];
    $rname = $_POST['rname'];
    $sp = $_POST['sp'];
    $af = $_POST['af'];
    $title = $_POST['title'];
    $abst = $_POST['abst'];
    $normaluser = $_POST['normaluser'];

    $msg = "======== " . $type . "  NOTICE ========= \n\n\n" . "Dear all,\n
        Please find the title and abstract of the talk appended herewith.\n\n
        \nVenue :" . $rname . "
        \nTime : " . $starttime . "
        \nSpeaker :" . $sp . "
        \nTITLE:" . $title . "
        \nAffiliation :" . $af . "
        \nABSTRACT:" . $abst."\nThank you\n\n\n
             -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480";

    for ($i = 0; $i < count($normaluser); $i++) {
        /***************    SEND MAIL        **************/
        $obj1->sendmail($normaluser[$i], $title, $msg);
    }
    echo "<script type='text/javascript'>alert('Mail has been successfuly sent !');</script>";
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
<form method="POST">
    <table border="0" width="100%" cellpadding="6">
        <caption>Event Notice</caption>
        <?php $fn->userdetail(); ?>
        <tr>
            <td colspan="2">
                <div align="center">
                    <p>
                    <div id="divoverflow">
                    <table>
                        <tr>
                            <td> <strong> Email Id Of User</strong></td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" name="sAll" onclick="selectAll(this)" /> (Select all)</td>
                        </tr>
                        
                        <?php
                         /***************    DATABASE OPRATION        **************/
                        $query = "SELECT * FROM login";
                        $result = mysql_query($query);
                        while ($row = mysql_fetch_array($result)) {
                            ?>
                            <tr>  <td> <input type="checkbox" name="normaluser[]" value="<?php echo $row['email']; ?>"/><?php echo $row['fname'] . " " . $row['lname']; ?></td></tr>
                        <?php } ?>
                    </table>
                             </div>
                </div></td>
        </tr>
        <tr>
            <td width="50%" align="right"><strong>Event Name</strong></td>
            <td width="50%"><select name="type" id="type">
                    <?php
                    $result = mysql_query("SELECT * FROM event");
                    while ($row1 = mysql_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row1['eventname']; ?>" selected="selected"><?php echo $row1['eventname']; ?></option>
                    <?php } ?>
                </select></td>
        </tr>
        <tr>
            <td width="50%" align="right"><b>Start Time  :   </b></td>
            <td align="left">

                <?php
                $interval_time_temp = 0;
                ?>
                <select name="starttime">
                    <?php
                    $count = (24 * 60) / $_GET['interval'];
                    for ($i = 0; $i < $count; $i++) {
                        $time_value = date('H:i', mktime(0, $time_count, 0) + ($interval_time_temp * 60));
                        if ($time_value == $_GET['starttime']) {
                            echo "<option value='$time_value' selected=selected>" . $time_value . "</option>";
                        } else {
                            echo "<option value='$time_value'>" . $time_value . "</option>";
                        }

                        $time_count = $time_count + $interval_time_temp;
                        $interval_time_temp = $_GET['interval'];
                    }
                    ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><strong>Vanue</strong></td>
            <td>
                <select name="rname" id="rname" >
                    <?php
                    $result = mysql_query("SELECT * FROM resources");
                    while ($row1 = mysql_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row1['machid']; ?>"><?php echo $row1['name']; ?></option>
                    <?php } ?>
                </select>
            </td>
        </tr>
        <tr>
            <td align="right"><strong >Spekar Name</strong></td>
            <td><input type="text" name="sp" id="sp"/></td>
        </tr>
        <tr>
            <td align="right"><strong>Affiliation</strong></td>
            <td><input type="text" name="af" id="af"/></td>
        </tr>
        <tr>
            <td align="right"><strong>Title</strong></td>
            <td><input type="text" name="title" id="title"/></td>
        </tr>
        <tr>
            <td align="right"><strong>Abstract</strong></td>
            <td><textarea cols="50" rows="10" name="abst"></textarea></td>
        </tr>
        <tr>
            <td colspan="2" align="center">
                <input type="submit" name="submit" Value="Submit">
            </td>
        </tr>
    </table>
    <?php 
    /***************    FOOTER    **************/
    include 'includes/footer.php' ?>
</form>