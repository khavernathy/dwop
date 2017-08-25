<?php
function cSelect($buttonText, $action)
{
	global $mysqlconn;
	echo '
	<form action="'.$action.'" method="POST">
	<select name="client_selected" size="12">';
	
	
	$getclientsquery = "SELECT * FROM CLIENTS ORDER BY client";
	$getclients = mysql_query($getclientsquery, $mysqlconn) or die(mysql_error());
	
	
	while ($clientsarray = (mysql_fetch_array($getclients))) {
		$client = $clientsarray['client'];
		$ticker = $clientsarray['ticker'];
		$id = $clientsarray['ID'];
		echo "<option name=\"client\" value=\"$id\">";
		echo $client.' - '.$ticker;
		echo "</option>";
	}
	echo '</select>
	<br />
	<input type="submit" value="'.$buttonText.'">
	</form>';
}

?>