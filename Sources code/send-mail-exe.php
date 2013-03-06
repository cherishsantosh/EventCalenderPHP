<?php
/***************    INCLUDE FILE        **************/
include 'includes/connect.php';
require_once "includes/Mail.php";

$res = $_POST['sres'];
$email = $_POST['semail'];



$toid = $_POST['to'];
$sub = $_POST['sub'];
$myarea = $_POST['myarea'];
$msgbody = $_POST['body'];

$from = "cherishsantosh@iitb.ac.in";
$to = $toid;
$subject = $sub;
$body = $msgbody;

/***************    SEND MAIL        **************/
//echo "INSERT INTO `moreinfo` (`email`, `info`, `flag`, `question`) VALUES ('$totos', 'NULL', 'NULL', '$myarea');";
$host = "smtp-auth.iitb.ac.in";
$headers = array('From' => $from,
    'To' => $to,
    'Subject' => $subject);
$smtp = Mail::factory('smtp', array('host' => $host, 'auth' => true, 'username' => "cherishsantosh", 'password' => "*sugandha"));
$mail = $smtp->send($to, $headers, $body);



if (PEAR::isError($mail)) {
    echo("<p>" . $mail->getMessage() . "</p>");
} else {
    echo "<h3>Mail sent successfully !!<h3>";
}

  /***************    WRITE INTO DATABASE      **************/
if ($res != '') {
    $myarea = $_POST['myarea'];
    $totos = $_POST['sres'];
    mysql_query("INSERT INTO `moreinfoevent` (`resid`, `info`, `flag`, `question`) VALUES ('$totos', 'NULL', 'NULL', '$myarea');");
   // echo "===>RES";
}
if ($email != '') {
    $myarea = $_POST['myarea'];
    $totos = $_POST['to'];
    mysql_query("INSERT INTO `moreinfo` (`email`, `info`, `flag`, `question`) VALUES ('$totos', 'NULL', 'NULL', '$myarea');");
    //echo "INSERT INTO `moreinfo` (`email`, `info`, `flag`, `question`) VALUES ('$totos', 'NULL', 'NULL', '$myarea');";
    //echo "===>Email";
}
?>
