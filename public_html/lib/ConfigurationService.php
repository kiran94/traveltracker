<?php 
namespace services; 

require_once 'IConfigurationService.php'; 

/*
    Configuration Service for reading config values
*/
class ConfigurationService implements \contracts\IConfigurationService
{
    /*
        Configuration Lookup
    */
    private $configLookup; 

    /* 
        Initialises a new instance of the Configuration Service class
    */
    public function __construct($fileLocation)
    {
        $this->configLookup = parse_ini_file($fileLocation); 
    }

    // @inheritdoc
    public function Get($key, $defaultVal)
    {
        if (array_key_exists($key, $this->configLookup))
        {
            return $this->configLookup[$key]; 
        }

        return $defaultVal; 
    }
}
?>