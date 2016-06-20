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

    /*
        Initialises a new instance of the Repository class
    */
    public function __construct($connection)
    {
        $this->connection = $connection;
    }

    public function ExecuteQuery($query)
    {
        $result = mysqli_query($this->connection, $query);
        $set = [];
        while ($row = mysqli_fetch_array($result))
        {
            $set[] = $row;
        }

        return $set;
    }
}
?>
