<?php
namespace services;

require_once 'Repository.php';
require_once 'ITripService.php';
require_once 'entities/Trip.php'; 

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
        $this->logger->debug(sprintf("Creating Trip %s", $toCreate->ID)); 

        $query = "INSERT INTO Trip VALUES(%s, %s, %s);"; 
        $query = sprintf($query, $toCreate->ID, $toCreate->Name, "0"); 

        return $this->repository->ExecuteCommand($query); 
    }

     // @inheritdoc
    public function Get($ID)
    {
        $this->logger->debug(sprintf("Retrieving Trip %s", $ID)); 

        $query = "SELECT * FROM Trip WHERE ID = '%s' and IsDeleted = '%s';"; 
        $query = sprintf($query, $ID, "0"); 
        $resultArray = $this->repository->ExecuteQuery($query);
        
        if (count($resultArray) > 0)
        {
            return $this->ResultToArray($resultArray)[0]; 
        }

        $this->logger->warn(sprintf("Trip %s not found", $ID));
        return false; 
    }

     // @inheritdoc
    public function Update($toUpdate)
    {
        $this->logger->debug(sprintf("Updating Trip %s", $toUpdate->ID)); 

        $query = "UPDATE Trip SET Name ='%s' WHERE ID = '%s'"; 
        $query = sprintf($query, $toUpdate->Name, $toUpdate->ID); 

        return $this->repository->ExecuteCommand($query); 
    }

     // @inheritdoc
    public function Delete($toDelete)
    {
        $this->logger->debug(sprintf("soft deleting Trip %s", $toDelete->ID)); 
        exit("not implemented");
    }

     // @inheritdoc
    public function GetAll()
    {
        $this->logger->debug("Retrieving all Trips"); 

        $query = "SELECT * FROM Trip WHERE IsDeleted = '0';"; 
        $resultArray = $this->repository->ExecuteQuery($query);
        return $this->ResultToArray($resultArray); 
    }

    /*
        Converts a result set to an array of Trip objects
        @param resultSet resultset to convert into an array of objects
    */
    private function ResultToArray($resultSet)
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