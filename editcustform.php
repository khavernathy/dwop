<?php include("connect-db.php"); ?>
<link rel="stylesheet" type="text/css" href="css/wostyle.css">

<?php

$client_selected = $_POST[client_selected];
// Let's get the client_selected contents

if (isset($_POST[client_selected])) { // 

$getclientsquery = "SELECT * FROM CLIENTS where ID = '$client_selected'";
$getclients = mysql_query($getclientsquery, $mysqlconn) or die(mysql_error());

	while ($clientsarray = (mysql_fetch_array($getclients))) {
	$id = $clientsarray['ID'];
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
	$CPU_ver = $clientsarray['CPU_ver'];
	$ticker = $clientsarray['ticker'];
	$email = $clientsarray['email'];
	}

} else {
	$dontdosquat;
}


// Here goes the form!

?>

<!-- first main row (the image)... -->
<form action="submitclient.php" method="POST">
<input type="hidden" name="id" value="<?php echo $id; ?>" />
<table border="0">
<tr><td style="text-align: center; border-bottom: 1px solid black" colspan="6"><img src="assets/dtsilogo.png" /></td>
</tr>

<!-- Second main row... -->

<tr class="first"><td>Client:</td>
    <td><input type="text" name="client" value="<?php if(isset($_POST[client_selected])) {echo $client;} ?>"></td>
    <td>Ticker:</td>
    <td><input type="text" name="ticker" value="<?php if(!empty($ticker)) {echo $ticker;} else {echo 'xxxx';} ?>" size="5" maxlength="5" /></td>
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


<tr class="second"><td>Order Contact:</td>
	<td><input type="text" name="order_contact" value="<?php echo $order_contact ?>"></td>
	
<tr class="second"><td>CPU version:</td>
	<td><input type="text" name="CPU_ver" value="<?php echo $CPU_ver; ?>"></td>
	<td>E-mail: </td>
	<td><input type="text" name="email" value="<?php echo $email; ?>" /></td>
    

</table>
<br />
<input type="submit" value="save customer"><input type="reset" value="reset fields">
</form>






