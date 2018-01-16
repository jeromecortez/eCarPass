<?php

require "connection.php";
$uuid = $_POST['uuid'];
$active = '';


$selectActive = "SELECT platenum from cars where uuid = '$uuid' and isActive = 'true'";
$activecar = mysqli_query($con,$selectActive);


if($activecar){
  $data = mysqli_fetch_assoc($activecar);
  $active = $data['platenum'];

  }
  
else
 {
	 $active = "false";
	 
 }
	echo $active;



?>