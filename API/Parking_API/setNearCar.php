<?php
	require "connection.php";
	
	$platenum = $_POST['platenum'];
	$uuid = $_POST['uuid'];
	
	$setNearStatement = "UPDATE cars SET location = 'near' where platenum = '$platenum' and uuid = '$uuid'";
	$setNearStatementQuery = mysqli_query($con,$setNearStatement);
	
	$setFarStatement = "UPDATE cars SET location = 'far' where platenum != '$platenum'";
	$setFarStatementQuery = mysqli_query($con,$setFarStatement);

	// and uuid = '$uuid'
?>	