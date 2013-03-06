<?php
/***************   SESSION START       **************/
	session_start();
/***************   SESSION END       **************/       
        session_destroy();
	//unset($_SESSION['SESS_MEMBER_ID']);
	header("location: index.php");
?>
