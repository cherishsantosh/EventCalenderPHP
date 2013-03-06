<?php  
/***************   SESSION START       **************/
ob_start();
/***************   INCLUDE FILE       **************/
include 'includes/header.php';
//include 'includes/header-image.php';
if(!isset($_SESSION['FULL_NAME']))
{
   ?>
<div style="color:red" align="center"> <h3>Please Kindly Login To Continue!!</h3></div><br>
<div align="center" ><a href="index.php">Login  >></a></div>

    <?php
}
else
{
    /***************   MEMBER INDEX       **************/
    if($_GET['date']==null || !isset($_GET['date']) || $_GET['machid'] == 'all'){
       
        $date = date('m/d/Y');
        
        header("location:member-index.php?date=$date&machid=1");
    }
?>

<table width="100%">
    <tr>
          <?php $_SESSION['ACC_TYPE'];if($_SESSION['ACC_TYPE']=='2'){include 'menu.php'; } ?>
    </tr>
</table>
 <?php
   include "template.php";
}
ob_flush();
   ?>  