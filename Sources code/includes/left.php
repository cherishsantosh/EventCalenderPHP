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
<table width="100%" border="0" style="background: none;" valign="top" cellspacing="5" cellpadding="2">
                <tr> 
                    <td colspan="2" width="25%" align="right" style="color:#FFFFFF;"><?php if(isset($_SESSION['FULL_NAME'])){ ?><a href="edit-member-profile.php?date=<?php echo $_GET['date'] ?>&machid=<?php echo $_GET['machid'] ?>" style="text-decoration:none;font-weight:bold;"><?php echo "Welcome ".$_SESSION['FULL_NAME']." , "; ?></a><?php } ?></td>
                </tr>
                <tr>
                    <td align="right"><?php if(isset($_SESSION['FULL_NAME'])){ ?><strong><a href="logout.php" style="color:#FFFFFF;text-decoration:none;">Logout </a></strong><?php } ?></td>
                </tr>
                <?php
                        if($str == "System Owner" || $str == "Admin")
                        {
                   ?>
                <tr>
                   
                  <td colspan="2" align="right" width="10%" style="color:#FFFFFF;"><?php echo "<strong>You Are a ".$str."</strong>"; ?></td>
                  </tr>
                  <?php
                        }
                  ?>
                  <tr>
                      <td>
                          <hr>
                      </td>
                  </tr>
                  
                 <tr>
                     <td align="right" ><u>System Owner</u></td>
                 </tr>
                 
                        <?php
                        if(isset($_GET['machid']))
                        {
                        if($_GET['machid'] != 'all')
                        {
                        $q = get_system_owners($_GET['machid']);
                       
                        while($row = mysql_fetch_row($q))
                        {
                           
                            echo "<tr>
                     <td align=right><b>".$row[0]." ".$row[1]."</b><br></td></tr>";
                        }
                        }
                        }
                        ?>
                      
                
           
                 <tr>
                     <td>
                         <hr>
                     </td>
                 </tr>
                                 
                  
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
                    
                      <tr><td colspan="2" align="right"><a href="mybookings-template.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">My Bookings</a></td></tr> 
                      <tr><td colspan="2" align="right"><a href="view_errorreport.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">View Error Report</a></td></tr>
                      <tr><td colspan="2" align="right"><a href="member-profile.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">Change Password</a></td></tr>
                      <?php  if($str=='Admin' )  
                         
                     {?>
                       <!--<option value="manage-user.php">Manage user</option>-->
                        <tr><td colspan="2" align="right"><a href="manage-resource.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">Manage Resource</a></td></tr>
                        <tr><td colspan="2" align="right"><a href="mass-mail.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">Mass Mail</a></td></tr>
                        <tr><td colspan="2" align="right"><a href="view_report.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">View Reports</a></td></tr>
                        <tr><td colspan="2" align="right"><a href="add_announcement.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">Add Announcements</a></td></tr>
                        <tr><td colspan="2" align="right"><a href="approve-user.php">Approve user</a></td></tr>
                        <tr><td colspan="2" align="right"><a href="manage-user.php">Manage user</a></td></tr>
                        <tr><td colspan="2" align="right"><a href="system-onwer-and-user-tracking.php">Track User</a></td></tr>
                       <?php }
                       ?>
                     <?php  if($str=='System Owner' || $str=='Admin' )  
                         
                     {?>
                       <tr><td colspan="2" align="right"><a href="set-permissions.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">Edit Permissions</a></td></tr>
                       <?php }
                       ?>
                       <tr><td colspan="2" align="right"><a href="member-index.php?date=<?php echo $dt ?>&machid=<?php echo $macid ?>">View All Bookings</a></td></tr>
                       
                  </td>
                  </tr>
                  <?php } ?>
           
</table>