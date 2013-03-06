<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
include 'includes/function.php';

$obj1 = new functions();

function compa($one, $two, $three, $four) {
    if ($one <= $two) {
        if ($three < $four) {
            $val = 0;
        }
    } else {
        $val = 1;
    }
    return $val;
}
/***************    FORM SUBMIT ACTION        **************/
if ($_POST['submit']) {
    $sdate = $_POST['sdate'];
    $slotno = $_POST['mycmb'];
    $edate = $_POST['edate'];
    $semyear = $_POST['semyear'];
    $semtype = $_POST['semtype'];

    $str = $_POST['weekone1'] . ":" . $_POST['hr1'] . ":" . $_POST['mn1'] . ":" . $_POST['hr8'] . ":" . $_POST['mn8'] . ":" . $_POST['hour1'] . "/" . $_POST['weekone2'] . ":" . $_POST['hr2'] . ":" . $_POST['mn2'] . ":" . $_POST['hr9'] . ":" . $_POST['mn9'] .":" . $_POST['hour2'] . "/" . $_POST['weekone3'] . ":" . $_POST['hr3'] . ":" . $_POST['mn3'] . ":" . $_POST['hr10'] . ":" . $_POST['mn10'] .":" . $_POST['hour3'] . "/" . $_POST['weekone4'] . ":" . $_POST['hr4'] . ":" . $_POST['mn4'] . ":" . $_POST['hr11'] . ":" . $_POST['mn11'] .":" . $_POST['hour4'] . "/" . $_POST['weekone5'] . ":" . $_POST['hr5'] . ":" . $_POST['mn5'] . ":" . $_POST['hr12'] . ":" . $_POST['mn12'] .":" . $_POST['hour5'] . "/" . $_POST['weekone6'] . ":" . $_POST['hr6'] . ":" . $_POST['mn6'] . ":" . $_POST['hr13'] . ":" . $_POST['mn13'] .":" . $_POST['hour6'] . "/" . $_POST['weekone7'] . ":" . $_POST['hr7'] . ":" . $_POST['mn7'] . ":" . $_POST['hr14'] . ":" . $_POST['mn14'].":" . $_POST['hour7'];
   // echo $str;
    $cnt = 0;
    $three = explode("/", $str);
    for ($i = 0; $i < count($three); $i++) {
        $twoarr = explode(":", $three[$i]);
        if (($twoarr[0] == "NULL") || ($twoarr[1] == "NULL") || ($twoarr[2] == "NULL") || ($twoarr[3] == "NULL") || ($twoarr[4] == "NULL")) {
            
        } else {
            $threearr[$cnt] = $three[$i];
            $cnt++;
        }
    }
/***************    DATABASE OPRATION        **************/
    mysql_query("INSERT INTO `eachdetail` (`slotno`, `startdate`, `enddate`, `slotyear`) VALUES ('$slotno', '$sdate', '$edate', '$semtype$semyear')");
    //echo "<br>INSERT INTO `eachdetail` (`slotno`, `startdate`, `enddate`, `slotyear`) VALUES ('$slotno', '$sdate', '$edate', '$semtype$semyear')";
    for ($i = 0; $i < count($threearr); $i++) {
        $tre = explode(":", $threearr[$i]);
        $vv = compa($tre[1], $tre[3], $tre[2], $tre[4]);
        if ($vv == '1') {
            echo "Plseae check your time";
            exit(0);
        }else{
            $time1=$tre[1].":".$tre[2];
            $time2=$tre[3].":".$tre[4];
           // echo "<br>INSERT INTO `slotdefine` (`day`, `slothour`, `starttime`, `endtime`, `slotno`, `slotyear`) VALUES ('$tre[0]', '$tre[5]$slotno','$time1','$time2', '$slotno', '$semtype$semyear')";
            mysql_query("INSERT INTO `slotdefine` (`day`, `slothour`, `starttime`, `endtime`, `slotno`, `slotyear`) VALUES ('$tre[0]', '$slotno$tre[5]','$time1','$time2', '$slotno', '$semtype$semyear')");
            
        }
    }
    echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
}

?>
<?php 
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];if($_SESSION['ACC_TYPE']=='2'){include 'menu.php'; } ?>
<!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" align="center" style="border-color:#1A6A75;border-collapse:collapse">
    <tr>
        <caption>Blank Slot</caption>
        
        <?php $obj1->userdetail(); ?>
        
    </tr>
    <tr>
        <td>
            <form action="" method="post">
                <table width="100%" border="0" align="center" style="border-collapse:collapse;"  cellpadding="6">
                    <tr>
                        <td colspan="3"><div align="center"><strong>Slot ID</strong></div></td>
                        <td colspan="3"><div align="left">
                                <select name="mycmb" id="mycmb" >
                                    <?php for ($i = 1; $i < 25; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                            </div></td>
                    </tr>
                    <tr>
                        <td colspan="3"><div align="center"><strong>Sart Date</strong></div></td>
                        <td colspan="3"><div align="left"><input type="text" id="date" name="sdate" value="<?php echo $sdate; ?>"></div></td>
                    </tr>
                    <tr>
                        <td colspan="3"><div align="center"><strong>End Date</strong></div></td>
                        <td colspan="3"><div align="left"><input type="text" id="date1" name="edate" value="<?php echo $edate; ?>"></div></td>
                    </tr>
                    <tr>
                        <td colspan="3"><div align="center"><strong>Semister Type</strong></div></td>
                        <td colspan="3"><div align="left"> <select name="semtype" id="semtype" >
                                    <option value="EVEN">EVEN</option>
                                    <option value="ODD">ODD</option>
                                </select></td>
                    </tr>
                    <tr>
                        <td colspan="3"><div align="center"><strong>Semister Year</strong></div></td>
                        <td colspan="3"><div align="left">
                                <?php $dd = date('m/d/Y');
                                $year = explode("/", $dd); ?>
                                <select name="semyear" id="semyear" >
                                    <?php for ($i = $year[2]; $i < ($year[2] + 10); $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>

                                </select></div></td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    <tr style="padding-bottom: 1em;cellpadding : 4px;">
                        <td width="15%" bgcolor="#1A6A75"><div align="center" style="color: #FFFFFF;"><strong>Day</strong></div></td>

                        <td width="16%" bgcolor="#1A6A75"><div align="center"  style="color: #FFFFFF;"><strong>Session</strong></div></td>
                        <td width="26%" bgcolor="#1A6A75"><div align="center"  style="color: #FFFFFF;"><strong>Start time</strong></div></td>
                        <td width="25%" bgcolor="#1A6A75"><div align="center"  style="color: #FFFFFF;"><strong>EndTime</strong></div></td>
                        <td width="8%" bgcolor="#1A6A75"><div align="center"  style="color: #FFFFFF;"><strong>Remark</strong></div></td>
                    </tr>
                    <tr>
                        <td>
                            <div align="center">
                                <select name="weekone1" id="weekone1" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hour1" id="hour1" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="A">First Session</option>
                                    <option value="B">Second Session</option>
                                    <option value="C">Third Session</option>
                                    <option value="D">Fourth Session</option>
                                    <option value="E">Fifth Session</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hr1" id="hr1" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn1" id="mn1" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center">
                                <select name="hr8" id="hr8" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn8" id="mn8" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center"></div></td>
                    </tr>
                    <tr>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="weekone2" id="weekone2" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hour2" id="hour2" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="A">First Session</option>
                                    <option value="B">Second Session</option>
                                    <option value="C">Third Session</option>
                                    <option value="D">Fourth Session</option>
                                    <option value="E">Fifth Session</option>
                                </select>
                            </div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hr2" id="hr2" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn2" id="mn2" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hr9" id="hr9" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 7; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn9" id="mn9" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td bgcolor="#DAEFF3"><div align="center"></div></td>
                    </tr>
                    <tr>
                        <td><div align="center">
                                <select name="weekone3" id="weekone3" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hour3" id="hour3" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="A">First Session</option>
                                    <option value="B">Second Session</option>
                                    <option value="C">Third Session</option>
                                    <option value="D">Fourth Session</option>
                                    <option value="E">Fifth Session</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hr3" id="hr3" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn3" id="mn3" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center">
                                <select name="hr10" id="hr10" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn10" id="mn10" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center"></div></td>
                    </tr>
                    <tr>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="weekone4" id="weekone4" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hour4" id="hour4" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="A">First Session</option>
                                    <option value="B">Second Session</option>
                                    <option value="C">Third Session</option>
                                    <option value="D">Fourth Session</option>
                                    <option value="E">Fifth Session</option>
                                </select>
                            </div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hr4" id="hr4" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn4" id="mn4" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hr11" id="hr11" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn11" id="mn11" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td bgcolor="#DAEFF3"><div align="center"></div></td>
                    </tr>
                    <tr>
                        <td><div align="center">
                                <select name="weekone5" id="weekone5" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hour5" id="hour5" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="A">First Session</option>
                                    <option value="B">Second Session</option>
                                    <option value="C">Third Session</option>
                                    <option value="D">Fourth Session</option>
                                    <option value="E">Fifth Session</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hr5" id="hr5" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn5" id="mn5" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center">
                                <select name="hr12" id="hr12" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn12" id="mn12" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center"></div></td>
                    </tr>
                    <tr>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="weekone6" id="weekone6" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hour6" id="hour6" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="A">First Session</option>
                                    <option value="B">Second Session</option>
                                    <option value="C">Third Session</option>
                                    <option value="D">Fourth Session</option>
                                    <option value="E">Fifth Session</option>
                                </select>
                            </div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hr6" id="hr6" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn6" id="mn6" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td bgcolor="#DAEFF3"><div align="center">
                                <select name="hr13" id="hr13" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn13" id="mn13" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td bgcolor="#DAEFF3"><div align="center"></div></td>
                    </tr>
                    <tr>
                        <td><div align="center">
                                <select name="weekone7" id="weekone7" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="Monday">Monday</option>
                                    <option value="Tuesday">Tuesday</option>
                                    <option value="Wednesday">Wednesday</option>
                                    <option value="Thursday">Thursday</option>
                                    <option value="Friday">Friday</option>
                                    <option value="Saturday">Saturday</option>
                                    <option value="Sunday">Sunday</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hour7" id="hour7" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="A">First Session</option>
                                    <option value="B">Second Session</option>
                                    <option value="C">Third Session</option>
                                    <option value="D">Fourth Session</option>
                                    <option value="E">Fifth Session</option>
                                </select>
                            </div></td>
                        <td><div align="center">
                                <select name="hr7" id="hr7" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn7" id="mn7" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center">
                                <select name="hr14" id="hr14" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <?php for ($i = 07; $i < 23; $i++) { ?>
                                        <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                    <?php } ?>
                                </select>
                                Hr
                                <select name="mn14" id="mn14" >
                                    <option value="NULL" selected="selected">NULL</option>
                                    <option value="00">00</option>
                                    <option value="15">15</option>
                                    <option value="30">30</option>
                                    <option value="45">45</option>
                                </select>
                                Mn</div></td>
                        <td><div align="center"></div></td>
                    </tr>
                    <tr>
                        <td colspan="6">&nbsp;</td>
                    </tr>
                    <tr>
                        <td colspan="6"><div align="center"> <input type="submit" name="submit" value="Submit"/></div></td>
                    </tr>
                </table>
            </form>     
        </td>
    </tr>
</table>
<?php 
/***************    FOOTER    **************/
include 'includes/footer.php' ?>