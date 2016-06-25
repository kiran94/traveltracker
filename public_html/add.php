<?php require_once 'build_dependencies.php'; ?>
<!DOCTYPE html> 
<html lang='en'>
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

    <div id='addLocationPage'>
        <h1>Add Location</h1>
        <form method='POST' action='add_post.php' id='addlocation'>
            <?php 
                require_once 'lib/TripService.php'; 
                $tripService = new services\TripService($repository, $logger); 
                $trips = $tripService->GetAll(); 

                echo "<label for='locationName'>Location Label (optional)</label>";
                echo "<input type='text' name='locationName'/>";
                echo "<br />"; 

                echo "<label for='selectedTrip'>Trip</label>";
                 echo "<br />"; 
                echo "<select name='selectedTrip'>";
                    foreach ($trips as $trip) 
                    {
                        echo sprintf("<option value='%s'>%s</option>", $trip->ID, $trip->Name); 
                    }
                echo "</select>";
                echo "<br />"; 

                echo "<label id='lat_label'>Lat:</label>"; 
                echo "<input type='hidden' id='lat' name='lat' value='' />";
                echo "<br />"; 

                echo "<label id='lng_label'>Long:</label>"; 
                echo "<input type='hidden' id='lng' name='lng' value='' />";
                echo "<br />"; 

                echo "<img src='res/ajax-loader.gif' alt='loading..' id='loader'>"; 

                echo "<br />"; 
                echo "<button id='location'>Get Location</button>"; 
                echo "<input type='submit' />"; 
            ?>
        </form>
     </div>

     <?php require_once 'footer.php'; ?>

    <script src='scripts/jquery/jquery.min.js'></script>
    <script src='scripts/addLocation.js'></script>
</body>
</html>