
<?php
/***************   SESSION START       **************/
ob_start();
/***************   INCLUDE FILE        **************/
include 'includes/header.php';
$obj1 = new functions();
$errmsg_arr = array();
$errflag = false;
$opt = $_POST['sms'];

function clean($str) {
    $str = @trim($str);
    if (get_magic_quotes_gpc()) {
        $str = stripslashes($str);
    }
    return mysql_real_escape_string($str);
}

$optval = ",";

//    if ($_POST['optt'] == '') {
//        //header("location: index.php");
//        echo "blank";
//    } else {
// echo "inside else";
/***************    POST SUBMISSION        **************/
if (isset($_POST['optt'])) {
    $fruit = $_POST['optt'];
    $how_many = count($_POST['optt']);
    //echo 'Fruits chosen: ' . $how_many . '<br><br>';
    for ($i = 0; $i < $how_many; $i++) {
        $optval = $optval . "" . $fruit[$i] . ",";
    }
    //echo $optval;
}
if (isset($_POST['Submit'])) {
    $opt = $_POST['sms'];
    if ($opt == 'Insta') {
        $name = clean($_POST['insname']);
         /***************   WRITE DATABASE OPRATION        **************/
        $sql = "INSERT INTO `subscriber` (`id`, `name`, `u_type`, `r_id`, `email_id`, `m_number`,`events`) VALUES (NULL, '" . $name . "', 'inst', '', '', '', '" . $optval . "');";
        //header("location: index.php");
        // echo $sql;
    } elseif ($opt == 'iniit') {
//echo "<script type='text/javascript'>alert('Your request have been successfuly sumited');</script>";
        
        
        $name = $_POST['iitname'];
        $rid = $_POST['idnum'];
        $eid = $_POST['email1'];
        $mnum = $_POST['mob1'];
        /***************    EROOR MESSAGAE        **************/
        $val = 0;
    if ($name == '') {
        echo"<br>Name is missing";
        $val = 1;
    } 
    if ($rid == '') {
        echo"<br>Roll no/ Employee is missing";
        $val = 1;
    }  if ($eid == '') {
        echo"<br>Email ID is missing";
        $val = 1;
    } 
    if ($mnum == '') {
        echo"<br>Mobile no is missing";
        $val = 1;
    } 
        
        
        
        if($val==0){
        $rs = str_replace(",", "   ", $optval);
        /***************   WRITE DATABASE OPRATION        **************/
        //echo "=" . $name . " = " . $rid . " = " . $eid . " = " . $mnum . " = ";
        $sql = "INSERT INTO `subscriber` (`id`, `name`, `u_type`, `r_id`, `email_id`, `m_number`,`events`) VALUES (NULL, '" . $name . "', 'iit', '" . $rid . "', '" . $eid . "', '" . $mnum . "', '" . $optval . "')";
        //echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";

        $msg = "Dear " . $name . ", \n You have successfully subscribed to  the following events in the BSBE Idepartment calendar :-\n
                     $rs \n\n
            -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480
            \n\nTo unsubscribe or edit your subscription, click on:- http://www.bio.iitb.ac.in/eventcalendar/unsucsribe.php?getemail=$eid ";
        /***************    SEND MAIL        **************/
        $obj1->sendmail($eid, "Sucessfuly Suscribe", $msg);
        //echo"INSERT INTO `subscriber` (`id`, `name`, `u_type`, `r_id`, `email_id`, `m_number`,`events`) VALUES (NULL, '" . $name . "', 'iit', '" . $rid . "', '" . $eid . "', '" . $mnum . "', '" . $optval . "')";
        //header("location: index.php");
        //echo $sql;
        }
        
    } elseif ($opt == 'outiit') {
        $name = clean($_POST['name']);
        $eid = clean($_POST['email']);
        $mnum = clean($_POST['mob']);
        $rs = str_replace(",", "   ", $optval);
        $msg = "\n\n \t\t Outside of IIT \n\nDear " . $name . ", \nYou have successfully subscribed to  the following events in the BSBE Idepartment calendar :-\n
                     $rs \n\n
            -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480
            \n\nTo unsubscribe or edit your subscription, click on:- http://www.bio.iitb.ac.in/eventcalendar/unsucsribe.php?getemail=$eid ";
        //  echo $msg;
        /***************    SEND MAIL        **************/
        $obj1->sendmail($eid, "Sucessfuly Suscribe", $msg);
        // header("location: index.php");
    }
    $result = mysql_query($sql);
    //  echo $result;
    //}
    
}
ob_flush();
?>


<?php if($val==0){ ?>
<?php echo "\t\t\n\n"; ?>You Successfully subscribed for following event :- <br> <?php echo $rs; ?>
Thank you 
<?php } ?>

<?php echo "<br><br>"; ?><strong><a href="subscribe.php">Home</a></strong>

