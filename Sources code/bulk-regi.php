<?php
/***************    SESSION START        **************/
ob_start();
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
require_once 'Excel/reader.php';

$data = new Spreadsheet_Excel_Reader();

$obj1 = new functions();
$_SESSION['ACC_TYPE'];
/***************    INCLUDE MENU IF {Admin login}        **************/
if ($_SESSION['ACC_TYPE'] == '2') {
    include 'menu.php';
}
?>
<?php
/***************    FORM SUBMIT ACTION        **************/
if ($_POST['Submit']) {
    $course = $_POST['course'];
    $target_path = "uploads/";
    if ((($_FILES["uploadedfile"]["type"] == "xls")
            || ($_FILES["uploadedfile"]["type"] == "xls")
            || ($_FILES["uploadedfile"]["type"] == "xls"))
            && ($_FILES["uploadedfile"]["size"] < 200000)) {
        if ($_FILES["uploadedfile"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "";
        }
    }
    $target_path = $target_path . basename($_FILES['uploadedfile'] . "demo.xls");
/***************    READ EXL FILE        **************/
    if (move_uploaded_file($_FILES['uploadedfile']['tmp_name'], $target_path)) {
       // echo "The file " . basename($_FILES['uploadedfile']['name']) ." has been uploaded";
        echo "<script type='text/javascript'>alert('Your file have been successfuly uploaded !');</script>";
    } else {
        echo "There was an error uploading the file, please try again!";
    }
    /***************    UPLOAD FILE        **************/
    $data->read('uploads/Arraydemo.xls');
}


error_reporting(E_ALL ^ E_NOTICE);
?>
 <!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0">
    <caption>Bulk Registration </caption>
    <?php $obj1->userdetail(); ?>
    <tr><td>
 

    
<form enctype="multipart/form-data" action="" method="POST">
    <input type="hidden" name="MAX_FILE_SIZE" value="100000" />
    Choose a file to upload: <input name="uploadedfile" type="file" /><br />
    Course Type :<select name="course">
        <option selected="selected" value="NULL">NULL</option>
        <option value="Btech">Btech</option>
        <option value="Mtech">Mtech</option>
        <option value="Msc">Msc</option>
        <option value="Phd">Phd</option>
    </select><br />
    <input type="submit" name="Submit" value="Upload File" />
</form>
<?php
echo "<table border='1' width='100%'>";
echo "<tr><td align='center' width='30%'>RollNo</td><td align='center'>Email ID</td><td align='center' >First Name</td><td align='center' >Last Name</td><td align='center' >Position</td><td align='center' >Department</td><td align='center' >Course</td></tr>";
$cnt = $data->sheets[0]['numRows'];
for ($j = 1; $j <= ($cnt - 1); $j++) {
    echo "<tr>";
    echo "<td align='center'>";
    echo $data->sheets[0]['cells'][$j + 1][2];
    $rollno=$data->sheets[0]['cells'][$j + 1][2];
    echo "</td>";
    echo "<td>";
    $emailid=$data->sheets[0]['cells'][$j + 1][2] . "@iitb.ac.in";
    echo $data->sheets[0]['cells'][$j + 1][2] . "@iitb.ac.in";
    echo "</td>";
    echo "<td>";
    $randomno = mt_rand(0, 999999999);
    $msgbody="Dear  , You are sucessfuly registered.\n\n Your Username :-".$emailid. "\nPassword :-".$randomno."\n\nThank you\n\n\n
         -----
            Regards,
            Office of the Head
            Department of Biosciences & Bioengineering
            IIT Bombay, Powai, Mumbai- 400076.
            Tele:- 25767771
            Fax: - 25723480";
    $fname = explode(" ", $data->sheets[0]['cells'][$j + 1][3]);
    $obj1->secondsendmail($emailid, $fname[0]." ".$fname[1], $msgbody);
    echo $fname[0];
    echo "</td>";
    echo "<td>";
    echo $fname[1];
    echo "</td>";
    echo "<td>";
    echo $data->sheets[0]['cells'][$j + 1][5];
    $pos=$data->sheets[0]['cells'][$j + 1][5];
    echo "</td>";
    echo "<td>";
    echo "BSBE";
    echo "</td>";
    echo "<td>";
    echo $course;
    echo "</td>";
    echo "</th>";
    $date = date('m/d/Y');
    $time = date('H:i:s');
    /***************    WIRGHT OPERATATION        **************/
    //echo "<br><br>INSERT INTO `login` (`memberid`, `email`, `password`, `fname`, `lname`, `position`, `is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`, `date`, `time`) VALUES (NULL, '$emailid', 'NULL', '$fname[0]', '$fname[1]', '$pos', '1', '$rollno', '$course', 'BSBE', 'NULL', 'NULL', NULL, 'NULL', '$date', '$time');";
    mysql_query("INSERT INTO `login` (`memberid`, `email`, `password`, `fname`, `lname`, `position`, `is_admin`, `rollno`, `course`, `department`, `supervisor`, `cosupervisor`, `project`, `mobile`, `date`, `time`) VALUES (NULL, '$emailid', '" . md5($randomno) . "', '$fname[0]', '$fname[1]', '$pos', '1', '$rollno', '$course', 'BSBE', 'NULL', 'NULL', NULL, 'NULL', '$date', '$time');");
}

echo "</table>";


?>
</td></tr></table><br>
<?php 
/***************    FOOTER    **************/
include 'includes/footer.php' ?>