<?php

require "connection.php";
$checker = " ";

$uuid = $_POST['uuid'];
$plateNumber = $_POST['platenum'];
$carType = $_POST['cartype'];

$checkCar = "SELECT * from cars where platenum = '$plateNumber' and uuid = '$uuid'";
$result = mysqli_query($con,$checkCar);
	
	//check if car with same platenumber and uuid exists
	if (mysqli_num_rows($result) > 0) {
		
	$checker = "false";
	echo $checker;
	}

	//if no car exists 
	else{
	$sql_query = "INSERT into cars(uuid,platenum,cartype) values ('$uuid','$plateNumber','$carType')";
	$registerCar = mysqli_query($con,$sql_query);
	
	$checker = "true";
	echo $checker;
	}



?>