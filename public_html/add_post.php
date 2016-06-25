<?php 
    require_once 'build_dependencies.php'; 
    require_once 'lib/LocationService.php'; 
    require_once 'lib/ValidationService.php'; 
    require_once 'lib/entities/Location.php';

    $validationService = new services\ValidationService(); 

    $tripID =  $_POST['selectedTrip']; 
    $tripID = trim($tripID); 

    $lat = $_POST['lat']; 
    $lng = $_POST['lng'];

    if(!isset($lat) || !isset($lng))
    {
        $logger->warn("lat or long are not set"); 
        $error_message = "Please ensure you set both lat and long values"; 
        require_once 'error.php'; 
        require_once 'add.php'; 
        exit(); 
    } 

    $name = $_POST['locationName']; 
    $name = trim($name); 

    $newLocation = new entities\Location(); 
    $newLocation->ID = $validationService->getGUID(); 
    $newLocation->Lat = $lat; 
    $newLocation->Long = $lng; 
    $newLocation->Name = $name;
    $newLocation->Date = date('Y-m-d H:i:s');; 
    $newLocation->IsDeleted = 0; 
    $newLocation->TripID = $tripID; 

    $locationService = new services\LocationService($repository, $logger); 
    if($locationService->Create($newLocation) == 1)
    {
        $logger->info(sprintf("new location added %s", $newLocation->ID)); 
        $success_message = "Location Successfully added"; 
        require_once 'success.php'; 
        require_once 'Index.php'; 
    }
    else 
    {
        $logger->warn("error inserting record"); 
        $error_message = "Unable to enter record, please try again"; 
        require_once 'error.php'; 
        require_once 'add.php'; 
        exit(); 
    }
?>

