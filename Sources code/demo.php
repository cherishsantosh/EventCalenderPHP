<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$obj1 = new functions();
/***************    DATABASE CONNECTION        **************/
mysql_connect("localhost", "cal", "*cal");
mysql_select_db("NewCal");
$fp = fopen("data.ics", "w");
/***************    DATABASE OPERATATION      **************/
$qry = "SELECT * FROM `reservations`";
$result = mysql_query($qry);
$cnt=0;
/***************   CREATE GOOGLE CALENDER FILE        **************/
$tt = "BEGIN:VCALENDAR
PRODID:-//Google Inc//Google Calendar 70.9054//EN
VERSION:2.0
CALSCALE:GREGORIAN
METHOD:PUBLISH
X-WR-CALNAME:sakandroidmobile@gmail.com
X-WR-TIMEZONE:Asia/Calcutta";

function timecal($time) {
    $pos = strpos($time, "00");
    echo "|".$pos."|";
    if ($pos == 2) {
        // string needle NOT found in haystack

        $tt1 = $time - 470;

        if (strlen($tt1) == '3')
            $tt1 = "0" . $tt1;
        //echo $tt1;
    }elseif ($pos == '') {
        // string needle NOT found in haystack

        $tt1 = $time - 430;

        if (strlen($tt1) == '3')
            $tt1 = "0" . $tt1;
        //echo $tt1;
    }elseif ($pos == '1') {
        // string needle NOT found in haystack

        $tt1 = $time - 470;

        if (strlen($tt1) == '3')
            $tt1 = "0" . $tt1;
        //echo $tt1;
    }else {
        // string needle found in haystack
        $tt2 = $time - 430;

        if (strlen($tt2) == '3')
            $tt1 = "0" . $tt2;
        // echo $tt2;
    }
    return $tt1;
}

while ($row = mysql_fetch_array($result)) {
    $vanue=idtovanue($row[2]);
  
    $currentdate=date("Ymd Hm");
    $tmt=explode(" ",$currentdate);
    $time1 = str_replace(":", "", $row[5]);
    $rp1 = timecal($time1);

    $time2 = str_replace(":", "", $row[6]);
    $rp2 = timecal($time2);

    if ($write == '') {

        $tt1 = "
BEGIN:VEVENT
DTSTART:" . date("Ymd", $row[3]) . "T" . $rp1 . "00Z" . "
DTEND:" . date("Ymd", $row[4]) . "T" . $rp2 . "00Z" . "
DTSTAMP: ".$tmt[0]."T".$tmt[1]."45Z"."
UID:".  md5($row[13])."@google.com
CREATED:" . date("Ymd", $row[3]) . "T" . $rp1 . "38Z" . "
DESCRIPTION:$row[13]
LAST-MODIFIED:".$tmt[0]."T".$tmt[1]."23Z"."
LOCATION: $vanue
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY: $row[9]
TRANSP:OPAQUE
END:VEVENT
    ";
        $write = $tt . ", " . $tt1;
    } else {
        $tt3 = "
BEGIN:VEVENT
DTSTART:" . date("Ymd", $row[3]) . "T" . $rp1 . "00Z" . "
DTEND:" . date("Ymd", $row[4]) . "T" . $rp2 . "00Z" . "
DTSTAMP: ".$tmt[0]."T".$tmt[1]."45Z"."
UID:".  md5($row[13])."@google.com
CREATED:" . date("Ymd", $row[3]) . "T" . $rp1 . "38Z" . "
DESCRIPTION:$row[13]
LAST-MODIFIED:".$tmt[0]."T".$tmt[1]."23Z"."
LOCATION: $vanue
SEQUENCE:0
STATUS:CONFIRMED
SUMMARY: $row[9]
TRANSP:OPAQUE
END:VEVENT
    ";
        $write = $write . "" . $tt3;
    }
    //$write=$write."END:VCALENDAR";
}
foreach ($data_array as $id => $ary) {

    $tmp = $id . ',';
    foreach ($ary as $value) {

        $tmp .= $value . ',';
    }

    $write .= substr($tmp, -1, 1) . "\r\n";
}

fwrite($fp, $write."END:VCALENDAR");
fclose($fp);
/***************    END FILE        **************/
?>
