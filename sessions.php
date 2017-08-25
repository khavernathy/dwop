<?php session_start();

// check for inactivity and redirect the user to login if timeout has occurred.

$max_time = 60 * 7; //time in seconds
if (isset($_SESSION['start_time'])) {
	if (time() > ($_SESSION['start_time'] + $max_time)) 
	{
		// kick 'em out
		session_destroy();
		header("Location: index.php?timeout");
		exit;
	} 
	else 
	{	
		$nada;
	}
}
	 
//confirm they can access the page
if ($_SESSION['auth'] == "yes")
{
	$nada;
}
else
{
	header("Location: index.php?unauthorized");
	exit;
}



?>
