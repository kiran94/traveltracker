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

     // @inheritdoc
     public function getGUID()
     {
        if (function_exists('com_create_guid'))
        {
            return com_create_guid();
        }
        else
        {
            mt_srand((double)microtime()*10000);//optional for php 4.2.0 and up.
            $charid = strtoupper(md5(uniqid(rand(), true)));
            $hyphen = chr(45);// "-"
            $uuid = //chr(123)// "{"
                substr($charid, 0, 8).$hyphen
                .substr($charid, 8, 4).$hyphen
                .substr($charid,12, 4).$hyphen
                .substr($charid,16, 4).$hyphen
                .substr($charid,20,12);
                //.chr(125);// "}"
            return strtolower($uuid); 
        }
    }
}
?>