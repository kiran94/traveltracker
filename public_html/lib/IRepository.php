<?php
namespace contracts;

/*
    Contract for data access to the database
*/
interface IRepository
{
    /*
    *   Executes a query on the database 
    *   @param query: query to execute
    *   @return resultset of the query
    */
    public function ExecuteQuery($query);

    /*
    *   Executes a command on the database where a resultset is not required 
    *   @param command: command to execute against the database 
    *   return bool indicating if the command executed succcessfully 
    */
    public function ExecuteCommand($command); 
}
?>