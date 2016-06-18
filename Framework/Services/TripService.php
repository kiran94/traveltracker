<?php 

namespace TravelTracker\Framework\Services; 

//use TravelTracker\Framework\Contracts; 
require_once("../Contracts/ITripService.php"); 
use TravelTracker\Dataaccess\Entity as Trip; 

/*
    Trip Service for operations on the Trip Entity
*/
class TripService implements ITripService 
{
    /*
        Logging Service
    */
    private $Logger; 

    /*
        Trip Query Object
    */
    private $TripQuery; 

    /*
        Initialises a new instance of the TripService class 
    */
    public function __construct($TripQuery, $Logger)
    {
        $this->logger = $Logger;
        $this->TripQuery = $TripQuery;  
    }

    public function Create($toCreate)
    {
        $toCreate->save(); 
    }

    public function Get($ID)
    {
        return $TripQuery->findPK($ID);
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