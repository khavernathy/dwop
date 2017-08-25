<?php session_start();
include("sessions.php");
include("connect-db.php"); 
include("client_selector.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - Edit Customer Information</title>
</head>

<body class="editcust">

<?php

include("menu.php");

print "<h2>Manage Customers</h2>";
print "Select a client to continue:";

cSelect('edit client info', '');

if (!isset($_POST[client_selected])) {
	print "Or create a new one below:<br />";
	include("editcustform.php");
} else {
	$getname = "SELECT * FROM CLIENTS WHERE ID = '$_POST[client_selected]'";
		$getnamequery = mysql_query($getname, $mysqlconn);
		while ($client_name = mysql_fetch_array($getnamequery))
		{ $name = $client_name['client']; }
	print "<h1>Editing customer <u>$name</u></h1>";
	include("editcustform.php");
}
?>


	




</body>
</html>