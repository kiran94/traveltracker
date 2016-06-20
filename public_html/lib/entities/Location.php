<?php 
namespace entities; 

/*
    Encapsulates information for a location object
*/
class Location 
{
    /* Unique identifier for Location */
    public $ID; 

    /* Latitude of the Location */
    public $Lat; 

    /* Longitude of the Location */
    public $Long; 

    /* Label of the Location */
    public $Name; 

    /* Date of the Location (timestamp) */
    public $Date;

    /* Flag indicating if the Location is deleted or not */ 
    public $IsDeleted; 

    /* Trip object this is related too */
    public $TripID; 
}
?>