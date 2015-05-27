<?php
echo('<?xml version="1.0" encoding="iso-8859-1"?>' . "\n");
echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n"); ?>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>W.C and A.N. Miller Development Company - Board Members</title>
<link href="wcanmdc.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('admin/dbinfo.php')?>
<?php include('admin/userlog.php')?>

<div class="center">
<?php include('header.php')?>

<div class="container">
	<img src="../img/middle-bar-blue.jpg" width="990" height="16">
	
	<p><span class="logintitle">Welcome to the Corporate Intranet</span></p>
	<p class="selectaccess"><span class="selectaccess">Select Your Access</span></p>
	<p><span class="clickto"><a href = "bm/">- Board Member Access -</a></span></p>
	<p><span class="clickto"><a href = "sh/">- Shareholder Access -</a></span></p>

</div><!-- end container -->
<?php include('footer.php')?>
</div><!-- end div center -->
</body>
</html>