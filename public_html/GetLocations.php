<?php 
    header('Content-Type: application/json');

    $tripID = $_POST['TripID']; 
    require_once 'build_dependencies.php';
    require_once 'lib/LocationService.php'; 
    require_once 'lib/ValidationService.php'; 

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