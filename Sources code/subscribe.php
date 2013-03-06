<?php
/***************    INCLUDE FILE        **************/
include 'includes/header.php';
?>

<script type="text/javascript">
    function show(tb1,tb2,tb3){
        document.getElementById(tb1).style.display = '';
        document.getElementById(tb2).style.display = 'none';
        document.getElementById(tb3).style.display = 'none';
		
    }
    function validatemobile1() {
        var mobile = document.loginForm.mob1.value;
        alert(mobile);
        var pattern = /^\d{10}$/;
        if (pattern.test(mobile)) {
            // alert("Your mobile number : "+mobile);
            return true;
        } 
        document.loginForm.mob1.value= "";
        alert("It is not valid mobile number.input 10 digits number!");
        return false;

    }
    function demo (){
        if (loginForm.email1.value == "")
        {
            alert("email is missing");
            window.location = "index.php"
        }
        
    }
	
    function validateemail1(form_id,email1) {
        //alert('Input Email Address :-'+email.val);
        var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
        var address = document.forms[form_id].elements[email1].value;
        if(reg.test(address) == false) {
            document.loginForm.email1.value= "";
            alert('Invalid Email Address');
            return false;
        }else{
            alert("Your Email-ID is :-"+address);
        }
    }
</script>
<style type="text/css">
    <!--
    .style1 {font-family: Arial, Helvetica, sans-serif}
    .style2 {font-family: Arial, Helvetica, sans-serif; font-weight: bold; }
    .style4 {font-family: Arial, Helvetica, sans-serif; font-size: 16; }
    .optt {font-family: Arial, Helvetica, sans-serif; font-size: 12px;font-weight:700; }
    -->
</style>
</head>

<body>
     <!--   ****************   HTML FORM CODE      ****************  -->
    <form id="loginForm" name="loginForm" action="instauser.php" method="POST" ">
        <div align="left"><h4><span><a href="index.php">Home</a></span></h4></div>
        <div align="center"><h4><span>Select proper user type</span></h4></div>
        <table width="100%" border="0" align="center" cellpadding="6">
            <tr>
                <td width="33%" >
                    <label>
                        <input type="radio" name="sms" id="sms1" value="Insta" checked="checked"  onclick="show('insta','iit','niit')" />
                        <h3>InstaMsg User</h3></label>
                </td>
                <td  >
                    <label>
                        <input type="radio" name="sms" id="sms2" value="iniit" onclick="show('iit','niit','insta')"/>
                        <h3>IIT user</h3></label>
                </td>
                <td > 
                    <label>
                        <input type="radio" name="sms" id="sms3" value="outiit"  onclick="show('niit','insta','iit')"/>
                        <h3>Non IIT user</h3></label>
                </td>
            </tr>
            <tr>
                <td colspan="3" align="center">

                    <table width="100%" border="0" cellpadding="5">
                        <tr style="background: #DAEFF3;">
                            <td valign="top" class="optt"> 
                                <?php
                                /***************    DATABASE  OPERATION    **************/
                                $result = mysql_query("SELECT eventname,srno FROM `event`");
                                $list = array();
                                $code = array();

                                while ($row = mysql_fetch_array($result, MYSQL_BOTH)) {
                                    // printf ("ID: %s  Name: %s", $row[0], $row[1]);
                                    array_push($list, $row[0]);
                                    array_push($code, $row[1]);
                                }
                                $i = 0;
                                foreach ($list as $value) {
                                    echo "<INPUT  TYPE='CHECKBOX' name='optt[]' id='optt[]' value='" . $value . "' >$value</option><br /> ";
                                    $code[$i++];
                                    if ($i % 5 == 0)
                                        echo"</td>    <td class='optt' valign='top'>";
                                }
                                ?>    </td></tr>
                    </table>





                    <span class="style4"><BR>
                    </span>
                    <div class="style4" id="insta" style="display:">

                        <table width="100%" border="0" cellpadding="5">
                            <tr style="color: #FF0000;">
                                <td  colspan="2"><strong><h3>For InstaMsg User </h3></strong></td>
                            </tr>
                            <tr>
                                <td  colspan="2">    </td>
                            </tr>
                            <tr style="background: #DAEFF3;">
                                <td width="50%" align="right">InstaMsg User name</td>
                                <td width="50%" ><input type="text" name="insname"/></td>
                            </tr>
                            <tr>
                                <td height="40">&nbsp;</td>
                                <td><input type="submit" name="Submit" value="Submit" /></td>
                            </tr>
                        </table>

                        <!--  </form> -->
                    </div>          
                    <div class="style4" id="iit" style="display:none">
                        <!--    <form action="iituser.php" method="post">-->
                        <table width="100%" border="0"  cellpadding="5">
                            <tr>
                                <td colspan="2" style="color: #FF0000;"><h3>For  All IIT  Users</h3></td>
                            </tr>
                            <tr style="background: #DAEFF3;">
                                <td width="50%" align="right">Full Name(Last,First,Middle)</td>
                                <td width="50%" ><input type="text" name="iitname"/></td>
                            </tr>
                            <tr>
                                <td align="right">Roll No/Employee Code</td>
                                <td><input type="text" name="idnum"/></td>
                            </tr>
                            <tr style="background: #DAEFF3;">
                                <td align="right">E-mail Id</td>
                                <td><input type="text" name="email1" id="email1" onBlur="validateemail1('loginForm','email1');"/></td>
                            </tr>
                            <tr>
                                <td align="right">Mobile No.</td>
                                <td><input type="text" name="mob1" id="mob1" onblur="validatemobile1();" maxLength=10/></td>
                            </tr>
                            <tr style="background: #DAEFF3;">

                                <td colspan="2" align="center"><input type="submit" name="Submit" value="Submit"  /></td>
                            </tr>
                        </table>

                        <!--      </form>-->
                    </div>          
                    <div class="style4" id="niit" style="display:none">
                        <!--    <form action="niit.php" method="post">-->
                        <table width="100%" border="0" cellpadding="5">
                            <tr>
                                <td colspan="2" style="color: #FF0000;"><h3>For Non IIT Users</h3></td>
                            </tr>
                            <tr style="background: #DAEFF3;">
                                <td width="50%" align="right">Full name(Last,First,Middle)</td>
                                <td width="50%" ><input type="text" name="name"/></td>
                            </tr>
                            <tr>
                                <td align="right">email Id</td>
                                <td><input type="text" name="email" onBlur="javascript:return validateemail('loginForm','email');"/></td>
                            </tr>
                            <tr style="background: #DAEFF3;">
                                <td align="right">Mobile No.</td>
                                <td><input type="text" name="mob" onblur="validatemobile();"  maxLength=10/></td>
                            </tr>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit"  name="Submit" value="Submit" /></td>
                            </tr>
                        </table>
                    </div></td>
            </tr>
        </table>
    </form>   
</body>
</html>
