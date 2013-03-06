<?php

 $link=mysql_connect("localhost","cal","*cal");
  if(!$link) {
  die('Failed to connect to server: ' . mysql_error());
  }
  //Select database
  $db=mysql_select_db("NewCal");
  if(!$db) {

  die("Unable to select database");
  } 

 /* $link=mysql_connect("localhost","root","");
  if(!$link) {
  die('Failed to connect to server: ' . mysql_error());
  }
  //Select database
  $db=mysql_select_db("slotbooking");
  if(!$db) {
  die("Unable to select database");
  } 
/*$link = mysql_connect("10.107.102.28", "jimit", "123456");
if (!$link) {
    die('Failed to connect to server: ' . mysql_error());
}
//Select database
$db = mysql_select_db("slotbooking");
if (!$db) {
    die("Unable to select database");
}*/
/*$link = mysql_connect("10.21.33.231", "jimit", "123456");
if (!$link) {
    die('Failed to connect to server: ' . mysql_error());
}
//Select database
$db = mysql_select_db("slotbooking");
if (!$db) {
    die("Unable to select database");
}*/

?>
