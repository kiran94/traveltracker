<?php 
   require_once 'build_dependencies.php'; 
?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <title>TravelTracker</title>
    <link href='https://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <link rel="stylesheet" type="text/css" href="styles/site.css" />
</head>
<body>

    <div id='title'>
    <h1>TravelTracker</h1>
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
            echo "<hr />"; 
            echo "</div>"; 
         }
    ?>
    </div>

    <div id='map'>
    <!-- Google Maps here -->
    </div>

</body>
</html> 