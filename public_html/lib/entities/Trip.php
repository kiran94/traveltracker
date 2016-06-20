<?php 
namespace entities; 

/*
    Encapsualtes the information for a Trip Entity
*/
class Trip 
{
    /*
        uniquely identifies a trip 
    */
    public $ID; 

    /*
        name of the trip
    */
    public $Name; 

    /*
        flag indicating if a trip has been soft deleted
    */
    public $IsDeleted; 
}
?>