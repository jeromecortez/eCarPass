<?php
	require "connection.php";
	$success = '';
	
	
	$uuid = $_POST['uuid'];


$statement = "Select * from account where uuid = '$uuid'";

$result = mysqli_query($con,$statement);



$sql_query = "INSERT into account (uuid) values ('$uuid');";

if (mysqli_num_rows($result) > 0)
{
$success = false;
echo json_encode($success);
}

else {
if(mysqli_query($con,$sql_query)) 
{
	
$success = true;
echo json_encode($success);
}

}

    
?>
