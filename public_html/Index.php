<?php
    require_once 'lib/TripService.php';
    require_once 'lib/Repository.php';
   
    $con = mysqli_connect("localhost:8889", "root", "root", "traveltracker");
    $repo = new dataaccess\Repository($con);

    $trips = new services\TripService($repo, null);
    $res = $trips->Get("test");
    echo var_dump($res);
?>
