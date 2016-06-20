<?php 
namespace dataaccess; 

/*
    Connection class opens connection to the database and stores
*/
class Connection
{
    /* Configuration Service */
    private $configService;

    /* Logger Service */
    private $logger; 

    /*
        Stores the mysql connection
    */
    private $connection = null; 

    /*
        Initialises a new instance of the connection class
    */
    public function __construct($configService, $loggerService)
    {
        $this->configService = $configService; 
        $this->logger = $loggerService; 
    }

    /*
        Opens a connection from config values, if already exists returns existing
        return mysqlconnection 
    */
    public function getConnection()
    {
        /// read config values and open connection
        if ($this->connection == null)
        {
            $con = mysqli_connect(
                $this->configService->Get("host", "localhost") . ":" . $this->configService->Get("port", "8889"),
                $this->configService->Get("username", "root"), 
                $this->configService->Get("password", "root"), 
                $this->configService->Get("database", "traveltracker")
            ); 

            if(!$con)
            {
                $this->logger->error(mysqli_connect_error);
                exit("cannot connect to database"); 
            }

            $this->connection = $con;
        }

        $this->logger->debug("connected to database"); 
        return $this->connection; 
    }
}
?>