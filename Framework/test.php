<?php 

require_once('Services/TripService.php'); 

$service = new TripService(null, null); 

echo var_dump($service); 

echo "hello world"; 
?>