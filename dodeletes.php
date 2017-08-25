<?php session_start();
include("sessions.php");
include("connect-db.php");
include("client_selector.php");
?>
<html>
<head>
<title>DTSIwop - Delete an Entry</title>
</head>

<body class="delete">

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

include("menu.php");

if ($_SESSION[del_access] == "yes")
{

		// Give the options
			print "<h3>MAKE SURE YOU WANT TO DELETE A RECORD BEFORE DELETING IT.</h3>";
			print "<form action=\"$_SERVER[PHP_SELF]\" method=\"POST\">";
			print "Select to delete a client or work order: ";
			print "<select name=\"clientorwo\">";
			print "<option value=\"client\">Client</option>";
			print "<option value=\"work_order\">Work Order</option>";
			print "</select>";
			print "<input type=\"submit\" value=\"continue\"></form><br />";
		
		if (isset($_POST[clientorwo])) { // If they've chosen client or work order
		
		
			if ($_POST[clientorwo] == "client") { // For client
		
			$getclientsquery = "SELECT * FROM CLIENTS ORDER BY client";
			$getclients = mysql_query($getclientsquery, $mysqlconn) or die(mysql_error());
			print "Here's the client list...<br />";
			
			cSelect('delete this client', 'delclient.php');
			
			} elseif ($_POST[clientorwo] == "work_order") { // for work order
			
			$getwosquery = "SELECT * FROM CUSTOMER_WORK_ORDERS ORDER BY order_date DESC";
			$getwos = mysql_query($getwosquery, $mysqlconn) or die(mysql_error());
			print "Here's the work order list...<br />";
			print "<form action=\"delwo.php\" method=\"POST\">";
			print "<select name=\"wo_selected\">";
		
		
				while ($wosarray = (mysql_fetch_array($getwos))) {
				$wo_num = $wosarray['wo_num'];
				$client = $wosarray['client'];
				$order_date = convertdate($wosarray['order_date'], 2);
		
				echo "<option name=\"wo_num\" value=\"$wo_num\">";
				echo "$order_date: #$wo_num - $client";
				echo "</option>";
				}
		
			print "</select><input type=\"submit\" value=\"delete this work order\"></form>";
		
			} else {
			
				print "Nothing selected yet...";
			}
		
		
		} else {
			print "Make a selection...<br />";
		}
}
else
{
	print "You don't have access to this page. You must enter the deletion password first <a href=\"deleteentry.php\">here</a>.";
}
?>
</body>
</html>