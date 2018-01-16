<?php

require "connection.php";

$uuid = $_POST['uuid'];

	$getParkingSlot = "SELECT slot, area from parkingslots where uuid = '$uuid'";
	$getParkingSlotQuery = mysqli_query($con,$getParkingSlot);

	$slot = Array();

if($getParkingSlotQuery){
	
	while ($row = mysqli_fetch_assoc($getParkingSlotQuery))
	{
	array_push($slot,array("parkingslot"=>$row['slot'], "parkingarea"=>$row['area']));
	}
	
	echo json_encode($slot);
}
else
{
	$result = 'false';
	echo $result;
	
}

?>