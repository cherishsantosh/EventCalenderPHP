<?php
/***************    INCLUDE FILE        **************/
include 'includes/connect.php';
?>
<?php
   /***************    DATABASE  OPERATION    **************/
    $val = $_POST['value'];
    if($val == 'uname')
    {
         $sql = "select distinct(login.fname),login.lname from login,reservations,error_reporting where error_reporting.resid = reservations.resid and reservations.memberid = login.memberid  ";
         $q = mysql_query($sql);
    }
   else if($val == 'email')
    {
         $sql = "select distinct(login.email) from login,reservations,error_reporting where error_reporting.resid = reservations.resid and reservations.memberid = login.memberid  ";
            $q = mysql_query($sql);
    }
    else if($val == 'machname')
    {
         $sql = "select distinct(resources.name) from resources,error_reporting where error_reporting.machid = resources.machid ";
         $q = mysql_query($sql);
         
    }
   ?>
<!--   ****************   HTML FORM CODE      ****************  -->
<?php   
    $flag = 0;
    echo '<option value="">--Select--</option>';
    if($val == 'date')
        {
            echo '<option value=asc>Ascending</option>';
            echo '<option value=dsc>Descending</option>';
        }
    while($row=mysql_fetch_row($q))
    {
        
        
        
            if($val == 'uname')
            {
                $v = $row[0]." ".$row[1];
            }
            else
            {
                $v = $row[0];
            }
            echo '<option value="'.rawurlencode($v).'">'.$v.'</option>';
        
       
    }
?>

