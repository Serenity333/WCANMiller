<?php
echo('<?xml version="1.0" encoding="iso-8859-1"?>' . "\n");
echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n"); ?>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>W.C and A.N. Miller Development Company - Board Members</title>
<link href="../wcanmdc.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('../admin/dbinfo.php')?>

<div class="center">
<?php include('../header.php')?>

<div class="container">
<img src="../../img/middle-bar-blue.jpg" width="990" height="16">

<?php include('bmnav.php')?>

<div class="main">
<?php
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));

// get page
	$show = $_GET['page'];
	$show = (($show == '999' OR $show == '1' OR $show == '2' OR $show == '3' OR $show == '4' OR $show == '5' OR $show == '6' OR $show == '7' OR $show == '8' OR $show == '9' OR $show == '10' OR $show == '11' OR $show == '12' OR $show == '13' OR $show == '14' OR $show == '15' OR $show == '16' OR $show == '17' OR $show == '18' OR $show == '19' OR $show == '20' OR $show == '22' OR $show == '23') ? $show : 10);

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
	if ($show == 1) {$titleName = 'Monthly Financial Statements';}
	if ($show == 2) {$titleName = 'Board Meeting Minutes';}
	if ($show == 3) {$titleName = 'Audited and Reviewed Year End Financials';}
	if ($show == 4) {$titleName = 'Quarterly Updates';}
	if ($show == 5) {$titleName = 'By-Laws';}
	if ($show == 6) {$titleName = 'Articles of Incorporation';}
	if ($show == 7) {$titleName = 'Annual Meeting Minutes';}
	if ($show == 8) {$titleName = 'Strategic Plan';}
	if ($show == 9) {$titleName = 'Correspondence';}
	if ($show == 10) {$titleName = 'Audit & Finance Committee';}
	if ($show == 11) {$titleName = 'Board Member Information';}
	if ($show == 12) {$titleName = 'Compensation Committee';}
	if ($show == 13) {$titleName = 'Corporate Governance Committee';}
	if ($show == 14) {$titleName = 'Governance & Nominating Committee';}
	if ($show == 15) {$titleName = 'Strategic Planning Committee';}
	if ($show == 16) {$titleName = 'Board Meeting Agenda';}
	if ($show == 17) {$titleName = 'Audit & Finance Committee';}
	if ($show == 18) {$titleName = 'Compensation Committee';}
	if ($show == 19) {$titleName = 'Governance & Nominating Committee';}
	if ($show == 20) {$titleName = 'Budgets';}
	if ($show == 22) {$titleName = 'Shareholder Information';}
	if ($show == 23) {$titleName = 'Ad Hoc Committee';}
	echo '<div class="title">' . $titleName . '</div>';
	
	$dir = (($show == 1 || $show == 2 || $show == 10 || $show == 11 || $show == 12 || $show == 13 || $show == 14 || $show == 15 || $show == 16 || $show == 23) ? 'uploads/' : '../sh/uploads/');
	
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
			<tr class="filesbottom"><td class="comments" colspan="2">$ucomments</td></tr>
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