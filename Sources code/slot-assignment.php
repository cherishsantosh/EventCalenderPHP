<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
include 'includes/function.php';

$obj1 = new functions();
/***************    FORM SUBMIT ACTION        **************/
if ($_POST['submit']) {

    $slotno = $_POST['slotno'];
    $rname = $_POST['rname'];
    $slotyear = $_POST['slotyear'];
    $subcode = $_POST['subcode'];
    $sp = $_POST['faculty'];

/***************  OPERATION DATABASE      **************/
    $result = mysql_query("SELECT * FROM  slotdefine NATURAL JOIN eachdetail WHERE slotdefine.slotno='$slotno' AND slotdefine.slotyear='$slotyear'");
    // echo "<br><br>SELECT * FROM  slotdefine NATURAL JOIN eachdetail WHERE slotdefine.slotno='$slotno' AND slotdefine.slotyear='$slotyear'";
    while ($row1 = mysql_fetch_array($result)) {

        $strr = $row1['day'] . "-" . $row1['slothour'] . "-" . $row1['starttime'] . "-" . $row1['endtime'] . "-" . $row1['slotno'] . "-" . $row1['slotyear'] . "-" . $row1['startdate'] . "-" . $row1['enddate'];
        if ($strr1 == '')
            $strr1 = $strr;
        else
            $strr1 = $strr1 . "|" . $strr;
    }
    // echo "<br><br>Complete String :- " . $strr1;
    $threearr = explode("|", $strr1);

    for ($i = 0; $i < count($threearr); $i++) {
        $three = explode("-", $threearr[$i]);
        //  echo "<br>";
        //print_r($three);
        $currentDate = strtotime($three[0], strtotime($three[6]));
        $endDate = strtotime($three[7]);
        while ($currentDate <= $endDate) {
            $mondays[] = date('d/m/Y', $currentDate) . "-" . $three[2] . "-" . $three[3] . "-" . $three[1] . "-" . $three[4];
            $currentDate = strtotime("+1 week", $currentDate);
        }
    }
    //print_r($mondays);
    // echo "Comnt===>".count($mondays);
    for ($j = 0; $j < count($mondays); $j++) {
        $finalval = explode("-", $mondays[$j]);
       // echo "<br>Date " . $finalval[0] . "<==>" . $finalval[1] . "<==>" . $finalval[2];
        $summary = "Repetative slot";
        $type = "Daily Slot";
        $obj1->reservation($finalval[1], $finalval[2], $finalval[0], $sp, $type, $subcode, $c1, $p1, $rname, $summary);
        
    }
    echo "<script type='text/javascript'>alert('Your request have been successfuly sumited !');</script>";
}
?>
<?php 
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];
if ($_SESSION['ACC_TYPE'] == '2') {
    include 'menu.php';
} ?>
  <!--   ****************   HTML FORM CODE      ****************  -->
<form action="" method="POST">
    <table width="100%">
        <caption>Blank Slot Assignment</caption>

<?php $obj1->userdetail(); ?>
        <tr>
            <td width="15%" bgcolor="#1A6A75"><div align="center"  class="style1"><strong>Slot No</strong></div></td>
            <td width="16%" bgcolor="#1A6A75"><div align="center"  class="style1"><strong>Vanue</strong></div></td>
            <td width="26%" bgcolor="#1A6A75"><div align="center"  class="style1"><strong>Academic Year</strong></div></td>
            <td width="25%" bgcolor="#1A6A75"><div align="center"  class="style1"><strong>Cource Code </strong></div></td>
            <td width="25%" bgcolor="#1A6A75"><div align="center"  class="style1"><strong>Faculty name </strong></div></td>

        </tr>
        <tr>
            <td>
                <div align="center">
                    <select name="slotno" id="slotno" >

                        <?php
                           /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM eachdetail");
                        while ($row1 = mysql_fetch_array($result)) {
                            ?>
                            <option value="<?php echo $row1['slotno']; ?>"><?php echo $row1['slotno']; ?></option>
<?php } ?>
                    </select>
                </div></td>
            <td><div align="center">
                    <select name="rname" id="rname" >

                        <?php
                           /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM resources");
                        while ($row1 = mysql_fetch_array($result)) {
                            ?>
                            <option value="<?php echo $row1['machid']; ?>"><?php echo $row1['name']; ?></option>
<?php } ?>
                    </select>

                </div></td>
            <td><div align="center">
                    <select name="slotyear" id="slotyear" >

                        <?php
                           /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM eachdetail");
                        while ($row1 = mysql_fetch_array($result)) {
                            ?>
                            <option value="<?php echo $row1['slotyear']; ?>"><?php echo $row1['slotyear']; ?></option>
<?php } ?>
                    </select></div>
            </td>
            <td><div align="center">
                    <select name="subcode" id="subcode" >

                        <?php
                           /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM SubjectCodeName");
                        while ($row1 = mysql_fetch_array($result)) {
                            ?>
                            <option value="<?php echo $row1['subcode']; ?>"><?php echo $row1['subcode'] . " (" . $row1['subname'] . ")"; ?></option>
<?php } ?>
                    </select>

                </div></td>
            <td><div align="center">
                    <select name="faculty" id="faculty" >

                        <?php
                           /***************    DATABASE  OPERATION    **************/
                        $result = mysql_query("SELECT * FROM faculty");
                        while ($row1 = mysql_fetch_array($result)) {
                            ?>
                            <option value="<?php echo $row1['firstname'] . " " . $row1['lastname']; ?>"><?php echo $row1['firstname'] . " " . $row1['lastname']; ?></option>
<?php } ?>
                    </select>

                </div></td>
        </tr>
        <tr>
            <td colspan="5"><div align="center"> <br><br><input type="submit" name="submit" value="Submit"/><br><br></div></td>
        </tr>
    </table>
</form>
<?php 

/***************    FOOTER    **************/
include 'includes/footer.php' ?>