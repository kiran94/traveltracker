<?php 
   require_once 'build_dependencies.php'; 
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <title>TravelTracker</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="styles/site.css" />
</head>
<body>

    <div id='title'>
    <h1>TravelTracker</h1>
    </div>

    <div id='map'>
    <!-- Google Maps here -->
    </div>

    <div id='trips'>
    <?php 
        $tripService = new services\TripService($repository, $logger); 
        $totals = $tripService->GetTripTotals(); 

        foreach ($totals as $currentRow) 
        {
            echo sprintf("<div class='trip' id='%s'>", $currentRow[0]); 
            echo sprintf("<h2>%s</h2>", $currentRow[1]);  
            echo sprintf("%s Locations", $currentRow[2]); 
            echo "</div>"; 
         }
    ?>
    </div>
    
    <script src='scripts/maps.js'></script>
    <?php 
        /*  
            This precaution is needed for developement until a refferer domain is added to the key in production
        */

        require_once 'api_key.php'; 
        echo '<script src="https://maps.googleapis.com/maps/api/js?key=' . KEY .'&callback=initMap"
                async defer></script>';
    ?>
</body>
</html> 