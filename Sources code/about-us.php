<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';

/***************    CREATE OBJECT OF CLASS        **************/
$fn =new functions();
?>
<?php
/***************    INCLUDE MENU IF {Admin login}        **************/
$_SESSION['ACC_TYPE'];
if ($_SESSION['ACC_TYPE'] == '2') {
    include 'menu.php';
} ?>
 <table align="center" cellspacing="8" cellpadding="8" width="100%" style="overflow: auto;">
            <caption>about Us</caption>
            <tr>
                
            </tr>
 </table>
<?php /***************    TYPE OF USER AND LOGOUT        **************/?>
<?php $fn->userdetail(); ?>
<?php /***************    FOOTER      **************/  ?>
<?php $fn->footer();?>