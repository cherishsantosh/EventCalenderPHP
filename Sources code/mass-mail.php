<?php
/***************   INCLUDE FILE       **************/
include 'includes/header.php';
//include 'includes/header-image.php';
//$typeid = $_GET['typeid'];
?>
<!--   ****************   HTML FORM CODE      ****************  -->
<table width="100%" border="0" style="border:0;background-color: white" >
    <tr>
        <td width="15%" style="background-color:#f6f6f6;">
           <?php include 'includes/logo.php'; ?>
        </td>
        <td width="80%" style="background-color: lightsteelblue" align="center"></td>
    </tr>
    <td>
            <hr>
        </td>
        <td>
            <hr>
        </td>
    <tr>
        <td width="15%" style="background-color: lightsteelblue" valign="top">
            <?php include 'includes/left.php' ?>
        </td>
        <td valign="top">


<table width="50%" border="0" align="center">
    <caption>Mass mail</caption>
    <tr>
        <td>


        </td>
    </tr>
    <tr>
        <td colspan="2">
            <div align="center">
                <p>

                    <a href="user-mail-list.php?typeid=1" target="iframe1">Admin</a> |
                    <a href="user-mail-list.php?typeid=2" target="iframe1">System Onwer</a> |
                    <a href="user-mail-list.php?typeid=0" target="iframe1">Normal user</a> |


                <p>
                    <iframe align="center" name="iframe1" width="300" height="300" src="" frameborder="yes" scrolling="yes">
                    </iframe>
                <p>

                    </font>
            </div></td>

    <tr>
        <td align="center">Subject</td>
        <td align="center"><input type="text" name="sub" ></td>

    </tr>
    <tr>
        <td align="center">Body</td>
        <td align="center"><textarea  rows="10" cols="60" ></textarea></td>
    </tr>
    <tr>
        <td colspan="2" align="center"><input type="submit" name="submit" value="Submit" /></td>
    </tr>
</table>
        </td>
    </tr>
</table>
<?php 
/***************    FOOTER    **************/
include 'includes/footer.php' ?>
