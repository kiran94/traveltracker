<?php
namespace dataaccess;
require_once 'IRepository.php';
use contracts;

/*
    Repository implementation
*/
class Repository implements \contracts\IRepository
{
    /*
    *   Database Connection
    */
    private $connection;

    /* Logger Service */
    private $logger; 

    /*
        Initialises a new instance of the Repository class
    */
    public function __construct($connection, $logger)
    {
        $this->connection = $connection->getConnection();
        $this->logger = $logger; 
    }

    // @inheritdoc
    public function ExecuteQuery($query)
    {
        $this->logger->trace(sprintf("Executing Query: %s", $query)); 

        $result = mysqli_query($this->connection, $query);
        $set = [];
        while ($row = mysqli_fetch_array($result))
        {
            $set[] = $row;
        }

        return $set;
    }

    // @inheritdoc
    public function ExecuteCommand($command)
    {
        $this->logger->trace(sprintf("Executing Command: %s", $command)); 
        return mysqli_query($this->connection, $query); 
    }
}
?>
