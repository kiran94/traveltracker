<?php 
namespace services; 

require_once 'contracts/ILocationService.php'; 
require_once 'entities/Location.php'; 

/* Location Service for operations on the Location Entity  */
class LocationService implements \contracts\ILocationService
{
    /* Repository Instance */
    private $repository; 

    /* Logger Instance */
    private $logger; 
    
    /*
        Initialises a new instance of the LocationService class
        @param $repository class for interfacing with the database
        @param $logger logger service
    */
    public function __construct($repository, $logger)
    {
        $this->repository = $repository; 
        $this->logger = $logger; 
    }

    // @inheritdoc
    public function Create($toCreate)
    {
        if ($toCreate == null)
        {
            $this->logger->warn("location entity to create is null"); 
            return false; 
        }

        $this->logger->debug(sprintf("Created Location %s", $toCreate->ID)); 
        $query = "INSERT INTO `Location` VALUES('%s', '%s', '%s', '%s', '%s', '%s', '%s');"; 
        $query = sprintf(
            $query, 
            $toCreate->ID, 
            $toCreate->Lat, 
            $toCreate->Long, 
            $toCreate->Name, 
            $toCreate->Date, 
            $toCreate->IsDeleted, 
            $toCreate->TripID); 

        return $this->repository->ExecuteCommand($query);
    }
    
    // @inheritdoc
    public function Get($ID)
    {
        if ($ID == null)
        {
            $this->logger->warn("Location ID is null"); 
            return false; 
        }

        $this->logger->debug(sprintf("Retrieving Location %s", $ID)); 
        $query = "SELECT * FROM `Location` WHERE `ID` = '%s'"; 
        $query = sprintf($query, $ID); 

        $resultArray = $this->repository->ExecuteQuery($query); 

        if (count($resultArray) > 0)
        {
            return LocationService::ResultToArray($resultArray)[0]; 
        }

        $this->logger->debug(sprintf("Cannot find Location %s", $ID)); 
        return false; 
    }

    // @inheritdoc
    public function Update($toUpdate)
    {
        if ($toUpdate == null)
        {
            $this->logger->warn("location entity to update is null"); 
            return false; 
        }

        $this->logger->debug(sprintf("Updating Location %s", $toUpdate->ID)); 
        $query = "UPDATE `Location` SET `Lat` = %s AND `Long` = %s AND `Name` = %s AND `Date` = %s AND `IsDeleted` = %s AND `TripID` = %s WHERE `ID` = %s;"; 
        $query = sprintf($query, $toUpdate->Lat, $toUpdate->Long, $toUpdate->Name, $toUpdate->Date, $toUpdate->IsDeleted, $toUpdate->TripID, $toUpdate->ID); 

        return $this->repository->ExecuteCommand($query);
    }

    // @inheritdoc
    public function Delete($toDelete)
    {
        if ($toDelete == null)
        {
            $this->logger->warn("location entity to delete is null"); 
            return false; 
        }

        if($toDelete->IsDeleted)
        {
            $this->logger->debug(sprintf("Location Entity %s is already deleted", $toDelete->ID)); 
            return false; 
        }

        $this->logger->debug(sprintf("Soft Deleting Location %s", $toDelete->ID)); 

        $query = "UPDATE `Location` SET `IsDeleted` = '%s' WHERE `ID` = %s"; 
        $query = sprintf($query, "1", $toDelete->ID); 

        return $this->repository->ExecuteCommand($query);
    }

    // @inheritdoc
    public function GetLocationsFromTrip($TripID)
    {
        if($TripID == null)
        {
            $this->logger->warn("trip id is null");
            return false;  
        }

        $this->logger->debug(sprintf("Retrieving all Locations for Trip %s", $TripID)); 

        $query = "SELECT * FROM `Location` WHERE `TripID` = '%s' AND `IsDeleted` = '%s'"; 
        $query = sprintf($query, $TripID, "0"); 

        $resultArray = $this->repository->ExecuteQuery($query); 
        return LocationService::ResultToArray($resultArray); 
    }

     /*
        Converts a result set to an array of Location objects
        @param resultSet resultset to convert into an array of objects
    */
    public static function ResultToArray($resultSet)
    {
        $locations = [];
        foreach ($resultSet as $row)
        {
            $currentLocation = new \entities\Location();
            $currentLocation->ID = $row[0];
            $currentLocation->Lat = $row[1];
            $currentLocation->Long = $row[2];
            $currentLocation->Name = $row[3];
            $currentLocation->Date = $row[4];
            $currentLocation->IsDeleted = $row[5];
            $currentLocation->TripID = $row[6];

            $locations[] = $currentLocation;
        }

       return $locations;
    }
}
?>