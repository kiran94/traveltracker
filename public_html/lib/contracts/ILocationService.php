<?php 
namespace contracts; 

/*
    Contract for Location Service
*/
interface ILocationService 
{
    /* 
        Creates a new Location Entity
    */
    public function Create($toCreate); 

    /*
        Gets a Location Entity according to an ID 
    */
    public function Get($ID); 

    /*
        Updates an existing Location Entity
    */
    public function Update($toUpdate); 

    /*
        Soft deletes a Location Entity
    */
    public function Delete($toDelete); 

    /*
        Gets all Locations for a given trip ID 
    */
    public function GetLocationsFromTrip($TripID); 
}
?>