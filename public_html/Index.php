<?php
    require_once 'lib/ConfigurationService.php'; 
    require_once 'lib/log4php/LoggerService.php';
    require_once 'lib/Connection.php';  
    require_once 'lib/Repository.php';
    require_once 'lib/TripService.php';
    require_once 'lib/LocationService.php'; 
   
    $config = new services\ConfigurationService("config.ini");
    $logger = new services\LoggerService($config); 
    $connection = new dataaccess\Connection($config, $logger);
    
    $repo = new dataaccess\Repository($connection, $logger);

    $TripService = new services\TripService($repo, $logger); 
    $array = $TripService->GetTripTotals(); 

    echo var_dump($array); 
    echo "done"; 
?>
