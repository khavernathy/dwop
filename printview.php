<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - Work Order Print View</title>
	<link rel="stylesheet" type="text/css" href="css/printstyle.css">
<script language="Javascript1.2">
  
  window.onload = function() {window.print();}
  
</script>
</head>

<body>

<?php
include("connect-db.php");

function convertdate($date,$func) 
{
	if ($func == 1)
	{ //insert conversion to MySQL database FROM user input
	list($month, $day, $year) = split('[/.-]', $date);
	$date = "$year-$month-$day";
	return $date;
	}
	if ($func == 2)
	{ //output conversion to User FROM MySQL database
	list($year, $month, $day) = split('[-.]', $date);
	$date = "$month-$day-$year";
	return $date;
	}
}
// End date convert function

// We would only be on this page IF they have selected to print a work order... so GET THE DATA
// check if this is a customer following an invoice e-mail link, and get the Invoice # from that

if (isset($_POST['wo_toprint'])) {$wo_toprint = $_POST[wo_toprint];}
else if (isset($_GET['inv_no'])) {$wo_toprint = $_GET['inv_no'];}

$getworkorder = 
	"SELECT *
	FROM CUSTOMER_WORK_ORDERS
	WHERE wo_num = '$wo_toprint';";

	$getworkorderquery = mysql_query($getworkorder, $mysqlconn) or die(mysql_error());

	while ($wo_array = mysql_fetch_array($getworkorderquery)) {
		
		// normal values
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
		
		$tech_comments = $wo_array['tech_comments'];
		$follow_up = $wo_array['follow_up'];
		
	} // VARIABLES DEFINED. NOW MAKE THE PRINT VIEW

// Here goes the printable version

if ($wo_num != '')
{
	echo '<span style="font-weight: bold; font-size: 20px; top: 32px; left: 620px; position: absolute;">Inv. # <span style="font-size: 16px;">'.$wo_num.'</span></span>'; 
} ?>
<!-- first main row (the image)... -->
<table border="0" class="main">
<tr>
<td style="text-align: center; border-bottom: 1px solid black;">
<img src="assets/dtsilogo.png" />

</td>
</tr>
</table>

<!-- Second main row... -->
<table border="0" cellspacing="0" cellpadding="0" class="main">
<tr class="first"><td class="bold" width="100">Client:</td>
    <td class="normal" width="225"><?php echo $client ?></td>
    <td width="50"></td>
    <td width="110"></td>
    <td class="bold" width="135">Phone System Type:</td>
    <td class="normal"><?php echo $phone_sys_type ?></td>
</tr>

<tr class="first"><td class="bold" rowspan="2">Address:</td>
    <td rowspan="2" class="normal"><?php echo $address ?></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<tr class="first"><td class="bold">City:</td>
    <td class="normal"><?php echo $city ?></td>
    <td class="bold">V.M. System Type:</td>
    <td class="normal"><?php echo $vm_sys_type ?></td>
</tr>

<tr class="first"><td class="bold">State:</td>
    <td class="normal"><?php echo $state ?></td>
    <td class="bold">Zip:</td>
    <td class="normal"><?php echo $zip?></td>
    <td class="bold">Bronze Date:</td>
    <td class="normal"><?php echo $bronze_date ?></td>
</tr>

<tr class="first"><td class="bold">Phone:</td>
    <td class="normal"><?php echo $phone ?></td>
    <td class="bold">Fax:</td>
    <td class="normal"><?php echo $fax ?></td>
    <td class="bold">Silver Date:</td>
    <td class="normal"><?php echo $silver_date ?></td>
</tr>

<tr class="first" id="borderbottom"><td class="bold">Original Install date:</td>
    <td class="normal"><?php echo $orig_inst_date ?></td>
    <td class="bold">Telco:</td>
    <td class="normal"><?php echo $telco ?></td>
    <td class="bold">Telco date:</td>
    <td class="normal"><?php echo $telco_date ?></td>
</tr>

</table>
<!-- ENDED THAT TABLE, now third main row... -->

<table class="main" border="0" cellspacing="0" cellpadding="0">
<tr class="second"><td id="servorder" width="110">INVOICE #:</td>
    <td class="normal" width="130"><?php echo $wo_num ?></td>
    <td width="110"></td>
	<td width="95"></td>
    <td class="bold" width="110">Billing note:</td>
    <td class="normal"><?php echo $billing_notes ?></td>
</tr>

<tr class="second"><td class="bold">Order Date:</td>
    <td class="normal"><?php echo $order_date ?></td>
    <td class="bold">Request Date:</td>
    <td class="normal"><?php echo $request_date ?></td>
    <td class="bold">Request Time:</td>
    <td class="normal"><?php echo $request_time ?></td>
</tr>

<tr class="second"><td class="bold">Order Contact:</td>
    <td class="normal"><?php echo $order_contact ?></td>
    <td class="bold" rowspan="1">Problem:</td>
    <td rowspan="3" colspan="4"><?php echo $problem ?></td>
</tr>

<tr class="second"><td class="bold">Notes:</td>
    <td class="normal" colspan="2"><?php echo $notes ?></td>
</tr>

<tr class="second"><td class="bold">CPU Version:</td>
    <td class="normal"><?php echo $CPU_ver ?></td>
</tr>

</table>
<!-- fourth main row. PART #s, AMOUNTS, ETC-->

<table class="thickborder" cellspacing="0" cellpadding="0">

<tr class="boldital">
<td style="width: 1.2in;">Part #(s)</td>
<td style="width: 4.0in;">Equipment Description(s)</td>
<td style="width: 0.7in; text-align: center">Qty.</td>
<td style="width: 1.0in; text-align: center">Amount</td>
<td style="width: 1.0in; text-align: center">Total</td>
</tr>

<!-- 8 rows for parts-->
<tr height="17"><td><?php echo $partno1; ?></td><td><?php echo $part1desc; ?></td><td><?php echo (($part1qty==0)?'--':(float)$part1qty); ?></td><td><?php echo (($part1amount==0)?'--':$part1amount); ?></td><td><?php echo (($part1amount * $part1qty == 0)?'--':number_format(round(($part1amount * $part1qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno2; ?></td><td><?php echo $part2desc; ?></td><td><?php echo (($part2qty==0)?'--':(float)$part2qty); ?></td><td><?php echo (($part2amount==0)?'--':$part2amount); ?></td><td><?php echo (($part2amount * $part2qty == 0)?'--':number_format(round(($part2amount * $part2qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno3; ?></td><td><?php echo $part3desc; ?></td><td><?php echo (($part3qty==0)?'--':(float)$part3qty); ?></td><td><?php echo (($part3amount==0)?'--':$part3amount); ?></td><td><?php echo (($part3amount * $part3qty == 0)?'--':number_format(round(($part3amount * $part3qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno4; ?></td><td><?php echo $part4desc; ?></td><td><?php echo (($part4qty==0)?'--':(float)$part4qty); ?></td><td><?php echo (($part4amount==0)?'--':$part4amount); ?></td><td><?php echo (($part4amount * $part4qty == 0)?'--':number_format(round(($part4amount * $part4qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno5; ?></td><td><?php echo $part5desc; ?></td><td><?php echo (($part5qty==0)?'--':(float)$part5qty); ?></td><td><?php echo (($part5amount==0)?'--':$part5amount); ?></td><td><?php echo (($part5amount * $part5qty == 0)?'--':number_format(round(($part5amount * $part5qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno6; ?></td><td><?php echo $part6desc; ?></td><td><?php echo (($part6qty==0)?'--':(float)$part6qty); ?></td><td><?php echo (($part6amount==0)?'--':$part6amount); ?></td><td><?php echo (($part6amount * $part6qty == 0)?'--':number_format(round(($part6amount * $part6qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno7; ?></td><td><?php echo $part7desc; ?></td><td><?php echo (($part7qty==0)?'--':(float)$part7qty); ?></td><td><?php echo (($part7amount==0)?'--':$part7amount); ?></td><td><?php echo (($part7amount * $part7qty == 0)?'--':number_format(round(($part7amount * $part7qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno8; ?></td><td><?php echo $part8desc; ?></td><td><?php echo (($part8qty==0)?'--':(float)$part8qty); ?></td><td><?php echo (($part8amount==0)?'--':$part8amount); ?></td><td><?php echo (($part8amount * $part8qty == 0)?'--':number_format(round(($part8amount * $part8qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno9; ?></td><td><?php echo $part9desc; ?></td><td><?php echo (($part9qty==0)?'--':(float)$part9qty); ?></td><td><?php echo (($part9amount==0)?'--':$part9amount); ?></td><td><?php echo (($part9amount * $part9qty == 0)?'--':number_format(round(($part9amount * $part9qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno10; ?></td><td><?php echo $part10desc; ?></td><td><?php echo (($part10qty==0)?'--':(float)$part10qty); ?></td><td><?php echo (($part10amount==0)?'--':$part10amount); ?></td><td><?php echo (($part10amount * $part10qty == 0)?'--':number_format(round(($part10amount * $part10qty),2),2)); ?></td></tr>
<tr height="17"><td><?php echo $partno11; ?></td><td><?php echo $part11desc; ?></td><td><?php echo (($part11qty==0)?'--':(float)$part11qty); ?></td><td><?php echo (($part11amount==0)?'--':$part11amount); ?></td><td><?php echo (($part11amount * $part11qty == 0)?'--':number_format(round(($part11amount * $part11qty),2),2)); ?></td></tr>

<tr height="25">
    <td style="border:none; text-align: right; vertical-align: top; padding-right: 4px" colspan="2">
    <p style="float: left; text-align: left; margin: 0px;"><span style="font-style: italic; border: 2px solid black; padding 2px; margin: 0px;">TECH COMMENTS:&nbsp;</span>
	<span style="color: #007700;"><?php echo wordwrap($tech_comments, 60); ?></span>
	</p>
    </td>
	
    <td colspan="2" style="border-bottom: 1px solid black">
    </td>
</tr>

<tr height="25">
    <td style="border: none; text-align: right; padding-right: 4px" colspan="2">
    Sub Total
    </td>
	
    <td colspan="2" style="border-bottom: 1px solid black">
	<?php echo $subtotal; ?>
    </td>
</tr>

<tr height="25">
    <td style="border: none; text-align: right; padding-right: 4px" colspan="2">
    Tax
    </td>
	
    <td colspan="2">
	<?php echo $tax; ?>
    </td>
</tr>

<tr height="25">
    <td style="border: none; text-align: right; padding-right: 4px" colspan="2">
    Total
    </td>
	
    <td colspan="2">
	<?php echo $total; ?>
    </td>
</tr>
</table>

<!-- END OF WRITTEN PART 1 -->

<p style="font-weight: bold; padding: 4px 0px 4px 14px; margin: 0px">  * FOLLOW-UP (if needed): <span style="color: red"><?php echo $follow_up; ?></span></p>

<!-- BEGIN WORK DESCRIPTION TABLE -->

<?php
if (empty($work_description)) { // IF WORK DESCRIPTION IS EMPTY, MAKE THE HANDWRITING TABLE
?>

<table class="thickborder" cellpadding="0">
<tr height="20">
  <td style="font-weight: bold; font-style: italic">WORK DESCRIPTION:</td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
<tr height="20">
  <td></td>
</tr>
</table>

<?php
} else { // IF WORK DESCRIPTION HAS A VALUE
?>

<table class="thickborder" cellpadding="0">
<tr><td style="font-style: italic">WORK DESCRIPTION</td></tr>
<tr>
<td><?php echo $work_description ?></td>
</tr>
</table>

<?php
}
?>

<!-- FOR THE TIME CLOCK AND SIGS -->

<table style="width: 8.0in">

<tr style="width: 8.0in">
	<td><table class="thickborder_s" cellpadding="0">
	<tr style="text-align: center">
		<td>Date</td>
		<td>Time In</td>
		<td>Time Out</td>
		<td>Total Time</td>
	</tr>

	<!-- FOUR ROWS FOR TIME LOG -->

	<tr height="15"><td><?php echo $date1; ?></td><td><?php echo $timein1; ?></td><td><?php echo $timeout1; ?></td><td><?php echo $totaltime1; ?></td></tr>
	<tr height="15"><td><?php echo $date2; ?></td><td><?php echo $timein2; ?></td><td><?php echo $timeout2; ?></td><td><?php echo $totaltime2; ?></td></tr>
	<tr height="15"><td><?php echo $date3; ?></td><td><?php echo $timein3; ?></td><td><?php echo $timeout3; ?></td><td><?php echo $totaltime3; ?></td></tr>
	<tr height="15"><td><?php echo $date4; ?></td><td><?php echo $timein4; ?></td><td><?php echo $timeout4; ?></td><td><?php echo $totaltime4; ?></td></tr>

	<tr>
		<td colspan="2">Standard minimum</td>
		<td style="text-align: center">1 Hour</td>
		<td></td>
	</tr>

	<tr>
		<td colspan="2"></td>
		<td style="text-align: center">Total</td>
		<td><?php echo $alltimetotal; ?></td>
	</tr>
	</table></td>
  

  <td><table>
    <tr>
	<td>
	<p class="sigs">TECH. OR REP. (PRINT):</p>
	<p class="sigs">________________________________________________</p>
	<p class="sigs">CUSTOMER SIGNATURE / APPROVAL ALL WORK
	VERIFIED AND COMPLETED:</p>
	<p class="sigs">________________________________________________</p>
	<p class="sigs">CUSTOMER PRINTED NAME</p>
	<p class="sigs">________________________________________________</p>
	</td>
	</tr>
  </table></td>
</tr>
</table>

<!-- FINALLY THE FOOTNOTE -->

<table style="width: 8.0in" cellpadding="0" border="0">
<tr><td>

<p id="footnote" style="padding: 0px; margin: 0px;">36181 East Lake Rd.  Suite 260 Palm Harbor, Fl. 34685 - Ph. 727-451-4545, Fax 727-451-4545<br /><span style="color: #005a00; font-weight: bolder; font-size: 19px;">This is your invoice</span></p>
</td></tr>
</table>


<!-- ENDING PRINTABLE WORK ORDER -->
</table>
<br />


</body>
</html>