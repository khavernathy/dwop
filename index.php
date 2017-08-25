<?php session_start(); 
$version = "2.7"; 
$offline = "no"; //for re-configuring program. Set to "yes" to enable offline state
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<meta http-equiv="Content-Language" content="en-us" />		
<meta name="description" content="Dependable Telecom Solutions, Inc. provides Phone System installations for small and large businesses, Voicemail integration, Voice Over IP, Computer Networking and Cabling, Programming, Messages on Hold, Lightning Suppression and more" />	
<meta name="keywords" content="Dependable Telecom, Dependable Telecom Solutions, Phone System, Computer Networking, Messages On Hold, Phone System Programming, Installation, Security Cameras, Paging Systems, Battery Backup, Local Dial Tone, Long Distance, Tampa Florida, Tampa FL, Clearwater FL, Clearwater Florida, Phone Systems Tampa, Phone Systems Florida, Telecom Solutions Clearwater FL, Pinellas, Phone Service Provider, NEC Dealer, DTSI, Tampa Bay Phones, Small Business, Aspire Phone System, NEC Aspire, UX 5000, NEC SL1100, VOIP Phone System, NEC Phone System Features, Aspire Features, Aspire Benefits, Aspire Phone System, Conquest Telecom, Conquest" />		
<meta name="author" content="Douglas Matthew Franz" />
<title>Dependable Telecom Solutions Work Order Program (DTSIwop)</title>
<link href="css/dtsiwop.css" rel="stylesheet" type="text/css">
<link rel="icon" 
      type="image/png" 
      href="assets/favicon.png" />
</head>

<body>

<?php
include("index_functions.php");

// functions are done being defined. now deciding what to display

include("connect-db.php");

// FIRST check if the program is in offline state for re-configuration
if ($offline == "yes") 
{
	if (!isset($_POST[code]))
	{
	print "DTSIwop is down for maintenance. Enter override code if you are the programmer: ";
	print "<form action=\"\" method=\"post\"><input type=\"password\" name=\"code\"><input type=\"submit\"></form>";
	}
	else
	{
		if (md5($_POST[code]) == "202cb962ac59075b964b07152d234b70")
		{
			$_SESSION['start_time'] = time();
			$_SESSION['id'] = session_id();
			$_SESSION['auth'] = "yes";
			displayMenu();
		}
		else
		{
			print "wrong override code. <a href=\"index.php\">Go back</a>.";
		}
	}
}
// Now we do the normal deal for users
else
{

// test the password
if (isset($_POST[password])) {
	$getpass = "SELECT password from password";
	$getpassquery = mysql_query($getpass, $mysqlconn) or die(mysql_error());
	$dataarray = (mysql_fetch_array($getpassquery));
	$password = $dataarray['password']; // $password is assigned to the MD5 encrypted pass
	if (md5($_POST[password]) == $password) {
	
		// CORRECT PASSWORD. SET SESSION AND DISPLAY MENU.
		$_SESSION['start_time'] = time();
		$_SESSION['id'] = session_id();
		$_SESSION['auth'] = "yes";
		displayMenu();

	} else { // WRONG PASSWORD. RESET
		displayLogin("Wrong password. Try again:");		
	}

} else { // IF PASSWORD ISN'T SET YET (from form submission -- the password is not 'reset' by the session)
	if ($_SESSION['auth'] == "yes") // if they've already logged in and are in a session
	{
		// if they're logging out
		if ($_GET['logout'] == "go")
		{ 
			displayLogin("Successfully logged out.");
			$_SESSION['auth'] = "no"; 
		}
		else
		{ displayMenu(); }
	}
	else if ($_SESSION['auth'] != "yes")
	{
		displayLogin("Enter password to continue:");
	}
}
}
?>

</body>
</html>
