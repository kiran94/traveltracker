<?php 

namespace TravelTracker\Framework\Contacts; 

/*
   Contact for Trip entity operations  
*/
interface ITripService 
{
    public function Get($ID); 

    public function Create($toCreate); 

    public function Update($toUpdate); 

    public function Delete($toDelete); 
}
?>