<?php

include 'connect.php';

function get_device_name($id) {
    if ($id != 'all') {
        $q = mysql_query("select name from resources where machid = $id");
        $row = mysql_fetch_row($q);
        return $row[0];
    } else {
        return "All Resources";
    }
}

function get_location_resource($id) {
    $q = mysql_query("select location from resources where machid = $id");
    $row = mysql_fetch_row($q);
    return $row[0];
}

function get_interval_time($id) {
    if ($id == 'all') {
        return '30';
    }
    $q = mysql_query("select schedule_config from resources where machid = $id");
    $row = mysql_fetch_row($q);
    return $row[0];
}

function get_resources() {

    $q = mysql_query("select * from resources order by machid");
    return $q;
}

function get_reservations($machid, $weekstart, $weekend) {
    $weekstart = strtotime($weekstart);


    $weekend = strtotime($weekend);

    $q = mysql_query("select startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout,login.memberid from reservations,login where machid = $machid and login.memberid = reservations.memberid and startdate between $weekstart and $weekend");
  //  echo "select startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout,login.memberid from reservations,login where machid in (1,2) and login.memberid = reservations.memberid and startdate between $weekstart and $weekend";
    return $q;
}

function get_meeting_reservations($machid, $weekstart, $weekend) {
    echo "<br>===============>>>".$machid;
    $weekstart = strtotime($weekstart);


    $weekend = strtotime($weekend);

    $q = mysql_query("select startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout,login.memberid from reservations,login where machid=$machid AND login.memberid IN ( 3756, 3755 ) and login.memberid = reservations.memberid and startdate between $weekstart and $weekend");
    echo "<br>select startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout,login.memberid from reservations,login where machid=$machid AND login.memberid IN ( 3756, 3755 ) and login.memberid = reservations.memberid and startdate between $weekstart and $weekend";
    return $q;
}

function get_reservations_my_bookings($machid, $weekstart, $weekend) {

    $weekstart = strtotime($weekstart);


    $weekend = strtotime($weekend);
    if ($machid == "all") {
        $q = mysql_query("select startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout,login.memberid from reservations,login where login.memberid = reservations.memberid and login.memberid=" . $_SESSION['SESS_MEMBER_ID'] . " and startdate between $weekstart and $weekend");
    } else {

        $q = mysql_query("select startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout,login.memberid from reservations,login where machid = $machid and login.memberid = reservations.memberid and login.memberid=" . $_SESSION['SESS_MEMBER_ID'] . " and startdate between $weekstart and $weekend");
    }
//echo "select startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout,login.memberid from reservations,login where machid = $machid and login.memberid = reservations.memberid and startdate between $weekstart and $weekend";  
    return $q;
}

function get_reservation_day($machid, $date) {

    $q = mysql_query("select * from reservations where machid = $machid and startdate = $date");

    return $q;
}

function save_reservations($machid, $startdate, $enddate, $starttime, $endtime, $summary, $isblackout, $sp, $type, $title, $c1, $p1) {
    $q = mysql_query("insert into reservations values(''," . $_SESSION['SESS_MEMBER_ID'] . ",$machid,$startdate,$enddate,'$starttime','$endtime','$sp','$type','$title','$c1','$p1','','$summary','','1',$isblackout)");
    //echo "<br>insert into reservations values('',".$_SESSION['SESS_MEMBER_ID'].",$machid,$startdate,$enddate,'$starttime','$endtime','$sp','$type','$title','$c1','$p1','','$summary','','1',$isblackout)";
    return $q;
}

function save_tempreservations($machid, $startdate, $enddate, $starttime, $endtime, $summary, $isblackout, $sp, $type, $title, $c1, $p1) {
    $q = mysql_query("insert into tempreservations values(''," . $_SESSION['SESS_MEMBER_ID'] . ",$machid,$startdate,$enddate,'$starttime','$endtime','$sp','$type','$title','$c1','$p1','','$summary','','1',$isblackout)");
    //echo "<br>insert into reservations values('',".$_SESSION['SESS_MEMBER_ID'].",$machid,$startdate,$enddate,'$starttime','$endtime','$sp','$type','$title','$c1','$p1','','$summary','','1',$isblackout)";
    return $q;
}

function get_reservation_id($resid) {
    $q = mysql_query("select * from reservations,login where resid = $resid and reservations.memberid = login.memberid");
    return $q;
}

function get_resource_activatation($machid) {
    $q = mysql_query("select relay_ipaddress,relay_switch_number,activation_status from resources where machid = $machid");
    $row = mysql_fetch_assoc($q);
    return $row;
}

function checkTime($resid, $status) {
    $sql = "select startdate,enddate,starttime,endtime,machid,activation_status from reservations where resid = $resid";
    $q = mysql_query($sql);
    $row = mysql_fetch_row($q);
    $timestampfrom = strtotime($row[2]);

    if (strtotime(date('m/d/Y')) < $row[0]) {
        return "101";
    } else if (strtotime(date('m/d/Y')) > $row[0]) {

        return "102";
    } else if (date("H:i:s", time()) < date("H:i:s", $timestampfrom - 900) && $row[2] != "12:00 am") {
        return "101";
    } else if (date("H:i:s", time()) > date("H:i:s", $timestampfrom + 900) && $row[3] != "12:00 am") {
        return "102";
    } else if ($status == 0) {
        return "103";
    } else {
        return 'OK';
    }
}

function cancel_reservation($resid) {
    $q = mysql_query("insert into cancel_reservation (resid,memberid,machid,startdate,enddate,starttime,endtime,invite_users,summary,datetime,activation_status,isblackout) select * from reservations where resid=$resid");
    mysql_query("delete from reservations where resid=$resid");
    return $q;
}

function save_error_report($resid, $machid, $details, $time, $memberid) {
    $q = mysql_query("insert into error_reporting values($machid,$resid,$memberid,'$details',$time)");
    mysql_error();
    return $q;
}

function save_report($resid, $machid, $details, $time, $memberid) {
    $q = mysql_query("insert into reporting values($machid,$resid,$memberid,'$details',$time)");
    mysql_error();
    return $q;
}

function get_error_report() {
    $q = mysql_query("select * from error_reporting");
    return $q;
}

function get_report() {
    $q = mysql_query("select * from reporting");
    return $q;
}

function get_owner_permissions($memberid, $machid) {
    $q = mysql_query("select * from system_owner where memberid = $memberid and machid=$machid");
    ///echo "select * from system_owner where memberid = $memberid and machid=$machid";

    if ($q) {
        if (mysql_num_rows($q) > 0) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function check_owner_permissions($memberid) {
    $q = mysql_query("select * from system_owner where memberid = $memberid");

    if ($q) {
        if (mysql_num_rows($q) > 0) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function get_user_permissions($memberid, $machid) {
    $q = mysql_query("select * from permissions where memberid=$memberid and machid=$machid");
    if ($q) {
        if (mysql_num_rows($q) > 0) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function get_user_permission($memberid) {
    $q = mysql_query("select * from permissions where memberid=$memberid");
    return $q;
}

function login_exec($uname, $passwords) {

    $qry = "SELECT * FROM login WHERE email='$uname' AND password='" . $passwords . "'";
    $result = mysql_query($qry);
    if ($result) {
        if (mysql_num_rows($result) > 0) {
            session_regenerate_id();
            $member = mysql_fetch_assoc($result);
            $_SESSION['SESS_MEMBER_ID'] = $member['memberid'];
            $_SESSION['FULL_NAME'] = $member['fname'] . " " . $member['lname'];
            $_SESSION['ACC_TYPE'] = $member['is_admin'];
            session_write_close();
            $flagval = 'true';
        } else {
            
        }
        return $flagval;
    } else {
        die("Query failed");
    }

    function forget_pass($randomno, $email) {
        $rr = "hi";
        return $rr;
    }

}

function update_member_profile($fname, $lname, $pos, $rollno, $course, $dept, $sup, $cosup, $project, $mob, $memberid) {

    $qry = "UPDATE `login` SET `fname` ='$fname', `lname` = '$lname',`position` = '$pos',`rollno` = '$rollno',`course` = '$course',`department` = '$dept',`supervisor` = '$sup',`cosupervisor` = '$cosup',`project` = '$project',`mobile` = '$mob' WHERE `login`.`memberid` ='$memberid'";
    $result = mysql_query($qry);
    return $result;
}

function user_exits($email) {

    $qry = "SELECT count(*) AS c FROM login WHERE email='$email'";
    //echo "===>".$qry;
    $result = mysql_query($qry);
    if ($result) {
        $result_array = mysql_fetch_assoc($result);
        if ($result_array['c'] > 0) {
            $errflag = 'true';
        }
        return $errflag;
    } else {
        die("Query failed");
    }
}

function user_exits2($email) {

    $qry = "SELECT count(*) AS c FROM  `templogin` WHERE email='$email'";
    //echo "===><br>".$qry;
    $result = mysql_query($qry);
    if ($result) {
        $result_array = mysql_fetch_assoc($result);
        if ($result_array['c'] > 0) {
            $errflag = 'true';
        }
        return $errflag;
    } else {
        die("Query failed");
    }
}

//Santosh 
//
function get_set_owner_permissions($memberid, $machid) {
    $q = mysql_query("select * from login,system_owner Where (system_owner.memberid=login.memberid) and (system_owner.machid='$machid') and (system_owner.memberid='$memberid');");
    //echo "<br>select * from login,system_owner Where (system_owner.memberid=login.memberid) and (system_owner.machid='$machid') and (system_owner.memberid='$memberid');";

    if ($q) {
        if (mysql_num_rows($q) > 0) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function get_set_user_permissions($memberid, $machid) {
    $q = mysql_query("select * from login,permissions Where (permissions.memberid=login.memberid) and (permissions.machid='$machid') and (permissions.memberid='$memberid');");
    //echo "<br>select * from login,permissions Where (permissions.memberid=login.memberid) and (permissions.machid='$machid') and (permissions.memberid='$memberid');";
    if ($q) {
        if (mysql_num_rows($q) > 0) {
            return 1;
        } else {
            return 0;
        }
    } else {
        return 0;
    }
}

function reg_user($email, $pass, $fname, $lname, $pos, $dept, $sup, $cosup, $project, $mob, $rollno, $course, $date, $time) {

    $qry = "INSERT INTO `templogin` (`memberid`, `email`, `password`, `fname`, `lname`, `position`,`is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`,`date`,`time`) 
	VALUES ('', '$email', '" . md5($pass) . "', '$fname', '$lname','$pos','1','$rollno', '$course', '$dept', '$sup', '$cosup','$project', '$mob','$date','$time');";
    //echo $qry;
    $result = mysql_query($qry);
    return $result;
}

function reg_admin($email, $pass, $fname, $lname, $pos, $dept, $sup, $cosup, $project, $mob, $rollno, $course, $date, $time) {

    $qry = "INSERT INTO `login` (`memberid`, `email`, `password`, `fname`, `lname`, `position`,`is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`,`date`,`time`) 
	VALUES ('', '$email', '" . md5($pass) . "', '$fname', '$lname','$pos','2','$rollno', '$course', '$dept', '$sup', '$cosup','$project', '$mob','$date','$time');";
    //echo $qry;
    $result = mysql_query($qry);
    return $result;
}

function user_approve($memberid) {
    mysql_query("INSERT INTO `login` (`email`, `password`, `fname`, `lname`, `position`,`is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`,`date`,`time`) SELECT `email`, `password`, `fname`, `lname`, `position`,`is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`,`date`,`time` FROM `templogin` WHERE memberid=$memberid");
    return (mysql_query("DELETE FROM `templogin` WHERE memberid=$memberid"));
}

function reject_user($memberid) {
    mysql_query("DELETE FROM `templogin` WHERE memberid=$memberid");
}

function reject_event($resid) {
    mysql_query("DELETE FROM `tempreservations` WHERE resid='$resid'");
    //echo "DELETE FROM `tempreservations` WHERE resid='$resid'";
}

function event_approve($resid) {
    mysql_query("INSERT INTO `reservations` (`memberid`, `machid`, `startdate`, `enddate`, `starttime`, `endtime`, `speakername`, `type`, `title`, `capacity`, `priority`, `invite_users`, `summary`, `datetime`, `activation_status`, `isblackout`) SELECT `memberid`, `machid`, `startdate`, `enddate`, `starttime`, `endtime`, `speakername`, `type`, `title`, `capacity`, `priority`, `invite_users`, `summary`, `datetime`, `activation_status`, `isblackout` FROM `tempreservations` WHERE resid=$resid");
    return (mysql_query("DELETE FROM `tempreservations` WHERE resid='$resid'"));
    //echo "<br>DELETE FROM `tempreservations` WHERE resid=$resid";
}

function get_previous_machid($machid) {

    $result3 = mysql_query("SELECT * FROM `system_owner` WHERE `machid` ='$machid'");
    //echo "<br>SELECT * FROM `system_owner` WHERE `machid` ='$machid'";
    while ($row = mysql_fetch_array($result3)) {
        if ($prevoiusres == '')
            $prevoiusres = $row['memberid'];
        else
            $prevoiusres = $row['memberid'] . ":" . $prevoiusres;
    }
    return $prevoiusres;
}

function no_of_row_on_machid($ownerarr) {
    $result = mysql_query("SELECT * FROM `system_owner` WHERE `machid` ='$ownerarr'");
    // echo "<br>SELECT * FROM `system_owner` WHERE `machid` ='$ownerarr'";
    return $result;
}

function now_uid_with_machid($ownerarr, $memberid) {
    $result2 = mysql_query("SELECT * FROM `system_owner` WHERE `memberid` ='$ownerarr' AND `machid` ='$memberid'");
    //echo "<br>SELECT * FROM `system_owner` WHERE `memberid` ='$ownerarr' AND `machid` ='$memberid'";
    return $result2;
}

function delete_edit_permisssion($memberid, $machid) {
    $date1 = datetime();
    $temp1 = explode('/', $date1);

    for ($i = 0; $i < count($memberid); $i++) {
        mysql_query("DELETE FROM `system_owner` WHERE `memberid` ='$memberid[$i]' AND `machid` = '$machid'");
        if ($memberid[$i] == '') {
            
        } else {
            mysql_query("INSERT INTO  `admin_system_onwer_track` (`loginid` ,`deviceid` ,`memberid` ,`date` ,`time` ,`action`)VALUES ('$temp1[2]',  '$machid',  '$memberid[$i]',  '$temp1[0]',  '$temp1[1]',  'DELETE');");
        }
        $norow = mysql_query("SELECT * FROM `system_owner` WHERE `memberid` ='$memberid[$i]'");
        $val = mysql_num_rows($norow);
        if ($val == 0) {
            mysql_query("UPDATE `login` SET `is_admin` = '0' WHERE `memberid` =' $memberid[$i]'");
        }
    }
    return 'true';
}

function datetime() {
    $date1 = date('m/d/Y');
    $startdate1 = strtotime($date1);
    $date2 = date('H:i:s');
    $temp2 = explode(':', $date2);
    $startdate2 = strtotime($temp2[0] . ":" . $temp2[1] . ":" . $temp2[2]);
    $fullname = $_SESSION['FULL_NAME'];
    $str = $startdate1 . "/" . $startdate2 . "/" . $fullname;
    return $str;
}

function update_edit_permisssion($memberid, $machid) {
    $date1 = datetime();
    $temp1 = explode('/', $date1);
    mysql_query("INSERT INTO `system_owner` VALUES('$memberid','$machid')");
    //echo "INSERT INTO `system_owner` VALUES('$memberid','$machid')";
    mysql_query("INSERT INTO  `admin_system_onwer_track` (`loginid` ,`deviceid` ,`memberid` ,`date` ,`time` ,`action`)VALUES ('$temp1[2]',  '$machid',  '$memberid',  '$temp1[0]',  '$temp1[1]',  'CREATE');");
    //mysql_query("UPDATE `login` SET `is_admin` = '2' WHERE `memberid` =' $memberid'");

    return 'true';
}

function update_status($status, $memberid) {
    $result = mysql_query("UPDATE `login` SET `is_admin` = '$status' WHERE `memberid` =' $memberid'");
    return $result;
    //echo "<br>UPDATE `login` SET `is_admin` = '$status' WHERE `memberid` =' $memberid'";
}

function del_user($memberid) {
    //echo "DELETE FROM login WHERE `memberid` ='$memberid'";
    $result = mysql_query("DELETE FROM login WHERE `memberid` =' $memberid'");
    return $result;
    //echo "<br>UPDATE `login` SET `is_admin` = '$status' WHERE `memberid` =' $memberid'";
}

function edit_nornal_user_per($memberid, $machid) {
    //echo "<br>SELECT * FROM `permissions` WHERE `machid` ='$userarr' AND `memberid` =' $memberid'";
    $result = mysql_query("SELECT * FROM `permissions` WHERE `machid` ='$machid' AND `memberid` =' $memberid'");
    return $result;
}

function get_previous_per($machid) {

    $result3 = mysql_query("SELECT * FROM `permissions` WHERE `machid` ='$machid'");
    // echo "SELECT * FROM `permissions` WHERE `machid` ='$machid'";
    while ($row = mysql_fetch_array($result3)) {
        if ($prevoiusres == '')
            $prevoiusres = $row['memberid'];
        else
            $prevoiusres = $row['memberid'] . ":" . $prevoiusres;
    }
    return $prevoiusres;
}

function update_edit_user_permisssion($memberid, $machid) {
    $date1 = datetime();
    $temp1 = explode('/', $date1);
    mysql_query("INSERT INTO `permissions` VALUES('$memberid','$machid')");
    mysql_query("INSERT INTO  `admin_user_permisssions_track` (`loginid` ,`deviceid` ,`memberid` ,`date` ,`time` ,`action`)VALUES ('$temp1[2]',  '$machid',  '$memberid',  '$temp1[0]',  '$temp1[1]',  'CREATE');");

    return 'true';
}

function delete_edit_user_permisssion($memberid, $machid) {
    for ($i = 0; $i < count($memberid); $i++) {
        $date1 = datetime();
        $temp1 = explode('/', $date1);
        mysql_query("DELETE FROM `permissions` WHERE `memberid` ='$memberid[$i]' AND `machid` = '$machid'");
        if ($memberid[$i] == '') {
            
        } else {
            mysql_query("INSERT INTO  `admin_user_permisssions_track` (`loginid` ,`deviceid` ,`memberid` ,`date` ,`time` ,`action`)VALUES ('$temp1[2]',  '$machid',  '$memberid[$i]',  '$temp1[0]',  '$temp1[1]',  'DELETE');");
        }
    }
    return 'true';
}

function get_error_user() {
    $sql = "select distinct login.fname,login.lname,login.memberid from login,reservations,error_reporting where error_reporting.resid = reservations.resid and reservations.memberid = login.memberid";
    return (mysql_query($sql));
}

function get_report_user() {
    $sql = "select distinct login.fname,login.lname,login.memberid from login,reservations,reporting where reporting.resid = reservations.resid and reservations.memberid = login.memberid";
    return (mysql_query($sql));
}

function get_error_mach() {
    $sql = "select distinct(resources.name),resources.machid from resources,error_reporting where error_reporting.machid = resources.machid ";
    return (mysql_query($sql));
}

function get_report_mach() {
    $sql = "select distinct(resources.name),resources.machid from resources,reporting where reporting.machid = resources.machid ";
    return (mysql_query($sql));
}

function get_system_owners($machid) {
    $sql = "select login.fname,login.lname from login,system_owner where system_owner.machid=$machid and system_owner.memberid = login.memberid";
    return (mysql_query($sql));
}

function get_same_reservation_count($date, $st, $en) {
    $d = strtotime($date);
    $count = 0;
    $sql = "SELECT count(*) FROM reservations, login where login.memberid = reservations.memberid AND login.memberid =" . $_SESSION['SESS_MEMBER_ID'] . " AND startdate = $d AND (starttime >= '$st' and endtime <='$en' || ((starttime >= '$st' AND starttime <= '$en') && (endtime > '$st' and endtime > '$en' )))";
    $row = mysql_fetch_row(mysql_query($sql));
    $count += $row[0];
    //$sql = "SELECT count(*) FROM reservations, login WHERE login.memberid = reservations.memberid AND login.memberid =".$_SESSION['SESS_MEMBER_ID']." AND startdate = $d AND starttime >= '$st' AND endtime > '$en' ";
    // $row = mysql_fetch_row(mysql_query($sql));
    // $count += $row[0];
    return $count;
    // return $row[0];
}

function get_same_reservation($date, $st, $en) {
    $d = strtotime($date);
    $sql = "SELECT startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout FROM reservations,login where login.memberid = reservations.memberid AND login.memberid =" . $_SESSION['SESS_MEMBER_ID'] . " AND startdate = $d AND (starttime >= '$st' and endtime <='$en' || ((starttime >= '$st' AND starttime <= '$en') && (endtime > '$st' and endtime > '$en' )))";
    $q = mysql_query($sql);
    return $q;


    // $sql = "SELECT startdate,starttime,endtime,fname,lname,machid,resid,activation_status,isblackout FROM reservations,login WHERE login.memberid = reservations.memberid AND login.memberid =".$_SESSION['SESS_MEMBER_ID']." AND startdate = $d AND starttime >= '$st' AND endtime > '$en'";
    // $q =  mysql_query($sql);
    // $rows =  mysql_fetch_array($q);
    // array_merge($row,(array)$rows);
}

function get_max_min($date, $st, $en) {
    $d = strtotime($date);
    $sql = "SELECT min(starttime) min,max(endtime) max FROM reservations,login where login.memberid = reservations.memberid AND login.memberid =" . $_SESSION['SESS_MEMBER_ID'] . " AND startdate = $d AND (starttime >= '$st' and endtime <='$en' || ((starttime >= '$st' AND starttime <= '$en') && (endtime > '$st' and endtime > '$en' )))";
    $q = mysql_query($sql);
    return $q;
}

function get_resid_exist($date, $st, $en) {

    $d = strtotime($date);

    return mysql_query($sql);
}

function get_device_owners($machid) {
    $sql = mysql_query("select login.fname,login.lname,login.email,login.rollno,login.supervisor,login.mobile from login,system_owner where system_owner.machid=$machid and system_owner.memberid = login.memberid");
    // echo "select login.fname,login.lname,login.email,login.rollno,login.supervisor,login.mobile from login,system_owner where system_owner.machid=$machid and system_owner.memberid = login.memberid";
    return $sql;
}

function add_ann($ann, $sdate, $edate) {
    $sql = mysql_query("INSERT INTO `announcements` (`announcementid`, `announcement`, `start_datetime`, `end_datetime`, `important`) VALUES ('', '$ann', '$sdate', '$edate', '0')");
}

function idtovanue($id) {

    $rs = mysql_query("SELECT `name` FROM `resources` WHERE `machid`='$id'");
    $row = mysql_fetch_row($rs);
    $name = $row[0];
    return $name;
}

?>
