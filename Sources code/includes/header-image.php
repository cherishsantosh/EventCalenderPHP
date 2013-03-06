<table width="100%" style="border:0;background:#FFFFFF;">
  
  <tr>
      <td colspan="4" style="color:  blue">
          <hr>
      </td>
  </tr>
  <?php 
  if(isset($_SESSION['ACC_TYPE']))
  {
      
    
    $acctype=$_SESSION['ACC_TYPE'];
    if(check_owner_permissions($_SESSION['SESS_MEMBER_ID'])==1)
     {
        $str="System Owner";
        }else if($acctype==1){
        $str="Admin";
        }else if($acctype==0) {
        $str="Normal User";
        }
  }
  ?>
  <!--<tr>
    <td colspan="4" align="left" valign="top" ><div style="width:100%;height:23px;-webkit-border-radius: 20px;-moz-border-radius: 20px;border-radius: 20px;background-color:#0075CE;font-family:Arial, Helvetica, sans-serif;font-size:12px;" align="center">
      <div align="left">
        <table width="100%" border="0" style="background: none;border:0">
          <tr> 
            <td width="25%" style="color:#FFFFFF;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php if(isset($_SESSION['FULL_NAME'])){ ?>Welcome<a href="member-profile.php?date=<?php echo $_GET['date'] ?>&machid=<?php echo $_GET['machid'] ?>" style="text-decoration:none;font-weight:bold;"><?php echo "<strong>          ".$_SESSION['FULL_NAME']."</strong>          "; ?></a><?php } ?></td>
            <td width="10%" style="color:#FFFFFF;"><?php echo "<strong>".$str."</strong>"; ?></td>
            <td width="40%">&nbsp;</td>
            <?php if(isset($_SESSION['FULL_NAME'])){ ?>
             <?php if(!isset($_GET['date']) || $_GET['date'] == '')
                        {
                            $dt = date('m/d/Y');
                            $macid = 1;
                        }
                        else
                        {
                            $dt = $_GET['date'];
                            $macid = $_GET['machid'];
                        }
                            ?>
            <td width="20%"> <b>Jump To</b>    :    <select name="jump" onchange="jumpto(this.value,'<?php echo $dt ?>',<?php echo $macid ?>)">
                        <option value="">--Select--</option>
                       
                      <option value="view_errorreport.php">View Error Report</option>
                      <option value="view_report.php">View Reports</option>
                        <option value="member-profile.php">Change Password</option>
                      <?php  if($str=='Admin' )  
                         
                     {?>
                       <option value="manage-user.php">Manage user</option>
                        <option value="manage-resource.php">Manage Resource</option>
                         <option value="mass-mail.php">Mass Mail</option>
                       <?php }
                       ?>
                     <?php  if($str=='System Owner' || $str=='Admin' )  
                         
                     {?>
                       <option value="set-permissions.php">View Permissions</option>
                       <?php }
                       ?>
                       <option value="member-index.php">View Bookings</option>
                       
                  </select> </td>
                  <?php } ?>
            <td width="10%"><div align="right" style="color:#FFFFFF;">
              <div align="left" style="color:#FFFFFF;">
                 <div align="center">
                
                    <?php if(isset($_SESSION['FULL_NAME'])){ ?><strong><a href="logout.php" style="color:#FFFFFF;text-decoration:none;">Logout </a></strong><?php } ?></div>
              </div>
            </div>
              <div align="left"></div></td>
          </tr>
        </table>
        <br />
      </div>
    </div></td>
  </tr>-->
 
</table>