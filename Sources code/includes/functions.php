<?php
require_once "includes/Mail.php";

class functions {

// display a befour login menu.
    function befour_login_menu() {
        ?>
        <div style="width:100%;height:550px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#88C2E3;
             font-family:'Times New Roman', 	Times, serif;font-size:14px;">
            <br /><br /><br />
            <span style="margin-left: 6px; margin-top: 80px; margin-right: 45px; margin-bottom: -5px; "><strong><a href="index.php">Log in</a></strong></span><br />
            <span style="margin-left: 6px; margin-top: 80px; margin-right: 45px; margin-bottom: -5px; "><strong><a href="register-form.php">Register</a></strong></span><br />
            <span style="margin-left: 6px; margin-top: 80px; margin-right: 45px; margin-bottom: -5px; "><strong><a href="forgot-password.php">Forgot password</a></strong></span><br />
            <span style="margin-left: 6px; margin-top: 80px; margin-right: 45px; margin-bottom: -5px; ">Help</span><br />
        </div>
        <?php
    }

    function getflag($memid) {
        $result1 = mysql_query("SELECT email FROM `templogin` WHERE `memberid`='$memid'");
//echo "<br>SELECT email FROM `templogin` WHERE `memberid`='$memid'";
        $row1 = mysql_fetch_row($result1);
        $mobile1 = $row1[0];

        $result = mysql_query("SELECT * FROM `moreinfo` WHERE `email`='$mobile1'");
//echo "<br>SELECT * FROM `moreinfo` WHERE `email`='$mobile1'";
        $kk = mysql_num_rows($result);
        return $kk;
    }

    function geteventflag($resid) {

        $result = mysql_query("SELECT * FROM `moreinfoevent` WHERE `resid`='$resid'");
//echo "<br>SELECT * FROM `moreinfoevent` WHERE `resid`='$mobile1'";
        $kk = mysql_num_rows($result);
        return $kk;
    }

// roghit side column with announcement. fetch from database using announcement table.	
    function announcements() {
        ?>
        <div style="width:100%;height:550px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#88C2E3;" align="center">
            <marquee scrollamount="2" direction="up" loop="true" height="550px" width="100%" style="color:#000000;" onmouseover="this.stop()" onmouseout="this.start();">
                <table width="100%" border="0" cellpadding="5" cellspacing="5" style=" background:none">
                    <?php
                    $order = "SELECT * FROM `announcements`";
                    $result = mysql_query($order);
                    while ($data = mysql_fetch_row($result)) {
                        ?>
                        <tr>
                            <td style="padding-left:10px;color:#000000;font-weight:bold"><?php echo("$data[1]<br><br>"); ?></td>
                        </tr>
                        <?php
                    }
                    ?>
                </table>
            </marquee>
        </div>
        <?php
    }

//authenticat function

    function logout() {

        unset($_SESSION['SESS_MEMBER_ID']);
        header("location: index.php");
    }

    function header_image() {
        ?>
        <tr>
            <td width="20%" height="88"><div align="right"><img src="images/iit-logo.jpg" alt="IIT Bombay " width="108" height="110" /></div></td>
            <td width="30%"><span align="right"><img src="images/cen-logo.jpg" alt="CEN Logo" width="371" height="110" /></span></td>
            <td width="30%"><div align="right"><img src="images/inup-logo.jpg" width="343" height="110" /></div></td>
            <td width="20%">&nbsp;</td>
        </tr>
        <?php
    }

    function footer() {
        ?>
        <table width="100%" border="0" style="background:#FFFFFF;">
            <tr style="background:#FFFFFF;">
                <td style="background:#FFFFFF;">
                    <div style="width:100%;height:22px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#333333;
                         color:#FFFFFF;font-family:Arial, Helvetica, sans-serif;font-size:12px;" align="center">
                        <strong>
                            © 2011 Department of Biosciences and Bioengineering, Indian Institute of Technology Bombay, Powai, Mumbai - 400076
                        </strong>
                    </div>
                </td>
            </tr>
        </table>
        </body>
        </html>

        <?php
    }

    function secondsendmail($toid, $sub, $msgbody) {
        $from = "cherishsantosh@iitb.ac.in";
        $to = $toid;
        $subject = $sub;
        $body = $msgbody;
        $host = "smtp-auth.iitb.ac.in";
        $headers = array('From' => $from,
            'To' => $to,
            'Subject' => $subject);
        $smtp = Mail::factory('smtp', array('host' => $host, 'auth' => true, 'username' => "cherishsantosh", 'password' => "*sugandha"));
        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            echo("<p>" . $mail->getMessage() . "</p>");
        } else {
            
        }
    }

// send mail function 
    function sendmail($toid, $sub, $msgbody) {
        $from = "cherishsantosh@iitb.ac.in";
        $to = $toid;
        $subject = $sub;
        $body = $msgbody;
        $host = "smtp-auth.iitb.ac.in";
        $headers = array('From' => $from,
            'To' => $to,
            'Subject' => $subject);
        $smtp = Mail::factory('smtp', array('host' => $host, 'auth' => true, 'username' => "cherishsantosh", 'password' => "*sugandha"));
        $mail = $smtp->send($to, $headers, $body);

        if (PEAR::isError($mail)) {
            echo("<p>" . $mail->getMessage() . "</p>");
        } else {
            //header("location: index.php");
        }
    }

//change password form design
    function change_pass() {
        ?>

        <table width="100%" border="0" style="background:#FFFFFF;">
            <tr>
                <td width="15%">&nbsp;</td>
                <td width="70%">
                    <div style="width:100%;height:3	5px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#333333;" align="center"><br />

                        <table width="100%" border="0" style=" background:none;color:#FFFFFF;">
                            <tr>
                                <td width="40%" style="padding-left:70px;"><div align="left">Old password </div></td>
                                <td width="60%"><input type="password" name="oldpass" id="oldpass"></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><div style="padding-left:70px;" align="left">New password </div></td>
                                <td><input type="password" name="newpass" id="newpass"></td>
                            </tr>
                            <tr>
                                <td><div  style="padding-left:70px;" align="left">Confirmed new password </div></td>
                                <td><input type="password" name="cnewpass" id="cnewpass"></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" align="center"><input type="submit" name="submit" value="submit"></td>
                            </tr>
                        </table>
                    </div>

                </td>
                <td width="15%"></td>
            </tr>
        </table>
        <?php
    }

    function send_not($evnt, $msg) {

        $result1 = mysql_query("SELECT `name`,`email_id` FROM `subscriber` WHERE `events` LIKE '%," . $evnt . ",%'");
// echo "SELECT `name`,`email_id` FROM `subscriber` WHERE `events` LIKE '%," . $evnt . ",%'";
        while ($row1 = mysql_fetch_array($result1, MYSQL_BOTH)) {
            $email = $row1[1];
            $name = $row1[o];
        }
        $msg1 = $msg . "\nPlease click following link for unsuscribe http://localhost/NewMod/unsucsribe.php\n\n Thnak you";
        $from = "cherishsantosh@iitb.ac.in";
        $to = $email;
        $subject = "[~Suscribe:IIT Bombay Event]";
        $body = $msg;
// echo "<br>To " . $to . "<br>Header " . $headers . "<br>BODY " . $body;
        $host = "smtp-auth.iitb.ac.in";
        $headers = array('From' => $from,
            'To' => $to,
            'Subject' => $subject);
        $smtp = Mail::factory('smtp', array('host' => $host, 'auth' => true, 'username' => "cherishsantosh", 'password' => "*sugandha"));
        $mail = $smtp->send($to, $headers, $msg);

        if (PEAR::isError($mail)) {
            echo("<p>" . $mail->getMessage() . "</p>");
        } else {
            header("location: index.php");
        }
    }

    function userdetail() {
        ?>
        <tr>
            <td colspan="4" align="left" valign="top" ><div style="width:100%;height:23px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#0075CE;font-family:Arial, Helvetica, sans-serif;font-size:12px;" align="center">
                    <div align="left">
                        <table width="100%" border="0" style="background: none;border:0">
                            <tr> 
                                <td width="33%" style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome :  <?php
        if ($_SESSION['ACC_TYPE'] == '2') {
            echo "<strong>  Admin</strong>";
        } else {
            echo "<strong>  User</strong>";
        }
        ?><a href="edit-member-profile.php" style="text-decoration:none;font-weight:bold;"><?php echo "<strong>          " . $_SESSION['FULL_NAME'] . "</strong>"; ?></a> </td>
                                <td width="17%" style="color:#FFFFFF;"><?php echo "<strong>" . $str . "</strong>"; ?></td>
                                <td width="40%" align="right" valign="top">
                                </td>
                                <td width="10%"> 

                                    <div align="center"><strong><a href="logout.php" style="color:#FFFFFF;text-decoration:none;">Logout </a></strong></div>
                                    </div>
                                    </div>
                                    <div align="left"></div></td>
                            </tr>
                        </table>
                        <br />
                    </div>
                </div><br><br></td>
        </tr>
        <?php
    }

    function time($starttime, $endtime, $str1) {

        $starttime = explode(":", $starttime);
        $starttime = $starttime[0] . "" . $starttime[1];
        $endtime = explode(":", $endtime);
        $endtime = $endtime[0] . "" . $endtime[1];
//echo "<br>Function ==>(".$starttime." = ".$endtime.")";
        $counter = 0;
        for ($i = $starttime; $i < $endtime; $i = $i + 30) {
            $u = $i;
            $p = ($i / 100);
            $rt = explode(".", $p);
            $p = ($rt[0] * 100) + 60;
            $counter++;
            if ($u == $p) {
                $i = $i - 60;
                $i = $i + 100;
                if (strlen($i) == '3')
                    $i = "0" . $i;
                $str = $str . ":" . $i;
            } else {
                if (strlen($i) == '3')
                    $i = "0" . $i;
                $str = $str . ":" . $i;
            }
        }
        if ($str == '') {
            $str = $str1;
        } else {
            $str = $str . ":" . $str1;
        }
        return $str;
    }

//edit member form design 
//
    function member_profile_menu() {
        ?>
        <table width="100%" border="0" style="background:none;color:#FFFFFF;">

            <tr>
                <td width="20%" style="padding-left:40px;padding-top:8px;"><strong><a href=" member-index.php?date=<?php echo $_GET['date'] ?>&machid=<?php echo '1' ?>">Home</a><strong></td>
                            <td width="20%" style="padding-left:40px;padding-top:8px;"><strong><a href="member-profile.php?date=<?php echo $_GET['date'] ?>&machid=<?php echo '1' ?>">change password</a></strong></td>
                            <td width="20%" style="padding-left:40px;padding-top:8px;"><strong><a href="edit-member-profile.php?date=<?php echo $_GET['date'] ?>&machid=<?php echo '1' ?>">Edit profile</a><strong></td>

                                        <td width="20%"></td>
                                        <td width="20%"></td>
                                        </tr>
                                        </table>
                                        <?php
                                    }

                                    function reservation($starttime, $endtime, $sdate, $sp, $type, $title, $c1, $p1, $machid, $summary) {

                                        //  echo "======>>>".$type;
//                                        echo "<br>Start time ".$starttime;
//                                         echo "<br>end time ".$endtime;
//                                         echo "<br>Start date ".$sdate;
                                        $curdate = strtotime(date('m/d/Y'));
                                        $curtime = date('H:i');
//echo "Current date".date('m/d/Y');
                                        $temp = explode('/', $sdate);
                                        //echo "<br><br><br> Function  start from hear :- ";
                                        $startdate = strtotime($temp[1] . "/" . $temp[0] . "/" . $temp[2]);
                                        //echo "<br>" . $temp[1] . "/" . $temp[0] . "/" . $temp[2];
                                        //echo "<br>".strtotime("Y/d/m",$curtime)." ==== ".strtotime("Y/d/m",$starttime)."<br>";
                                        // echo "<br>====>" . $startdate . " >= " . $curdate;
                                        if ($startdate >= $curdate) {
                                            //echo strtotime($curtime) ." ". str$enddatetotime($starttime) ." ". $curdate ." ". $startdate;
                                            if ($curtime < $starttime || $curdate < $startdate) {
                                                $temp = explode('/', $sdate);
                                                $enddate = strtotime($temp[1] . "/" . $temp[0] . "/" . $temp[2]);
                                                $q = get_reservation_day($machid, $startdate);
                                                $flag = 0;
                                                $end_time = strtotime($endtime);

                                                if ($endtime == '00:00') {
                                                    $end_time = strtotime('00:00') + 86400;
                                                }

                                                if (mysql_num_rows($q) > 0) {
                                                    while ($row = mysql_fetch_row($q)) {
                                                        $db_end_time = strtotime($row[6]);
                                                        if ($row[6] == '00:00') {
                                                            $db_end_time = strtotime('00:00') + 86400;
                                                        }
                                                        //if(strtotime($starttime) > strtotime($endtime))
                                                        else if ((strtotime($starttime) < strtotime($row[5]) && $end_time > $db_end_time) || (strtotime($row[5]) <= strtotime($starttime) && $db_end_time > strtotime($starttime)) || (strtotime($row[5]) < $end_time && $db_end_time >= $end_time)) {

                                                            $flag = 1;
                                                        }
                                                    }
                                                }


                                                if (strtotime($starttime) > $end_time) {

                                                    $flag = 2;
                                                }

                                                if ($flag == 2) {
                                                    echo "<div class=errorlabel align=center>Invalid Time Selection</div>";
                                                } else if ($flag == 1) {
                                                    echo "<div class=errorlabel align=center>No Slot Available On This Date/Time :- " . date("d/m/Y", $startdate) . "</div>";
//                                                } else if ($_POST['summary'] == "") {
//                                                    echo "<div class=errorlabel align=center>Enter Summery</div>";
//                                                } 
                                                } else {

                                                    $isblackout = 1;
                                                    if (isset($_POST['blackout'])) {
                                                        $isblackout = 0;
                                                    }
                                                    //$type = "NULL";
                                                    $c1 = "30";
                                                    $p1 = "5";
                                                    //  echo "<br>   =======================Insert in to database=============    <br>";
                                                    //$q = save_reservations($machid, $startdate, $enddate, $starttime, $endtime, $summary, $isblackout, $sp, $type, $title, $c1, $p1);
                                                    if ($_SESSION['ACC_TYPE'] == '2') {
                                                        // echo "=========================".$type;
                                                        $q = save_reservations($machid, $startdate, $enddate, $starttime, $endtime, $summary, $isblackout, $sp, $type, $title, $c1, $p1);
                                                        //echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
                                                    } else {
                                                        $q = save_tempreservations($machid, $startdate, $enddate, $starttime, $endtime, $summary, $isblackout, $sp, $type, $title, $c1, $p1);
                                                        //echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
                                                    }
                                                    if ($q) {
//                                                        echo "<table width=100%><tr><th align=center>Reservation Done Successfully!!!</td></tr>";
//                                                        echo "<tr>
//                <td align=center>
//                    <a href=javascript:void(0) onclick=closeWindow()>Close</a>
//                </td>
//                </tr></table>";
//                                                        //exit(0);
                                                    } else {
                                                        echo mysql_error();
                                                    }
                                                }
                                            } else {
                                                echo "<div align=center class=errorlabel>You cannot book a slot for previous Time</div>";
                                                echo "<script type='text/javascript'>alert('You cannot book a slot for previous Time');</script>";
                                                // header("location: index.php");
                                            }
                                        } else {
                                            echo "<div align=center class=errorlabel>You cannot book a slot for previous days</div>";
                                            echo "<script type='text/javascript'>alert('You cannot book a slot for previous days');</script>";
                                            //header("location: reservation.php");
                                        }
                                    }

                                    function inttodate($intdate) {
//echo "==>".$intdate;
                                        if ($intdate == '0') {
                                            $date = '00';
                                        } elseif ($intdate == '1') {
                                            $date = '01';
                                        } elseif ($intdate == '2') {
                                            $date = '02';
                                        } elseif ($intdate == '3') {
                                            $date = '03';
                                        } elseif ($intdate == '4') {
                                            $date = '04';
                                        } elseif ($intdate == '5') {
                                            $date = '05';
                                        } elseif ($intdate == '6') {
                                            $date = '06';
                                        } elseif ($intdate == '7') {
                                            $date = '07';
                                        } elseif ($intdate == '8') {
                                            $date = '08';
                                        } elseif ($intdate == '9') {
                                            $date = '09';
                                        } else {
                                            $date = $intdate;
                                            // echo "got it".$date;
                                        }
                                        return $date;
                                    }

                                    function getDaysInBetween($start, $end) {
                                        $day = 86400; // Day in seconds
                                        $format = 'm/d/Y'; // Output format (see PHP date funciton)
                                        $sTime = strtotime($start); // Start as time
                                        $eTime = strtotime($end); // End as time
                                        $numDays = round(($eTime - $sTime) / $day) + 1;
                                        $days = array();

                                        for ($d = 0; $d < $numDays; $d++) {
                                            $days[] = date($format, ($sTime + ($d * $day)));
                                            // print_r($days);
                                        }

                                        return $days;
                                    }

                                    function getWorkingDays($startDate, $endDate) {

                                        $businessDays = array();
                                        $businessDaysInWeek = range(1, 5);      // Only Monday to Friday
                                        // Decompose the provided dates.        
                                        list($startMonth, $startDay, $startYear) = explode('/', $startDate);
                                        list($endMonth, $endDay, $endYear) = explode('/', $endDate);

                                        // Create our start and end timestamps.
                                        $startStamp = mktime(1, 1, 1, $startMonth, $startDay, $startYear);
                                        $endStamp = mktime(1, 1, 1, $endMonth, $endDay, $endYear);

                                        // Check each day in turn.
                                        for ($loop = $startStamp; $loop <= $endStamp; $loop+=86400) {
                                            if (in_array(date('N', $loop), $businessDaysInWeek)) {

                                                // You'll also want to omit bank holidays, etc. in here.

                                                $businessDays[] = date('m/d/Y', $loop);
                                            }
                                        }

                                        return $businessDays;
                                    }

                                }
                                ?>
