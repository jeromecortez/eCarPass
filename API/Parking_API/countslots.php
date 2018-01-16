<?php
	require "connection.php";
	$success = '';
	
	$statement = "select sum(capacity) as `total` from parkingarea";
	
	$result = mysqli_query($con,$statement);
	
	$total = 0;
	$row = mysqli_fetch_assoc($result);
	$total = $row['total'];
	
	$statement = "select count(uuid) as `countuuid` from parkingslots where uuid is not NULL";
	
	$result = mysqli_query($con,$statement);
	
	$slots = 0;
	$row = mysqli_fetch_assoc($result);
	$slots = $row['countuuid'];
	
	$results = Array();
	array_push($results,array("total"=>$total, "slots"=>$slots));
	
	echo json_encode($results);
?>