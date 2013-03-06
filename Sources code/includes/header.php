<?php
session_start();
include 'connect.php';
include 'query.php';
include 'functions.php';
require 'exportcsv.php';
?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="js/jqueryslidemenu.css" />
        <script type="text/javascript" src="js/jquery.min.js"></script>
        <script type="text/javascript" src="js/jqueryslidemenu.js"></script>
        <LINK href="css/style.css" rel="stylesheet" type="text/css">
        <link href="css/jquery-ui-1.8.21.custom.css" media="screen" rel="stylesheet" type="text/css" >
        <link href="css/jquery-ui-1.8.22.custom.css" media="screen" rel="stylesheet" type="text/css" >
        <script type="text/javascript" language="javascript" src="js/jquery.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery-1.7.2.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.21.custom.min.js"></script>
        <script type="text/javascript" language="javascript" src="js/jquery-ui-1.8.22.custom.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function()
            {
            
                $("#date").datepicker({ dateFormat: 'mm/dd/yy' });
                $("#date1").datepicker({ dateFormat: 'mm/dd/yy' });
                $("#errreportfromdate").datepicker({ dateFormat: 'mm/dd/yy' });
                $("#reservationdate").datepicker({ dateFormat: 'dd/mm/yy' });
                $("#errreporttodate").datepicker({ dateFormat: 'mm/dd/yy' });
            });
            $(function() {
                var moveLeft = 20;
                var moveDown = 10;
    
                $('td.trigger').hover(function(e) {
                    $(this).find('div.pop-up').fadeIn('slow')
                    // .css('top', e.pageY + moveDown)
                    // .css('left', e.pageX + moveLeft)
                    // .appendTo('body');
                }, function() {
                    $('div.pop-up').fadeOut('slow');
                });
                $('td.blank_col').hover(function(e) {
                    $(this).find('div.time-pop-up').fadeIn('fast')
                }, function() {
                    $('div.time-pop-up').fadeOut('fast');
                });
                $('.prevweek').hover(function()
                {
                    $('div.prevweekpopup').fadeIn('fast'); 
                },function(){
                    $('div.prevweekpopup').fadeOut('fast'); 
                }
            );
                $('.nextweek').hover(function()
                {
                    $('div.nextweekpopup').fadeIn('fast'); 
                },function(){
                    $('div.nextweekpopup').fadeOut('fast'); 
                }
            );
  
                $(document).bind("click",function(e) {
                    $('.menu').fadeOut('fast');
                });
            });
            function openmenu(e,t)
            {
      
                var posx = 0;
                var posy = 0;
                if (!e) var e = window.event;
                if (e.pageX || e.pageY) 	{
                    posx = e.pageX;
                    posy = e.pageY;
                }
                else if (e.clientX || e.clientY) 	{
                    posx = e.clientX + document.body.scrollLeft
                        + document.documentElement.scrollLeft;
                    posy = e.clientY + document.body.scrollTop
                        + document.documentElement.scrollTop;
                }
                // posx and posy contain the mouse position relative to the document
                // Do something with this information
        
                $('.menu').fadeOut('fast');
                // event = event || window.event;
     
                $('#menu'+t).css({
                    top: posy+'px',
                    left: posx+'px'
                }).fadeIn('fast');
                return false;
            }
 
            function changeResource(curdate,value)
            {
                window.location="member-index.php?date="+curdate+"&machid="+value;
            }
            function changeResourceMyBooking(curdate,value)
            {
                window.location="mybookings-template.php?date="+curdate+"&machid="+value;
            }
            function changeDate(machid)
            {
                curdate = $('#date').val();
                window.location="member-index.php?date="+curdate+"&machid="+machid;
            }
            function changeDatemeeting()
            {
                curdate = $('#date').val();
                window.location="meeting.php?date="+curdate;
            }
            function changeDateMyBooking(machid)
            {
                curdate = $('#date').val();
      
                window.location="mybookings-template.php?date="+curdate+"&machid="+machid;
            }
            function updateArea (e) {
                document.getElementById('area').value = '';
                for (var i=0; i<e.form.elements.length; i++){
                    if (e.form.elements[i].type == 'checkbox' && e.form.elements[i].checked) {
                        document.getElementById('area').value+= e.form.elements[i].nextSibling.data+","; 
                    }
                };
                alert(document.getElementById('area').value);

            }
            function checksystemonwertrack(value)
            {
                window.location="system-onwer-and-user-tracking.php?systemonwermachid="+value;
            } 
            function getSelected(opt) {
                var selected = new Array();
                var index = 0;
                for (var intLoop = 0; intLoop < opt.length; intLoop++) {
                    if ((opt[intLoop].selected) ||
                        (opt[intLoop].checked)) {
                        index = selected.length;
                        selected[index] = new Object;
                        selected[index].value = opt[intLoop].value;
                        selected[index].index = intLoop;
                    }
                }
                return selected;
            }

            function outputSelected(opt) {
                var f=document.ColorSelector;
                var sel = getSelected(opt);
                var strSel = "";
                for (var item in sel) {    
                    if(strSel=="")
                        strSel = "'"+sel[item].value+"'";
                    else
                        strSel =strSel+",'"+ sel[item].value+"'";
                }
                var textbox = document.getElementById('result');
                f.result.value=strSel;
                textbox="";
                var dd = document.getElementById('result');
                var kk=dd.value;
                //alert("val:-" + dd.value);
                //window.location="index.php?eventname="+dd.value
            }
            function eventnamechange()
            {
                var f=document.form1;
                var baseName = 'checkbox';
                var num = 23;
                var valStr = '';
                var el;
                for(var i=1;i<=num;i++) {
                    el = f.elements[baseName+i];
                    if(el.checked) {
                        valStr += el.value+',';
                    }
                }
                var lastCharPos = valStr.length -1;
                if(valStr.lastIndexOf(',') == lastCharPos) {
                    valStr = valStr.substring(0,lastCharPos)
                }
                alert(valStr);
                result.value=valStr;
                // window.location="index.php?eventname="+valStr;
            }
            function checkusertrack(value)
            {
                window.location="system-onwer-and-user-tracking.php?usermachid="+value;
            }
            function demotrack(value)
            {
                window.location="demo-track.php?machid="+value;
            }
            function selectAll(x) {
                for(var i=0,l=x.form.length; i<l; i++)
                    if(x.form[i].type == 'checkbox' && x.form[i].name != 'sAll')
                        x.form[i].checked=x.form[i].checked?false:true
            }
            function reservation(startdate,enddate,machid,starttime,interval)
            {
      
                var win = window.open('reservation.php?startdate='+startdate+'&enddate='+enddate+'&machid='+machid+'&starttime='+starttime+'&interval='+interval, 'Reservation','left=100,top=100,width=500,height=700,resizable=0');
                win.focus();
                void(0); 
            }
            function view_reservation(resid)
            {
        
                /*  $('#dialog').load('view_reservation.php?resid='+resid).dialog(
      
           {
                
               model:true,
               height:420,
               show: { effect: 'drop', direction: "up" },
               width:500,
               hide: "explode",
               title:"View Reservation",
               resizable: false
           });*/
       
    

                var win = window.open('view_reservation.php?resid='+resid, 'View Reservation','left=100,top=100,width=500,height=500,resizable=0');
                win.focus();
                void(0); 
            }
            function mailwindow(memberid)
            {
                var win = window.open('mail-window.php?memberid='+memberid, 'Reservation','left=100,top=100,width=600,height=300,resizable=0');
                win.focus();
                void(0); 
            }
            
            function getemailid()
            {
                var win = window.open('getmailidlidt.php?', 'Ge more Information for user','left=100,top=100,width=600,height=300,resizable=0');
                win.focus();
                void(0); 
            }
            function moreinfo(memberid)
            {
                var win = window.open('mail-window.php?mmmemberid='+memberid, 'Ge more Information for user','left=100,top=100,width=800,height=400,resizable=0');
                win.focus();
                void(0); 
            }
            function showmoreinfo(memberid)
            {
                var win = window.open('showmoreinfo.php?mmmemberid='+memberid, 'Information for user','left=100,top=100,width=600,height=300,resizable=0');
                win.focus();
                void(0); 
            }
            function moreinfoevent(memberid)
            {
                var win = window.open('mail-window.php?resid='+memberid, 'Ge more Event information ','left=100,top=100,width=600,height=300,resizable=0');
                win.focus();
                void(0); 
            }
            function showmoreinfoevent(memberid)
            {
                var win = window.open('showmoreinfo.php?resid='+memberid, 'Information for user','left=100,top=100,width=600,height=300,resizable=0');
                win.focus();
                void(0); 
            }
            function report(resid,machid)
            {
      
      
                var win2 = window.open('report.php?resid='+resid+'&machid='+machid, 'Error Report','left=100,top=100,width=500,height=250,resizable=0');
                win2.focus();
                void(0);
            }
            function errorreport(resid,machid)
            {
                var win1 = window.open('errorreport.php?resid='+resid+'&machid='+machid, 'Error Report','left=100,top=100,width=500,height=250,resizable=0');
                win1.focus();
                void(0); 
            }
            function closeWindow()
            {
                opener.document.location.reload(true);
                window.close();
            }
  
            function validatemobile() {
                var mobile = document.loginForm.mob.value;
                alert(mobile);
                var pattern = /^\d{10}$/;
                if (pattern.test(mobile)) {
                    // alert("Your mobile number : "+mobile);
                    return true;
                } 
                document.loginForm.mob.value= "";
                alert("It is not valid mobile number.input 10 digits number!");
                return false;

            }
            function copy(){
                var o, i;
                with(document.myform){
                    myarea.value = '';
                    for (i=0; i < mylist.options.length; i++){
                        o = mylist.options[i];
                        if (o.selected){
                            if (myarea.value != '')
                                myarea.value += '\n';
                            myarea.value += o.text;
                        }
                    }
                }
            }
	
            function validateemail(form_id,email) {
 
                var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
                var address = document.forms[form_id].elements[email].value;
                if(reg.test(address) == false) {
                    document.loginForm.email.value= "";
                    alert('Invalid Email Address');
                    return false;
                }else{
                    alert("Your Email-ID is :-"+address);
                }
            }
            function activate(status,resid,date,machid,event)
            {
      
                event = event || window.event;
                $.get("includes/activate.php", { status: status, resid: resid , date:date, machid:machid },
                function(response,status,xhr){
            
                    response = $.trim(response);
                    if(response == "101")
                    {
                        $("#tooearly").fadeIn('slow');
                        setTimeout(function() 
                        {
                            $("#tooearly").fadeOut('slow')
                        }, 3000);

                    }
                    else if(response == "102")
                    {
                        $('#toolate').css({
                            top: event.pageY+'px',
                            left: event.pageX+'px'
                        }).fadeIn('slow');
                        setTimeout(function() 
                        {
                            $("#toolate").fadeOut('slow')
                        }, 3000);
                    }
                    else if(response == '103')
                    {
                        $('#inuse').css({
                            top: event.pageY+'px',
                            left: event.pageX+'px'
                        }).fadeIn('slow');
                        setTimeout(function() 
                        {
                            $("#inuse").fadeOut('slow')
                        }, 3000);
                    }
                    else
                    {
                        $('#success').css({
                            top: event.pageY+'px',
                            left: event.pageX+'px'
                        }).fadeIn('slow');
                        setTimeout(function() 
                        {
                            $("#success").fadeOut('slow');
                            location.reload();
                        }, 3000);
                    }
                });
            }
   
            function jumpto(url,date,machid)
            {
        
                window.location = url+"?date="+date+"&machid="+machid;
            }
            function setFilterValue(value)
            {
      
                value='value='+value;
                $.ajax
                ({

                    type: "POST",
                    url: "add_filter_report.php",
                    data: value,
                    cache: false,
                    success: function(html)
                    {
                
                        $('.filterValue').html(html);
                    }
                });
            }
        </script>
        <style type="text/css">

            font, a:link{
                color: #000000;


                text-decoration:none;

            }
            font, a:visited{
                color: #000000;


                text-decoration:none;

            }
            font, a:hover {
                color: #FF0000;


                text-decoration:none;

            }
            font, a:active {
                color: #FFFFFF;


                text-decoration:none;
                font-weight:bold;
            }
            #divoverflow 
            {
                width:60%;
                height:140px;
                overflow:scroll;
            }

        </style>

    </head>
    <body>

        <div id="tooearly"> 
            <table width="100%" height="100%" style="background: none;border:0px;color:white">
                <tr>
                    <td>
                        <img src="images/error-icon.png" height="30" width="30">

                    </td>
                    <td align="left">
                        <b>You Are Too Early</b>
                    </td>
                </tr>
            </table>
        </div>
        <div id="toolate"> 
            <table width="100%" height="100%" style="background: none;border:0px;color:white">
                <tr>
                    <td>
                        <img src="images/error-icon.png" height="30" width="30">

                    </td>
                    <td align="left">
                        <b>You Are Too Late</b>
                    </td>
                </tr>
            </table>
        </div>
        <div id="success"> 
            <table width="100%" height="100%" style="background: none;border:0px;color:white">
                <tr>
                    <td>
                        <img src="images/success.png" height="30" width="30">

                    </td>
                    <td align="left">
                        <b>Machine Activated Successfully</b>
                    </td>
                </tr>
            </table>
        </div>
        <div id="inuse"> 
            <table width="100%" height="100%" style="background: none;border:0px;color:white">
                <tr>
                    <td>
                        <img src="images/error-icon.png" height="30" width="30">

                    </td>
                    <td align="left">
                        <b>Machine Already in Use</b>
                    </td>
                </tr>
            </table>
        </div>
        <div id="dialog" title="Basic dialog">
        </div>

