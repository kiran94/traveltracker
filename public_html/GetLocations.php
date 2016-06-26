<?php 
    header('Content-Type: application/json');
    require_once 'build_dependencies.php';
    require_once 'lib/LocationService.php'; 
    require_once 'lib/ValidationService.php'; 

    $tripID = $_POST['TripID']; 
    if(!isset($tripID))
    {
        $logger->warn('trip id was not set in get locations'); 
        $error_message = "error loading trip"; 
        require_once 'error.php'; 
        require_once 'Index.php'; 
        exit(); 
    }

    $validationService = new services\ValidationService(); 
    if ($validationService->checkUUID($tripID))
    {
        $locationService = new services\LocationService($repository, $logger); 
        $locations = $locationService->GetLocationsFromTrip($tripID);

        if($locations == null || count($locations) == 0)
        {
            $logger->warn(sprintf("no locations found for trip %s", $tripID)); 
            $locations = false; 
        }

        echo json_encode($locations); 
    }
    else 
    {
        $logger->warn(sprintf("trip %s does not match pattern", $tripID)); 
        echo json_encode(false); 
    }
?>