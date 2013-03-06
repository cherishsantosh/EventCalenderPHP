<?php

function booking($date, $machid) 
 {
    $reservation_color = 'skyblue';
    $blackout_color = 'brown';
    $activated = 'darkgreen';
    $myslot = 'blue';
    $past_reservation = 'rosybrown';
    $other_past_reservation = 'thistle';
    $mybook_all = 'orange';
    $q = get_reservations_my_bookings($machid, $date, date('m/d/y', strtotime('+6 days', strtotime($date))));
    $reservation = array();
    while ($row = mysql_fetch_assoc($q)) {
        $formated_date = date('d/m/Y', $row['startdate']);
        $temp = array($formated_date, $row['starttime'], $row['endtime'], 0, $row['fname'] . " " . $row['lname'], 0, $row['machid'], $row['resid'], $row['activation_status'], $row['isblackout'], $row['memberid']);
        array_push($reservation, $temp);
        $memberid=$row[9];
    }
    
    $date_array = array();
    $first_day_of_week = $date;
    $interval_time = get_interval_time($machid);
    $interval_time_temp = 0;
    $time_count = 0;
    ?>
    <table align="center" width="100%"  border="1" >
        <thead>
            <tr>
                <th align="center">Time</th>
                <?php
                $t = 0;
                for ($i = 0; $i < 7; $i++) {
                    $curdate = date('d/m/Y',  strtotime($_GET['date']));
                   
                    $date_cal = date('d/m/Y', strtotime('+' . $i . ' day', strtotime($first_day_of_week)));
                    if($curdate == $date_cal)
                    {
                         echo "<th align=center style=background-color:#C0C0C0>" . $date_cal . "<br>";
                        echo date('l', strtotime('+' . $i . ' day', strtotime($first_day_of_week)));
                        echo "</th>";
                    }
                    else
                    {
                        echo "<th align=center>" . $date_cal . "<br>";
                        echo date('l', strtotime('+' . $i . ' day', strtotime($first_day_of_week)));
                        echo "</th>";
                    }
                    
                    $date_array[$i] = $date_cal;
                }
                ?>
            </tr>
        </thead>
        <?php

        $count = (24 * 60) / $interval_time;
        for ($i = 0; $i < $count; $i++) {
            $flag = 0;
            echo "<tr>";
            echo "<th align=center width=5% style=font-weight: bold>";
            $time_value = date('H:i', mktime(0, $time_count, 0) + ($interval_time_temp * 60));
            echo $time_value;
            echo "</th>";
            $time_count = $time_count + $interval_time_temp;
            $interval_time_temp = $interval_time;
            for ($j = 0; $j < 7; $j++) {
                $temp_flag = 0;
                for ($k = 0; $k < count($reservation); $k++) {
                    $end_time = strtotime($reservation[$k][2]);
                    if ($reservation[$k][2] == '00:00') {
                        $end_time = strtotime('00:00') + 86400;
                    }
                    if($_GET['machid'] == 'all')
                    {
                        
                       $machid= $reservation[$k][6];
                       list($d, $m, $y) = preg_split('/\//', $date_array[$j]);
                       $fd = sprintf('%02d/%02d/%4d', $m, $d, $y);
                       //$sr = get_same_reservation_count(sprintf('%02d/%02d/%4d', $m, $d, $y),$time_value);
                       $sr = get_same_reservation_count(sprintf('%02d/%02d/%4d', $m, $d, $y),$reservation[$k][1],$reservation[$k][2]);
                      
                    }
                    
                    //if((strtotime($time_value) >= strtotime($reservation[$k][1])) && (strtotime($time_value) < strtotime($reservation[$k][2])) && $date_array[$j] == $reservation[$k][0] && $machid == $reservation[$k][6])
                    if ((strtotime($time_value) >= strtotime($reservation[$k][1])) && (strtotime($time_value) < $end_time) && $date_array[$j] == $reservation[$k][0] && $machid == $reservation[$k][6]) 
                        {
                        
                         //echo $reservation[$k][1]." ". $reservation[$k][4]." ".$reservation[$k][9]."<br>";
                        $temp_flag = 1;
                        // $diff = abs(strtotime($reservation[$k][2]) - strtotime($reservation[$k][1]));
                        $diff = abs($end_time - strtotime($reservation[$k][1]));
                        $rowspan = $diff / ($interval_time * 60);
                        $flag = 1;
                        if ($reservation[$k][3] == 1) {
                            continue;
                        }
                        $reservation[$k][3] = 1;
                       //echo $reservation[$k][9];
                        
                        $flagvalue = 1;
                        
                        if($sr >= 2)
                        {
                            
                            if($prevdate != $reservation[$k][0] || $prevtime != $time_value)
                            {
                                $qq = get_same_reservation($fd, $reservation[$k][1],$reservation[$k][2]);
                                $maxmin = get_max_min($fd, $reservation[$k][1],$reservation[$k][2]);
                                $row = mysql_fetch_assoc($maxmin);
                                    $tempmaxtime = strtotime($row['max']);
                                    //if($row['max'] == '00:00')
                                    //{
                                            //$tempmaxtime = strtotime('00:00') + 86400;
                                    //}
                                    $tempmintime = strtotime($row['min']);
                                    //if($row['min'] == '00:00')
                                    //{
                                           // $tempmintime = strtotime('00:00') + 86400;
                                   // }
                                   while($row = mysql_fetch_assoc($qq))
                                   {
                                      for($tempi = 0;$tempi<count($reservation);$tempi++)
                                      {
                                         
                                          if($reservation[$tempi][7] == $row['resid'])
                                          {
                                              
                                              $reservation[$tempi][3] = 1;
                                          }
                                      }
                                        if(strtotime($row['endtime']) > $tempmaxtime)
                                        {
                                            $tempmaxtime = strtotime($row['endtime']);
                                            //if($row['endtime'] == '00:00')
                                           // {
                                                //$tempmaxtime = strtotime('00:00') + 86400;
                                          //  }
                                         }
                                        if(strtotime($row['starttime']) < $tempmintime)
                                        {
                                            $tempmintime = strtotime($qq[$i][1]);
                                           // if($row['starttime'] == '00:00')
                                            //{
                                                //$tempmintime = strtotime('00:00') + 86400;
                                           // }
                                        }
                                        $tempdiff = abs($tempmaxtime - $tempmintime);
                                        $temprowspan = $tempdiff / ($interval_time * 60);
                                   // echo $temprowspan." ";
                                        $max = $temprowspan;
                                        if($temprowspan > $max)
                                        {
                                            $max = $temprowspan;
                                        }
                                    }
                                
                                $prevdate = $reservation[$k][0];
                                $prevtime = $time_value;
                           ?>
                            <td rowspan="<?php echo $max; ?>" align="center" class="reserved_col trigger" oncontextmenu="return openmenu(event,<?php echo $t ?>)" style="background-color:<?php echo $mybook_all ?>;">Multiple Devices</a>
                                <div class="pop-up" style="">
                                    <?php
                                    $qq = get_same_reservation($fd, $reservation[$k][1],$reservation[$k][2]);
                                                                   

                                    while($row=mysql_fetch_assoc($qq))
                                    {
                                        
                                        if($row['isblackout'] == 1)
                                        {
                                            ?> 
                                                    <?php //echo $row['fname'] . " " . $row['lname'] ?> <br>
                                                    <?php echo get_device_name($row['machid']) ?> <br>
                                                    <?php echo $row['starttime'] . "-" . $row['endtime'] ?><br>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                        
                                                    Blackout <br>
                                                <?php echo $row['starttime'] . "-" . $row['endtime']."<br>" ?>
                                             <?php
                                        }
                                    }
                                    ?>
                                </div>    
                            </td>
                            <?php
                           
                            if (get_owner_permissions($_SESSION['SESS_MEMBER_ID'], $machid) == 1) 
                            {
                                ?>
                                <div id="menu<?php echo $t ?>" class="menu" >
                                    <ul>

                                        <li><a href="includes/cancel.php?resid=<?php echo $reservation[$k][7] ?>&date=<?php echo $_GET['date'] ?>&machid=<?php echo $machid ?>">Cancel</a></li>

                                    </ul>
                                </div>


                                <?php
                            }
                            }
                        }
                        else if ($reservation[$k][9] == 0 && $flagvalue==1) 
                        {
                             
                            ?>
                            <td rowspan="<?php echo $rowspan; ?>" align="center" class="reserved_col trigger" oncontextmenu="return openmenu(event,<?php echo $t ?>)" style="background-color:<?php echo $blackout_color ?>;color:white">Blackout</a>
                                <div class="pop-up" style="">
                                    Blackout <br>
                            <?php echo $reservation[$k][1] . "-" . $reservation[$k][2] ?>
                                </div>    
                            </td>
                            <?php
                           
                            if (get_owner_permissions($_SESSION['SESS_MEMBER_ID'], $machid) == 1) 
                            {
                                ?>
                                <div id="menu<?php echo $t ?>" class="menu" >
                                    <ul>

                                        <li><a href="includes/cancel.php?resid=<?php echo $reservation[$k][7] ?>&date=<?php echo $_GET['date'] ?>&machid=<?php echo $machid ?>">Cancel</a></li>

                                    </ul>
                                </div>


                                <?php
                            }
                       } 
                       else if ($reservation[$k][8] == 0 && $flagvalue == 1) 
                       {
                           
                            ?>
                            <td rowspan="<?php echo $rowspan; ?>" align="center" class="reserved_col trigger" style="cursor:pointer;z-index:-1;background-color: <?php echo $activated ?>" oncontextmenu="return openmenu(event,<?php echo $t ?>)" onclick="view_reservation(<?php echo $reservation[$k][7] ?>)"><a href="javascript:void(0)" style="color:white"><?php echo $reservation[$k][4] ?></a>
                                <div class="pop-up">
                                    <?php echo $reservation[$k][4] . "<br>" . $reservation[$k][1] . "-" . $reservation[$k][2] . "<br> Activated" ?>
                                </div>
                            </td>
                            <div id="menu<?php echo $t ?>" class="menu" >
                            <ul>
                            <?php
                                if ($_SESSION['SESS_MEMBER_ID'] == $reservation[$k][10]) 
                                {
                                        ?>
                                        <li><a href="includes/deactivate.php?status=Deactivate&resid=<?php echo $reservation[$k][7] ?>&date=<?php echo $_GET['date'] ?>&machid=<?php echo $machid ?>">Deactivate</a></li>
                                       <!-- <li><a href="includes/cancel.php?resid=<?php echo $reservation[$k][7] ?>&date=<?php echo $_GET['date'] ?>&machid=<?php echo $machid ?>">Cancel</a></li>-->
                                        <?php
                                }
                            ?>
                                    <li><a href="activate.php">Costing</a></li>
                                    <li><a href="javascript:void(0)" onclick="mailwindow(<?php echo $memberid; ?>)">Email</a></li>
                                    <li><a href="javascript:void(0)" onclick="errorreport(<?php echo $reservation[$k][7] ?>,<?php echo $machid ?>)">Report an Error</a></li>
                                    <li><a href="javascript:void(0)" onclick="report(<?php echo $reservation[$k][7] ?>,<?php echo $machid ?>)">Report</a></li>

                            </ul>
                            </div>
                                    <?php
                        } 
                        else 
                        {
                            
                                    if ($reservation[$k][10] == $_SESSION['SESS_MEMBER_ID']) 
                                    {
                                        if(date('d/m/Y') > $date_array[$j])
                                        {
                                            ?>
                                                 <td rowspan="<?php echo $rowspan; ?>" align="center" class="reserved_col trigger" style="white-space: nowrap;max-width:0px;overflow:hidden;cursor:pointer;z-index:-1;background-color: <?php echo $past_reservation ?>;" oncontextmenu="return openmenu(event,<?php echo $t ?>)" onclick="view_reservation(<?php echo $reservation[$k][7] ?>)"><a href="javascript:void(0)" style="color:white"><?php echo $reservation[$k][4] ?></a>
                                                    <div class="pop-up">
                                                        <?php echo $reservation[$k][4] . "<br>" . $reservation[$k][1] . "-" . $reservation[$k][2] ?>
                                                     </div>
                                                </td>
                                            <?php
                                        }
                                        else
                                        {
                                        ?>
                                        
                                <td rowspan="<?php echo $rowspan; ?>" align="center" class="reserved_col trigger" style="white-space: nowrap;max-width:0px;overflow:hidden;cursor:pointer;z-index:-1;background-color: <?php echo $myslot ?>;" oncontextmenu="return openmenu(event,<?php echo $t ?>)" onclick="view_reservation(<?php echo $reservation[$k][7] ?>)"><a href="javascript:void(0)" style="color:white"><?php echo $reservation[$k][4] ?></a>
                                    <div class="pop-up">
                            <?php echo $reservation[$k][4] . "<br>" . $reservation[$k][1] . "-" . $reservation[$k][2] ?>
                                    </div>
                                </td>
                            <?php
                                        }
                                    } 
                                    else 
                                    {
                                        if(date('d/m/Y') > $date_array[$j])
                                        {
                                            ?>
                                                <td rowspan="<?php echo $rowspan; ?>"  nowrap="nowrap" align="center" width="0%" class="reserved_col trigger" style="white-space: nowrap;max-width:0px;overflow:hidden;cursor:pointer;z-index:-1;background-color: <?php echo $other_past_reservation ?>;" oncontextmenu="return openmenu(event,<?php echo $t ?>)" onclick="view_reservation(<?php echo $reservation[$k][7] ?>)"><a href="javascript:void(0)" ><?php echo $reservation[$k][4] ?></a>
                                                    <div class="pop-up">
                                                        <?php echo $reservation[$k][4] . "<br>" . $reservation[$k][1] . "-" . $reservation[$k][2] ?>
                                                    </div>
                                                </td>
                                            <?php
                                        }
                                        else
                                        {
                                            ?>
                                            <td rowspan="<?php echo $rowspan; ?>" align="center" class="reserved_col trigger" style="white-space: nowrap;max-width:0px;overflow:hidden;cursor:pointer;z-index:-1;background-color: <?php echo $reservation_color ?>;" oncontextmenu="return openmenu(event,<?php echo $t ?>)" onclick="view_reservation(<?php echo $reservation[$k][7] ?>)"><a href="javascript:void(0)"><?php echo $reservation[$k][4] ?></a>
                                                <div class="pop-up">
                                                    <?php echo $reservation[$k][4] . "<br>" . $reservation[$k][1] . "-" . $reservation[$k][2] ?>
                                                </div>
                                            </td>
                                            <?php
                                        }
                                    }
                                ?>
                                    <div id="menu<?php echo $t ?>" class="menu" >
                                    <ul>
                                    <?php
                                        if ($_SESSION['SESS_MEMBER_ID'] == $reservation[$k][10]) 
                                        {
                                        ?>
                                            <li><a href="javascript:void(0)" onclick="activate('Activate',<?php echo $reservation[$k][7] ?>,'<?php echo $_GET['date'] ?>','<?php echo $machid ?>',event)">Activate</a></li>
                                        <?php
                                        }
                                        ?>
                                            <li><a href="includes/cancel.php?resid=<?php echo $reservation[$k][7] ?>&date=<?php echo $_GET['date'] ?>&machid=<?php echo $machid ?>">Cancel</a></li>
                                            <li><a href="activate.php">Costing</a></li>
                                            <li><a href="javascript:void(0)" onclick="mailwindow(<?php echo $memberid; ?>)">Email</a></li>
                                            <li><a href="javascript:void(0)" onclick="errorreport(<?php echo $reservation[$k][7] ?>,<?php echo $machid ?>)">Report an Error</a></li>
                                            <li><a href="javascript:void(0)" onclick="report(<?php echo $reservation[$k][7] ?>,<?php echo $machid ?>)">Report</a></li>
                                    </ul>
                                    </div>
                                <?php
                       }
                        ?>           

                                <?php
                                $t++;
                            }
                        }
                        if ($temp_flag != 1) {


                            if (get_owner_permissions($_SESSION['SESS_MEMBER_ID'], $machid) == 1) {
                                ?>
                        <td rowspan="" width="13%" align="center" class="blank_col" style="background-color: white"><a href="javascript:void(0)" onclick="reservation('<?php echo $date_array[$j] ?>','<?php echo $date_array[$j] ?>',<?php echo $machid ?>,'<?php echo $time_value ?>',<?php echo $interval_time ?>)" >&nbsp;</a>
                            <div class="time-pop-up">
                    <?php echo $time_value . " - " . date('H:i', strtotime($time_value) + ($interval_time * 60)) ?>
                            </div>   
                        </td>  
                    <?php
                } else if ($_SESSION['ACC_TYPE'] == 0) {
                    
                    if (get_user_permissions($_SESSION['SESS_MEMBER_ID'], $machid) == 1) 
                    {
                         if($date_array[$j] == $curdate)
                        {
                        
                        ?>
                            <td rowspan="" width="13%" align="center" class="blank_col" style="background-color: #C0C0C0"><a href="javascript:void(0)" onclick="reservation('<?php echo $date_array[$j] ?>','<?php echo $date_array[$j] ?>',<?php echo $machid ?>,'<?php echo $time_value ?>',<?php echo $interval_time ?>)" >&nbsp;</a>
                                <div class="time-pop-up">
                            <?php echo $time_value . " - " . date('H:i', strtotime($time_value) + ($interval_time * 60)) ?>
                                </div>   
                            </td> 
                            <?php
                        }
                        else
                        {
                            ?>
                            <td rowspan="" width="13%" align="center" class="blank_col" style="background-color: white"><a href="javascript:void(0)" onclick="reservation('<?php echo $date_array[$j] ?>','<?php echo $date_array[$j] ?>',<?php echo $machid ?>,'<?php echo $time_value ?>',<?php echo $interval_time ?>)" >&nbsp;</a>
                                <div class="time-pop-up">
                            <?php echo $time_value . " - " . date('H:i', strtotime($time_value) + ($interval_time * 60)) ?>
                                </div>   
                            </td> 
                            <?php
                        }
                    } 
                    else 
                    {
                            ?>

                            <td rowspan="" width="13%" align="center" class="blank_col" style="background-color: white"><a>&nbsp;</a>
                                <div class="time-pop-up">
                            <?php echo $time_value . " - " . date('H:i', strtotime($time_value) + ($interval_time * 60)) ?>
                                </div>   
                            </td>
                        <?php
                    }
                } else {
                  
                    if($date_array[$j] == $curdate)
                    {
                        
                        ?>
                        <td rowspan="" width="13%" align="center" class="blank_col" style="background-color:#C0C0C0"><a href="javascript:void(0)" onclick="reservation('<?php echo $date_array[$j] ?>','<?php echo $date_array[$j] ?>',<?php echo $machid ?>,'<?php echo $time_value ?>',<?php echo $interval_time ?>)" >&nbsp;</a>
                            <div class="time-pop-up">
                        <?php echo $time_value . " - " . date('H:i', strtotime($time_value) + ($interval_time * 60)) ?>
                            </div>   
                        </td>  
                        <?php
                    }
                    else
                    {
                    ?>
                        <td rowspan="" width="13%" align="center" class="blank_col" style="background-color:white"><a href="javascript:void(0)" onclick="reservation('<?php echo $date_array[$j] ?>','<?php echo $date_array[$j] ?>',<?php echo $machid ?>,'<?php echo $time_value ?>',<?php echo $interval_time ?>)" >&nbsp;</a>
                            <div class="time-pop-up">
                        <?php echo $time_value . " - " . date('H:i', strtotime($time_value) + ($interval_time * 60)) ?>
                            </div>   
                        </td>  
                        <?php
                    }
                    }
                    ?>


                            <?php
                        }
                    }
                    echo "</tr>";
                }
                ?>
    </table>
        <?php
    }
    ?>