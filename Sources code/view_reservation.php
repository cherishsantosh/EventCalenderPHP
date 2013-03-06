<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$memberid=$_SESSION['SESS_MEMBER_ID'];
 /***************  OPERATION DATABASE      **************/
$q = get_reservation_id($_GET['resid']);
$row = mysql_fetch_assoc($q);


?>
 <!--   ****************   HTML FORM CODE      ****************  -->
<table align="center" cellspacing="5" cellpadding="5" width="100%">
    <caption> View Reservation</caption>
  
    <tr>
        <th >
            Vanue Name  :
        </th>
        <td>
            <?php
            
                echo get_device_name($row['machid']);
            
            ?>
        </td>
    </tr>
     <tr>
        <th >
            Spekar Name  :
        </th>
        <td>
            <?php
            
                echo $row['speakername'];
            
            ?>
        </td>
    </tr>
     <tr>
        <th >
            Event Type  :
        </th>
        <td>
            <?php
            
                echo $row['type'];
            
            ?>
        </td>
    </tr>
    <tr>
        <th >
            Event Title  :
        </th>
        <td>
            <?php
            
                echo $row['title'];
            
            ?>
        </td>
    </tr>
    <tr>
        <th >
            Capacity Of Vanue  :
        </th>
        <td>
            <?php
            
                echo $row['capacity'];
            
            ?>
        </td>
    </tr>
    <tr>
        <th >
    
        Date Of Reservation :
        </th>
  
      
        <td align="left">
            
            <?php echo date('d/m/Y',$row['enddate']) ?>
            
        </td>
    </tr>
    <tr>
        <th colspan="2" align="center">
           <hr style="color: activecaption">
            Time Of Reservation
        </th>
    </tr>
    
    <tr>
        <td align="center">
            <b>Start Time  :   </b>
            <?php echo $row['starttime'] ?>
        </td>
        
        <td align="center">
            <b>End Time  :   </b>
            <?php echo $row['endtime'] ?>
        </td>
    </tr>
    <tr>
        <td colspan="2">
            <hr style="color: activecaption">
        </td>
    </tr>
    <tr>
        <th colspan="2" align="left">
             
            Summary :
        </th>
    </tr>
    <tr>
        <td colspan="2" align="left">
           <?php echo $row['summary'] ?>
           
        </td>
    </tr>
    
</table>
    
  