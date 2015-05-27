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
<?php include('../admin/dbinfo.php')?>

<div class="center">
<?php include('../header.php')?>

<div class="container">
<img src="../../img/middle-bar-blue.jpg" width="990" height="16">

<?php include('managementnav.php')?>

<div class="main">
<?php
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));

// get page
	$show = 24;
	
// set page number
	$result = mysql_query("SELECT * FROM uploadedDocs WHERE udirectory = $show", $db);
	$rowmax = mysql_num_rows($result);
	$pagemax = (($rowmax > 10) ? (floor($rowmax/10)+1) : 1);
	if (isset ($_GET['pn'])) { $pagenum= $_GET['pn']; }
	else { $pagenum=1;	}
	if ($pagenum > $pagemax || $pagenum <1) { $pagenum=1; }
	
	$pageNewer = $pagenum-1;
	$pageOlder = $pagenum+1;
	$offset = (($pagenum-1)*10);
	
// Print Files Info
	echo '<div class="title">Management Section</div>';
	
	$dir = ('uploads/');
	
	$query = "SELECT * FROM	uploadedDocs
			  WHERE udirectory = $show
			  ORDER BY udate DESC
			  LIMIT $offset, 10";
	$results = mysql_query($query, $db) or die(mysql_error($db));
	
	$table = '<table class="files"><tr class = "pagenav"><td class = "leftpagenav">';
// page nav	
	if ($pageOlder <= $pagemax) { $table .= '<a href="?page='.$show.'&pn='.$pageOlder.'"> << Older </a>'; }
	$table .= '</td><td class="rightpagenav">';
	if ($pageNewer > 0) { $table .= '<a href="?page='.$show.'&pn='.$pageNewer.'"> Newer >> </a>'; }
	$table .= '</td></tr>';
	
	while ($row = mysql_fetch_assoc($results)) {
		extract($row); 
		$udate = date("F j, Y", strtotime($udate));
	
		$table .= <<<WORK
			<tr class="filestop">
			  <td class="displayname"><a href="$dir$fileName">$displayName</a></td>
			  <td class="udate">$udate</td>
			</tr>
			<tr class="filesbottom">
				<td class="comments">$ucomments</td>
				<td class="admin">
					<form action="mupdate.php" method="post" enctype="multipart/form-data">
						<input type="hidden" name="whichrow" value=$udID />
						<div class="delete"><input type="submit" name="submit" value="Delete" /></div>
						<div class="edit"><input type="submit" name="submit" value="Edit" /></div>					
					</form>
				</td>
			</tr>
			<tr class="spacer"><td class="spacer" colspan="2"></td></tr>
WORK;
		}
	$table.= '</table>';
	echo $table;
?>
</div><!-- end main -->
</div><!-- end container -->
<?php include('../footer.php')?>
</div><!-- end div center -->
</body>
</html>