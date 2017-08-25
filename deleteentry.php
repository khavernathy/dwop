<?php session_start();
include("sessions.php");
include("connect-db.php");

if ($_SESSION[del_access] == "yes")
{
	header("Location: dodeletes.php");
}
?>
<html>
<head>
<title>DTSIwop - Delete an Entry</title>
</head>

<body class="delete">

<?php

include("menu.php");
print "<h2>Delete Entries</h2>";

if (isset($_POST[del_password]))
{
	// Verify the password
	
	$del_password = md5($_POST[del_password]);
	
	$verify = "SELECT password from del_password";
	$verifyquery = mysql_query($verify, $mysqlconn) or die(mysql_error());
	$truepass_array = (mysql_fetch_array($verifyquery));
	$truepass = $truepass_array['password']; // $truepass is now assigned to MD5 encrypted pass
	
	if ($del_password == $truepass)
	{
		$_SESSION['del_access'] = "yes";
		print "Password correct... -><a href='dodeletes.php'>Go to deletion menu</a>";
	}
	else
	{
		print "Incorrect password. <a href=\"deleteentry.php\">Try again</a>";
	}
}
else
{
	?>
	<form action="<?php $_SERVER[PHP_SELF] ?>" method="post">
	<p>Please enter deletion password to continue: 
	<input type="password" name="del_password">
	<input type="submit" value="continue"></p>
	</form>
	<?php	
}




?>

</body>
</html>