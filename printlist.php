<?php session_start();
include("sessions.php");
include("connect-db.php"); 
if (!isset($_POST[timeframe_toprint]) && !isset($_POST[status_toprint]))
{
	header("Location: edit.php");
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Printing Work Order List</title>
<style type="text/css">

body {font-family: sans-serif, Arial, times;}

</style>
</head>

<body onload="window.print();">
<?php
// define date convert function
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

// define variables
$status = $_POST[status_toprint];

if ($status == "All")
{
	if ($_POST[timeframe_toprint] == 'all')
	{$timeframe = "";
	 $timetext = 'all time.';}
	elseif ($_POST[timeframe_toprint] == 'past_week')
	{$timeframe = "WHERE order_date >= DATE_SUB(NOW() , INTERVAL 7 DAY)";
	 $timetext = 'the past week.';}
	elseif ($_POST[timeframe_toprint] == 'past_two_weeks')
	{$timeframe = "WHERE order_date >= DATE_SUB(NOW() , INTERVAL 14 DAY)";
	 $timetext = 'the past two weeks.';}
}

elseif ($status == "Open")
{
	if ($_POST[timeframe_toprint] == 'all')
	{$timeframe = "";
	 $timetext = 'all time.';}
	elseif ($_POST[timeframe_toprint] == 'past_week')
	{$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 7 DAY)";
	 $timetext = 'the past week.';}
	elseif ($_POST[timeframe_toprint] == 'past_two_weeks')
	{$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 14 DAY)";
	 $timetext = 'the past two weeks.';}
}

elseif ($status == "Closed")
{
	if ($_POST[timeframe_toprint] == 'all')
	{$timeframe = "";
	 $timetext = 'all time.';}
	elseif ($_POST[timeframe_toprint] == 'past_week')
	{$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 7 DAY)";
	 $timetext = 'the past week.';}
	elseif ($_POST[timeframe_toprint] == 'past_two_weeks')
	{$timeframe = "AND order_date >= DATE_SUB(NOW() , INTERVAL 14 DAY)";
	 $timetext = 'the past two weeks.';}
}

$curr_timedate = date('l jS \of F Y h:i:s A');
$status = strtolower($status);
// variables done

//begin list of work orders from selection
print "<h2>List of <u>".$status."</u> work orders for <u>".$timetext."</u></h2>";
print "<h3>Report generated on ".$curr_timedate."</h3>";
print "<hr />";
print "<ul>";

		//get MySQL data
		if ($status == 'all')
		{
			$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS $timeframe ORDER BY order_date DESC";
		}
		else
		{
			$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS WHERE status = '$status' $timeframe ORDER BY order_date DESC";
		}
		$getworkordersquery = mysql_query($getworkorders, $mysqlconn) or die(mysql_error());
		
		$count = 0;
		while ($clientarray = mysql_fetch_array($getworkordersquery))
		{
		$client = $clientarray['client'];
		$wo_num = $clientarray['wo_num'];
		$order_date = convertdate($clientarray['order_date'], 2);
		
		print "<li>$order_date: #$wo_num - $client </li>";
		$count++;
		}
		
print "</ul>"; 

print "<br />$count work orders listed.";
		
?>
</body>
</html>
