<?php 
    /*
        Builds dependency tree for services
    */
    require_once 'lib/ConfigurationService.php'; 
    require_once 'lib/Connection.php'; 
    require_once 'lib/log4php/LoggerService.php'; 
    require_once 'lib/Repository.php'; 

    $configService = new services\ConfigurationService("config.ini"); 
    $timezone = $configService->Get("TimeZone", "Europe/London"); 
    date_default_timezone_set($timezone);

    $logger = new services\LoggerService($configService); 
    $connection = new dataaccess\Connection($configService, $logger); 
    $repository = new dataaccess\Repository($connection, $logger); 
?>