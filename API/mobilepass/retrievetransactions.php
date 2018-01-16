<?php
	require "connection.php";
	$success = '';
	
	$platenum = 'AXA1803';
	
	$statement = "select * from transactions where platenum = '$platenum'";
	
	$result = mysqli_query($con,$statement);
	
	$details = Array();
	while ($row = mysqli_fetch_assoc($details))
		array_push($details,array($row));
	
	echo json_encode($details);
	?>