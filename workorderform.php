<?php include("connect-db.php"); ?>

<link rel="stylesheet" type="text/css" href="css/wostyle.css">
<script type="text/javascript" language="javascript" src="assets/jquery.js"></script>

<?php
// Begin making select elements function
function makeSelect($inorout, $x)
{
	global ${'time'.$inorout.$x}; // must global the variable to make it usable in this function!!!

	$it = 'time'.$inorout.$x;
	if ($inorout == "in")
		{print "<select name='timein$x' id='timein$x'>";}
	elseif ($inorout == "out")
		{print "<select name='timeout$x' id='timeout$x'>";}
	
	if (${$it} == '') {print  "<option value='' selected=\"selected\"></option>";}
	else {print  "<option value=''></option>";}	
	
		for ($h = 6; $h <= 22; $h++)
		{
			if (${$it} == "$h:00") {print  "<option value='$h:00' selected=\"selected\">$h:00</option>";}
			else { print  "<option value='$h:00'>$h:00</option>";}
	
			if (${$it} == "$h:15") {print  "<option value='$h:15' selected=\"selected\">$h:15</option>";}
			else { print  "<option value='$h:15'>$h:15</option>"; }
	
			if (${$it} == "$h:30") {print  "<option value='$h:30' selected=\"selected\">$h:30</option>";}
			else { print  "<option value='$h:30'>$h:30</option>"; }
	
			if (${$it} == "$h:45") {print  "<option value='$h:45' selected=\"selected\">$h:45</option>";}
			else { print  "<option value='$h:45'>$h:45</option>"; }
		}
		if (${$it} == "23:00") {print  "<option value='23:00' selected=\"selected\">23:00</option>";}
		else {print  "<option value='23:00'>23:00</option>"; }
	
		if (${$it} == "23:15") {print  "<option value='23:15' selected=\"selected\">23:15</option>";}
		else {print  "<option value='23:15'>23:15</option>"; }
	
		if (${$it} == "23:30") {print  "<option value='23:30' selected=\"selected\">23:30</option>";}
		else {print  "<option value='23:30'>23:30</option>"; }
		
	print  "</select>";
}
// End function for making select elements

$client_selected = $_POST[client_selected];

// Let's get the client_selected contents

if (isset($_POST[client_selected])) { // if they're making a new one. They only selected a client to create a new work order for

$getclientsquery = "SELECT * FROM CLIENTS where ID = '$client_selected'";
$getclients = mysql_query($getclientsquery, $mysqlconn) or die(mysql_error());

	while ($clientsarray = (mysql_fetch_array($getclients))) {
	$id = $clientsarray['ID']; // This is important
	$client = $clientsarray['client'];
	$address = $clientsarray['address'];
	$city = $clientsarray['city'];
	$state = $clientsarray['state'];
	$zip = $clientsarray['zip'];
	$phone = $clientsarray['phone'];
	$fax = $clientsarray['fax'];
	$orig_inst_date = $clientsarray['orig_inst'];
	$telco = $clientsarray['telco'];
	$phone_sys_type = $clientsarray['phone_sys_type'];
	$vm_sys_type = $clientsarray['vm_sys_type'];
	$bronze_date = $clientsarray['bronze_date'];
	$silver_date = $clientsarray['silver_date'];
	$telco_date = $clientsarray['telco_date'];
	$order_contact = $clientsarray['order_contact'];
	$ticker = $clientsarray['ticker'];
	$CPU_ver = $clientsarray['CPU_ver'];

	}

} else { // if they're editing an old one. They selected a specific work order.
	//..the variables are already set including $id
}


// Here goes the form!

?>

<!-- first main row (the image)... --><div id="testzone"></div>

<form action="submitwo.php" method="POST" name="workorderform" id="workorderform">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table border="0" style="width: 1050px;">
<tr><td style="text-align: center; border-bottom: 1px solid black; position: relative;" colspan="6">
<img src="assets/dtsilogo.png" />
</td>
</tr>

<!-- Second main row... -->

<tr class="first"><td>Client:</td>
    <td><input type="text" name="client" readonly="readonly" style="background-color: #dddddd;" value="<?php echo $client ?>"></td>
    <td>Ticker:</td>
    <td><input type="text" name="ticker" readonly="readonly" style="background-color: #dddddd;" value="<?php echo $ticker ?>" /></td>
    <td>Phone System Type:</td>
    <td><input type="text" name="phone_sys_type" value="<?php echo $phone_sys_type ?>"></td>
</tr>

<tr class="first"><td rowspan="2">Address:</td>
    <td rowspan="2"><textarea style="border: 1px solid black" name="address" rows="2"><?php echo $address ?></textarea></td>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
</tr>

<tr class="first"><td>City:</td>
    <td><input type="text" name="city" value="<?php echo $city ?>"></td>
    <td>V.M. System Type:</td>
    <td><input type="text" name="vm_sys_type" value="<?php echo $vm_sys_type ?>"></td>
</tr>

<tr class="first"><td>State:</td>
    <td><input type="text" name="state" value="<?php echo $state ?>"></td>
    <td>Zip:</td>
    <td><input type="text" name="zip" value="<?php echo $zip ?>">
    <td>Bronze Date:</td>
    <td><input type="text" name="bronze_date" value="<?php echo $bronze_date ?>"></td>
</tr>

<tr class="first"><td>Phone:</td>
    <td><input type="text" name="phone" value="<?php echo $phone ?>"></td>
    <td>Fax:</td>
    <td><input type="text" name="fax" value="<?php echo $fax ?>"></td>
    <td>Silver Date:</td>
    <td><input type="text" name="silver_date" value="<?php echo $silver_date ?>"></td>
</tr>

<tr class="first" id="borderbottom"><td>Original Installation date:</td>
    <td><input type="text" name="orig_inst_date" value="<?php echo $orig_inst_date ?>"></td>
    <td>Telco:</td>
    <td><input type="text" name="telco" value="<?php echo $telco ?>"></td>
    <td>Telco date:</td>
    <td><input type="text" name="telco_date" value="<?php echo $telco_date ?>"></td>
</tr>

<!-- third main row... -->

<tr class="second"><td id="servorder">INVOICE #:</td>
    <td><input id="son" type="text" name="wo_num" value="<?php echo $wo_num ?>"></td>
    <td></td>
    <td></td>
    <td>Billing note:</td>
    <td><input type="text" name="billing_notes" value="<?php echo $billing_notes ?>"></td>
</tr>

<tr class="second"><td>Order Date:</td>
    <td><input type="text" name="order_date" value="<?php echo $order_date ?>"></td>
    <td>Service Request Date:</td>
    <td><input type="text" name="request_date" value="<?php echo $request_date ?>"></td>
    <td>Service Time:</td>
    <td><input type="text" name="request_time" value="<?php echo $request_time ?>"></td>
</tr>

<tr class="second"><td>Order Contact:</td>
    <td><input type="text" name="order_contact" value="<?php echo $order_contact ?>"></td>
    <td rowspan="3">Problem:</td>
    <td rowspan="3" colspan="2" style="text-align: left"><textarea maxlength="300" name="problem" id="pb"><?php echo $problem ?></textarea></td>
</tr>

<tr class="second"><td>Notes:</td>
    <td><input type="text" name="notes" value="<?php echo $notes ?>"></td>
</tr>

<tr class="second"><td>CPU Version:</td>
    <td><input type="text" name="CPU_ver" value="<?php echo $CPU_ver ?>"></td>
</tr>

<tr class="second" id="borderbottom"><td>Work Description</td>
    <td colspan="5" style="text-align: left"><textarea maxlength="500" id="wd" name="work_description"><?php echo $work_description ?></textarea></td>
</tr>
</table>

<!-- NEXT BORDER... THE FOLLOWING ARE FOR PARTS DESCRIPTIONS, COSTS, AND TIME LOGGED -->
<table class="parts_and_time" style="border: 2px solid black; width: 1050px;">
<tr>
	<!-- PARTS AND COSTS SUBTABLE -->
	<td style="vertical-align: top; padding-top: 10px;">
	<h3>Parts and Costs</h3>
	<table class="parts_and_time" style="float: left;"> <!-- contains 5 columns -->
		<tr>
			<th></th>
			<th>Part #(s)</th>
			<th>Equipment Description</th>
			<th>Qty</th>
			<th>Amount Per</th>
		</tr>
		<tr>
			<td>1</td>
			<td><input type="text" maxlength="20" name="partno1" value="<?php echo $partno1 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part1desc" value="<?php echo $part1desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part1qty" name="part1qty" value="<?php echo $part1qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8" id="part1amount" name="part1amount" value="<?php echo $part1amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td>2</td>
			<td><input type="text" maxlength="20" name="partno2" value="<?php echo $partno2 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part2desc" value="<?php echo $part2desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part2qty" name="part2qty" value="<?php echo $part2qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8" id="part2amount" name="part2amount" value="<?php echo $part2amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td>3</td>
			<td><input type="text" maxlength="20" name="partno3" value="<?php echo $partno3 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part3desc" value="<?php echo $part3desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6"  id="part3qty" name="part3qty" value="<?php echo $part3qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8" id="part3amount" name="part3amount" value="<?php echo $part3amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td>4</td>
			<td><input type="text" maxlength="20" name="partno4" value="<?php echo $partno4 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part4desc" value="<?php echo $part4desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part4qty" name="part4qty" value="<?php echo $part4qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8" id="part4amount" name="part4amount" value="<?php echo $part4amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td>5</td>
			<td><input type="text" maxlength="20" name="partno5" value="<?php echo $partno5 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part5desc" value="<?php echo $part5desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part5qty" name="part5qty" value="<?php echo $part5qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8" id="part5amount" name="part5amount" value="<?php echo $part5amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td>6</td>
			<td><input type="text" maxlength="20" name="partno6" value="<?php echo $partno6 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part6desc" value="<?php echo $part6desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part6qty" name="part6qty" value="<?php echo $part6qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8" id="part6amount" name="part6amount" value="<?php echo $part6amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td>7</td>
			<td><input type="text" maxlength="20" name="partno7" value="<?php echo $partno7 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part7desc" value="<?php echo $part7desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part7qty" name="part7qty" value="<?php echo $part7qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8"  id="part7amount" name="part7amount" value="<?php echo $part7amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
		<tr>
			<td>8</td>
			<td><input type="text" maxlength="20" name="partno8" value="<?php echo $partno8 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part8desc" value="<?php echo $part8desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part8qty" name="part8qty" value="<?php echo $part8qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8"  id="part8amount" name="part8amount" value="<?php echo $part8amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
		<tr>
			<td>9</td>
			<td><input type="text" maxlength="20" name="partno9" value="<?php echo $partno9 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part9desc" value="<?php echo $part9desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part9qty" name="part9qty" value="<?php echo $part9qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8"  id="part9amount" name="part9amount" value="<?php echo $part9amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
		<tr>
			<td>10</td>
			<td><input type="text" maxlength="20" name="partno10" value="<?php echo $partno10 ?>" style="width: 110px;" /></td>
			<td><input type="text" maxlength="100" name="part10desc" value="<?php echo $part10desc ?>" style="width: 300px;" /></td>
			<td><input type="text" maxlength="6" id="part10qty" name="part10qty" value="<?php echo $part10qty ?>" style="width: 60px;" /></td>
			<td>$<input type="text" maxlength="8"  id="part10amount" name="part10amount" value="<?php echo $part10amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td>11</td>
			<td style="padding-bottom: 8px;"><input type="text" maxlength="20" name="partno11" value="<?php echo $partno11 ?>" style="width: 110px;" /></td>
			<td style="padding-bottom: 8px;"><input type="text" maxlength="100" name="part11desc" value="<?php echo $part11desc ?>" style="width: 300px;" /></td>
			<td style="padding-bottom: 8px;"><input type="text" maxlength="6"  id="part11qty" name="part11qty" value="<?php echo $part11qty ?>" style="width: 60px;" /></td>
			<td style="padding-bottom: 8px; border-bottom: 2px double black;">$<input type="text" maxlength="8"  id="part11amount" name="part11amount" value="<?php echo $part11amount ?>" style="width: 80px;" /></td>
		</tr>
		<tr>
			<td colspan="3"><span style="color: red; font-weight: bold;">Totals will auto-calculate after a field is changed.</span></td>
			<td>Sub total: </td>
			<td>$<input type="text" id="subtotal" name="subtotal" value="<?php echo $subtotal ?>" readonly="readonly" style="width: 80px; background-color: #DDDDDD; font-weight: bold" /></td>
		</tr>
		<tr>
			<td colspan="3">
			<strong>Is this job taxable? </strong>
			<input type="radio" id="taxable_yes" name="taxable" value="yes"
			<?php if ($taxable == "yes") {echo 'checked';} ?> /> Yes
			<input type="radio" id="taxable_no" name="taxable" value="no"
			<?php if ($taxable == "no") {echo 'checked';} ?> /> No
			</td>
			<td>Tax: </td>
			<td>$<input type="text" id="tax" name="tax" value="<?php echo $tax ?>" readonly="readonly" style="width: 80px; background-color: #DDDDDD; font-weight: bold" /></td>
		</tr>
		<tr>
			<td colspan="3"><strong>Work Order Status: </strong>
			<input type="radio" id="status_open" name="status" value="open"
			<?php if ($status == "open") {echo 'checked';} ?>> Open
			<input type="radio" id="status_closed" name="status" value="closed"
			<?php if ($status == "closed") {echo 'checked';} ?>> Closed
			</td>
			<td>Total: </td>
			<td>$<input id="total" type="text" name="total" value="<?php echo $total ?>" readonly="readonly" style="width: 80px;  background-color: #DDDDDD; font-weight: bold" /></td>
		</tr>
	</table>
	</td>
	
	<!-- NOW THE TIME ENTRIES -->
	
	<td style="padding-left: 50px; padding-top: 10px; vertical-align: top;">
	<h3>Time log</h3>
	<table class="parts_and_time" style="float: left;"> <!-- 4 columns -->
		<tr>
			<th>Date</th>
			<th>Time In</th>
			<th>Time Out</th>
			<th>Total Time</th>
		</tr>
		<tr>
			<td><input type="text" id="date1" name="date1" value="<?php echo $date1 ?>" style="width: 100px;" maxlength="10" /></td>
			<td>
			<?php makeSelect('in', 1); ?>
			</td>
			<td>
			<?php makeSelect('out', 1); ?>
			</td>
			<td><input type="text" id="totaltime1" name="totaltime1" value="<?php echo $totaltime1 ?>" style="width: 50px; background-color: #DDDDDD; font-weight: bold" maxlength="5" readonly="readonly" /></td> 
		</tr>
		<tr>
			<td><input type="text" id="date2" name="date2" value="<?php echo $date2 ?>" style="width: 100px;" maxlength="10" /></td>
			<td>
			<?php makeSelect('in', 2); ?>
			</td>
			<td>
			<?php makeSelect('out', 2); ?>
			</td>
			<td><input type="text" id="totaltime2" name="totaltime2" value="<?php echo $totaltime2 ?>" style="width: 50px; background-color: #DDDDDD; font-weight: bold" maxlength="5" readonly="readonly" /></td> 
		</tr>
		<tr>
			<td><input type="text" id="date3" name="date3" value="<?php echo $date3 ?>" style="width: 100px;" maxlength="10" /></td>
			<td>
			<?php makeSelect('in', 3); ?>
			</td>
			<td>
			<?php makeSelect('out', 3); ?>
			</td>
			<td><input type="text" id="totaltime3" name="totaltime3" value="<?php echo $totaltime3 ?>" style="width: 50px; background-color: #DDDDDD; font-weight: bold" maxlength="5" readonly="readonly" /></td> 
		</tr>
		<tr>
			<td><input type="text" id="date4" name="date4" value="<?php echo $date4 ?>" style="width: 100px;" maxlength="10" /></td>
			<td>
			<?php makeSelect('in', 4); ?>
			</td>
			<td>
			<?php makeSelect('out', 4); ?>
			</td>
			<td><input type="text" id="totaltime4" name="totaltime4" value="<?php echo $totaltime4 ?>" style="width: 50px; background-color: #DDDDDD; font-weight: bold" maxlength="5" readonly="readonly" /></td> 
		</tr>
		<tr>
			<td></td>
			<td></td>
			<td>Total:</td>
			<td><input type="text" id="alltimetotal" name="alltimetotal" value="<?php echo $alltimetotal ?>" style="width: 50px; background-color: #DDDDDD; font-weight: bold" readonly="readonly" /></td>
		</tr>
		
		<!-- Tech comments and follow-up -->
		<tr>
			<td colspan="4">Tech Comments:<br />
			<textarea name="tech_comments" maxlength="200" style="width: 90%; border: 1px solid black;"><?php echo $tech_comments; ?></textarea>
			<br /><br />
			Follow-up:<br />
			<input type="text" name="follow_up" maxlength="70" style="width: 90%;" value="<?php echo $follow_up; ?>" />
			</td>
		</tr>
	</table>
	</td>
</tr>
</table>

<script language="javascript" type="text/javascript">

// -----------------FOR THE PARTS AND COSTS---------------------

// arrays needed
amounts = new Array();
quantities = new Array();
partTotals = new Array();

// make the onchange events
for (x = 1; x <= 11; x++)
{
	document.getElementById('part' + x + 'qty').onchange = addPartsTotals;
	document.getElementById('part' + x + 'amount').onchange = addPartsTotals;
}
document.getElementById('taxable_yes').onchange = addPartsTotals;
document.getElementById('taxable_no').onchange = addPartsTotals;

function addPartsTotals() // THIS ENTIRE FUNCTION IS CALLED EVERY ONCHANGE to amount or qty
{
	// redefine the variables every time a change is made. Default 0
	for (i = 1; i <= 11; i++)
	{ 
		if (document.getElementById('part' + i + 'amount').value == '')
			{ amounts[i] = 0; }
		else
			{ amounts[i] = Math.round(document.getElementById('part' + i + 'amount').value * 100) / 100; }
		
		if (document.getElementById('part' + i + 'qty').value == '')
			{ quantities[i] = 0; }
		else
			{ quantities[i] = document.getElementById('part' + i + 'qty').value; }
		
		partTotals[i] = amounts[i] * quantities[i];
	}
	
	// get subtotal
	var subTotal = Math.round((partTotals[1] + partTotals[2] + partTotals[3] + partTotals[4] + partTotals[5] + partTotals[6] + partTotals[7] + partTotals[8] + partTotals[9] + partTotals[10] + partTotals[11]) * 100) / 100; 
	document.getElementById('subtotal').value = subTotal.toFixed(2);
	
	// get tax
	if (document.workorderform.taxable[0].checked)
	{
		var tax = Math.round(0.07 * subTotal * 100) / 100;
		document.getElementById('tax').value = tax.toFixed(2);
	} 
	else
	{
		var tax = 0;
		document.getElementById('tax').value = tax.toFixed(2);
	}
	
	// get grand total
	var grandTotal = Math.round((tax + subTotal) * 100) / 100;
	document.getElementById('total').value = grandTotal.toFixed(2);
}

// -----------------END PARTS AND COSTS---------------------

// -----------------FOR TIME LOG----------------------------

// arrays needed
timeins = new Array();
timeins_split = new Array();
timeins_min = new Array();
timeins_dec = new Array();
timeouts = new Array();
timeouts_split = new Array();
timeouts_min = new Array();
timeouts_dec = new Array();
totaltimes = new Array();
dec_total = new Array();

// make the onchange events
for (y = 1; y <= 4; y++)
{	
	document.getElementById('timein' + y).onchange = addTimes;
	document.getElementById('timeout' + y).onchange = addTimes;
}

function addTimes()
{
	for (y = 1; y <= 4; y++)
	{
	// set variables when onchange is triggered
	timeins[y] = document.getElementById('timein' + y).options[document.getElementById('timein' + y).selectedIndex].value;
	timeouts[y] = document.getElementById('timeout' + y).options[document.getElementById('timeout' + y).selectedIndex].value;
	
	// split the variables into mathematically workable stuff
	timeins_split[y] = timeins[y].split(":");
	timeouts_split[y] = timeouts[y].split(":");
	
	// re-assemble as decimals
	timeins_min[y] = timeins_split[y][1] / 60;
	timeins_dec[y] = (parseInt(timeins_split[y][0]) + timeins_min[y]);
	
	timeouts_min[y] = timeouts_split[y][1] / 60;
	timeouts_dec[y] = (parseInt(timeouts_split[y][0]) + timeouts_min[y]);
	
		// calculate that day's total
		dec_total[y] = (timeouts_dec[y] - timeins_dec[y]);
		
		// set it to the totals box
		if (isNaN(dec_total[y]))
			{dec_total[y] = 0;}
		document.getElementById('totaltime' + y).value = dec_total[y];
		
		// add all totals
		var all_time_totals = dec_total[1] + dec_total[2] + dec_total[3] + dec_total[4];
		document.getElementById('alltimetotal').value = (all_time_totals < 1) ? 1 : all_time_totals;
	}
		
}

// ------------------END TIME LOG--------------

// BEGIN FORM VALIDATION
$('#workorderform').submit(function()
{
	var form = document.workorderform;
	// regular expression to match required date format 
	re = /^\d{2}\-\d{2}\-\d{4}$/;
	
	if (form.client.value == '')
	{
		alert("You must enter a Client"); 
		form.client.focus(); 
	}
	else if (form.wo_num.value == '')
	{
		alert("You must enter a Service Order Number"); 
		form.wo_num.focus(); 
	}
	else if (form.order_date.value == '' || !form.order_date.value.match(re)) 
	{
		alert("Invalid date format for Order Date: " + form.order_date.value + "\nMM-DD-YYYY format is required."); 
		form.order_date.select(); 
	}
	else if (!document.workorderform.status[0].checked && !document.workorderform.status[1].checked) 
	{
		alert("You must enter a work order status (open or closed)."); 
	}
	else if (!document.workorderform.taxable[0].checked && !document.workorderform.taxable[1].checked) 
	{
		alert("You must choose whether the job is taxable (yes or no)."); 
	}
	else if (isNaN(document.getElementById('subtotal').value) || isNaN(document.getElementById('tax').value) || isNaN(document.getElementById('total').value))
	{
		alert("NaN error: You have entered an invalid data type for one of the Quantity or Amount fields. Only numbers or decimals are acceptable (e.g. 3 or 3.58). Go back and make sure these are correct!");
	}
	else
	{
		// retrieve work order numbers for verification
		var wo_number = document.workorderform.wo_num.value;
			$.ajax(
			{
				url: "wo_array.php",
				async: false,
				success: function(woArray)
				{
					var woArray = $.parseJSON(woArray); // converts json_encoded PHP array into JS array
					// Check if this is from create.php and if the Work order number is a duplicate
					// Only do this check for create.php because edit.php SHOULD overwrite and save a number already in the DB
					if (window.location.href.indexOf('create.php') != -1 && woArray.indexOf(wo_number) != -1)
					{
						// Work order number that the user input was found already in the database
						alert('The Invoice number you entered, ' + wo_number + ', was found in the database. If you want to edit and overwrite an existing invoice, select "Edit/View" from the top menu. Otherwise give this invoice a different number.');
						form.wo_num.focus();
					}
					else
					{
						document.workorderform.submit(); // Submit the form if all the above worked to now
					}
				}
			});
	}
	// cancel normal form submission
	return false;
});	
// END FORM VALIDATION
</script>

<!--END PARTS/TIME SECTION -->

</table>
<br />
<input type="submit" value="save work order"><input type="reset" value="reset fields">
</form>






