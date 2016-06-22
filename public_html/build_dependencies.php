<?php 
    /*
        Builds dependency tree for services
    */
    require_once 'lib/ConfigurationService.php'; 
    require_once 'lib/Connection.php'; 
    require_once 'lib/log4php/LoggerService.php'; 
    require_once 'lib/Repository.php'; 
    require_once 'lib/TripService.php'; 

    $configService = new services\ConfigurationService("config.ini"); 
    $logger = new services\LoggerService($configService); 
    $connection = new dataaccess\Connection($configService, $logger); 
    $repository = new dataaccess\Repository($connection, $logger); 
?>