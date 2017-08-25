<?php session_start();
include("sessions.php");
include("connect-db.php"); 
include("client_selector.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>DTSIwop - View and Print Work Order</title>
</head>

<body class="email">

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

//print "<strong>IMPORTANT: The Print View functionality is undergoing repairs... don't try to print a work order now.</strong><br />";

print "<h2>E-mail a Work Order</h2>";

if (!isset($_POST['submit_email']))
{
	print "Select a client to e-mail the customer a link:";
	
	cSelect('continue', '');
	
	if (isset($_POST[client_selected])) { // if client is picked, get the work orders for it
		$client_selected = $_POST[client_selected];
		$getworkorders = "SELECT * FROM CUSTOMER_WORK_ORDERS WHERE client_id = '$client_selected' ORDER BY order_date DESC";
		$getworkordersquery = mysql_query($getworkorders, $mysqlconn) or die(mysql_error());
	
		$getname = "SELECT * FROM CLIENTS WHERE ID = '$client_selected'";
			$getnamequery = mysql_query($getname, $mysqlconn);
			while ($client_name = mysql_fetch_array($getnamequery))
			{ $name = $client_name['client']; $email = $client_name['email'];}
			if ($email != '')
			{
				print "<p>Select the invoice for <strong>$name</strong> that you wish to e-mail to the customer:</p>";
			
				print "<form action=\"email.php\" method=\"POST\">";
				print "<select name=\"wo_toemail\">";
				
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
				print "</select><br /><br />
						Additional comments (the e-mail will automatically say \"Thank you for your business!\"):<br /><textarea name=\"extra_comments\" rows=\"7\" cols=\"85\"></textarea><br />";
						
						print "<br />This e-mail will be sent to <b>".$email."</b>. If this is the wrong e-mail address, first fix it from the <a href=\"editcust.php\">Customers</a> page.<br />If the customer cannot find the e-mail, have them check their spam box.<br /><br />";
						echo '<input type="hidden" name="email_address" value="'.$email.'">';
						echo '<input type="hidden" name="cust_name" value="'.$name.'">';
						echo '<input type="checkbox" name="email_dep"> E-mail to mmonroe@getdtsi.com also?'.'<br />'; 
						print "<input type=\"submit\" name=\"submit_email\" value=\"e-mail selected invoice\"></form>";
			}
			else
			{
				print "No e-mail was found in the database for <b>".$name."</b>. Go to the <a href=\"editcust.php\">Customers</a> page and add an e-mail address to the appropriate record first.";
			}
	
	} else {
		print "No client selected...";
	
	} 
}
else
{
	// send e-mail
	$extra_comments = $_POST['extra_comments'];
	if (isset($_POST['email_dep'])) {$to = 'mmonroe@getdtsi.com, ';} else {$to = '';}
	$to .= $_POST['email_address'];
	$cust_name = $_POST['cust_name'];
	$inv_no = $_POST['wo_toemail'];
	$subject = "Your Invoice from Dependable Telecom Solutions, Inc.";
	$message = "To whom it may concern at ".$cust_name.",\n\nPlease use the following link to view an electronic copy of your invoice in your web browser. You can print the invoice from there or save it as an .html file by navigating \"File->Save Page As...\" in most browsers.\n\nLink: http://www.getdtsi.com/dtsi_wop/printview.php?inv_no=".$inv_no." \n\n";
	if ($extra_comments != '') {
		$message .= "Comments:\n".$extra_comments."\n\n";
		}
	$message .= "Thank you for your business!\nDependable Telecom Solutions, Inc.\nwww.getdtsi.com\nPhone: 1-888-366-3284\n1-727-451-4545\nFax: 1-727-451-4545\n\nThis is an automated message. Please do not reply by e-mail.";
	$headers = "From: no-reply@getdtsi.com";
	
	if (mail($to,$subject,$message,$headers))
	{
		echo 'E-mail sent successfully to '.$_POST['email_address'].'.';
	}
	else
	{
	
	}
}



?>

</body>
</html>