<?php
echo('<?xml version="1.0" encoding="iso-8859-1"?>' . "\n");
echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n"); ?>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>W.C and A.N. Miller Development Company - Management Section</title>
<link href="../wcanmdc.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div class="center">
<?php include('../header.php')?>

<div class="container">
<img src="../../img/middle-bar-blue.jpg" width="990" height="16">


<div class="admin">
<div class="title"><p>Add a new file.</p></div>

	<table class="upload">
	<form action="mupdate.php" method="post" enctype="multipart/form-data">
		<tr><td>Choose a file to upload.</td>
			<td><input type="file" name="fupload" id="fupload" /></td>
		</tr>
		<tr><td>Title to display:</td>
			<td><input type="text" name="fdisplayname" /></td>
		</tr>
		<tr><td>Comments:</td>
			<td><input type="text" name="fcomments" /></td>
		</tr>
		<tr><td>Date (MM-DD-YYY):</td>
			<td><input type="text" name="fdate" /></td>		
		</tr>
		<tr><td>File destination:</td>
			<td><select name="fdest">				
					<option value="24">Management Section</option>	
				</select>
			</td>
		</tr>
		<tr><td><input type="submit" name="submit" value="Upload" /></td>
			<td></td>
		</tr>
	</form>
	</table>

</div><!-- end admin -->
</div><!-- end container -->
<?php include('../footer.php')?>
</div><!-- end div center -->
</body>
</html>