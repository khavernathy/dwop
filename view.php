<?php session_start();
include("sessions.php");
include("connect-db.php"); 
include("client_selector.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - View and Print Work Order</title>
</head>

<body class="view">

<?php
function convertdate($date,$func) 
{
	if ($func == 1)
	{ //insert conversion to MySQL database
	list($month, $day, $year) = split('[/.-]', $date);
	$date = "$year-$month-$day";
	return $date;
	}
	if ($func == 2)
	{ //output conversion to User
	list($year, $month, $day) = split('[-.]', $date);
	$date = "$month-$day-$year";
	return $date;
	}
}
// End date convert function


if (!isset($_POST[wo_toprint])) { // if a work order has NOT been selected by clicking 'print' after saving it
// let 'em pick one

include("menu.php");

//print "<strong>IMPORTANT: The Print View functionality is undergoing repairs... don't try to print a work order now.</strong><br />";

print "<h2>Print a Work Order</h2>";
print "Select a client to view and/or print a work order:";

cSelect('continue', '');

if (isset($_POST[client_selected])) { // if client is picked, get the work orders for it
	$client_selected = $_POST[client_selected];
	$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS WHERE client_id = '$client_selected' ORDER BY order_date DESC";
	$getworkordersquery = mysql_query($getworkorders, $mysqlconn) or die(mysql_error());

	$getname = "SELECT * FROM CLIENTS WHERE ID = '$client_selected'";
		$getnamequery = mysql_query($getname, $mysqlconn);
		while ($client_name = mysql_fetch_array($getnamequery))
		{ $name = $client_name['client']; }
	print "<p>Work orders for <strong>$name</strong></p>";

	print "<form action=\"printview.php\" method=\"POST\" target=\"_blank\">";
	print "<select name=\"wo_toprint\">";
	
	while ($clientarray = mysql_fetch_array($getworkordersquery))
		{
		$client = $clientarray['client'];
		$problem = $clientarray['problem'];
			if (strlen($problem) > 75)
			{ $problem = substr($problem, 0, 75)."..."; }
		$wo_num = $clientarray['wo_num'];
		$order_date = convertdate($clientarray['order_date'], 2);
	
		print "<option name=\"$wo_num\" value=\"$wo_num\">$order_date: #$wo_num - $client ($problem)</option>";
		}
	print "</select><br /><input type=\"submit\" value=\"view/print selected work order\"></form>";

} else {
	print "No client selected...Do you want to print a <a href=\"printviewblank.php\" class=\"nor\" target=\"_blank\">blank order</a>?<br />";

} 

} // END what happens when they didn't select 'print' beforehand

else { //If a work order HAS BEEN SELECTED by clicking 'print' after saving...

	$wo_toprint = $_POST[wo_toprint];
	include("printview.php");
}



?>

</body>
</html>