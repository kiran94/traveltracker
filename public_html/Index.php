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

    //$currentLocation = $TripService->Get('b6dc24ec-3728-11e6-a680-8c15c1896d85'); 
    
    // echo $currentLocation->ID; 
    // echo "<br/>";
    // echo $currentLocation->Name; 


    // $trips = new services\TripService($repo, $logger);
    // $res = $trips->Get("58b3ab6e-36c5-11e6-bbd4-f388cc669bd7");

    // if(!$res)
    // {
    //     echo "failed to find trip"; 
    //     exit(); 
    // }

    // echo $res->ID; 
    // echo "<br/>";
     
    // echo $res->Name;
    // echo "<br/>"; 

    echo "done"; 
?>
