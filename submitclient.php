<?php include("connect-db.php"); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - Customer Edited</title>
</head>

<body class="editcust">

<?php include("menu.php"); ?>

<h1>Results of form submission</h1>

<?php

if (isset($_POST[client])) {
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
	$order_contact = $_POST[order_contact];
	$CPU_ver = $_POST[CPU_ver];
	$ticker = $_POST[ticker];
	$email = $_POST[email];
	
// IF CLIENT EXISTS

if (mysql_num_rows(mysql_query("SELECT client FROM CLIENTS WHERE ID = '$id'"))){

$saveclient =
"UPDATE CLIENTS SET `client` = '$client',`address` = '$address',`city` = '$city',`state` = '$state',`zip` = '$zip',`phone` = '$phone',
`fax` = '$fax',`orig_inst` = '$orig_inst_date',`phone_sys_type` = '$phone_sys_type',`vm_sys_type` = '$vm_sys_type',`bronze_date` = '$bronze_date',
`silver_date` = '$silver_date',`telco` = '$telco',`telco_date` = '$telco_date', `order_contact` = '$order_contact', `CPU_ver` = '$CPU_ver', `ticker` = '$ticker', `email` = '$email'
WHERE CONVERT( `CLIENTS`.`ID` USING utf8 ) = '$id' LIMIT 1 ;";


} else { //IF CLIENT DOESNT EXIST
 		
$saveclient =
"INSERT INTO CLIENTS (`ID`, `client` ,`address` ,`city` ,`state` ,`zip` ,`phone` ,`fax` ,`orig_inst` ,`telco` ,`phone_sys_type` ,`vm_sys_type` ,
`bronze_date` ,`silver_date` ,`telco_date` ,`order_contact`, `CPU_ver`, `ticker`, `email`)
VALUES (
'', '$client', '$address', '$city', '$state', '$zip', '$phone', '$fax', 
'$orig_inst_date', '$telco', '$phone_sys_type', '$vm_sys_type', 
'$bronze_date', '$silver_date', '$telco_date', '$order_contact', '$CPU_ver', '$ticker', '$email'
);";

}

	$saveclientquery = mysql_query($saveclient, $mysqlconn) or die(mysql_error()); //saved the client
	print "The customer <strong>$client</strong> was saved successfully.";

} else {
	print "No client selected...";
}
?>