<?php
function OperateRelays($msg,$ip,$relays) {
    
   
  $PORT = 30302;
  $RELAYBOARD = $ip;    
  if (!extension_loaded('sockets')) {
    die ("Socket extension not loaded");
  }
  $sock = socket_create(AF_INET, SOCK_DGRAM, SOL_UDP);
  if (!$sock) 
  {
	  die("socket_create failed");
  }
  if (!socket_connect($sock, $RELAYBOARD, $PORT)) 
  {
	  die("socket_connect failed");
  }
  $sock_data = socket_set_option($sock, SOL_SOCKET, SO_BROADCAST, 1); //Set
  $t="";
  $m = $msg.$relays;
  $length = strlen($m);
  $t .= $m;
  while ($length > 0) 
  {
	    $sock_data = socket_write($sock, $m, $length); //Send data
            if($sock_data === false) 
            {
                  die("Socket Write Failure");
            }
	    $length -= $sock_data;
            $m = substr($m, $sock_data);
  }
  
  socket_close($sock); //Close socket
  //echo $t."\n";
}
?>
