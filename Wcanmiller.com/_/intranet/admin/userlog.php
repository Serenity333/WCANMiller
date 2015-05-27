<?php
// Getting the information
$user = $_SERVER['REMOTE_USER'];
$ipaddress = $_SERVER['REMOTE_ADDR'];
$page = "http://{$_SERVER['HTTP_HOST']}{$_SERVER['PHP_SELF']}";
$referrer = $_SERVER['HTTP_REFERER'];
$datetime = date("F j, Y, g:i a");
$useragent = $_SERVER['HTTP_USER_AGENT'];
$remotehost = @getHostByAddr($ipaddress);


// Write to log file:
$logline = $user . ',"' . $datetime . '",' . $ipaddress . "\n";
$logfile = 'admin/userlog.csv';
$handle = fopen($logfile, 'a+');
fwrite($handle, $logline);
fclose($handle);


//insert information into image table
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));

   $query = 'INSERT INTO userlog
        (username, ipaddress)
    VALUES
        ("' . $user . '", "' . $ipaddress . '")';

	$result = mysql_query($query, $db) or die (mysql_error($db));

?>