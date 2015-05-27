<?php
echo('<?xml version="1.0" encoding="iso-8859-1"?>' . "\n");
echo('<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">' . "\n"); ?>
<html xml:lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html" />
<title>W.C and A.N. Miller Development Company - Administrator</title>
<link href="../wcanmdc.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php include('dbinfo.php')?>

<div class="center">
<?php include('../header.php')?>

<div class="container">
<img src="../../img/middle-bar-blue.jpg" width="990" height="16">

<div class="admin">
<?php
// get the entry to delete and ask for confimation
if ($_POST['submit'] == 'Delete') {
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));

	$thisrow = $_POST[whichrow];
	
	$query = "SELECT * FROM	uploadedDocs
			  WHERE udID = $thisrow";
	$results = mysql_query($query, $db) or die(mysql_error($db));
	$row = mysql_fetch_assoc($results);
	extract($row);
	
	if ($udirectory == 1) {$udirectory = 'Monthly Financial Statements';}
	if ($udirectory == 2) {$udirectory = 'Board Meeting Minutes';}
	if ($udirectory == 3) {$udirectory = 'Audited and Reviewed Year End Financials';}
	if ($udirectory == 4) {$udirectory = 'Quarterly Updates';}
	if ($udirectory == 5) {$udirectory = 'By-Laws';}
	if ($udirectory == 6) {$udirectory = 'Articles of Incorporation';}
	if ($udirectory == 7) {$udirectory = 'Annual Meeting Minutes';}
	if ($udirectory == 8) {$udirectory = 'Strategic Plan';}
	if ($udirectory == 9) {$udirectory = 'Correspondence';}
	if ($udirectory == 10) {$udirectory = 'Audit & Finance Committee';}
	if ($udirectory == 12) {$udirectory = 'Compensation Committee';}
	if ($udirectory == 13) {$udirectory = 'Corporate Governance Committee';}
	if ($udirectory == 14) {$udirectory = 'Governance & Nominating Committee';}
	if ($udirectory == 15) {$udirectory = 'Strategic Planning Committee';}
	if ($udirectory == 16) {$udirectory = 'Board Meeting Agenda';}
	if ($udirectory == 17) {$udirectory = 'Audit & Finance Committee';}
	if ($udirectory == 18) {$udirectory = 'Compensation Committee';}
	if ($udirectory == 19) {$udirectory = 'Governance & Nominating Committee';}
	if ($udirectory == 20) {$udirectory = 'Budgets';}
	if ($udirectory ==11) {$udirectory = 'Board Member Information';}
	if ($udirectory ==22) {$udirectory = 'Shareholder Information';}
	if ($udirectory ==23) {$udirectory = 'Ad Hoc Committee';}
	if ($udirectory ==24) {$udirectory = 'Management Section';}

	$udate = date("F j, Y", strtotime($udate));
	
	$table = <<<WORK
		<table class="upload">
			<tr><td>File:</td><td>$fileName</td></tr>
			<tr><td>Location:</td><td>$udirectory</td></tr>
			<tr><td>Title</td><td>$displayName</td></tr>
			<tr><td>Comments:<td>$ucomments</td></td></tr>
			<tr><td>Date</td><td>$udate</td></tr>
			<tr><td>
					<form action="update.php" method="post" enctype="multipart/form-data">
					<input type="submit" name="submit" value="Confirm Delete" />
					<input type="hidden" name="whichrow" value=$udID />
				</td>
				<td><a href="../admin/">Cancel and return to the main page.</a></td>
			</tr>
		</table>
WORK;
	echo '<div class="title"><p><span class="red">Are you sure you want to delete this record? This action can not be undone.</span></p></div>';
	echo $table;
}

// delete the file and entry
if ($_POST['submit'] == 'Confirm Delete') {
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));

	$thisrow = $_POST[whichrow];
	
	$query = "SELECT * FROM	uploadedDocs
			  WHERE udID = $thisrow";
	$results = mysql_query($query, $db) or die(mysql_error($db));
	$row = mysql_fetch_assoc($results);
	extract($row);
	if ($udirectory == 24) { $dir ='../management/uploads/'; }
	if ($udirectory == 1 || $udirectory == 2 || $udirectory == 10 || $udirectory == 11 || $udirectory == 12 || $udirectory == 13 || $udirectory == 14 || $udirectory == 15 || $udirectory == 16 || $udirectory == 23 || $udirectory == 24) { $dir ='../bm/uploads/'; }
	if ($udirectory == 3 || $udirectory == 4 || $udirectory == 5 || $udirectory == 6 || $udirectory == 7 || $udirectory == 8 || $udirectory == 9 || $udirectory == 17 || $udirectory == 18 || $udirectory == 19 || $udirectory == 20 || $udirectory == 22) { $dir ='../sh/uploads/'; }
	$deletedFile = $dir . $fileName;
	
	unlink($deletedFile);
	mysql_query("DELETE FROM uploadedDocs WHERE udID = $thisrow") or die(mysql_error($db));

	echo '<p>The file record has been deleted.</p><p><a href = "../admin/">Return to the main page.</a></p>';

}

// get the file to update and let the user make changes
if ($_POST['submit'] == 'Edit')
{
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));

	$thisrow = $_POST[whichrow];
	
	$query = "SELECT * FROM	uploadedDocs
			  WHERE udID = $thisrow";
	$results = mysql_query($query, $db) or die(mysql_error($db));
	$row = mysql_fetch_assoc($results);
	extract($row);
	
	
	$a_date = explode('-', $udate);
			$year = $a_date[0];
			$month = $a_date[1];
			$day = $a_date[2];
			
	$pdate = $month.'-'.$day.'-'.$year;
	echo '<div class="title"><p>Update this record.</p></div>';
	$form = <<<WORK
		<form action="update.php" method="post" enctype="multipart/form-data">
		<input type="hidden" name="whichrow" value=$udID />
		
		<table class="upload">
			<tr><td>The current file is: </td>
				<td>$fileName</td>
			</tr>
			<tr><td>Leave blank to keep the current file<br />or choose a new file to upload.</td>
				<td><input type="file" name="fupload" id="fupload" /></td>
			</tr>
			<tr><td>Title to display:</td>
				<td><input type="text" name="fdisplayname" value="$displayName" /></td>
			</tr>
			<tr><td>Comments:</td>
				<td><input type="text" name="fcomments" value="$ucomments" /></td>
			</tr>
			<tr><td>Date (MM-DD-YYY):</td>
				<td><input type="text" name="fdate" value="$pdate" /></td>		
			</tr>
			<tr><td>File destination:</td>
				<td><select name="fdest">
						<option value="1"
WORK;
	if ($udirectory == 1) {$form .= 'selected="selected" ';}
	$form .= ' >Monthly Financial Statements</option>
						<option value="2" ';
	if ($udirectory == 2) {$form .= 'selected="selected" ';}
	$form .= '>Board Meeting Minutes</option>
						<option value="3" ';
	if ($udirectory == 3) {$form .= 'selected="selected" ';}
	$form .=' >Audited and Reviewed Year End Financials</option>
						<option value="4" ';
	if ($udirectory == 4) {$form .= 'selected="selected" ';}
	$form .= ' >Quarterly Updates</option>
						<option value="5" ';
	if ($udirectory == 5) {$form .= 'selected="selected" ';}
	$form .= ' >By-Laws</option>
						<option value="6" ';
	if ($udirectory == 6) {$form .= 'selected="selected" ';}
	$form .= ' >Articles of Incorporation</option>
						<option value="7" ';
	if ($udirectory == 7) {$form .= 'selected="selected" ';}
	$form .= ' >Annual Meeting Minutes</option>
						<option value="8" ';
	if ($udirectory == 8) {$form .= 'selected="selected" ';}
	$form .= ' >Strategic Plan</option>
						<option value="9" ';
	if ($udirectory == 9) {$form .= 'selected="selected" ';}
	$form .= ' >Correspondence</option>
						<option value="10" ';
	if ($udirectory == 10) {$form .= 'selected="selected" ';}
	$form .= ' >Audit & Finance Committee</option>
						<option value="11" ';
	if ($udirectory == 11) {$form .= 'selected="selected" ';}
	$form .= ' >Board Member Information</option>
						<option value="12" ';
	if ($udirectory == 12) {$form .= 'selected="selected" ';}
	$form .= ' >Compensation Committee</option>
						<option value="13" ';
	if ($udirectory == 13) {$form .= 'selected="selected" ';}
	$form .= ' >Corporate Governance Committee</option>
						<option value="14" ';
	if ($udirectory == 14) {$form .= 'selected="selected" ';}
	$form .= ' >Governance & Nominating Committee</option>
						<option value="15" ';
	if ($udirectory == 15) {$form .= 'selected="selected" ';}
	$form .= ' >Strategic Planning Committee</option>
						<option value="16" ';
	if ($udirectory == 16) {$form .= 'selected="selected" ';}
	$form .= ' >Board Meeting Agenda</option>
						<option value="17" ';
	if ($udirectory == 17) {$form .= 'selected="selected" ';}
	$form .= ' >Audit & Finance Committee</option>
						<option value="18" ';
	if ($udirectory == 18) {$form .= 'selected="selected" ';}
	$form .= ' >Compensation Committee</option>
						<option value="19" ';
	if ($udirectory == 19) {$form .= 'selected="selected" ';}
	$form .= ' >Governance & Nominating Committee</option>
						<option value="19" ';
	if ($udirectory == 20) {$form .= 'selected="selected" ';}
	$form .= ' >Budgets</option>
						<option value="22" ';
	if ($udirectory == 22) {$form .= 'selected="selected" ';}
	$form .= ' >Shareholder Information</option>
						<option value="23" ';
	if ($udirectory == 23) {$form .= 'selected="selected" ';}
	$form .= ' >Ad Hoc Committee</option>
						<option value="23" ';
	if ($udirectory == 24) {$form .= 'selected="selected" ';}
	$form .= <<<WORK
		>Management Section</option>
					</select>
				</td>
			</tr>
			<tr><td><input type="submit" name="submit" value="Update" /></td>
				<td></td>
			</tr>
		</table>
	</form>
WORK;
	
	echo $form;
}

// confirm that edits have been made and that they are valid
if ($_POST['submit'] == 'Update')
{
	// get edited file info
	$updatefileName = $_FILES['fupload']['name'];
	$updatedisplayName = $_POST['fdisplayname'];
	$updatecomments = $_POST['fcomments'];
	$date = $_POST['fdate'];
	$dest = $_POST['fdest'];
	$thisrow = $_POST[whichrow];
	
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));
	
	$query = "SELECT * FROM	uploadedDocs
			  WHERE udID = $thisrow";
	$results = mysql_query($query, $db) or die(mysql_error($db));
	$row = mysql_fetch_assoc($results);
	extract($row);


// change directory    
	if ($dest == 24)
	{ 
	chdir('../management/uploads');
	$updatedir = getcwd() . '/';
	}
	if ($dest == 1 || $dest == 2 || $dest == 10 || $dest == 11 || $dest == 12 || $dest == 13 || $dest == 14 || $dest == 15 || $dest == 16 || $dest == 23)
	{ 
	chdir('../bm/uploads');
	$updatedir = getcwd() . '/';
	}
	 if ($dest == 3 || $dest == 4 || $dest == 5 || $dest == 6 || $dest == 7 || $dest == 8 || $dest == 9 || $dest == 18 || $dest == 18 || $dest == 19 || $dest == 20 || $dest == 22)
	{chdir('../sh/uploads');
	$updatedir = getcwd() . '/';
	}
	
//check date
	$date = str_replace(array('\'', '/', '.', ',', ' '), '-', $date);
	if ($date == '') {$date = date('m-d-Y');} 
	$a_date = explode('-', $date);
		$month = $a_date[0];
		$day = $a_date[1];
		$year = $a_date[2];
	if (strlen($day)==1) { $day='0'.$day; }
	if (strlen($month)==1) { $month='0'.$month; }
	if (strlen($year)==2) { $year='20'.$year; }
	$inputdate =$year . '-' . $month . '-' . $day  ;
	if (!checkdate($month, $day, $year)) { die('You have entered an invalid date. Please click back and enter a valid date.'); }
	
// check title
	if ($displayName == '') { die('The "Title" field is blank. Please click back and enter the title of this file as you want it to appear on the page.'); }
	    
	//insert file into table
	if ($updatefileName != '')
	{
		// check the file upload
	    if ($_FILES['fupload']['error'] != UPLOAD_ERR_OK)
	    {
		    switch ($_FILES['fupload']['error'])
		    {
	        case UPLOAD_ERR_INI_SIZE:
	            die('The uploaded file exceeds the upload_max_filesize directive in php.ini.');
	            break;
	        case UPLOAD_ERR_FORM_SIZE:
	            die('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
	            break;
	        case UPLOAD_ERR_PARTIAL:
	            die('The uploaded file was only partially uploaded.');
	            break;
	        case UPLOAD_ERR_NO_FILE:
	            die('No file was uploaded.');
	            break;
	        case UPLOAD_ERR_NO_TMP_DIR:
	            die('The server is missing a temporary folder.');
	            break;
	        case UPLOAD_ERR_CANT_WRITE:
	            die('The server failed to write the uploaded file to disk.');
	            break;
	        case UPLOAD_ERR_EXTENSION:
	            die('File upload stopped by extension.');
	            break;
	        }
	    }
	    
	if ($udirectory == 24) { $dir ='../management/uploads/'; }
	if ($udirectory == 1 || $udirectory == 2 || $udirectory == 10 || $udirectory == 11 || $udirectory == 12 || $udirectory == 13 || $udirectory == 14 || $udirectory == 15 || $udirectory == 16 || $udirectory == 23) { $dir ='../bm/uploads/'; }
	if ($udirectory == 3 || $udirectory == 4 || $udirectory == 5 || $udirectory == 6 || $udirectory == 7 || $udirectory == 8 || $udirectory == 9 || $udirectory == 17 || $udirectory == 18 || $udirectory == 19 || $udirectory == 20 || $udirectory == 22) { $dir ='../sh/uploads/'; }
	$deletedFile = $dir . $fileName;
		
	unlink($deletedFile);
    mysql_query("UPDATE uploadedDocs SET fileName = '$updatefileName' 
    			WHERE udID = '$thisrow' ");
    
    move_uploaded_file($_FILES['fupload']['tmp_name'], $updatedir . $_FILES['fupload']['name']);
	}
	
	//insert information into table
	    mysql_query("UPDATE uploadedDocs SET displayName = '$updatedisplayName', ucomments = '$updatecomments', udirectory = '$dest', udate = '$inputdate' 
	    			WHERE udID = '$thisrow' ");
	
	echo '<p>The record has been updated.</p><p><a href = "../admin/">Return to the main page.</a></p>';

}

// Add a new record
if ($_POST['submit'] == 'Upload') {
	$db = mysql_connect($server, $username, $password) or die ('Unable to connect. Check your connection parameters.');
	mysql_select_db($dbase, $db) or die(mysql_error($db));

// get file info
	$fileName = $_FILES['fupload']['name'];
	$displayName = $_POST['fdisplayname'];
	$comments = $_POST['fcomments'];
	$date = $_POST['fdate'];
	$dest = $_POST['fdest'];

// change directory    
	if ($dest == 24)
	{ 
	chdir('../management/uploads');
	$updatedir = getcwd() . '/';
	}
	if ($dest == 1 || $dest == 2 || $dest == 10 || $dest == 11 || $dest == 12 || $dest == 13 || $dest == 14 || $dest == 15 || $dest == 16 || $dest == 23)
	{ 
	chdir('../bm/uploads');
	$updatedir = getcwd() . '/';
	}
	 if ($dest == 3 || $dest == 4 || $dest == 5 || $dest == 6 || $dest == 7 || $dest == 8 || $dest == 9 || $dest == 18 || $dest == 18 || $dest == 19 || $dest == 20 || $dest == 22)
	{chdir('../sh/uploads');
	$updatedir = getcwd() . '/';
	}
	

//check date
	$date = str_replace(array('\'', '/', '.', ',', ' '), '-', $date);
	if ($date == '') {$date = date('m-d-Y');} 
	$a_date = explode('-', $date);
		$month = $a_date[0];
		$day = $a_date[1];
		$year = $a_date[2];
	if (strlen($day)==1) { $day='0'.$day; }
	if (strlen($month)==1) { $month='0'.$month; }
	if (strlen($year)==2) { $year='20'.$year; }
	$inputdate =$year . '-' . $month . '-' . $day  ;
	if (!checkdate($month, $day, $year)) { die('You have entered an invalid date. Please click back and enter a valid date.'); }
	
// check title
	if ($displayName == '') { die('The "Title" field is blank. Please click back and enter the title of this file as you want it to appear on the page.'); }
	
// check the file upload
    if ($_FILES['fupload']['error'] != UPLOAD_ERR_OK)
    {
        switch ($_FILES['fupload']['error'])
        {
        case UPLOAD_ERR_INI_SIZE:
            die('The uploaded file exceeds the upload_max_filesize directive in php.ini.');
            break;
        case UPLOAD_ERR_FORM_SIZE:
            die('The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.');
            break;
        case UPLOAD_ERR_PARTIAL:
            die('The uploaded file was only partially uploaded.');
            break;
        case UPLOAD_ERR_NO_FILE:
            die('No file was uploaded.');
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            die('The server is missing a temporary folder.');
            break;
        case UPLOAD_ERR_CANT_WRITE:
            die('The server failed to write the uploaded file to disk.');
            break;
        case UPLOAD_ERR_EXTENSION:
            die('File upload stopped by extension.');
            break;
        }
    }
	
	if (file_exists($dir . $_FILES['fupload']['name']))
	{
	die($_FILES['fupload']['name'] . ' already exists. ');
	}
	
//insert information into image table
   $query = 'INSERT INTO uploadedDocs
        (displayName, fileName, ucomments, udirectory, udate)
    VALUES
        ("' . $displayName . '", "' . $fileName . '", "' . $comments . '", "' . $dest . '", "' . $inputdate . '")';

	$result = mysql_query($query, $db) or die (mysql_error($db));
	
	
	move_uploaded_file($_FILES['fupload']['tmp_name'],
	      $dir . $_FILES['fupload']['name']);
	echo '<p>The new Record was created.</p><p><a href="addnewfileform.php">Add another file.</a></p><p><a href = "../admin/">Return to the main page.</a></p>';
}
?>
</div><!-- end admin -->
</div><!-- end container -->
<?php include('../footer.php')?>
</div><!-- end div center -->
</body>
</html>