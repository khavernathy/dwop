<?php session_start();
include("sessions.php");
include("connect-db.php"); 
include("client_selector.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - Create Work Order</title>
</head>

<body class="create">

<?php

include("menu.php");

print "<h2>Create a Work Order</h2>";
print "<strong>Select an <span style=\"color: red\">existing client</span> to create a work order:</strong>";
print "<br />Click in the box and <strong>begin typing the Customer</strong> to find it quickly...";

cSelect('select', '');

if (!isset($_POST[client_selected])) {
	print "Waiting for you to <span style=\"color: red\">select a client</span> <strong>or</strong> <a href=\"editcust.php\" class=\"nor\">create a new client</a>.<br />";
} else {

	$getname = "SELECT * FROM CLIENTS WHERE ID = '$_POST[client_selected]'";
		$getnamequery = mysql_query($getname, $mysqlconn);
		while ($client_name = mysql_fetch_array($getnamequery))
		{ $name = $client_name['client']; }
	print "<h1>Make a work order for <u>$name</u></h1>";
	include("workorderform.php");
}
?>


	




</body>
</html>