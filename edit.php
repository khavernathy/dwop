<?php session_start();
include("sessions.php");
include("connect-db.php"); 
include("client_selector.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - Edit Work Order</title>
</head>

<body class="edit">

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
print "<h2>Edit/View a Work Order</h2>";

if (!$_POST[radiosbutton] && !$_POST[client_selected])
{
	?>
	<!-- OPTION ONE: SELECT BY STATUS AND TIME RANGE -->
	<h3>Option one: Select Work order by Status and Time frame</h3>
	<form action="<?php $_SERVER[PHP_SELF] ?>" method="post">
	<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td>1. Select Work Order Status: </td>
		<td><input type="radio" name="status" value="Open"> Open</td>
		<td><input type="radio" name="status" value="Closed"> Closed</td>
		<td><input type="radio" name="status" value="All" checked> All</td>
	</tr>
	
	<tr>
		<td>2. Select Time frame: </td>
		<td><input type="radio" name="timeframe" value="past_week"> Past Week</td>
		<td><input type="radio" name="timeframe" value="past_two_weeks"> Past 2 Weeks</td>
	 	<td><input type="radio" name="timeframe" value="all" checked> All</td>
	</tr>
	</table>
	<input type="submit" name="radiosbutton" value="continue">
	</form>
	
	<p><strong>---OR---</strong></p>
	<!-- OPTION TWO: SELECT BY CLIENT -->
	
	<h3>Option Two: Select work order by Client</h3>
	<?php
		print "Select a client to edit a work order:";
		
		cSelect('continue', '');
		
		print "<br /><br />No client selected...<br />";
}
else if ($_POST[radiosbutton])// IF RADIOS OPTION IS USED
{
	$status = $_POST[status];
	$timeframe_sub = $_POST[timeframe];
	if ($timeframe_sub == "past_week") {$time_text = "past 7 days";}
	else if ($timeframe_sub == "past_two_weeks") {$time_text = "past 14 days";}
	else if ($timeframe_sub == "all") {$time_text = "all time";}
	
	if ($status == "All") // all work orders -- open and closed
	{
		if ($timeframe_sub == "past_week") {$timeframe = "WHERE order_date >= DATE_SUB(NOW() , INTERVAL 7 DAY)";}
		else if ($timeframe_sub == "past_two_weeks") {$timeframe = "WHERE order_date >= DATE_SUB(NOW() , INTERVAL 14 DAY)";}
		else {$timeframe = "";}
	
		print "Displaying All tickets...for $time_text.<br />";
		?>
		<form action="makeedits.php" method="post">
		<select name="workorder" size="24">
		<?php
		
		$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS $timeframe ORDER BY order_date DESC";
		$getworkordersquery = mysql_query($getworkorders, $mysqlconn) or die(mysql_error());
		
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
		print "</select><br /><input type=\"submit\" value=\"edit\">";
		?>
		</form>
		<form name="printlist" action="printlist.php" method="post" target="_blank">
		<input type="hidden" name="timeframe_toprint" value="<?php echo $timeframe_sub; ?>" />
		<input type="hidden" name="status_toprint" value="<?php echo $status; ?>" />
		<input type="submit" name="printlist" value="print this list" />
		</form>
		
		
	<?php
	}
	else if ($status == "Open")
	{
		if ($timeframe_sub == "past_week") {$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 7 DAY)";}
		else if ($timeframe_sub == "past_two_weeks") {$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 14 DAY)";}
		else {$timeframe = "";}
		
		print "Displaying Open tickets...for $time_text.<br />";
		?>
		<form action="makeedits.php" method="post">
		<select name="workorder" size="24">
		<?php
		
		$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS WHERE status = 'open' $timeframe ORDER BY order_date DESC";
		$getworkordersquery = mysql_query($getworkorders, $mysqlconn) or die(mysql_error());
		
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
		print "</select><br /><input type=\"submit\" value=\"edit\">";
		?>
		</form>
		<form name="printlist" action="printlist.php" method="post" target="_blank">
		<input type="hidden" name="timeframe_toprint" value="<?php echo $timeframe_sub; ?>" />
		<input type="hidden" name="status_toprint" value="<?php echo $status; ?>" />
		<input type="submit" name="printlist" value="print this list" />
		</form>
		
		
	<?php
	}
	else if ($status == "Closed")
	{
		if ($timeframe_sub == "past_week") {$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 7 DAY)";}
		else if ($timeframe_sub == "past_two_weeks") {$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 14 DAY)";}
		else {$timeframe = "";}
		
		print "Displaying Closed tickets...for $time_text.<br />";
		?>
		<form action="makeedits.php" method="post">
		<select name="workorder" size="24">
		<?php
		
		$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS WHERE status = 'closed' $timeframe ORDER BY order_date DESC";
		$getworkordersquery = mysql_query($getworkorders, $mysqlconn) or die(mysql_error());
		
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
		print "</select><br /><input type=\"submit\" value=\"edit\">";
		?>
		</form>
		<form name="printlist" action="printlist.php" method="post" target="_blank">
		<input type="hidden" name="timeframe_toprint" value="<?php echo $timeframe_sub; ?>" />
		<input type="hidden" name="status_toprint" value="<?php echo $status; ?>" />
		<input type="submit" name="printlist" value="print this list" />
		</form>
		
		
	<?php
	}
}
else if ($_POST[client_selected]) // IF BY-CLIENT OPTION IS USED
{
		$client_selected = $_POST[client_selected];
		
		$getname = "SELECT * FROM CLIENTS WHERE ID = '$client_selected'";
		$getnamequery = mysql_query($getname, $mysqlconn);
		while ($client_name = mysql_fetch_array($getnamequery))
		{ $name = $client_name['client']; }
		
		$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS WHERE client_id = '$client_selected' ORDER BY order_date DESC";
		$getworkordersquery = mysql_query($getworkorders, $mysqlconn) or die(mysql_error());
	
		print "<p>Work Orders for <strong>".$name."</strong></p>";
		
		$num_results = mysql_num_rows($getworkordersquery);
		if ($num_results == 0)
		{ echo 'This client does not have any work orders in the database.';}
		else
		{
			print "<form action=\"makeedits.php\" method=\"POST\">";
			echo '<select name="workorder" size="';
			if ($num_results < 12) {echo $num_results.'">';}
			else {echo '12">';}
			
			while ($clientarray = mysql_fetch_array($getworkordersquery)) 
			{
				$client = $clientarray['client'];
				$problem = $clientarray['problem'];
					if (strlen($problem) > 75)
					{ $problem = substr($problem, 0, 75)."..."; }
				$wo_num = $clientarray['wo_num'];
				$order_date = convertdate($clientarray['order_date'], 2);
			
				print "<option name=\"$wo_num\" value=\"$wo_num\">$order_date: #$wo_num - ($problem)</option>";
			}
		
			print "</select><br /><input type=\"submit\" value=\"edit this work order\"></form>";
		}	
}

?>

</body>
</html>