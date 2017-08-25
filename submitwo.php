<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - Work Order Submitted</title>
</head>

<body class="edit">

<?php 
include("connect-db.php");

// Write the date convert function
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
include("menu.php"); ?>

<h1>Results of form submission</h1>

<?php

if (isset($_POST[client])) {

	// set values
	$id = $_POST[id];
	$client = $_POST[client];
	$wo_num = $_POST[wo_num];
	$address = $_POST[address];
	$city = $_POST[city];
	$state = $_POST[state];
	$zip = $_POST[zip];
	$phone = $_POST[phone];
	$fax = $_POST[fax];
	$orig_inst_date = $_POST[orig_inst_date];
	$phone_sys_type = $_POST[phone_sys_type];
	$vm_sys_type = $_POST[vm_sys_type];
	$bronze_date = $_POST[bronze_date];
	$silver_date = $_POST[silver_date];
	$telco = $_POST[telco];
	$telco_date = $_POST[telco_date];
	$problem = mysql_real_escape_string($_POST[problem]);
	$order_date = convertdate($_POST[order_date], 1);
	$order_contact = mysql_real_escape_string($_POST[order_contact]);
	$notes = mysql_real_escape_string($_POST[notes]);
	$CPU_ver = $_POST[CPU_ver];
	$request_date = $_POST[request_date];
	$request_time = $_POST[request_time];
	$billing_notes = mysql_real_escape_string($_POST[billing_notes]);
	$work_description = mysql_real_escape_string($_POST[work_description]);
	$status = $_POST[status];
	
	// and also the parts costs, time, etc.
	$partno1 = $_POST[partno1]; $part1desc = $_POST[part1desc]; $part1qty = $_POST[part1qty]; $part1amount = $_POST[part1amount];
	$partno2 = $_POST[partno2]; $part2desc = $_POST[part2desc]; $part2qty = $_POST[part2qty]; $part2amount = $_POST[part2amount];
	$partno3 = $_POST[partno3]; $part3desc = $_POST[part3desc]; $part3qty = $_POST[part3qty]; $part3amount = $_POST[part3amount];
	$partno4 = $_POST[partno4]; $part4desc = $_POST[part4desc]; $part4qty = $_POST[part4qty]; $part4amount = $_POST[part4amount];
	$partno5 = $_POST[partno5]; $part5desc = $_POST[part5desc]; $part5qty = $_POST[part5qty]; $part5amount = $_POST[part5amount];
	$partno6 = $_POST[partno6]; $part6desc = $_POST[part6desc]; $part6qty = $_POST[part6qty]; $part6amount = $_POST[part6amount];
	$partno7 = $_POST[partno7]; $part7desc = $_POST[part7desc]; $part7qty = $_POST[part7qty]; $part7amount = $_POST[part7amount];
	$partno8 = $_POST[partno8]; $part8desc = $_POST[part8desc]; $part8qty = $_POST[part8qty]; $part8amount = $_POST[part8amount];
	$partno9 = $_POST[partno8]; $part9desc = $_POST[part9desc]; $part9qty = $_POST[part9qty]; $part9amount = $_POST[part9amount];
	$partno10 = $_POST[partno10]; $part10desc = $_POST[part10desc]; $part10qty = $_POST[part10qty]; $part10amount = $_POST[part10amount];
	$partno11 = $_POST[partno11]; $part11desc = $_POST[part11desc]; $part11qty = $_POST[part11qty]; $part11amount = $_POST[part11amount];
	
	$subtotal = $_POST[subtotal];
	$tax = $_POST[tax];
	$total = $_POST[total];
	
	$date1 = $_POST[date1]; $timein1 = $_POST[timein1]; $timeout1 = $_POST[timeout1]; $totaltime1 = $_POST[totaltime1];
	$date2 = $_POST[date2]; $timein2 = $_POST[timein2]; $timeout2 = $_POST[timeout2]; $totaltime2 = $_POST[totaltime2];
	$date3 = $_POST[date3]; $timein3 = $_POST[timein3]; $timeout3 = $_POST[timeout3]; $totaltime3 = $_POST[totaltime3];
	$date4 = $_POST[date4]; $timein4 = $_POST[timein4]; $timeout4 = $_POST[timeout4]; $totaltime4 = $_POST[totaltime4];
	
	$alltimetotal = $_POST[alltimetotal];
	$taxable = $_POST[taxable];
	
	$tech_comments = $_POST[tech_comments];
	$follow_up = $_POST[follow_up];
	$ticker = $_POST[ticker];
	
	
if (isset($_POST[wo_num])) { // IF this is a WORK ORDER (NOT JUST CLIENT ENTRY)	

// Checking if work order already exists

if (mysql_num_rows(mysql_query("SELECT client FROM CUSTOMER_WORK_ORDERS WHERE wo_num = '$wo_num'"))){

//SAVE BY REPLACING

$saveorder =
"REPLACE INTO CUSTOMER_WORK_ORDERS (`wo_num`,`client`, `client_id` ,`address` ,`city` ,`state` ,`zip` ,`phone` ,`fax` ,`orig_inst_date` ,`phone_sys_type` ,`vm_sys_type` ,`bronze_date` ,`silver_date` ,`telco` ,`telco_date` ,`problem` ,`order_date` ,`order_contact` ,`notes` ,`CPU_ver` ,`request_date` ,`request_time` ,`billing_notes`,`work_description`,`status`,
`partno1`,`part1desc`,`part1qty`,`part1amount`,
`partno2`,`part2desc`,`part2qty`,`part2amount`,
`partno3`,`part3desc`,`part3qty`,`part3amount`,
`partno4`,`part4desc`,`part4qty`,`part4amount`,
`partno5`,`part5desc`,`part5qty`,`part5amount`,
`partno6`,`part6desc`,`part6qty`,`part6amount`,
`partno7`,`part7desc`,`part7qty`,`part7amount`,
`partno8`,`part8desc`,`part8qty`,`part8amount`,
`partno9`,`part9desc`,`part9qty`,`part9amount`,
`partno10`,`part10desc`,`part10qty`,`part10amount`,
`partno11`,`part11desc`,`part11qty`,`part11amount`,
`subtotal`,`tax`,`total`,
`date1`,`timein1`,`timeout1`,`totaltime1`,
`date2`,`timein2`,`timeout2`,`totaltime2`,
`date3`,`timein3`,`timeout3`,`totaltime3`,
`date4`,`timein4`,`timeout4`,`totaltime4`,
`alltimetotal`,
`taxable`,
`tech_comments`,
`follow_up`,
`ticker`

)
VALUES (
'$wo_num','$client','$id', '$address', '$city', '$state', '$zip', '$phone', '$fax', '$orig_inst_date', '$phone_sys_type','$vm_sys_type', '$bronze_date', '$silver_date', '$telco', '$telco_date', '$problem', '$order_date', '$order_contact', '$notes', '$CPU_ver', '$request_date', '$request_time', '$billing_notes', '$work_description','$status',
'$partno1', '$part1desc', '$part1qty', '$part1amount',
'$partno2', '$part2desc', '$part2qty', '$part2amount',
'$partno3', '$part3desc', '$part3qty', '$part3amount',
'$partno4', '$part4desc', '$part4qty', '$part4amount',
'$partno5', '$part5desc', '$part5qty', '$part5amount',
'$partno6', '$part6desc', '$part6qty', '$part6amount',
'$partno7', '$part7desc', '$part7qty', '$part7amount',
'$partno8', '$part8desc', '$part8qty', '$part8amount',
'$partno9', '$part9desc', '$part9qty', '$part9amount',
'$partno10', '$part10desc', '$part10qty', '$part10amount',
'$partno11', '$part11desc', '$part11qty', '$part11amount',
'$subtotal', '$tax', '$total',
'$date1', '$timein1', '$timeout1', '$totaltime1',
'$date2', '$timein2', '$timeout2', '$totaltime2',
'$date3', '$timein3', '$timeout3', '$totaltime3',
'$date4', '$timein4', '$timeout4', '$totaltime4',
'$alltimetotal',
'$taxable',
'$tech_comments',
'$follow_up',
'$ticker'
);";  	 

} else { // SAVE BY INSERTING

$saveorder =
"INSERT INTO CUSTOMER_WORK_ORDERS (`wo_num`, `client`,`client_id`,`address` ,`city` ,`state` ,`zip` ,`phone` ,`fax` ,`orig_inst_date` ,`phone_sys_type` ,`vm_sys_type` ,`bronze_date` ,`silver_date` ,`telco` ,`telco_date` ,`problem` ,`order_date` ,`order_contact` ,`notes` ,`CPU_ver` ,`request_date` ,`request_time` ,`billing_notes`,`work_description`,`status`,
`partno1`,`part1desc`,`part1qty`,`part1amount`,
`partno2`,`part2desc`,`part2qty`,`part2amount`,
`partno3`,`part3desc`,`part3qty`,`part3amount`,
`partno4`,`part4desc`,`part4qty`,`part4amount`,
`partno5`,`part5desc`,`part5qty`,`part5amount`,
`partno6`,`part6desc`,`part6qty`,`part6amount`,
`partno7`,`part7desc`,`part7qty`,`part7amount`,
`partno8`,`part8desc`,`part8qty`,`part8amount`,
`partno9`,`part9desc`,`part9qty`,`part9amount`,
`partno10`,`part10desc`,`part10qty`,`part10amount`,
`partno11`,`part11desc`,`part11qty`,`part11amount`,
`subtotal`,`tax`,`total`,
`date1`,`timein1`,`timeout1`,`totaltime1`,
`date2`,`timein2`,`timeout2`,`totaltime2`,
`date3`,`timein3`,`timeout3`,`totaltime3`,
`date4`,`timein4`,`timeout4`,`totaltime4`,
`alltimetotal`,
`taxable`,
`tech_comments`,
`follow_up`,
`ticker`
)
VALUES (
'$wo_num','$client', '$id', '$address', '$city', '$state', '$zip', '$phone', '$fax', '$orig_inst_date', '$phone_sys_type','$vm_sys_type', '$bronze_date', '$silver_date', '$telco', '$telco_date', '$problem', '$order_date', '$order_contact', '$notes', '$CPU_ver', '$request_date', '$request_time', '$billing_notes', '$work_description','$status',
'$partno1', '$part1desc', '$part1qty', '$part1amount',
'$partno2', '$part2desc', '$part2qty', '$part2amount',
'$partno3', '$part3desc', '$part3qty', '$part3amount',
'$partno4', '$part4desc', '$part4qty', '$part4amount',
'$partno5', '$part5desc', '$part5qty', '$part5amount',
'$partno6', '$part6desc', '$part6qty', '$part6amount',
'$partno7', '$part7desc', '$part7qty', '$part7amount',
'$partno8', '$part8desc', '$part8qty', '$part8amount',
'$partno9', '$part9desc', '$part9qty', '$part9amount',
'$partno10', '$part10desc', '$part10qty', '$part10amount',
'$partno11', '$part11desc', '$part11qty', '$part11amount',
'$subtotal', '$tax', '$total',
'$date1', '$timein1', '$timeout1', '$totaltime1',
'$date2', '$timein2', '$timeout2', '$totaltime2',
'$date3', '$timein3', '$timeout3', '$totaltime3',
'$date4', '$timein4', '$timeout4', '$totaltime4',
'$alltimetotal',
'$taxable',
'$tech_comments',
'$follow_up',
'$ticker'
);";  	 

}

	$saveorderquery = mysql_query($saveorder, $mysqlconn) or die(mysql_error()); //the work order is saved..
} // DONE WITH 'IF IT'S A WORK ORDER'

	
	print "<form action=\"printview.php\" method=\"POST\" target=\"_blank\">";
	print "<input type=\"hidden\" name=\"wo_toprint\" value=\"$wo_num\">"; //save the WO NUM for printing a work order
	print "Work order #$wo_num saved for <strong>$client</strong>.";
	print "<br />";
	print "<input type=\"submit\" value=\"print\">";
	print "</form>"; 

} else {
  print "Client was not entered in form.";
}


?>


</body>
</html>
