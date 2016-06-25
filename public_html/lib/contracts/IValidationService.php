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

    /*
        Generates a GUID, COM is not supported 
        http://tutsnare.com/how-to-create-guid-in-php/
        slightly modified from above reference to fit format of this application
        @return unique guid 
    */
    public function getGUID();
}
?>