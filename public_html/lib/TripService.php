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

    public function Create($toCreate)
    {
       exit("not implemented");
    }

    public function Get($ID)
    {
       $resultArray = $this->repository->ExecuteQuery("SELECT * FROM Trip");
       $trips = [];
       foreach ($resultArray as $row)
       {
           $currentTrip = new \entities\Trip();
           $currentTrip->ID = $row[0];
           $currentTrip->Name = $row[1];
           $trips[] = $currentTrip;
       }

       return $trips;
    }

    public function Update($toUpdate)
    {
        exit("not implemented");
    }

    public function Delete($toDelete)
    {
        exit("not implemented");
    }
}
?>