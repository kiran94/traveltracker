<?php 
    $tripID = $_POST['TripID']; 
    require_once 'build_dependencies.php';
    require_once 'lib/LocationService.php'; 

    $locationService = new services\LocationService($repository, $logger); 
    $locations = $locationService->GetLocationsFromTrip($tripID);

    if($locations == null || count($locations) == 0)
    {
        $locations = false; 
    }

    header('Content-Type: application/json');
    echo json_encode($locations); 
?>