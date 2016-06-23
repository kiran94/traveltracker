<?php 
namespace services; 

require_once 'contracts/IValidationService.php'; 

/*
    Service for data validation
*/
class ValidationService implements \contracts\IValidationService
{
     // @inheritdoc
     public function checkUUID($UUID)
     {
         if ($UUID == null)
         {
             return false; 
         }

         $UUID = trim($UUID); 
         $uuidRegex = "/[a-z0-9]{8}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{4}-[a-z0-9]{12}/"; 
         $matchResult = preg_match($uuidRegex, $UUID);

         return ($matchResult == 1) ? true : false; 
     }
}
?>