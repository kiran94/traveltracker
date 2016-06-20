<?php 
namespace contracts; 

/*
    Configuration Service for reading the config file
*/
interface IConfigurationService
{
    /*
        Gets a configuration value according to a key
        @param $key key to get config value for
        @param $defaultVal default value if the config cannot be found
    */
    public function Get($key, $defaultVal); 
}
?>