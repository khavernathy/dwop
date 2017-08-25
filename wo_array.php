<?php
include('connect-db.php');
$work_orders = array();

$result = mysql_query("SELECT wo_num FROM CUSTOMER_WORK_ORDERS");

while ($row = mysql_fetch_assoc($result)) 
{
  $work_orders[] = $row['wo_num'];
}

echo json_encode($work_orders);
?>