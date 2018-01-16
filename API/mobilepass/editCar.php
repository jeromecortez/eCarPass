<?php 

require "connection.php";

$uuid = $_POST['uuid'];
$plateNum = $_POST['plate'];
$editPlate = $_POST['editplate'];
$editType = $_POST['editType'];

	$editCar = "SELECT * from cars where uuid = '$uuid' and platenum = '$plateNum'";
	
	$result = mysqli_query($con,$editCar);
	
	if (mysqli_num_rows($result) <= 0)
	{
		$result = "false";
		echo $result;
	}
	
	else 
	{
		$updateCar = "UPDATE cars SET platenum = '$editPlate', cartype = '$editType' where platenum = '$plateNum' and uuid = '$uuid'";
		$result2 = mysqli_query($con,$updateCar);
		$result = "true";
		echo $result;
	}

?>