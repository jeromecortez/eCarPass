<?php
	require "connection.php";
	$success = '';
	
	
	$plate = $_POST['plate'];
	$uuid = $_POST['uuid'];
	$name = $_POST['name'];
	$car = $_POST['cartype'];

$statement = "Select * from cars where platenum = '$plate'";
$statement2 = "Select * from account where uuid = '$uuid'";
$statement3 = "Select * from cars where platenum = '$plate' and uuid = '$uuid'";



$result = mysqli_query($con,$statement);
$result2 = mysqli_query($con,$statement2);
$result3 = mysqli_query($con,$statement3);



$sql_query = "INSERT into cars (platenum,uuid,cartype) values ('$plate','$uuid','$car');";
$sql_query2 = "INSERT into account (uuid) values ('$uuid');";
$sql_query3 = "UPDATE account set name = '$name' Where uuid = '$uuid'";


if (mysqli_num_rows($result2) <= 0)
{
mysqli_query($con,$sql_query2);


}

else {
	
	if(mysqli_query($con,$sql_query3)) 
	{
	$success = true;
	echo json_encode($success);
	}
	else if (mysqli_num_rows($result3) > 0)
	{
	$success = false;
	echo json_encode($success);
	}
	/*else if(mysqli_query($con,$sql_query)
	{
	$success = true;
	echo json_encode($success);
	}*/
}
	



    
?>
