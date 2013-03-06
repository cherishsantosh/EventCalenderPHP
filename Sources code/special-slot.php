<?php
    /***************    INCLUDE FILE        **************/
include 'includes/header.php';
include 'includes/function.php';

$obj1 = new functions();
/***************    FORM SUBMIT ACTION        **************/
if ($_POST['submit']) {
    $sdate = $_POST['sdate'];
    $edate = $_POST['edate'];
    $starttime = $_POST['starttime'];
    $endtime = $_POST['endtime'];

    $type = $_POST['type'];
    $v1 = $_POST['v1'];
    $sp = $_POST['sp'];
    $title = $_POST['title'];
    $abstract = $_POST['abstract'];
    $one = $_POST['selectName'];
    $three = $_POST['weekday2'];
    $four = $_POST['weekday1'];
    $weekno = $_POST['weekno'];

/***************    WRITE INTO DATABASE      **************/
   // echo "====" . $one;
    if ($one == 'one') {
        $get_all_date = ($obj1->getDaysInBetween($sdate, $edate));

        for ($j = 0; $j < count($get_all_date); $j++) {
            $date1 = explode("/", $get_all_date[$j]);
            $datee = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
           // echo "<br>Date " . $datee;
            $summary = "Repetative slot";
            $obj1->reservation($starttime, $endtime, $datee, $sp, $type, $title, $c1, $p1, $v1, $abstract);
            
        }
        echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
    } elseif ($one == 'two') {
        $workingdays = ($obj1->getWorkingDays($sdate, $edate));
        for ($j = 0; $j < count($workingdays); $j++) {
            $date1 = explode("/", $workingdays[$j]);
            $datee = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
            $summary = "Repetative slot";
            $obj1->reservation($starttime, $endtime, $datee, $sp, $type, $title, $c1, $p1, $v1, $abstract);
        }
                    echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";

    } elseif ($one == 'three') {
        for ($i = 0; $i < count($three); $i++) {
            $currentDate = strtotime($three[$i], strtotime($sdate));
            $endDate = strtotime($edate);
            while ($currentDate <= $endDate) {
                $mondays[] = date('m/d/Y', $currentDate);
                $currentDate = strtotime("+1 week", $currentDate);
            }
        }
        for ($j = 0; $j < count($mondays); $j++) {
            $date1 = explode("/", $mondays[$j]);
            $datee = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
            //echo "<br>Date" . $datee;
            $summary = "Repetative slot";
            $obj1->reservation($starttime, $endtime, $datee, $sp, $type, $title, $c1, $p1, $v1, $abstract);
        }
                    echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";

    } elseif ($one == 'four') {
        for ($i = 0; $i < count($four); $i++) {
            $currentDate = strtotime($four[$i], strtotime($sdate));
            $endDate = strtotime($edate);
            while ($currentDate <= $endDate) {
                $mondays[] = date('m/d/Y', $currentDate);
                $currentDate = strtotime("+1 week", $currentDate);
            }
        }
        for ($j = 0; $j < count($mondays); $j++) {
            $date1 = explode("/", $mondays[$j]);
            $datee = $date1[1] . "/" . $date1[0] . "/" . $date1[2];
           // echo "<br>Date" . $datee;
            $summary = "Repetative slot";
            $obj1->reservation($starttime, $endtime, $datee, $sp, $type, $title, $c1, $p1, $v1, $abstract);
            echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
        }
    }
}
//
?>
<head>
    <script type="text/javascript"><!--
        var lastDiv = "";
        function showDiv(divName) {
            if (lastDiv) {
                document.getElementById(lastDiv).className = "hiddenDiv";
            }
            if (divName && document.getElementById(divName)) {
                document.getElementById(divName).className = "visibleDiv";
                lastDiv = divName;
            }
        }
    </script>
    <style type="text/css" media="screen">
        <!--
        .hiddenDiv {
            display: none;
        }
        .visibleDiv {
            display: block;
        }
    </style>


</head> 
<?php 
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];if($_SESSION['ACC_TYPE']=='2'){include 'menu.php'; } ?>


<form action="" method="POST">
    
    <table width="100%" border="0" align="center">
         <caption>Special Slot </caption>
    
     <?php $obj1->userdetail(); ?>
     
        <tr style="background: #DAEFF3;">
            <td width="50%" align="right">Starting Date :-</td>
            <td width="50%"><input type="text" id="date" name="sdate" value="<?php echo $sdate; ?>"></td>
        </tr>
        <tr>
            <td align="right">Ending Date :-</td>
            <td><input type="text" id="date1" name="edate" value="<?php echo $edate; ?>"></td>
        </tr>
        <tr style="background: #DAEFF3;">
            <td width="230" align="right">Select repete mode :- </td>
            <td width="260">
                <select name="selectName" size="1" onchange="showDiv(this.value);">
                    <option value="">Choose One...</option>
                    <option value="one">Repete daily</option>
                    <option value="two">Every Weekday(Mon-Fri)</option>
                    <option value="three">Weekly(Every Monday)</option>
               <!--     <option value="four">Monthly(FirstWeek of Monday)</option> -->
                </select>		</td>
        </tr>
        <tr>
            <td colspan="2">
                <p id="one" class="hiddenDiv"><input type="hidden" name="one" id="one" value="one"/></p>

                <p id="two" class="hiddenDiv" align="center"><input type="hidden" name="two" id="two" value="two"/></p>

                <p id="four" class="hiddenDiv" align="center"><br /><br /><strong>  Monthly(FirstWeek of Monday) </strong><br /><br />
                    <input type="hidden" name="four" id="four" value="four"/>
                <table width="100%" border="0">
                    <tr>
                        <td colspan="2"><select name="weekno">
                                <option value="first">First</option>
                                <option value="second">Second</option>
                                <option value="third">Third</option>
                                <option value="four">Four</option>
                            </select></td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input align="left" type="checkbox" name="weekday1[]" value="Monday" /> Monday</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input align="left" type="checkbox" name="weekday1[]" value="Tuesday" /> Tuesday</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input align="left" type="checkbox" name="weekday1[]" value="Wednesday" /> Wednesday</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input align="left" type="checkbox" name="weekday1[]" value="Thursday" /> Thursday</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input align="left" type="checkbox" name="weekday1[]" value="Friday" /> Friday</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input align="left" type="checkbox" name="weekday1[]" value="Saturday" /> Saturday</td>
                    </tr>
                    <tr>
                        <td>&nbsp;</td>
                        <td><input  align="left" type="checkbox" name="weekday1[]" value="Sunday" /> Sunday</td>
                    </tr>
                </table>

                </p>


                <p id="three" class="hiddenDiv">

                    <br /><br />
                    <strong>   Weekly(Every Monday) </strong><br /><br />
                    <input type="hidden" name="three" id="three" value="three"/>

                    <label><input type="checkbox" name="weekday2[]" value="Monday" /> Monday</label><br />
                    <label><input type="checkbox" name="weekday2[]" value="Tuesday" /> Tuesday</label><br />
                    <label><input type="checkbox" name="weekday2[]" value="Wednesday" /> Wednesday</label><br />
                    <label><input type="checkbox" name="weekday2[]" value="Thursday" /> Thursday</label><br />
                    <label><input type="checkbox" name="weekday2[]" value="Friday" /> Friday</label><br />
                    <label><input type="checkbox" name="weekday2[]" value="Saturday" /> Saturday</label></br>
                    <label><input type="checkbox" name="weekday2[]" value="Sunday" /> Sunday</label><br />
                </p>        </td>
        </tr>

        <tr  style="background: #DAEFF3;">
            <td align="right">Event Type</td>
            <td>
                <select name="type" id="type">
                    <?php
                    $result = mysql_query("SELECT * FROM event");
                    while ($row1 = mysql_fetch_array($result)) {
                        ?>
                        <option value="<?php echo $row1['eventname']; ?>" selected="selected"><?php echo $row1['eventname']; ?></option>
                    <?php } ?>
                </select>    
            </td>
        </tr>

        <tr>
            <td align="right">Vanue</td>
            <td>      
                <select name="v1" id="v1">
                    <?php
                    $result = mysql_query("SELECT * FROM resources ");
                    while ($row = mysql_fetch_array($result)) {
                        ?>
                        <option  value="<?php echo $row['machid']; ?>" selected="selected"><?php echo $row['name']; ?></option>
                    <?php } ?>
                </select>    
            </td>
        </tr>

        <tr style="background: #DAEFF3;">
            <td align="right">Speaker Name</td>
            <td><input type="text" name="sp" id="sp"/></td>
        </tr>

        <tr>
            <td align="right">Title</td>
            <td><input type="text" name="title" id="title"/></td>
        </tr>

        <tr style="background: #DAEFF3;">
            <td align="right">Starting time</td>
            <td> <select name="starttime">
                    <?php
                    for ($i = 00; $i < 24; $i++) {
                        for ($j = 00; $j <= 45; $j = $j + 30) {

                            $ss = $obj1->inttodate($i) . ":" . $obj1->inttodate($j);
                            // $ss1=inttodate($ss);
                            echo "<option value='$ss' selected=selected>" . $ss . "</option>";
                            // echo "<option value='$time_value'>" . $time_value . "</option>";
                        }
                    }
                    ?></select>
            </td>

        </tr>
        <tr>
            <td align="right">Ending time :- </td>
            <td>  
                <select name="endtime">
                    <?php
                    for ($i = 00; $i < 24; $i++) {
                        for ($j = 00; $j <= 45; $j = $j + 30) {

                            $ss = $obj1->inttodate($i) . ":" . $obj1->inttodate($j);
                            // $ss1=inttodate($ss);
                            echo "<option value='$ss' selected=selected>" . $ss . "</option>";
                            // echo "<option value='$time_value'>" . $time_value . "</option>";
                        }
                    }
                    ?>

                </select> </td>
        </tr>
        <tr style="background: #DAEFF3;">
            <td><div align="center">Abstract </div></td><td><textarea id="abstract" name="abstract" cols="40" rows="7" id="abstract"></textarea></td>
        </tr>
        <tr>
            <td colspan="2">&nbsp;</td>
        </tr>
        <tr>
            <td colspan="2" align="center"><input type="submit" name="submit" value="Submit"/> </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp; </td>
        </tr>
        <tr>
            <td colspan="2">&nbsp; </td>
        </tr>
    </table>
</form>
<?php
/***************    FOOTER    **************/
include 'includes/footer.php' ?>