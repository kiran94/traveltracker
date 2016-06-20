<?php
namespace contracts;

/*
   Contact for Trip entity operations
*/
interface ITripService
{
    /*
        Retrieves a single Trip object according to the ID
        @param $ID id of the entity
    */
    public function Get($ID);

    /*
        Creates a new Trip Entity in the database
        @param $toCreate Trip Entity to create
    */
    public function Create($toCreate);

    /*
        Updates an existing entity in the database
        @param $toUpdate Trip to update 
    */
    public function Update($toUpdate);

    /*
        Deletes a trip entity 
        @param $toDelete Trip to delete
    */
    public function Delete($toDelete);

    /*
        Gets all Trips in the database
    */
    public function GetAll(); 
}
?>