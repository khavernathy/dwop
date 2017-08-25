<?php include("connect-db.php"); ?>
<html>
<head>
<title>DTSIwop - Delete Work Order</title>
</head>

<body class="delete">

<?php

include("menu.php");
print "<br /><br />";

if (isset($_POST[wo_selected])) {

// FIRST SAVE IT TO THE BACKUP TABLE 'BACKUP'

$wo_selected = $_POST[wo_selected];

$getworkorder = 
	"SELECT *
	FROM CUSTOMER_WORK_ORDERS
	WHERE wo_num = '$wo_selected';";

	$getworkorderquery = mysql_query($getworkorder, $mysqlconn) or die(mysql_error());

	while ($wo_array = mysql_fetch_array($getworkorderquery)) {
		
		$wo_num = $wo_array['wo_num'];
		$client = $wo_array['client'];
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
		$order_date = $wo_array['order_date'];
		$order_contact = $wo_array['order_contact'];
		$notes = $wo_array['notes'];
		$CPU_ver = $wo_array['CPU_ver'];
		$request_date = $wo_array['request_date'];
		$request_time = $wo_array['request_time'];
		$billing_notes = $wo_array['billing_notes'];
		$work_description = $wo_array['work_description'];
		$status = $wo_array['status'];
		
	}

	$savewotobackup = "INSERT INTO BACKUP values('$wo_num','$client','$address','$city','$state','$zip','$phone','$fax','$phone_sys_type',
				'$vm_sys_type','$bronze_date','$silver_date','$orig_inst_date','$telco','$telco_date','$problem','$order_date',
				'$order_contact','$notes','$CPU_ver','$request_date','$request_time','$billing_notes','$work_description','$status');";
	$savewotobackupquery = mysql_query($savewotobackup, $mysqlconn) or die(mysql_error());

// NOW WE CAN DELETE IT FROM THE MAIN ARCHIVE
 
	$delwo = "DELETE FROM CUSTOMER_WORK_ORDERS WHERE wo_num = '$wo_selected'";
	$delwoquery = mysql_query($delwo, $mysqlconn) or die(mysql_error());

	print "The work order, <strong>#$wo_selected</strong>, was deleted.";


} else { 
	print "No work order selected...";
}





?>

</body>
</html>