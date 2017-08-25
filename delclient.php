<?php include("connect-db.php"); ?>
<html>
<head>
<title>DTSIwop - Delete Client</title>
</head>

<body>

<?php

include("menu.php");
print "<br /><br />";


if (isset($_POST[client_selected])) {
 
	$client_selected = $_POST[client_selected];
	
	$delclient = "DELETE FROM CLIENTS WHERE ID = '$client_selected'";
	$delclientquery = mysql_query($delclient, $mysqlconn) or die(mysql_error());
	
	print "The client was deleted.";


} else { 
	print "No client selected...";
}





?>

</body>
</html>