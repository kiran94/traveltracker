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
    */
    public function __construct($Repository, $Logger)
    {
        $this->repository = $Repository;
        $this->logger = $Logger;
    }

     // @inheritdoc
    public function Create($toCreate)
    {
        $query = "INSERT INTO Trip VALUES(%s, %s, %s);"; 
        $query = sprintf($query, $toCreate->ID, $toCreate->Name, "0"); 

        return $this->repository->ExecuteCommand($query); 
    }

     // @inheritdoc
    public function Get($ID)
    {
        $query = "SELECT * FROM Trip WHERE ID = '%s' and IsDeleted = '%s';"; 
        $query = sprintf($query, $ID, "0"); 
        $resultArray = $this->repository->ExecuteQuery($query);

        if (count($resultArray) >= 0)
        {
            return $this->ResultToArray($resultArray)[0]; 
        }
       
        return false; 
    }

     // @inheritdoc
    public function Update($toUpdate)
    {
        $query = "UPDATE Trip SET Name ='%s' WHERE ID = '%s'"; 
        $query = sprintf($query, $toUpdate->Name, $toUpdate->ID); 

        return $this->repository->ExecuteCommand($query); 
    }

     // @inheritdoc
    public function Delete($toDelete)
    {
        /// need soft delete flag
        exit("not implemented");
    }

     // @inheritdoc
    public function GetAll()
    {
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