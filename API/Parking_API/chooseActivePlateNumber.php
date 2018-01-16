<?php 
	require "connection.php";
	
$uuid = $_POST['uuid'];
$plateNumber = $_POST['platenum'];

$setActivePlateNum = "UPDATE cars SET isActive = 'true' where platenum = '$plateNumber' and uuid = '$uuid'";
$setActivePlateNumResult = mysqli_query($con,$setActivePlateNum);

$setInactivePlateNum = "UPDATE cars SET isActive = 'false' where platenum != '$plateNumber' and uuid = '$uuid'";
$setInactivePlateNumQuery = mysqli_query($con,$setInactivePlateNum);

	

?> 