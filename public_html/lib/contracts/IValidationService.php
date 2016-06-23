<?php 
namespace contracts; 

/*
    Contract for validating data
*/
interface IValidationService 
{
    /*
        Checks if a string is in proper UUID format
        @param $UUID string to check
        @return flag indicating if the string is in proper uuid format 
    */
    public function checkUUID($UUID); 
}
?>