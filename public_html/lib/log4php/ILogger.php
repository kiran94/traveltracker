<?php 
namespace contracts; 

/*
    Contract for the Logger
*/
interface ILogger 
{
    /*
        Logs a Trace level Log
        @param $message message to log
    */
    public function trace($message); 
    
    /*
        Logs a Debug level Log
        @param $message message to log
    */
    public function debug($message); 

    /*
        Logs a Info level Log
        @param $message message to log
    */
    public function info($message); 
    
    /*
        Logs a Warn level Log
        @param $message message to log
    */
    public function warn($message); 

    /*
        Logs a Error level Log
        @param $message message to log
    */
    public function error($message); 

    /*
        Logs a Fatal level Log 
        @param $message message to log
    */
    public function fatal($message); 
}
?>