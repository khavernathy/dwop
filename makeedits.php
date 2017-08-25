<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - Editing Work Order</title>
</head>

<body class="edit">

<?php
include("connect-db.php");
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
print "<br />";

if (!isset($_POST[workorder])) {
	print "No work order selected...<br />";
} else { // if they have picked a workorder
	
	$workorder = $_POST[workorder]; // equivalent to the work order number
	
	//now we retrieve the work order's data for the form
	print "<p>&raquo;Editing Invoice <b>#$workorder</b></p>";

	$getworkorder = 
	"SELECT *
	FROM CUSTOMER_WORK_ORDERS
	WHERE wo_num = '$workorder';";

	$getworkorderquery = mysql_query($getworkorder, $mysqlconn) or die(mysql_error());

	while ($wo_array = mysql_fetch_array($getworkorderquery)) {
		
		// normal values
		$wo_num = $wo_array['wo_num'];
		$client = $wo_array['client'];
		$id = $wo_array['client_id'];
		$address = $wo_array['address'];
		$city = $wo_array['city'];
		$state = $wo_array['state'];
		$zip = $wo_array['zip'];
		$phone = $wo_array['phone'];
		$fax = $wo_array['fax'];
		$phone_sys_type = $wo_array['phone_sys_type'];
		$vm_sys_type = $wo_array['vm_sys_type'];
		$bronze_date = $wo_array['bronze_date'];
		$silver_date = $wo_array['silver_date'];
		$orig_inst_date = $wo_array['orig_inst_date'];	
		$telco = $wo_array['telco'];
		$telco_date = $wo_array['telco_date'];
		$problem = $wo_array['problem'];
		$order_date = convertdate($wo_array['order_date'], 2);
		$order_contact = $wo_array['order_contact'];
		$notes = $wo_array['notes'];
		$CPU_ver = $wo_array['CPU_ver'];
		$request_date = $wo_array['request_date'];
		$request_time = $wo_array['request_time'];
		$billing_notes = $wo_array['billing_notes'];
		$work_description = $wo_array['work_description'];
		$status = $wo_array['status'];
		
		// parts, costs, time logs
		$partno1 = $wo_array['partno1']; $part1desc = $wo_array['part1desc']; $part1qty = $wo_array['part1qty']; $part1amount = $wo_array['part1amount'];	
		$partno2 = $wo_array['partno2']; $part2desc = $wo_array['part2desc']; $part2qty = $wo_array['part2qty']; $part2amount = $wo_array['part2amount'];
		$partno3 = $wo_array['partno3']; $part3desc = $wo_array['part3desc']; $part3qty = $wo_array['part3qty']; $part3amount = $wo_array['part3amount'];
		$partno4 = $wo_array['partno4']; $part4desc = $wo_array['part4desc']; $part4qty = $wo_array['part4qty']; $part4amount = $wo_array['part4amount'];
		$partno5 = $wo_array['partno5']; $part5desc = $wo_array['part5desc']; $part5qty = $wo_array['part5qty']; $part5amount = $wo_array['part5amount'];
		$partno6 = $wo_array['partno6']; $part6desc = $wo_array['part6desc']; $part6qty = $wo_array['part6qty']; $part6amount = $wo_array['part6amount'];
		$partno7 = $wo_array['partno7']; $part7desc = $wo_array['part7desc']; $part7qty = $wo_array['part7qty']; $part7amount = $wo_array['part7amount'];
		$partno8 = $wo_array['partno8']; $part8desc = $wo_array['part8desc']; $part8qty = $wo_array['part8qty']; $part8amount = $wo_array['part8amount'];
		$partno9 = $wo_array['partno9']; $part9desc = $wo_array['part9desc']; $part9qty = $wo_array['part9qty']; $part9amount = $wo_array['part9amount'];
		$partno10 = $wo_array['partno10']; $part10desc = $wo_array['part10desc']; $part10qty = $wo_array['part10qty']; $part10amount = $wo_array['part10amount'];
		$partno11 = $wo_array['partno11']; $part11desc = $wo_array['part11desc']; $part11qty = $wo_array['part11qty']; $part11amount = $wo_array['part11amount'];
		
		$subtotal = $wo_array['subtotal'];
		$tax = $wo_array['tax'];
		$total = $wo_array['total'];
		
		$date1 = $wo_array['date1']; $timein1 = $wo_array['timein1']; $timeout1 = $wo_array['timeout1']; $totaltime1 = $wo_array['totaltime1'];
		$date2 = $wo_array['date2']; $timein2 = $wo_array['timein2']; $timeout2 = $wo_array['timeout2']; $totaltime2 = $wo_array['totaltime2'];
		$date3 = $wo_array['date3']; $timein3 = $wo_array['timein3']; $timeout3 = $wo_array['timeout3']; $totaltime3 = $wo_array['totaltime3'];
		$date4 = $wo_array['date4']; $timein4 = $wo_array['timein4']; $timeout4 = $wo_array['timeout4']; $totaltime4 = $wo_array['totaltime4'];
		
		$alltimetotal = $wo_array['alltimetotal'];
		$taxable = $wo_array['taxable'];
		
		$tech_comments = $wo_array['tech_comments'];
		$follow_up = $wo_array['follow_up'];
		$ticker = $wo_array['ticker'];
	}


	include("workorderform.php");
}
	
?>


</body>
</html>