<?php 
   require_once 'build_dependencies.php'; 
   require_once 'lib/TripService.php'; 
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>TravelTracker</title>
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=Open+Sans'/>
    <link rel="stylesheet" type="text/css" href="styles/site.css" />
</head>
<body>

    <?php require_once 'header.php'; ?>

    <div id='map'>
    <!-- Google Maps here -->
    </div>

    <div id='trips'>
    <?php 
        $tripService = new services\TripService($repository, $logger); 
        $totals = $tripService->GetTripTotals(); 
        $defaultTrip = null; 

        foreach ($totals as $currentRow) 
        {
            // Gets the first trip as the default trip
            if($defaultTrip == null)
            {
                $defaultTrip = $currentRow[0]; 
                echo sprintf("<div id='currentTrip'>%s</div>", $defaultTrip); 
            }

            echo sprintf("<div class='trip' id='%s'>", $currentRow[0]); 
            echo sprintf("<h2>%s</h2>", $currentRow[1]);  
            echo sprintf("<p>%s Locations</p>", $currentRow[2]); 
            echo "</div>"; 
         }
    ?>
    </div>

    //here
    <?php require_once 'footer.php'; ?>
    
    <script src='scripts/jquery/jquery.min.js'></script>
    <script src='scripts/maps.js'></script>
    <script src='scripts/ready.js'></script>

    <?php 
        /*  This precaution is needed for developement until a refferer domain is added to the key in production */
        require_once 'api_key.php'; 
        echo '<script src="https://maps.googleapis.com/maps/api/js?key=' . KEY .'&callback=initMap"></script>';
    ?>
    
</body>
</html> 