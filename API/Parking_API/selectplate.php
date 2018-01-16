<?php
	require "connection.php";
	$success = '';
	
	
	$uuid = $_POST['uuid'];

$statement = "Select platenum, cartype from cars where uuid = '$uuid'";

$result = mysqli_query($con,$statement);

$platenum = Array();
	while ($row = mysqli_fetch_assoc($result))
	{
	array_push($platenum,array("platenum"=>$row['platenum'], "cars"=>$row['cartype'],"uuid"=>$uuid));
	}
	/*foreach(mysqli_fetch_assoc($result) as $row)
	{
		array_push($platenum,array("platenum"=>$row->platenum, "cars"=>$row->cartype));
	}*/


echo json_encode($platenum);



    
?>
