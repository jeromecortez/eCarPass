<?php

require "connection.php";
$uuid = $_POST['uuid'];
$active = '';


$selectActive = "SELECT platenum from cars where uuid = '$uuid' and isActive = 'YES'";
$activecar = mysqli_query($con,$selectActive);


if($activecar){
  $data = mysqli_fetch_assoc($activecar);
  $active = $data['platenum'];
}

echo $active;


?>