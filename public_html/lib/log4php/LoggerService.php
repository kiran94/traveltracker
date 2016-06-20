<?php 
namespace services; 

require_once 'ILogger.php'; 
require_once 'log4php/Logger.php'; 

/*
    log4PHP wrapper class
*/
class LoggerService implements \contracts\ILogger
{
    /*
        Log4PHP instance
    */
    private $logger; 

    /*
        Initialises a new instance of the Logger 
        @param $configService configuration service
    */
    public function __construct($configService)
    {
        $configLocation = $configService->Get("loggerConfig", "config.xml"); 
        $loggerName = $configService->Get("loggerName", "main"); 

        \Logger::configure($configLocation); 
        $this->logger = \Logger::getLogger($loggerName); 
    }
    
    // @inheritdoc
    public function trace($message)
    {
        $this->logger->trace($message); 
    }
    
    // @inheritdoc
    public function debug($message)
    {
        $this->logger->debug($message); 
    }

    // @inheritdoc
    public function info($message)
    {
        $this->logger->info($message); 
    }

    // @inheritdoc
    public function warn($message)
    {
        $this->logger->warn($message); 
    }

    // @inheritdoc
    public function error($message)
    {
        $this->logger->error($message); 
    }

    // @inheritdoc
    public function fatal($message)
    {
        $this->logger->fatal($message); 
    }
}
?>