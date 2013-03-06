<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
?> <!--   ****************   HTML FORM CODE      ****************  -->
    <form>
        <div style="font-size: 12px;font-family: Verdana,Arial,Helvetica,sans-serif;"><input type="checkbox" name="sAll" onclick="selectAll(this)" /> (Select all)</div>
        <?php
        /***************  OPERATION DATABASE      **************/
        $query = "SELECT * FROM login";
        $result = mysql_query($query);
        while ($row = mysql_fetch_array($result)) {
            ?>
            <div style="font-size: 12px;font-family: Verdana,Arial,Helvetica,sans-serif;"><input type="checkbox" name="normaluser[]" /><?php echo $row['fname'] . " " . $row['lname']; ?></div>
        <?php } ?>
    </form>
