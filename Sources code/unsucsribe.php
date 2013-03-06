<?php
/***************   SESSION START    **************/
session_start();
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
$eemail = $_GET['getemail'];
$obj1 = new functions();
if (isset($_POST["submit"])) {
    $val = $_POST['optt'];
    $utype = $_POST['utype'];
    $rid = $_POST['rid'];
  //  print_r($val);
    //echo $utype;

    $fruit = $_POST['optt'];
    $how_many = count($_POST['optt']);
    // echo 'Fruits chosen: ' . $how_many . '<br><br>';
    for ($i = 0; $i < $how_many; $i++) {
        $optval = $optval . "" . $fruit[$i] . ",";
    }
   // echo $optval;
    $rs = str_replace(",", " ", $fruit);
    //print_r($rs);
    for ($ii = 0; $ii < count($rs); $ii++) {
        if($re=='')
        {
            $re=$rs[$ii];
        }else{
            $re=$re." ".$rs[$ii];
        }
    }
    $msg = "Dear " . $name . ", \n You have successfully subscribed to  the following events in the BSBE Idepartment calendar :-\n
                     $re \n\n
            -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480
            \n\nTo unsubscribe or edit your subscription, click on:- http://localhost/NewMod/unsucsribe.php?getemail=$eid ";
    /***************  SEND MAIL       **************/
    $obj1->sendmail($eemail, "Update : Sucessfuly Suscribe", $msg);
    //echo "<br>==>".$eemail;
//    echo "<br>==>".$msg;
    /*************** WRITE INTO DATABASE      **************/
    mysql_query("UPDATE `subscriber` SET  `events` =  '$optval' WHERE  `email_id` ='$eemail'");
}
?>
  <!--   ****************   HTML FORM CODE      ****************  -->
<form id="loginForm" name="loginForm" action="" method="POST">
    <table width="100%" border="0" cellpadding="5">
        <p align="center"><caption>Unsuscribe Form</caption></p><br>
        <tr style="background: #DAEFF3;">

            <td valign="top" class="optt"> 
                <?php
                /***************  OPERATION DATABASE      **************/
                // echo "SELECT events FROM `subscriber` WHERE `email_id`='cherishsantosh@gmail.com'";
                $rs = mysql_query("SELECT events,u_type,r_id FROM `subscriber` WHERE `email_id`='$eemail'");
                $row = mysql_fetch_row($rs);
                $events = $row[0];
                $evearr = explode(",", $events);
                echo "<input type='hidden' name='utype' value='" . $row[1] . "'>";
                echo "<input type='hidden' name='rid' value='" . $row[2] . "'>";
                $result = mysql_query("SELECT eventname,srno FROM `event`");
                while ($row = mysql_fetch_array($result)) {
                    if (in_array($row[0], $evearr)) {
                        if ($i % 5 == 0)
                            echo"</td>    <td class='optt' valign='top'>";
                        echo "<INPUT checked='yes' TYPE='CHECKBOX' name='optt[]' value='" . $row[0] . "' >" . $row[0] . "</option><br /> ";
                    }else {
                        echo "<INPUT  TYPE='CHECKBOX' name='optt[]' value='" . $row[0] . "' >" . $row[0] . "</option><br /> ";
                    }
                }
                ?>    </td></tr>
        <tr>
            <td colspan="2"><center><input type="submit" name="submit" value="submit" /></center></td>
        </tr>
    </table>
</form>   
<?php
/***************    FOOTER    **************/
$obj1->footer(); ?>