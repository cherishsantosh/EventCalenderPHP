<?php
/***************   SESSION START       **************/
ob_start();
/***************   INCLUDE FILE        **************/
include 'includes/header.php';
$obj1 = new functions();
 /***************    POST SUBMISSION        **************/
if (isset($_POST["submit"])) {
    $eventname = $_POST['result'];
}
//echo "Event name :-----".$eventname;
?>
<head>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/expand.js"></script>
    <script type="text/javascript">
        <!--//--><![CDATA[//><!--
        $(function() {
            $("h2.expand").toggler({method: "toggle"});
            $("#content").expandAll({trigger: "h2.expand", ref: "div.demo", localLinks: "p.top a"});
        });
    </script>
    <script type="text/javascript">
        function showContent(vThis)
        {
            vParent = vThis.parentNode;
            vSibling = vParent.nextSibling;
            while (vSibling.nodeType==3) { // Fix for Mozilla/FireFox Empty Space becomes a TextNode or Something
                vSibling = vSibling.nextSibling;
            };
            if(vSibling.style.display == "none")
            {
                vThis.src="/img/collapse.gif";
                vThis.alt = "Hide Div";
                vSibling.style.display = "block";
            } else {
                vSibling.style.display = "none";
                vThis.src="/img/expand.gif";
                vThis.alt = "Show Div";
            }
            return;
        }
        
    </script>

</head>
 <!--   ****************   HTML FORM CODE      ****************  -->
<div style="width:100%;height:25px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#88C2E3;
     font-family:'Times New Roman', 	Times, serif;font-size:14px;">
    <div align="center"> <strong> <a href="login.php">Login for posting</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <a href="subscribe.php">Subscribe</a></strong><strong> | &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="Help/index.html">Help</a> </strong> </div>
</div><br><br>
<div id="wrapper">
    <div id="content">
        <table align="center"  width="100%" style="background-color: #FFF;">
            <tr>
                <td align="center"><strong>Select Event Name</strong></td>
                <td align="center">
                    <FORM NAME="ColorSelector" method="POST">
                        <table  width="100%" style="background-color: #FFF;">
                            <tr>
                                <?php
                                $cnt = 0;
                                $result = mysql_query("SELECT * FROM event");
                                echo "";
                                while ($row1 = mysql_fetch_array($result)) {
                                    ?>
                                    <td> <INPUT TYPE=CHECKBOX NAME="color" VALUE="<?php echo $row1['eventname']; ?>" ONCLICK="outputSelected(this.form.color);"><?php echo $row1['eventname']; ?></td>
                                    <?php
                                    if ($cnt == '4') {
                                        $cnt = 0;
                                    }
                                    $cnt++;
                                }
                                ?>
                            </tr>
                        </table>
                        <input type="hidden" name="result" id="result" size="80">
                        <input type="submit" name="submit" value="submit" />
                    </FORM>
                </td>
            </tr>
        </table>
        <br><br>
        <?php
        if (isset($_POST['Next'])){
            $current = (int) $_POST['text'];
        $eventname=$_POST['result'];
        //  echo ">>".$eventname;
        }
        else{
            $current = time();
            $eventname=$_POST['result'];
          //  echo "<<".$eventname;
        }
        $prv1 = $current;
        if (isset($_POST['prev'])) {
            $current = (int) $_POST['prv'];
        }

//Echo "==>".date('m/d/Y', $current);
        for ($i = 0; $i < 7; $i++) {
            $demo = date('m/d/Y', $current);
            $current = strtotime("+1 day", $current);
  //          echo "====>>".$demo;
            ?>
            <table width="100%" border="0" cellpadding="6">

                <tr>
                    <td bgcolor="#666666"><div align="center" style="color:#FFFFFF;"><strong><?php echo $demo; ?></strong></div></td>
                    
                </tr>
            </table>
            <?php
            $flag = "stop";
            $rr = strtotime($demo);
            /***************    DATABASE OPERATATION        **************/
            $noum = mysql_num_rows(mysql_query("SELECT * FROM `reservations` WHERE `startdate` = '$rr'"));
            // echo "SELECT * FROM `reservations` WHERE `startdate` = '$rr'";
            $celldata = mysql_fetch_row(mysql_query("SELECT * FROM `reservations` WHERE `startdate` = '$rr'"));

            // for ($pp = 0; $pp < $noum; $pp++) {
            if ($eventname == '') {
                //$qry1 = "SELECT * FROM `reservations` WHERE `type` IN ($eventname) AND `startdate` = '$rr'";
                $qry1 = "SELECT * FROM `reservations` WHERE `startdate` = '$rr'";
               // echo "SELECT * FROM `reservations` WHERE `type` IN ($eventname) AND `startdate` = '$rr'";
            } else {
                $qry1 = "SELECT * FROM `reservations` WHERE `type` IN ($eventname) AND `startdate` = '$rr' ";
                //echo "SELECT * FROM `reservations` WHERE `type` IN ($eventname) AND `startdate` = '$rr'" ;
            }
            // echo "<br>=>".$celldata[8][$pp]." No row:-".$noum;
            //echo $qry1;
            $result = mysql_query($qry1);
            //$celldata11 = mysql_fetch_row($result);
            //  print_r($celldata11);
            while ($row = mysql_fetch_array($result)) {
                //echo "<br>=>".$row['title']." No row:-".$noum;
                $count = 0;
                //if ($row['type'] == "Repetative slot") {
                // } else {

                $count++;
                // echo $count;
                $flag = "start";
                ?>
                <div class="demo">
                    <h2 class="expand" style="font-family: Verdana,Arial,Helvetica,sans-serif;margin: 0px;font-size: 14px;">
                        <?php
                        echo $row['type'] . "  / [" . $row['starttime'] . " - " . $row['endtime'] . "] / " . $row['title'];
                        ?></h2>
                    <div class="collapse">

                        <table width="100%" border="0" bordercolor="#CCCCCC" style="border-collapse:collapse;font-family: Verdana,Arial,Helvetica,sans-serif;margin: 0px;font-size: 14px;" cellpadding="6">
                            <tr>
                            
                                <td width="32%" bgcolor="#DDDDDD"><em><strong>StartTime and EndTime:- </strong></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td width="68%" bgcolor="#DDDDDD"><?php echo $row['starttime'] . "--" . $row['endtime']; ?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF"><em><strong>Spekar Name :- </strong></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td bgcolor="#FFFFFF"><?php echo $row['speakername']; ?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#DDDDDD"><em><strong>Title :- </strong></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td bgcolor="#DDDDDD"><?php echo $row['title']; ?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF"><em><strong>Vanue :- </strong></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td bgcolor="#FFFFFF"><?php $rp = idtovanue($row['machid']);
                echo $rp; ?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#DDDDDD"><em><strong>Event Type :- </strong></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td bgcolor="#DDDDDD"><?php echo $row['type']; ?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#FFFFFF"><em><strong>Capacity of Vanue :- </strong></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td bgcolor="#FFFFFF"><?php echo $row['capacity']; ?></td>
                            </tr>
                            <tr>
                                <td bgcolor="#DDDDDD"><em><strong>Abstract  :- </strong></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                                <td bgcolor="#DDDDDD"><?php echo $row['summary']; ?></td>
                            </tr>
                        </table>

                    </div>

                </div>

                <?php
                //}
                //}
            }


            if ($flag == "stop") {
                ?>
                <div class="demo">
                    <div style="color:#FF6600;">
                        <div align="center"><strong> No event scheduled today.</strong></div>
                    </div>
                </div>
                <?php
            }
            ?>
            <?php
        }
        $prv1 = strtotime("-14 day", $current);
        ?><form method="post" action="<?php $_SERVER['PHP_SELF'] ?>">

            <table align="center" cellspacing="8" cellpadding="8" width="100%" style="overflow: auto;">
                <tr>
                    <td align="left"><input type="hidden" name="prv" value="<?php echo $prv1 ?>"> <input type="hidden" name="result" id="result" value="<?php echo $eventname; ?>"><input type="submit" value="Previous" name="prev"></td>
                    <td align="right"><input type="hidden" name="text" value="<?php echo $current ?>"> <input type="hidden" name="result" id="result" value="<?php echo $eventname; ?>"><input type="submit" value="Next" name="Next"></td>
                </tr>
            </table>
        </form><?php ?>
    </div>
</div>
<?php
/***************    FOOTER    **************/
$obj1->footer();
?>