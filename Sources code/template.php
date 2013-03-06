<?php
/***************    INCLUDE FILE        **************/
include 'includes/bookings.php';
//include 'includes/header.php';
//include 'includes/functions.php';
$obj1 = new functions();
$machid = 0;
$fullname = $_SESSION['FULL_NAME'];
$acctype = $_SESSION['ACC_TYPE'];
$memberid = $_SESSION['SESS_MEMBER_ID'];

$kk = $_GET['machid'];
/***************    CEATE GRID        **************/
if (isset($_GET['date'])) {

    if (date('D', strtotime($_GET['date'])) != 'Sun') {
        $first_day_of_week = date('m/d/y', strtotime('Previous Sunday', strtotime($_GET['date'])));
    } else {
        $first_day_of_week = $_GET['date'];
    }
} else {
    $first_day_of_week = date('m/d/y', strtotime('Last Sunday', time()));
}
?>
 <!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="border:0;background-color: white">
    <tr>

        <td colspan="2">
            <table width="100%" align="center" style="border: 0">
                <tr>
                    <td width="100%" colspan="3" align="center" >



                        <?php
                        $next_week = date('m/d/Y', strtotime('+8 days', strtotime($first_day_of_week)));
                        $prev_week = date('m/d/Y', strtotime('-6 days', strtotime($first_day_of_week)));
                        ?>
                        <table  width="100%" align="center">
                            <tr>
                                <?php
                                if (isset($_GET['machid'])) {
                                    $machid = $_GET['machid'];
                                    echo "<td align=right width=1% rowspan=2><a href=member-index.php?date=$prev_week&machid=$machid><img src=images/prev-images.jpg height=40 width=40 class=prevweek></a><div class=prevweekpopup>Previous Week</div></td>";
                                    echo "<td  align=center width=5%><h2 style=margin:0px>" . get_device_name($_GET['machid']) . "</h2></td>";
                                    echo "<td rowspan=2 width=5% align=center><a href=member-index.php?date=$next_week&machid=$machid><img src=images/next-images.jpg height=40 width=40 class=nextweek></a><div class=nextweekpopup>Next Week</div></td>";
                                    echo " <th width=20% rowspan=2 align=center>Jump To Date    :</th>";
                                    echo "<td rowspan=2 align=left><input type=text id=date onChange=changeDate($machid) ></td>";
                                    echo "<tr>";
                                    echo "<td align=center width=50%><h3>" . date('d/m/Y', strtotime($first_day_of_week)) . " - " . date('d/m/Y', strtotime('+6 days', strtotime($first_day_of_week))) . "</h3></td>";
                                    echo "</tr>";
                                }
                                ?>
                        </table>
                    </td>
                </tr>
                <tr>

                    <td style="padding-left:10px;" >

                        Select Resource :
                        <?php
                        $q = get_resources();
                        ?>
                        <select name="machid" onchange="changeResource('<?php echo $_GET['date'] ?>',this.value)">
                            <?php
                            while ($row = mysql_fetch_row($q)) {

                                if ($row[0] == $machid) {
                                    echo "<option value=$row[0] selected=selected >$row[1]</option>";
                                } else {
                                    echo "<option value=$row[0]>$row[1]</option>";
                                }
                            }
                            ?>
                        </select>


                    </td>
                    <td  style="" align="left">
                        <?php
                           /***************    DATABASE  OPERATION    **************/
                        $dd = mysql_query("select activationtime_config,location from resources WHERE machid='$kk'");
                        $row = mysql_fetch_row($dd);
                        echo "<br><h2>Venue Capacity : <span  style='color : blue;'>" . $row[0] . "</span><br>  Resources Name :  <span  style='color : blue;'>" . $row[1]."</span></h2>";
                        ?>
                         <?php
                        include 'includes/color-scheme.php';
                        ?>
                    </td>

                    <td >
                       
                        <!--<div align="right" style="display: inline;overflow: hidden;float: right "><a href="member-index.php?date=<?php echo $next_week ?>&machid=<?php echo $machid ?>"><img src="images/next-images.jpg" height="40" width="40"></a></div>-->
                    </td>
                </tr>
            </table>
        </td>
<?php $obj1->userdetail(); ?>
    <tr>
        <td>
            <hr>
        </td>
        <td>
            <hr>
        </td>
    </tr>
    <tr>

        <td colspan="2">


            <?php
            echo booking($first_day_of_week, $machid);
            ?>

        </td>
    </tr>
</table>
<?php
/***************    FOOTER    **************/
include 'includes/footer.php';
?>