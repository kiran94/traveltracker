<?php
namespace services;

require_once 'Repository.php';
require_once 'contracts/ITripService.php';
require_once 'entities/Trip.php';
require_once 'LocationService.php'; 

use dataccess;
use contracts;

/*
    Trip Service for operations on the Trip Entity
*/
class TripService implements contracts\ITripService
{
    /*
     * Repository Service
     */
    private $repository;

    /*
        Logging Service
    */
    private $logger;

    /*
        Initialises a new instance of the TripService class
        @param Repository access to the database
        @param logger service
    */
    public function __construct($Repository, $Logger)
    {
        $this->repository = $Repository;
        $this->logger = $Logger;
    }

     // @inheritdoc
    public function Create($toCreate)
    {
        if($toCreate == null)
        {
            $this->logger->warn(sprintf("trip entity to create is null")); 
            return false; 
        }

        $this->logger->debug(sprintf("Creating Trip %s", $toCreate->ID)); 
        $query = "INSERT INTO `Trip` VALUES(%s, %s, %s);"; 
        $query = sprintf($query, $toCreate->ID, $toCreate->Name, "0"); 

        return $this->repository->ExecuteCommand($query); 
    }

     // @inheritdoc
    public function Get($ID)
    {
        if($ID == null)
        {
            $this->logger->warn("ID is null in Get"); 
            return false; 
        }

        $this->logger->debug(sprintf("Retrieving Trip %s", $ID)); 

        $query = "SELECT * FROM `Trip` WHERE `ID` = '%s' and `IsDeleted` = '%s';"; 
        $query = sprintf($query, $ID, "0"); 
        $resultArray = $this->repository->ExecuteQuery($query);

        if (count($resultArray) == 0)
        {
            $this->logger->warn(sprintf("Trip %s not found", $ID));
            return false;  
        }

        return TripService::ResultToArray($resultArray)[0]; 
    }

     // @inheritdoc
    public function Update($toUpdate)
    {
        if($toUpdate == null)
        {
            $this->logger->warn("trip entity to update is null"); 
            return false; 
        }

        $this->logger->debug(sprintf("Updating Trip %s", $toUpdate->ID)); 
        $query = "UPDATE `Trip` SET `Name` ='%s' WHERE `ID` = '%s'"; 
        $query = sprintf($query, $toUpdate->Name, $toUpdate->ID); 

        return $this->repository->ExecuteCommand($query); 
    }

     // @inheritdoc
    public function Delete($toDelete)
    {
        if($toDelete == null)
        {
            $this->logger->warn("trip entity to soft delete is null"); 
            return false; 
        }

        if($toDelete->IsDeleted)
        {
            $this->logger->debug(sprintf("trip %s is already deleted", $toDelete->ID)); 
            return false; 
        }

        $this->logger->debug(sprintf("soft deleting Trip %s", $toDelete->ID)); 
        $query = "UPDATE `Trip` SET `IsDeleted` = '1' WHERE `ID` = '%s'"; 
        $query = sprintf($query, $toDelete->ID); 

        return $this->repository->ExecuteCommand($query); 
    }

     // @inheritdoc
    public function GetAll()
    {
        $this->logger->debug("Retrieving all Trips"); 

        $query = "SELECT * FROM `Trip` WHERE `IsDeleted` = '0';"; 
        $resultArray = $this->repository->ExecuteQuery($query);
        return TripService::ResultToArray($resultArray); 
    }

    // @inheritdoc
    public function GetTripTotals()
    {
        $query = "SELECT t.`ID`, t.`Name`, COUNT(l.`ID`) AS Total 
                    FROM `Trip` t 
                    INNER JOIN `Location` l ON t.ID = l.TripID 
                    GROUP BY t.`ID` 
                    ORDER BY t.`Name`;";
                    
        return $this->repository->ExecuteQuery($query); 
    }

    /*
        Converts a result set to an array of Trip objects
        @param resultSet resultset to convert into an array of objects
    */
    public static function ResultToArray($resultSet)
    {
        $trips = [];
        foreach ($resultSet as $row)
        {
            $currentTrip = new \entities\Trip();
            $currentTrip->ID = $row[0];
            $currentTrip->Name = $row[1];
            $trips[] = $currentTrip;
        }
       return $trips;
    }
}
?>