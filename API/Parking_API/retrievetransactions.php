<?php
	require "connection.php";
	$success = '';
	
		
	$uuid = '706542fdd96641ea';

$statement = "SELECT * FROM transactions
LEFT JOIN cars ON transactions.platenum = cars.platenum
UNION
SELECT * FROM transactions
RIGHT JOIN cars ON transactions.platenum = cars.platenum

WHERE cars.uuid='$uuid' and transactions.refnum is not NULL";

$result = mysqli_query($con,$statement);

$details = Array();
	
	if ($result){
	while ($row = mysqli_fetch_assoc($result))
		array_push($details,array("refnum"=>$row['refnum'],"platenum"=>$row['platenum'],"parkingid"=>$row['parkingid'],"staffid"=>$row['staffid'],"timein"=>$row['timein']
					,"timeout"=>$row['timeout'],"date"=>$row['date'],"price"=>$row['price'],"slot"=>$row['slot']));
	
	echo json_encode($details);
	}
	else
	{
		
		die(mysqli_error($con));
	}
	
	?>