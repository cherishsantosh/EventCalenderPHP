<?php
/***************    SESSION START        **************/
session_start();

/***************    INCLUDE FILE        **************/
include 'includes/header.php';

/***************    CREATE OBJECT OF CLASS        **************/
$fn = new functions();

/***************    FORM SUBMIT ACTION        **************/
if (isset($_POST['submit'])) {
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];
    $startdate = $_POST['startdate'];
    $sp = $_POST['sp'];
    $type = $_POST['type'];
    $title = $_POST['title'];
    $c1 = $_POST['c1'];
    $p1 = $_POST['p1'];
    $machid = $_GET['machid'];
    $summary = $_POST['summary'];
    
    /***************    DATABASE  OPERATION    **************/
    $er=  mysql_query("SELECT `activationtime_config` FROM `resources` WHERE `machid`='$machid'");
    $row = mysql_fetch_row($er);
    $cpty = $row[0];
    // echo "<br>VanueID :- ".$machid." <br>Vanue Capacity :- ".$cpty."<br> Require capacity :- ".$c1;
    if($cpty>=$c1){
     
      /***************    SEND EMAIL      **************/
      $fn->send_not($type);
      /***************    WRITE INTO DATABASE      **************/
      $fn->reservation($starttime, $endtime, $startdate, $sp, $type, $title, $c1, $p1, $machid, $summary);
     
    }else{
     //   echo "<br>Go for following  vanue option<br><br>";
       //echo "SELECT `name`,`activationtime_config` FROM `resources`";
        /***************    DATABASE  OPERATION    **************/
        $result = mysql_query("SELECT `name`,`activationtime_config` FROM `resources`");
        while ($row = mysql_fetch_array($result)) {
          //   echo "<br>VanueID :- ".$row[0]." <br>Vanue Capacity :- ".$row[1]."<br> Require capacity :- ".$c1."<br><br>".$row[1].">=".$c1;
             //echo "<br>".$row[1].">=".$c1;
            if($row[1]>=$c1){
              //  echo "hi".$row[1];
                if($str=='')
                {
                    $str="<strong>".$row[0]."</strong>";
                }else{
                    $str="<strong>".$str."</strong>, <strong>".$row[0]."</strong>";
                }
            }else{
               // echo "bye";
                
            }
            
        }
        $er="<br><div style='color: #FF0000;'>Your requireing capacity is more than vanue capacity.<br> Go for following vanue :-".$str."</div>";
    }
    
    
    
}
if (!isset($_SESSION['FULL_NAME'])) {
    /***************    ERROR MESSAGAE        **************/
    ?>
    <div style="color:red" align="center"> <h3>Please Kindly Login To Continue!!</h3></div><br>
    <div align="center" ><a href="index.php">Login  >></a></div>
    <?php
} else {
    ?>
    <!--   ****************   HTML FORM CODE      ****************  -->
    <form name="reservation" action="" method="post" >
        <table align="center" cellspacing="8" cellpadding="8" width="100%" style="overflow: auto;">
            <caption>Reservation</caption>
            <th colspan="2" align="center" style="color: red;padding-top: 0px"><h4>All fields marked with * are mandatory</h4></th>
            <tr>
                <th align="right">
                    User Name   :
                </th>
                <td>
                    <?php echo $_SESSION['FULL_NAME'] ?>
                </td>
            </tr>
            <tr>
                <th align="center">* Speaker Name</th>
                <td><input type="text" name="sp" id="sp"/></td>
            </tr>
            <tr>
                <th align="center">Event type </th>
                <td><select name="type" id="type">
                        <?php
                        /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM event");
                        while ($row1 = mysql_fetch_array($result)) {
                            ?>
                            <option value="<?php echo $row1['eventname']; ?>" selected="selected"><?php echo $row1['eventname']; ?></option>
                        <?php } ?>
                    </select></td>
            </tr>
            <tr>
                <th align="center">* Title</th>
                <td><input type="text" name="title" id="title"/></td>
            </tr>
            <tr>
                <th align="center">Priority</th>
                <td><select name="p1" id="p1">
                        <option value="01">01</option>
                        <option value="02" >02</option>
                        <option value="03">03</option>
                        <option value="04">04</option>
                        <option value="05" selected="selected">05</option>

                    </select></td>
            </tr>
            <tr>
                <th align="center">Capacity</th>
                <td><select name="c1"  id="c1">
                        <option value="10">0-10</option>
                        <option value="120">10-20</option>
                        <option value="30">20-30</option>
                        <option value="40">30-40</option>
                        <option value="50" selected="selected">40-50</option>
                        <option value="60">50-60</option>
                        <option value="70">60-70</option>
                        <option value="80">70-80</option>
                        <option value="90">80-90</option>
                        <option value="100">90-100</option>
                        <option value="200">100-200</option>
                        <option value="300">200-300</option>
                    </select>
                <?php echo $er; ?>
                </td>
            </tr>
            <tr>
                <th align="right">

                    Date Of Reservation :
                </th>
                <td>
                    <input type="text" id="reservationdate" name="startdate" value="<?php echo $_GET['startdate'] ?>">
                </td>
            </tr>
            <tr>
                <th align="right">
                    Blackout    :
                </th>
                <td>
                    <input type="checkbox" name="blackout" value="blackout">
                </td>
            </tr>
            <tr>
                <th colspan="2" align="center">
            <hr style="color: activecaption">
            Time Of Reservation
            </th>
            </tr>

            <tr>
                <td align="center">
                    <b>Start Time  :   </b>
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
                <?php
                $enddate = date('H:i', strtotime($_GET['starttime']) + ($_GET['interval'] * 60));
                ?>
                <td align="center">
                    <b>End Time  :   </b>
                    <?php
                    $interval_time_temp = 0;
                    $time_count = 0;
                    ?>
                    <select name="endtime">
                        <?php
                        $count = (24 * 60) / $_GET['interval'];
                        for ($i = 0; $i < $count; $i++) {
                            $time_value = date('H:i', mktime(0, $time_count, 0) + ($interval_time_temp * 60));
                            if ($time_value == $enddate) {
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
                <td colspan="2">
                    <hr style="color: activecaption">
                </td>
            </tr>

            <tr>
                <th colspan="2" align="center">

                    * Abstract :
                </th>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <textarea cols="50" rows="5" name="summary"></textarea>
                    <hr style="color: activecaption">
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    <input type="submit" name="submit" Value="Submit">
                </td>
            </tr>
        </table>
    </form>

    <?php
}
?>